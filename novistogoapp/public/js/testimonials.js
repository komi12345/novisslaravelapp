// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    // Slider de témoignages
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    let currentSlide = 0;
    
    function showSlide(index) {
        testimonialCards.forEach(card => card.classList.remove('active'));
        testimonialCards[index].classList.add('active');
    }
    
    if (prevBtn && nextBtn && testimonialCards.length > 0) {
        prevBtn.addEventListener('click', function() {
            currentSlide--;
            if (currentSlide < 0) {
                currentSlide = testimonialCards.length - 1;
            }
            showSlide(currentSlide);
        });
        
        nextBtn.addEventListener('click', function() {
            currentSlide++;
            if (currentSlide >= testimonialCards.length) {
                currentSlide = 0;
            }
            showSlide(currentSlide);
        });
        
        // Changer automatiquement les témoignages toutes les 5 secondes
        setInterval(function() {
            currentSlide++;
            if (currentSlide >= testimonialCards.length) {
                currentSlide = 0;
            }
            showSlide(currentSlide);
        }, 5000);
    }
});