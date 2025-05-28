// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Empêcher l'envoi normal du formulaire
            
            // Créer un objet FormData pour récupérer les données du formulaire
            const formData = new FormData(contactForm);
            
            // Créer un élément pour afficher le message de chargement
            let statusMessage = document.createElement('div');
            statusMessage.className = 'alert alert-info';
            statusMessage.textContent = 'Envoi en cours...';
            
            // Supprimer tout message de statut précédent
            const existingAlert = contactForm.nextElementSibling;
            if (existingAlert && existingAlert.classList.contains('alert')) {
                existingAlert.remove();
            }
            
            // Ajouter le message de chargement après le formulaire
            contactForm.after(statusMessage);
            
            // Désactiver le bouton d'envoi pendant le traitement
            const submitButton = contactForm.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            
            // Envoyer les données via fetch API
            fetch(contactForm.getAttribute('action'), {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Remplacer le message de chargement par un message de succès
                statusMessage.className = 'alert alert-success';
                statusMessage.textContent = data.message || 'Votre message a été envoyé avec succès.';
                
                // Réinitialiser le formulaire
                contactForm.reset();
            })
            .catch(error => {
                // Afficher un message d'erreur
                statusMessage.className = 'alert alert-danger';
                statusMessage.textContent = 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.';
                console.error('Erreur:', error);
            })
            .finally(() => {
                // Réactiver le bouton d'envoi
                submitButton.disabled = false;
            });
        });
    }
});