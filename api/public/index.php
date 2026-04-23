<?php
	require __DIR__ . "/../auth/TokenService.php";
    require __DIR__ . "/../endpoints/UsersEndpoints.php";
    require __DIR__ . "/../endpoints/AppEndpoints.php";
    require __DIR__ . "/../endpoints/PostEndpoints.php";
    require __DIR__ . "/../endpoints/SpaceEndpoints.php";
    require __DIR__ . "/../endpoints/CommentEndpoints.php";

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type");

    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    $requestMethod = $_SERVER["REQUEST_METHOD"];
	$request = $_SERVER["REQUEST_URI"];
    $segments = explode('/', trim($request, "/"));

    // Trova dove inizia "api"
    $apiIndex = array_search("api", $segments);

    if ($apiIndex !== false) {
        // Taglia tutto prima di "api"
        $segments = array_slice($segments, $apiIndex + 1);
    }

    //ottenere tutti gli header
    $headers = getallheaders();
    //authHeader[0] = tipo ---- authHeader[1] = token
    if (isset($headers['Authorization'])) {
        $authHeader = explode(' ', $headers['Authorization'], 2);
    }
    else {
        $authHeader = [null, null];
    }

    function authorizeRequest($headers, $authHeader) {
        if (!isset($headers['Authorization']) || $headers['Authorization'] == null) {
            http_response_code(401);
            echo json_encode(["error" => "Auth error", "message" => "Missing authorization header."]);
            exit;
        }

        if ($authHeader[0] !== 'Bearer') {
            http_response_code(401);
            echo json_encode(["error" => "Auth error", "message" => "Invalid token type."]);
            exit;
        }
    }

    // -- INIZIO GESTIONE ENDPOINT PER VERIFICA CREDENZIALI -- //

    function verifyUserPassword(string $storedPassword, string $plainPassword): bool {
        $parts = explode('.', $storedPassword, 2);
        if (count($parts) !== 2) {
            return false;
        }

        $salt = $parts[0];
        $hash = $parts[1];
        $candidateHash = hash("sha256", $salt . $plainPassword . LOGIN_SECRET_PEPPER);

        return hash_equals($hash, $candidateHash);
    }

    if ($segments[0] == 'credentials') {
        if ($segments[1] == 'login') {
            $username = $data["username"] ?? null;
            $password = $data["password"] ?? null;

            if (!$username || !$password) {
                http_response_code(400);
                echo json_encode(["error" => "Bad request", "message" => "Username and password are required."]);
                exit;
            }

            try {
                $usersEndpoints = new UsersEndpoints();
                $userLoginData = $usersEndpoints->getUserLoginData($username);

                if (!$userLoginData) {
                    http_response_code(404);
                    echo json_encode(["error" => "Not found", "message" => "User not found."]);
                    exit;
                }

                if (($userLoginData["status"] ?? null) !== "active") {
                    http_response_code(403);
                    echo json_encode(["error" => "Forbidden", "message" => "Account not verified."]);
                    exit;
                }

                if (!verifyUserPassword($userLoginData["password"], $password)) {
                    http_response_code(401);
                    echo json_encode(["error" => "Unauthorized", "message" => "Invalid credentials."]);
                    exit;
                }

                $tokenService = new TokenService();
                $refreshToken = $tokenService->generateRefreshToken($userLoginData["username"], $userLoginData["id"]);
                $accessToken = $tokenService->generateAccessToken($userLoginData["username"], $userLoginData["id"]);

                setcookie("jwtAccess", $accessToken, [
                    "expires" => time() + 600,
                    "path" => "/",
                    "httponly" => true,
                    "samesite" => "Lax"
                ]);

                setcookie("jwtRefresh", $refreshToken, [
                    "expires" => time() + 604800,
                    "path" => "/",
                    "httponly" => true,
                    "samesite" => "Lax"
                ]);

                http_response_code(200);
                echo json_encode([
                    "message" => "Login successful.",
                    "accessToken" => $accessToken,
                    "refreshToken" => $refreshToken
                ]);
            }
            catch (Exception $e) {
                http_response_code(500);
                echo json_encode(["error" => "Internal error", "message" => $e->getMessage()]);
            }
            exit;
        }

        http_response_code(404);
        echo json_encode(["error" => "Not found", "message" => "Credentials endpoint not found."]);
        exit;
    }

    // -- FINE GESTIONE ENDPOINT PER VERIFICA CREDENZIALI -- //

    // -- INIZIO GESTIONE ENDPOINT PER CREAZIONE E VERIFICA TOKEN JWT -- //

    if ($segments[0] == 'token') {
        if ($segments[1] == 'refresh') {
            $username = $data["username"] ?? null;
            $id = $data["id"] ?? null;
            try {
                $tokenService = new TokenService();
                $refreshToken = $tokenService->generateRefreshToken($username, $id);
                http_response_code(200);
                echo json_encode(["refreshToken" => $refreshToken]);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
                exit;
            }
        }
        //verify-access per accedere alle risorse dell'applicazione
        else if ($segments[1] == 'verify-access') {
            try {
                $tokenService = new TokenService();
                $userdata = $tokenService->validateAccessToken($authHeader[1]);
                http_response_code(200);
                echo json_encode(["message" => "Access token is valid.", "userdata" => $userdata]);
            }
            catch (Exception $e) {
                http_response_code(401);
                echo json_encode(["error" => "Auth error", "message" => $e->getMessage()]);
                exit;
            }
        }
        //verify-refresh per ottener nuovo access token
        else if ($segments[1] == 'verify-refresh') {
            try {
                $tokenService = new TokenService();
                $userdata = $tokenService->validateRefreshToken($authHeader[1]);
                $accessToken = $tokenService->generateAccessToken($userdata->username, $userdata->id);
                http_response_code(200);
                echo json_encode(["accessToken" => $accessToken, "userdata" => $userdata]);
            }
            catch (Exception $e) {
                http_response_code(401);
                echo json_encode(["error" => "Auth error", "message" => $e->getMessage()]);
                exit;
            }
        }
    }

    // -- FINE GESTIONE ENDPOINT PER CREAZIONE E VERIFICA TOKEN JWT -- //

    // -- INIZIO GESTIONE ENDPOINT PER RICHIESTE DATABASE -- //

    if ($segments[0] == 'users') {
        if ($segments[1] == 'getUserLoginData') {
            $username = $segments[2];
            try {
                $usersEndpoints = new UsersEndpoints();
                $userLoginData = $usersEndpoints->getUserLoginData($username);
                http_response_code(200);
                echo json_encode($userLoginData);
            }
            catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
        else if ($segments[1] == 'getUserSpaces') {
            authorizeRequest($headers, $authHeader);
            $id = $segments[2];
            try {
                $usersEndpoints = new UsersEndpoints();
                $userSpaces = $usersEndpoints -> getUserSpaces($id);
                http_response_code(200);
                echo json_encode($userSpaces);
            }
            catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
        else if ($segments[1] == 'getUserInterests') {
            authorizeRequest($headers, $authHeader);
            $id = $segments[2];
            try {
                $usersEndpoints = new UsersEndpoints();
                $userInterests = $usersEndpoints->getUserInterests($id);
                http_response_code(200);
                echo json_encode($userInterests);
            }
            catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
        else if ($segments[1] == 'getUserFollowers') {
            authorizeRequest($headers, $authHeader);
            $id = $segments[2];
            try {
                $usersEndpoints = new UsersEndpoints();
                $userFollowers = $usersEndpoints->getUserFollowers($id);
                http_response_code(200);
                echo json_encode($userFollowers);
            }
            catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
    }

    if ($segments[0] == 'app') {
        if ($segments[1] == 'getArguments') {
            authorizeRequest($headers, $authHeader);
            $id = $segments[2] ?? null;
            try {
                $appEndpoints = new AppEndpoints();
                $arguments = $appEndpoints->getArguments($id);
                http_response_code(200);
                echo json_encode($arguments);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
    }

    if ($segments[0] == 'posts') {
        if ($segments[1] == 'getCustomPosts') {
            authorizeRequest($headers, $authHeader);
            $id = $segments[2];
            try {
                $postEndpoints = new PostEndpoints();
                $posts = $postEndpoints->getCustomPosts($id);
                http_response_code(200);
                echo json_encode($posts);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
        else if ($segments[1] == 'getFollowedFeed') {
            authorizeRequest($headers, $authHeader);
            $id = $segments[2];
            try {
                $postEndpoints = new PostEndpoints();
                $posts = $postEndpoints->getFollowedFeed($id);
                http_response_code(200);
                echo json_encode($posts);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
        else if ($segments[1] == 'getPostsByUser') {
            authorizeRequest($headers, $authHeader);
            $id = $segments[2] ?? null;
            try {
                $postEndpoints = new PostEndpoints();
                $posts = $postEndpoints->getPostsByUser($id);
                http_response_code(200);
                echo json_encode($posts);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
        else if ($segments[1] == 'getPostsBySpace') {
            authorizeRequest($headers, $authHeader);
            $id = $segments[2] ?? null;
            try {
                $postEndpoints = new PostEndpoints();
                $posts = $postEndpoints->getPostsBySpace($id);
                http_response_code(200);
                echo json_encode($posts);
            }
            catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
    }

    if ($segments[0] == 'spaces') {
        authorizeRequest($headers, $authHeader);
        if ($segments[1] == 'createSpace') {
            $name = $data["name"];
            $iconUrl = $data["iconUrl"];
            $bannerUrl = $data["bannerUrl"];
            $description = $data["description"];
            $maxMembers = $data["maxMembers"];

            try {
                $spaceEndpoints = new SpaceEndpoints();
                $spaceEndpoints->createSpace($name, $iconUrl, $bannerUrl, $description, $maxMembers);
                http_response_code(201);
                echo json_encode(["message" => "Space created successfully."]);
            }
            catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
        else if ($segments[1] == 'getMembers') {
            authorizeRequest($headers, $authHeader);
            $spaceId = $segments[2];
            try {
                $spaceEndpoints = new SpaceEndpoints();
                $members = $spaceEndpoints->getMembers($spaceId);
                http_response_code(200);
                echo json_encode($members);
            }
            catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
        }
    }

    if ($segments[0] == 'comments') {
        authorizeRequest($headers, $authHeader);
        if ($segments[1] == 'getCommentsByPost') {
            $postId = $segments[2];
            try {
                $commentEndpoints = new CommentEndpoints();
                $comments = $commentEndpoints->getCommentsByPost($postId);
                http_response_code(200);
                echo json_encode($comments);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }

        }
        if ($segments[1] == 'getCommentReplies') {
            authorizeRequest($headers, $authHeader);
            $commentId = $segments[2];
            try {
                $commentEndpoints = new CommentEndpoints();
                $replies = $commentEndpoints->getCommentReplies($commentId);
                http_response_code(200);
                echo json_encode($replies);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Internal error: ' . $e->getMessage()]);
            }
         }
    }
?>