// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    // --- Projects Modal Functionality ---
    const projectModal = document.getElementById('project-modal');
    if (!projectModal) return; // Sortir si l'élément n'existe pas
    
    const modalBody = projectModal.querySelector('.project-modal-body');
    const closeModalIcon = projectModal.querySelector('.project-modal-close-icon');
    const closeModalBtn = projectModal.querySelector('.project-modal-back-btn');
    const readMoreLinks = document.querySelectorAll('.project-read-more');

    // Function to open the modal
    function openModal(contentHtml) {
        modalBody.innerHTML = contentHtml; // Inject content
        projectModal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    // Function to close the modal
    function closeModal() {
        projectModal.classList.remove('active');
        document.body.style.overflow = ''; // Restore background scrolling
        // Optional: Clear content after closing animation finishes
        setTimeout(() => {
             if (!projectModal.classList.contains('active')) {
                 modalBody.innerHTML = '';
             }
        }, 350); // Match CSS transition duration
    }

    // Add event listeners to all "En savoir plus" links
    readMoreLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            const projectId = this.getAttribute('data-project-id');
            const projectContentElement = document.getElementById(`${projectId}-content`);

            if (projectContentElement) {
                openModal(projectContentElement.innerHTML);
            } else {
                console.error(`Content not found for project ID: ${projectId}`);
                // Optionally show a default message in the modal
                openModal('<p>Désolé, le contenu de ce projet n\'est pas disponible.</p>');
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
    projectModal.addEventListener('click', function(e) {
        if (e.target === projectModal) { // Check if the click is directly on the overlay
            closeModal();
        }
    });

    // Optional: Close modal with the Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && projectModal.classList.contains('active')) {
            closeModal();
        }
    });
    
    // Fonctionnalité pour le bouton "Voir plus/Voir moins" dans la section projets
    const toggleProjectBtn = document.getElementById('toggle-project-btn');
    const hiddenProjectItems = document.getElementById('hidden-project-items');
    const projectMoreDiv = document.querySelector('.project-more');
    const container = document.querySelector('.projects .container');

    if (toggleProjectBtn && projectMoreDiv && container) {
        // Supprimer tout clone existant pour éviter les doublons
        const existingClone = document.getElementById('project-more-clone');
        if (existingClone) {
            existingClone.remove();
        }
        
        // Créer un clone du bouton pour l'afficher après les projets cachés
        const projectMoreClone = document.createElement('div');
        projectMoreClone.className = 'project-more';
        projectMoreClone.id = 'project-more-clone';
        projectMoreClone.style.display = 'none'; // Caché par défaut
        
        const toggleProjectBtnClone = document.createElement('button');
        toggleProjectBtnClone.id = 'toggle-project-btn-clone';
        toggleProjectBtnClone.className = 'btn-toggle-project';
        toggleProjectBtnClone.textContent = 'Voir moins';
        toggleProjectBtnClone.style.display = 'inline-block';
        
        projectMoreClone.appendChild(toggleProjectBtnClone);
        container.appendChild(projectMoreClone);
        
        // Initialiser l'état du bouton et des projets cachés
        let isHidden = true; // État initial: projets cachés
        
        // Fonction pour gérer le clic sur les deux boutons
        function handleToggleClick() {
            console.log('Bouton cliqué, hiddenProjectItems existe:', !!hiddenProjectItems);
            // Vérifier si l'élément hiddenProjectItems existe
            if (hiddenProjectItems) {
                if (isHidden) {
                    // Afficher les projets cachés
                    hiddenProjectItems.style.display = 'grid';
                    // Cacher le bouton original
                    projectMoreDiv.style.display = 'none';
                    // Afficher le bouton clone
                    projectMoreClone.style.display = 'block';
                    isHidden = false;
                    console.log('Affichage des projets cachés');
                } else {
                    // Cacher les projets cachés
                    hiddenProjectItems.style.display = 'none';
                    // Afficher le bouton original
                    projectMoreDiv.style.display = 'block';
                    // Cacher le bouton clone
                    projectMoreClone.style.display = 'none';
                    isHidden = true;
                    console.log('Masquage des projets cachés');
                }
            } else {
                // S'il n'y a pas de projets cachés, afficher un message
                console.log('Aucun projet supplémentaire disponible');
                alert('Aucun projet supplémentaire disponible pour le moment.');
            }
        }
        
        // Ajouter les écouteurs d'événements aux deux boutons
        toggleProjectBtn.addEventListener('click', handleToggleClick);
        toggleProjectBtnClone.addEventListener('click', handleToggleClick);
        
        // S'assurer que les projets sont bien cachés au chargement
        if (hiddenProjectItems) {
            hiddenProjectItems.style.display = 'none';
            console.log('Projets cachés au chargement');
        } else {
            console.log('Élément hiddenProjectItems non trouvé');
        }
        projectMoreDiv.style.display = 'block';
        projectMoreClone.style.display = 'none';
        toggleProjectBtn.textContent = 'Voir plus';
    }
});