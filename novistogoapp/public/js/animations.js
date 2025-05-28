// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    // Animation au défilement
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.mission-card, .project-card, .about-image, .about-text');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                element.classList.add('animate');
            }
        });
    };
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Exécuter une fois au chargement
    
    // Effet de parallaxe pour la section hero
    window.addEventListener('scroll', function() {
        const hero = document.querySelector('.hero');
        const scrollPosition = window.pageYOffset;
        
        if (hero) {
            hero.style.backgroundPositionY = scrollPosition * 0.5 + 'px';
        }
    });
    
    // Animation pour les statistiques
    const statsItems = document.querySelectorAll('.impact-item h3');
    
    function animateStats() {
        statsItems.forEach(item => {
            const target = parseInt(item.textContent);
            let count = 0;
            const duration = 2000; // 2 secondes
            const interval = duration / target;
            
            const counter = setInterval(() => {
                count++;
                item.textContent = count;
                
                if (count >= target) {
                    clearInterval(counter);
                    item.textContent = target + (item.textContent.includes('+') ? '+' : '');
                }
            }, interval);
        });
    }
    
    // Déclencher l'animation des statistiques lorsqu'elles sont visibles
    const impactSection = document.querySelector('.impact');
    
    if (impactSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(impactSection);
    }
});