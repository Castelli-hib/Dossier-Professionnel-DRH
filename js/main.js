/**
 * Direction des Ressources Humaines - Main JavaScript
 * Mobile-first interactive features
 */

(function() {
    'use strict';

    // ===================================
    // MOBILE MENU TOGGLE
    // ===================================
    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.navigation');

    if (menuToggle && navigation) {
        menuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Toggle aria-expanded
            this.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle navigation visibility
            navigation.classList.toggle('active');
            
            // Update aria-label
            this.setAttribute('aria-label', isExpanded ? 'Ouvrir le menu' : 'Fermer le menu');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideMenu = navigation.contains(event.target);
            const isClickOnToggle = menuToggle.contains(event.target);
            
            if (!isClickInsideMenu && !isClickOnToggle && navigation.classList.contains('active')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Ouvrir le menu');
                navigation.classList.remove('active');
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && navigation.classList.contains('active')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Ouvrir le menu');
                navigation.classList.remove('active');
                menuToggle.focus();
            }
        });

        // Close menu when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768 && navigation.classList.contains('active')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Ouvrir le menu');
                navigation.classList.remove('active');
            }
        });
    }

    // ===================================
    // CONTACT FORM VALIDATION & SUBMISSION
    // ===================================
    const contactForm = document.getElementById('contactForm');
    const formSuccess = document.getElementById('form-success');
    const formError = document.getElementById('form-error');

    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Hide previous messages
            if (formSuccess) formSuccess.style.display = 'none';
            if (formError) formError.style.display = 'none';
            
            // Basic validation
            const nom = document.getElementById('nom');
            const prenom = document.getElementById('prenom');
            const email = document.getElementById('email');
            const objet = document.getElementById('objet');
            const message = document.getElementById('message');
            const rgpd = document.getElementById('rgpd');
            
            let isValid = true;
            
            // Check required fields
            if (!nom.value.trim()) {
                nom.focus();
                isValid = false;
            } else if (!prenom.value.trim()) {
                prenom.focus();
                isValid = false;
            } else if (!email.value.trim() || !isValidEmail(email.value)) {
                email.focus();
                isValid = false;
            } else if (!objet.value.trim()) {
                objet.focus();
                isValid = false;
            } else if (!message.value.trim()) {
                message.focus();
                isValid = false;
            } else if (!rgpd.checked) {
                rgpd.focus();
                isValid = false;
            }
            
            if (!isValid) {
                if (formError) {
                    formError.textContent = 'Veuillez remplir tous les champs obligatoires.';
                    formError.style.display = 'block';
                }
                return;
            }
            
            // Simulate form submission
            // In a real application, this would send data to a server
            simulateFormSubmission();
        });
    }

    /**
     * Validate email format
     */
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    /**
     * Simulate form submission
     */
    function simulateFormSubmission() {
        // Show loading state (optional)
        const submitButton = contactForm.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        submitButton.textContent = 'Envoi en cours...';
        submitButton.disabled = true;
        
        // Simulate network delay
        setTimeout(function() {
            // Reset button
            submitButton.textContent = originalText;
            submitButton.disabled = false;
            
            // Show success message
            if (formSuccess) {
                formSuccess.style.display = 'block';
                formSuccess.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            
            // Reset form
            contactForm.reset();
            
            // Hide success message after 5 seconds
            setTimeout(function() {
                if (formSuccess) {
                    formSuccess.style.display = 'none';
                }
            }, 5000);
        }, 1500);
    }

    // ===================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ===================================
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            const href = this.getAttribute('href');
            
            // Skip if it's just "#"
            if (href === '#') {
                event.preventDefault();
                return;
            }
            
            const target = document.querySelector(href);
            
            if (target) {
                event.preventDefault();
                
                // Close mobile menu if open
                if (navigation && navigation.classList.contains('active')) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    menuToggle.setAttribute('aria-label', 'Ouvrir le menu');
                    navigation.classList.remove('active');
                }
                
                // Smooth scroll to target
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Update focus for accessibility
                target.focus();
            }
        });
    });

    // ===================================
    // RESPONSIVE IMAGES (if needed in future)
    // ===================================
    function handleResponsiveImages() {
        // Placeholder for future image optimization
        // Can be used to lazy load images or switch sources based on viewport
    }

    // ===================================
    // ACCESSIBILITY ENHANCEMENTS
    // ===================================
    
    // Add keyboard navigation for details/summary (FAQ)
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(function(item) {
        const summary = item.querySelector('summary');
        
        if (summary) {
            summary.addEventListener('keydown', function(event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    this.click();
                }
            });
        }
    });

    // ===================================
    // FORM FIELD ENHANCEMENTS
    // ===================================
    
    // Add visual feedback to form fields
    const formInputs = document.querySelectorAll('input, select, textarea');
    
    formInputs.forEach(function(input) {
        // Add focused class for custom styling if needed
        input.addEventListener('focus', function() {
            this.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.classList.remove('focused');
            
            // Add validation feedback
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('error');
            } else {
                this.classList.remove('error');
            }
        });
    });

    // ===================================
    // PRINT FRIENDLY
    // ===================================
    
    // Expand all FAQ items before printing
    window.addEventListener('beforeprint', function() {
        faqItems.forEach(function(item) {
            item.setAttribute('open', '');
        });
    });

    // ===================================
    // PERFORMANCE MONITORING (Optional)
    // ===================================
    
    // Log page load time for performance monitoring
    window.addEventListener('load', function() {
        if (window.performance && window.performance.timing) {
            const loadTime = window.performance.timing.loadEventEnd - window.performance.timing.navigationStart;
            console.log('Page load time: ' + loadTime + 'ms');
        }
    });

    // ===================================
    // INITIALIZATION
    // ===================================
    
    // Call any initialization functions
    handleResponsiveImages();
    
    // Log that JavaScript is loaded
    console.log('DRH Website - JavaScript loaded successfully');

})();
