const modal = document.getElementById('create-post-modal');
const openModalBtn = document.getElementById('create-post-btn');
const closeModalBtn = document.getElementById('close-modal-btn');
const cancelBtn = document.getElementById('cancel-btn');
const form = document.getElementById('create-post-form');
const imageInput = document.getElementById('post-images');
const previewContainer = document.getElementById('image-preview-container');

// File selezionati (per invio)
let selectedFiles = [];

// Apri modale
openModalBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
    resetForm();
});

// Chiudi modale
function closeModal() {
    modal.classList.add('hidden');
    resetForm();
}
closeModalBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);

// Chiudi cliccando fuori dal contenuto
modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
});

// Reset form e anteprime
function resetForm() {
    form.reset();
    selectedFiles = [];
    previewContainer.innerHTML = '';
}

// Gestione selezione immagini (anteprima e limite 5)
imageInput.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    
    // Limita a 5 totali (tra nuovi e già selezionati)
    const total = selectedFiles.length + files.length;
    if (total > 5) {
    alert('Puoi caricare massimo 5 immagini.');
    imageInput.value = ''; // reset input
    return;
    }

    // Aggiungi nuovi file
    selectedFiles = [...selectedFiles, ...files];
    renderPreviews();
    imageInput.value = ''; // resetta input per permettere nuova selezione
});

// Rimuovi un'immagine dall'anteprima
function removeImage(index) {
    selectedFiles.splice(index, 1);
    renderPreviews();
}

// Renderizza le anteprime
function renderPreviews() {
    previewContainer.innerHTML = '';
    selectedFiles.forEach((file, index) => {
    const reader = new FileReader();
    reader.onload = (e) => {
        const div = document.createElement('div');
        div.className = 'relative w-20 h-20 rounded-lg overflow-hidden border border-gray-200';
        div.innerHTML = `
        <img src="${e.target.result}" class="w-full h-full object-cover" alt="anteprima">
        <button type="button" class="absolute top-0.5 right-0.5 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600" data-index="${index}">&times;</button>
        `;
        previewContainer.appendChild(div);
        
        // Aggiungi evento rimuovi
        div.querySelector('button').addEventListener('click', (e) => {
        e.stopPropagation();
        removeImage(index);
        });
    };
    reader.readAsDataURL(file);
    });
}

// Invio form
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const title = document.getElementById('post-title').value.trim();
    const description = document.getElementById('post-description').value.trim();
    
    if (!title) {
    alert('Il titolo è obbligatorio.');
    return;
    }
    
    // Preparazione dati (multipart per file)
    const formData = new FormData();
    formData.append('user_id', sessionStorage.getItem('id'));
    formData.append('title', title);
    formData.append('description', description);
    selectedFiles.forEach(file => formData.append('images[]', file));
    
    try {
    const response = await fetch(APP_CONFIG.ENDPOINTS.posts.createPost, {
        method: 'POST',
        credentials: 'include',
        body: formData // non impostare Content-Type, lo fa il browser con boundary
    });
    
    if (!response.ok) {
        throw new Error(`Errore: ${response.status}`);
    }
    
    alert('Post pubblicato con successo!');
    closeModal();
    // Ricarica il feed per mostrare il nuovo post (opzionale)
    loadAllData(sessionStorage.getItem('id')); // Assicurati che la funzione esista
    } catch (error) {
    console.error('Pubblicazione fallita:', error);
    alert('Errore durante la pubblicazione. Riprova.');
    }
});