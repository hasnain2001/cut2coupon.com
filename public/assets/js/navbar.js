        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const navbarMenu = document.querySelector('.navbar-menu');
            const navbarToggle = document.querySelector('.navbar-toggle');
            const body = document.body;

            // Toggle mobile menu
            function toggleMenu() {
                navbarMenu.classList.toggle('active');
                navbarToggle.classList.toggle('active');
                body.classList.toggle('no-scroll');
            }

            // Close mobile menu when clicking on a menu item
            function closeMenu() {
                navbarMenu.classList.remove('active');
                navbarToggle.classList.remove('active');
                body.classList.remove('no-scroll');
            }

            // Event listeners
            mobileMenu.addEventListener('click', toggleMenu);

            // Close menu when clicking on links
            const navLinks = document.querySelectorAll('.navbar-links');
            navLinks.forEach(link => link.addEventListener('click', closeMenu));

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideMenu = navbarMenu.contains(event.target);
                const isClickOnToggle = mobileMenu.contains(event.target);

                if (!isClickInsideMenu && !isClickOnToggle && navbarMenu.classList.contains('active')) {
                    closeMenu();
                }
            });

            // Prevent scrolling when menu is open
            document.addEventListener('scroll', function() {
                if (navbarMenu.classList.contains('active')) {
                    window.scrollTo(0, 0);
                }
            });
        });
// Add to script.js
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('sticky', window.scrollY > 0);
});
