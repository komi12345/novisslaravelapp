// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire de contact
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            
            if (!name || !email || !message) {
                alert('Veuillez remplir tous les champs obligatoires.');
                return;
            }
            
            // Simuler l'envoi du formulaire
            alert('Merci pour votre message ! Nous vous contacterons bientôt.');
            contactForm.reset();
        });
    }
    
    // Validation du formulaire de newsletter
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.querySelector('input[type="email"]').value;
            
            if (!email) {
                alert('Veuillez entrer votre adresse email.');
                return;
            }
            
            // Simuler l'inscription à la newsletter
            alert('Merci pour votre inscription à notre newsletter !');
            this.reset();
        });
    }
    
    // Validation du formulaire de don
    const donationForm = document.querySelector('.donation-form');
    if (donationForm) {
        donationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const amount = this.querySelector('input[type="number"]').value;
            
            if (!amount || amount < 1000) {
                alert('Veuillez entrer un montant valide (minimum 1000 FCFA).');
                return;
            }
            
            // Simuler le processus de don
            alert(`Merci pour votre don de ${amount} FCFA !`);
            this.reset();
        });
    }
});