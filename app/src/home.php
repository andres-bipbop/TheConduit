<?php
if (!isset($_COOKIE['jwtRefresh'])) {
    header("location: loginForm.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
  <title>The Conduit · Home</title>
  <!-- Google Fonts Inter (300, 500, 800) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,500;14..32,800&display=swap" rel="stylesheet">
  <script src="../config/config.js"></script>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'electric-blue': '#0b06ff',
          },
          fontFamily: {
            'sans': ['Inter', 'sans-serif'],
          },
          fontWeight: {
            'light': 300,
            'medium': 500,
            'extrabold': 800,
          }
        }
      }
    }
  </script>
  <style>
    .inter-medium { font-family: 'Inter', sans-serif; font-weight: 500; }
    .inter-bold { font-family: 'Inter', sans-serif; font-weight: 800; }
    .inter-normal { font-family: 'Inter', sans-serif; font-weight: 300; }
    .custom-scroll::-webkit-scrollbar { width: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 10px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #a0a0a0; }
    .sidebar-height { max-height: calc(100vh - 8rem); }
    .skeleton {
      background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
      background-size: 200% 100%;
      animation: shimmer 1.5s infinite;
    }
    @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
  </style>
</head>

<!-- MODALE CREAZIONE POST -->
<div id="create-post-modal" class="fixed inset-0 z-[60] flex items-center justify-center bg-black/50 backdrop-blur-sm hidden">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl mx-4 p-6 relative max-h-[90vh] overflow-y-auto custom-scroll">
    <!-- Intestazione -->
    <div class="flex justify-between items-center mb-5">
      <h2 class="text-xl font-extrabold text-gray-900">Crea un nuovo post</h2>
      <button id="close-modal-btn" class="text-gray-400 hover:text-gray-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Form -->
    <form id="create-post-form" class="space-y-5">
      <!-- Titolo -->
      <div>
        <label for="post-title" class="block text-sm font-medium text-gray-700 mb-1">Titolo *</label>
        <input type="text" id="post-title" name="title" required
               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-electric-blue focus:border-transparent outline-none transition">
      </div>

      <!-- Descrizione -->
      <div>
        <label for="post-description" class="block text-sm font-medium text-gray-700 mb-1">Descrizione</label>
        <textarea id="post-description" name="description" rows="4"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-electric-blue focus:border-transparent outline-none transition resize-none"></textarea>
      </div>

      <!-- Caricamento immagini -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Immagini (max 5)</label>
        <div class="flex flex-wrap gap-2 mb-2" id="image-preview-container">
          <!-- Le anteprime appariranno qui -->
        </div>
        <input type="file" id="post-images" accept="image/*" multiple
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-electric-blue file:text-white hover:file:bg-blue-700 transition"/>
        <p class="text-xs text-gray-400 mt-1">Puoi caricare fino a 5 immagini.</p>
      </div>

      <!-- Pulsanti -->
      <div class="flex justify-end space-x-3 pt-2">
        <button type="button" id="cancel-btn"
                class="px-5 py-2.5 text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition font-medium">
          Annulla
        </button>
        <button type="submit"
                class="px-5 py-2.5 bg-electric-blue text-white font-medium rounded-xl hover:bg-blue-700 transition shadow-sm">
          Pubblica
        </button>
      </div>
    </form>
  </div>
</div>

<!-- HOMEPAGE -->
<body class="bg-white text-gray-800 font-sans antialiased">

  <!-- ========== NAVBAR ========== -->
  <nav class="w-full h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 fixed top-0 left-0 z-50 shadow-sm">
    <div class="flex items-center space-x-2">
      <span class="text-2xl font-extrabold text-electric-blue tracking-tight">The Conduit</span>
    </div>
    <!-- Contenitore relativo per il dropdown -->
    <div class="relative" id="profile-dropdown-container">
      <button id="profile-button" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300 hover:ring-2 hover:ring-electric-blue transition focus:outline-none">
        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
        </svg>
      </button>

      <!-- Menu a tendina -->
      <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
        <button onclick="window.location.href='profile.php'" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition flex items-center space-x-3">
          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          <span>Vai al profilo</span>
        </button>
        <button onclick="window.location.href='settings.php'" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition flex items-center space-x-3">
          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <span>Impostazioni</span>
        </button>
        <hr class="my-1 border-gray-100">
        <button onclick="window.location.href='logout.php'" class="w-full text-left px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition flex items-center space-x-3">
          <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
          <span>Logout</span>
        </button>
      </div>
    </div>
  </nav>

  <div class="pt-16"></div>

  <!-- ========== LAYOUT PRINCIPALE ========== -->
  <div class="flex w-full max-w-7xl mx-auto px-4 gap-6 mt-4">
    <!-- Spaces -->
    <aside class="w-1/4 hidden lg:block">
      <div class="sticky top-20 bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sidebar-height overflow-y-auto custom-scroll">
        <h2 class="text-lg font-extrabold text-electric-blue mb-4">Spaces</h2>
        <button class="w-full bg-electric-blue text-white font-medium py-2.5 px-4 rounded-xl hover:bg-blue-700 transition-colors duration-200 mb-6 shadow-sm">
          + Crea nuovo Space
        </button>
        <div id="spaces-container" class="space-y-3">
          <div class="skeleton h-16 rounded-xl"></div>
          <div class="skeleton h-16 rounded-xl"></div>
          <div class="skeleton h-16 rounded-xl"></div>
        </div>
      </div>
    </aside>

    <!-- Feed -->
    <main class="w-full lg:w-2/4 flex flex-col gap-6">
      <div class="flex items-center justify-between">
        <!-- Contenitore dei tab -->
        <div class="flex p-1 bg-gray-100 rounded-xl">
          <button id="tab-feed"
                  class="px-5 py-2 text-sm font-medium rounded-lg transition-all duration-200
                        bg-white text-electric-blue shadow-sm">
            Il tuo feed
          </button>
          <button id="tab-myposts"
                  class="px-5 py-2 text-sm font-medium rounded-lg transition-all duration-200
                        text-gray-500 hover:text-gray-700">
            I tuoi post
          </button>
        </div>

        <button id="create-post-btn"
                class="bg-electric-blue text-white font-medium py-2.5 px-5 rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-sm flex items-center space-x-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          <span>Crea post</span>
        </button>
      </div>
      <div id="feed-container" class="flex flex-col gap-5">
        <!-- I post verranno iniettati qui via JavaScript -->
      </div>
    </main>

    <!-- Followed -->
    <aside class="w-1/4 hidden lg:block">
      <div class="sticky top-20 bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sidebar-height overflow-y-auto custom-scroll">
        <h2 class="text-lg font-extrabold text-electric-blue mb-4">Seguiti</h2>
        <div id="followed-container" class="space-y-3">
          <div class="skeleton h-14 rounded-xl"></div>
          <div class="skeleton h-14 rounded-xl"></div>
          <div class="skeleton h-14 rounded-xl"></div>
        </div>
      </div>
    </aside>
</div>

  <!-- INCLUSIONE CONFIGURAZIONE ESTERNA -->
  <script src="js/home.js"></script>

  <!-- GESTIONE MODALE CREAZIONE POST -->
  <script src="js/createPostModal.js"></script>

  <!-- FETCH & RENEW TOKEN -->
  <script src="js/fetch.js"></script>

  <!-- GESTIONE DROPDOWN PROFILO -->
  <script>
    const profileBtn = document.getElementById('profile-button');
    const profileDropdown = document.getElementById('profile-dropdown');

    profileBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      profileDropdown.classList.toggle('hidden');
    });

    // Chiudi il dropdown cliccando fuori
    document.addEventListener('click', (e) => {
      if (!profileDropdown.classList.contains('hidden')) {
        // Controlla se il click è fuori dal contenitore del dropdown
        const container = document.getElementById('profile-dropdown-container');
        if (!container.contains(e.target)) {
          profileDropdown.classList.add('hidden');
        }
      }
    });
  </script>

  <!-- Gestione tab Feed / Miei Post -->
  <script>
    const tabFeed = document.getElementById('tab-feed');
    const tabMyPosts = document.getElementById('tab-myposts');
    let currentTab = 'feed'; // 'feed' o 'myposts'

    function setActiveTab(tab) {
      if (tab === 'feed') {
        tabFeed.className = 'px-5 py-2 text-sm font-medium rounded-lg transition-all duration-200 bg-white text-electric-blue shadow-sm';
        tabMyPosts.className = 'px-5 py-2 text-sm font-medium rounded-lg transition-all duration-200 text-gray-500 hover:text-gray-700';
      } else {
        tabMyPosts.className = 'px-5 py-2 text-sm font-medium rounded-lg transition-all duration-200 bg-white text-electric-blue shadow-sm';
        tabFeed.className = 'px-5 py-2 text-sm font-medium rounded-lg transition-all duration-200 text-gray-500 hover:text-gray-700';
      }
      currentTab = tab;
      loadTabContent();
    }

    async function loadTabContent() {
      const userId = sessionStorage.getItem('id');
      if (!userId) return;

      try {
        if (currentTab === 'feed') {
          const feed = await apiFetch(APP_CONFIG.ENDPOINTS.posts.getCustomPosts(userId));
          renderFeed(feed);
        } else {
          const myPosts = await apiFetch(APP_CONFIG.ENDPOINTS.posts.getPostsByUser(userId));
          renderFeed(myPosts);
        }
      } catch (error) {
        console.error('Errore cambio tab:', error);
        document.getElementById('feed-container').innerHTML = '<p class="text-red-500 text-sm">Errore nel caricamento.</p>';
      }
    }

    tabFeed.addEventListener('click', () => setActiveTab('feed'));
    tabMyPosts.addEventListener('click', () => setActiveTab('myposts'));
  </script>

  <!-- ========== TEMPLATE E GESTIONE DINAMICA ========== -->
  <script>
    // ---------- TEMPLATE ----------
    function templatePost(post) {
      // Crea un array con i percorsi delle immagini, ma solo se esistono e non sono null/vuoti
      const mediaFields = [
        post.mediaFile_1,
        post.mediaFile_2,
        post.mediaFile_3,
        post.mediaFile_4,
        post.mediaFile_5
      ];
      
      // Filtra tenendo solo quelli che esistono, non sono null, non sono stringhe vuote e non sono la stringa "NULL"
      const validImages = mediaFields.filter(img => 
        img && img !== 'NULL' && img.trim() !== ''
      );
      
      // Aggiungi il prefisso del percorso base solo alle immagini valide
      const imageUrls = validImages.map(img => `${APP_CONFIG.PROGETTO}${img}`);
      
      // Se c'è una sola immagine, la mostriamo a larghezza piena con altezza automatica (max 384px)
      // Se ce ne sono più di una, creiamo una striscia orizzontale con miniature di altezza fissa (192px) e object-contain
      const galleria = imageUrls.length > 0 
        ? `<div class="mt-3 px-5">
            <div class="flex gap-2 ${imageUrls.length > 1 ? 'overflow-x-auto pb-2' : ''}">
              ${imageUrls.map(url => `
                <img src="${url}" alt="Immagine post" 
                    class="${imageUrls.length === 1 
                        ? 'w-full h-auto max-h-96 object-contain rounded-lg' 
                        : 'h-48 w-auto object-contain rounded-lg border border-gray-100'}">
              `).join('')}
            </div>
          </div>`
        : '';

      
      return `
        <article class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
          <div class="px-5 pt-5 pb-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-electric-blue bg-blue-50 px-3 py-1 rounded-full">${post.spaceName}</span>
          </div>
          <p class="px-5 text-sm text-gray-500 mt-1">di <span class="font-medium text-gray-700">${post.authorName}</span></p>
          <h2 class="px-5 text-xl font-extrabold text-gray-900 leading-snug">${post.postTitle}</h2>
          ${galleria}
          <p class="px-5 mt-3 text-gray-600 font-light text-sm leading-relaxed line-clamp-3">${post.postDescription || ''}</p>
          <div class="flex items-center space-x-6 px-5 py-4 mt-2 border-t border-gray-50 text-gray-500 text-sm">
            <button class="flex items-center space-x-2 hover:text-electric-blue transition-colors" data-post-id="${post.postId}" data-action="like">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
              <span>${post.postLikes || 0}</span>
            </button>
            <button class="flex items-center space-x-2 hover:text-electric-blue transition-colors" data-post-id="${post.postId}" data-action="comment">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
              <span>${post.totalComments || 0}</span>
            </button>
          </div>
        </article>
      `;
    }

    function templateSpace(space) {
      const iconHtml = space.iconUrl 
        ? `<img src="${space.iconUrl}" class="w-10 h-10 rounded-lg object-cover" alt="${space.name}">`
        : `<div class="w-10 h-10 bg-gradient-to-br from-electric-blue to-blue-400 rounded-lg flex items-center justify-center text-white font-bold text-sm">${space.name.charAt(0).toUpperCase()}</div>`;
      
      return `
        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors cursor-pointer">
          ${iconHtml}
          <div class="flex-1 min-w-0">
            <p class="font-medium text-gray-800 truncate">${space.name}</p>
            <p class="text-xs text-gray-500">${space.member_count || 0} membri</p>
          </div>
        </div>
      `;
    }

    function templateFollowed(user) {
      const avatar = user.avatarUrl || 'https://i.pravatar.cc/40?img=3';
      return `
        <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-xl transition-colors cursor-pointer">
          <div class="flex items-center space-x-3 min-w-0">
            <img src="${avatar}" alt="${user.username}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
            <div class="min-w-0">
              <p class="font-medium text-gray-800 truncate text-sm">@${user.username}</p>
              <p class="text-xs text-gray-500 truncate">${user.name || ''}</p>
            </div>
          </div>
        </div>
      `;
    }

    // ---------- RENDER DOM ----------
    function renderSpaces(spacesArray) {
      const container = document.getElementById('spaces-container');
      if (!container) return;
      if (!spacesArray || spacesArray.length === 0) {
        container.innerHTML = '<p class="text-gray-400 text-sm text-center py-4">Nessuno spazio ancora.</p>';
        return;
      }
      container.innerHTML = spacesArray.map(space => templateSpace(space)).join('');
    }

    function renderFeed(postsArray) {
      const container = document.getElementById('feed-container');
      if (!container) return;
      if (!postsArray || postsArray.length === 0) {
        container.innerHTML = '<p class="text-gray-400 text-center py-8">Nessun post da mostrare.</p>';
        return;
      }
      container.innerHTML = postsArray.map(post => templatePost(post)).join('');
      
      container.querySelectorAll('[data-action="like"]').forEach(btn => {
        btn.addEventListener('click', () => {
          const postId = btn.dataset.postId;
          alert(`Hai messo like al post ${postId} (funzionalità da implementare)`);
        });
      });
      container.querySelectorAll('[data-action="comment"]').forEach(btn => {
        btn.addEventListener('click', () => {
          const postId = btn.dataset.postId;
          alert(`Apri commenti per il post ${postId} (funzionalità da implementare)`);
        });
      });
    }

    function renderFollowed(usersArray) {
      const container = document.getElementById('followed-container');
      if (!container) return;
      if (!usersArray || usersArray.length === 0) {
        container.innerHTML = '<p class="text-gray-400 text-sm text-center py-4">Non segui nessuno.</p>';
        return;
      }
      container.innerHTML = usersArray.map(user => templateFollowed(user)).join('');
    }

    // ---------- CARICAMENTO DATI ----------
    async function loadAllData(userId) {
      try {
        const [spaces, followed] = await Promise.all([
          apiFetch(APP_CONFIG.ENDPOINTS.users.getUserSpaces(userId)),
          apiFetch(APP_CONFIG.ENDPOINTS.users.getUserFollowers(userId)),
        ]);
        
        renderSpaces(spaces);
        renderFollowed(followed);
      } catch (error) {
        console.error('Caricamento dati fallito:', error);
        document.getElementById('spaces-container').innerHTML = '<p class="text-red-500 text-sm">Errore nel caricamento.</p>';
        document.getElementById('followed-container').innerHTML = '<p class="text-red-500 text-sm">Errore nel caricamento.</p>';
      }
    }

    // ---------- AVVIO ----------
    document.addEventListener('DOMContentLoaded', () => {
      const userId = sessionStorage.getItem("id");
      const username = sessionStorage.getItem("username");
      const email = sessionStorage.getItem("email");
      loadAllData(userId);
      setActiveTab('feed');
    });

  </script>
</body>
</html>