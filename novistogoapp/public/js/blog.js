// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    // --- Blog Modal Functionality ---
    const blogModal = document.getElementById('blog-modal');
    if (!blogModal) return; // Sortir si l'élément n'existe pas
    
    const modalBody = blogModal.querySelector('.blog-modal-body');
    const closeModalIcon = blogModal.querySelector('.blog-modal-close-icon');
    const closeModalBtn = blogModal.querySelector('.blog-modal-back-btn');
    const readMoreLinks = document.querySelectorAll('.read-more');

    // Function to open the modal
    function openModal(contentHtml) {
        modalBody.innerHTML = contentHtml; // Inject content
        blogModal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    // Function to close the modal
    function closeModal() {
        blogModal.classList.remove('active');
        document.body.style.overflow = ''; // Restore background scrolling
        // Optional: Clear content after closing animation finishes
        setTimeout(() => {
             if (!blogModal.classList.contains('active')) {
                 modalBody.innerHTML = '';
             }
        }, 350); // Match CSS transition duration
    }

    // Add event listeners to all "Lire plus" links
    readMoreLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            const articleId = this.getAttribute('data-article-id');
            const articleContentElement = document.getElementById(`${articleId}-content`);

            if (articleContentElement) {
                openModal(articleContentElement.innerHTML);
            } else {
                console.error(`Content not found for article ID: ${articleId}`);
                // Optionally show a default message in the modal
                openModal('<p>Désolé, le contenu de cet article n\'est pas disponible.</p>');
            }
        });
    });

    // Add event listeners to close buttons
    if (closeModalIcon) {
        closeModalIcon.addEventListener('click', closeModal);
    }
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }

    // Optional: Close modal when clicking on the background overlay
    blogModal.addEventListener('click', function(e) {
        if (e.target === blogModal) { // Check if the click is directly on the overlay
            closeModal();
        }
    });

    // Optional: Close modal with the Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && blogModal.classList.contains('active')) {
            closeModal();
        }
    });
    
    // Fonctionnalité pour le bouton "Voir plus/Voir moins" dans la section blog
    const toggleBlogBtn = document.getElementById('toggle-blog-btn');
    const hiddenBlogPosts = document.getElementById('hidden-blog-posts');
    const blogMoreDiv = document.querySelector('.blog-more');
    const container = document.querySelector('.blog .container');

    if (toggleBlogBtn && hiddenBlogPosts && blogMoreDiv && container) {
        // Supprimer tout clone existant pour éviter les doublons
        const existingClone = document.getElementById('blog-more-clone');
        if (existingClone) {
            existingClone.remove();
        }
        
        // Créer un clone du bouton pour l'afficher après les articles cachés
        const blogMoreClone = document.createElement('div');
        blogMoreClone.className = 'blog-more';
        blogMoreClone.id = 'blog-more-clone';
        blogMoreClone.style.display = 'none'; // Caché par défaut
        
        const toggleBlogBtnClone = document.createElement('button');
        toggleBlogBtnClone.id = 'toggle-blog-btn-clone';
        toggleBlogBtnClone.className = 'btn-toggle-blog';
        toggleBlogBtnClone.textContent = 'Voir moins';
        toggleBlogBtnClone.style.display = 'inline-block';
        
        blogMoreClone.appendChild(toggleBlogBtnClone);
        container.appendChild(blogMoreClone);
        
        // Initialiser l'état du bouton et des articles cachés
        let isHidden = true; // État initial: articles cachés
        
        // Fonction pour gérer le clic sur les deux boutons
        function handleToggleClick() {
            if (isHidden) {
                // Afficher les articles cachés
                hiddenBlogPosts.style.display = 'grid';
                // Cacher le bouton original
                blogMoreDiv.style.display = 'none';
                // Afficher le bouton clone
                blogMoreClone.style.display = 'block';
                isHidden = false;
            } else {
                // Cacher les articles cachés
                hiddenBlogPosts.style.display = 'none';
                // Afficher le bouton original
                blogMoreDiv.style.display = 'block';
                // Cacher le bouton clone
                blogMoreClone.style.display = 'none';
                isHidden = true;
            }
        }
        
        // Ajouter les écouteurs d'événements aux deux boutons
        toggleBlogBtn.addEventListener('click', handleToggleClick);
        toggleBlogBtnClone.addEventListener('click', handleToggleClick);
        
        // S'assurer que les articles sont bien cachés au chargement
        hiddenBlogPosts.style.display = 'none';
        blogMoreDiv.style.display = 'block';
        blogMoreClone.style.display = 'none';
        toggleBlogBtn.textContent = 'Voir plus';
    }
});