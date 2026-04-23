const APP_CONFIG = (() => {
	const APP_ORIGIN = window.location.origin;
	const WEBSITE_BASE_PATH = "/website";
	const APP_BASE_PATH = `${WEBSITE_BASE_PATH}/progetto/app`;
	const API_BASE_PATH = `${WEBSITE_BASE_PATH}/progetto/api`;

	const APP_BASE_URL = `${APP_ORIGIN}${APP_BASE_PATH}`;
	const API_BASE_URL = `${APP_ORIGIN}${API_BASE_PATH}`;

	const ENDPOINTS = {
		credentials: {
			login: `${API_BASE_URL}/credentials/login`
		},
		token: {
			refresh: `${API_BASE_URL}/token/refresh`,
			verifyAccess: `${API_BASE_URL}/token/verify-access`,
			verifyRefresh: `${API_BASE_URL}/token/verify-refresh`
		},
		users: {
			getUserLoginData: (username) => `${API_BASE_URL}/users/getUserLoginData/${encodeURIComponent(username)}`,
			getUserSpaces: (id) => `${API_BASE_URL}/users/getUserSpaces/${id}`,
			getUserInterests: (id) => `${API_BASE_URL}/users/getUserInterests/${id}`,
			getUserFollowers: (id) => `${API_BASE_URL}/users/getUserFollowers/${id}`
		},
		app: {
			getArguments: (id) => `${API_BASE_URL}/app/getArguments/${id}`
		},
		posts: {
			getCustomPosts: (id) => `${API_BASE_URL}/posts/getCustomPosts/${id}`,
			getFollowedFeed: (id) => `${API_BASE_URL}/posts/getFollowedFeed/${id}`,
			getPostsByUser: (id) => `${API_BASE_URL}/posts/getPostsByUser/${id}`,
			getPostsBySpace: (id) => `${API_BASE_URL}/posts/getPostsBySpace/${id}`
		},
		spaces: {
			createSpace: `${API_BASE_URL}/spaces/createSpace`,
			getMembers: (id) => `${API_BASE_URL}/spaces/getMembers/${id}`
		},
		comments: {
			getCommentsByPost: (id) => `${API_BASE_URL}/comments/getCommentsByPost/${id}`,
			createComment: `${API_BASE_URL}/comments/createComment`
		}
	};

	return Object.freeze({
		APP_ORIGIN,
		WEBSITE_BASE_PATH,
		APP_BASE_PATH,
		APP_BASE_URL,
		API_BASE_PATH,
		API_BASE_URL,
		ENDPOINTS
	});
})();

window.APP_CONFIG = APP_CONFIG;
