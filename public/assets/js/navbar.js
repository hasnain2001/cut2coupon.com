    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const navbarMenu = document.getElementById('navbarMenu');
        const body = document.body;

        // Categories modal elements
        const categoriesLink = document.getElementById('categoriesLink');
        const categoriesModal = document.getElementById('categoriesModal');
        const closeCategoriesModal = document.getElementById('closeCategoriesModal');

        // Language elements
        const languageToggle = document.getElementById('languageToggle');
        const languageModal = document.getElementById('languageModal');
        const closeLanguageModal = document.getElementById('closeLanguageModal');
        const languageDesktopDropdown = document.getElementById('languageDesktopDropdown');

        // Toggle mobile menu
        function toggleMenu() {
            navbarMenu.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');
            body.classList.toggle('no-scroll');
        }

        // Close mobile menu when clicking on a menu item
        function closeMenu(event) {
            if (!event.target.closest('.mega-dropdown') && !event.target.closest('.language-dropdown')) {
                navbarMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                body.classList.remove('no-scroll');
            }
        }

        // Open categories modal on mobile
        function openCategoriesModal(event) {
            if (window.innerWidth <= 1024) {
                event.preventDefault();
                categoriesModal.classList.add('active');
                body.classList.add('no-scroll');
            }
        }

        // Close categories modal
        function closeCategoriesModalFunc() {
            categoriesModal.classList.remove('active');
            body.classList.remove('no-scroll');
        }

        // Open language modal on mobile
        function openLanguageModal(event) {
            if (window.innerWidth <= 1024) {
                event.preventDefault();
                languageModal.classList.add('active');
                body.classList.add('no-scroll');
            }
        }

        // Close language modal
        function closeLanguageModalFunc() {
            languageModal.classList.remove('active');
            body.classList.remove('no-scroll');
        }

        // Close modal when clicking outside
        function handleOutsideClick(event) {
            if (event.target === categoriesModal) {
                closeCategoriesModalFunc();
            }
            if (event.target === languageModal) {
                closeLanguageModalFunc();
            }
        }

        // Event listeners
        mobileMenuToggle.addEventListener('click', toggleMenu);

        // Close menu when clicking on regular links
        const navLinks = document.querySelectorAll('.navbar-links:not(.mega-dropdown .navbar-links)');
        navLinks.forEach(link => link.addEventListener('click', closeMenu));

        // Categories link
        if (categoriesLink) {
            categoriesLink.addEventListener('click', openCategoriesModal);
        }

        // Close categories modal button
        if (closeCategoriesModal) {
            closeCategoriesModal.addEventListener('click', closeCategoriesModalFunc);
        }

        // Language toggle
        if (languageToggle) {
            languageToggle.addEventListener('click', openLanguageModal);
        }

        // Close language modal button
        if (closeLanguageModal) {
            closeLanguageModal.addEventListener('click', closeLanguageModalFunc);
        }

        // Close modals when clicking outside
        document.addEventListener('click', handleOutsideClick);

        // Close menu when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const isClickInsideMenu = navbarMenu.contains(event.target);
            const isClickOnToggle = mobileMenuToggle.contains(event.target);

            if (!isClickInsideMenu && !isClickOnToggle && navbarMenu.classList.contains('active')) {
                toggleMenu();
            }
        });

        // Sticky navbar on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('sticky', window.scrollY > 0);
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                // Reset mobile menu if resized to desktop
                navbarMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                body.classList.remove('no-scroll');
            }
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                if (categoriesModal.classList.contains('active')) {
                    closeCategoriesModalFunc();
                }
                if (languageModal.classList.contains('active')) {
                    closeLanguageModalFunc();
                }
            }
        });

        // Prevent desktop language dropdown from closing when clicking inside
        if (languageDesktopDropdown) {
            languageDesktopDropdown.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        }
    });
