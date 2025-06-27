      // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const navbarMenu = document.getElementById('navbarMenu');
        mobileMenuToggle.addEventListener('click', () => {
            navbarMenu.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');
        });

        // Categories Modal
        const categoriesLink = document.getElementById('categoriesLink');
        const categoriesModal = document.getElementById('categoriesModal');
        const closeCategoriesModal = document.getElementById('closeCategoriesModal');

        categoriesLink.addEventListener('click', (e) => {
            if (window.innerWidth <= 991) {
                e.preventDefault();
                categoriesModal.style.display = 'flex';
            }
        });

        closeCategoriesModal.addEventListener('click', () => {
            categoriesModal.style.display = 'none';
        });

        // Close modal when clicking outside
        categoriesModal.addEventListener('click', (e) => {
            if (e.target === categoriesModal) {
                categoriesModal.style.display = 'none';
            }
        });
