/**
 * AKSO PHARMA — Main JavaScript Entry
 *
 * Initializes Alpine.js, registers Alpine components,
 * and imports Swiper for product carousels.
 */

import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// ——— Alpine.js Component: Product Filter ———
Alpine.data('productFilter', () => ({
    search: '',
    activeCategory: 'all',
    products: [],

    init() {
        // Products are passed from blade via a data attribute
        const el = this.$el.closest('[data-products]');
        if (el) {
            try {
                this.products = JSON.parse(el.dataset.products);
            } catch (e) {
                this.products = [];
            }
        }
    },

    get filteredProducts() {
        return this.products.filter(product => {
            const matchesCategory = this.activeCategory === 'all' || product.category === this.activeCategory;
            const matchesSearch = this.search === '' ||
                product.name.toLowerCase().includes(this.search.toLowerCase()) ||
                product.category.toLowerCase().includes(this.search.toLowerCase()) ||
                (product.active_ingredients && JSON.stringify(product.active_ingredients).toLowerCase().includes(this.search.toLowerCase()));
            return matchesCategory && matchesSearch;
        });
    },

    get categories() {
        const cats = [...new Set(this.products.map(p => p.category))];
        return ['all', ...cats];
    },

    setCategory(cat) {
        this.activeCategory = cat;
    },

    isActive(cat) {
        return this.activeCategory === cat;
    }
}));

// ——— Alpine.js Component: Contact Form ———
Alpine.data('contactForm', () => ({
    loading: false,
    success: false,
    errors: {},

    async submitForm(e) {
        this.loading = true;
        this.success = false;
        this.errors = {};

        const form = e.target;
        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422 && data.errors) {
                    this.errors = data.errors;
                } else {
                    this.errors = { general: ['Something went wrong. Please try again.'] };
                }
            } else {
                this.success = true;
                form.reset();
                // Auto-hide success message after 8 seconds
                setTimeout(() => { this.success = false; }, 8000);
            }
        } catch (error) {
            this.errors = { general: ['Network error. Please check your connection and try again.'] };
        } finally {
            this.loading = false;
        }
    }
}));

// ——— Alpine.js Component: Mobile Nav ———
Alpine.data('navbar', () => ({
    scrolled: false,
    mobileOpen: false,

    init() {
        this.checkScroll();
        window.addEventListener('scroll', () => this.checkScroll(), { passive: true });
    },

    checkScroll() {
        this.scrolled = window.scrollY > 50;
    },

    toggleMobile() {
        this.mobileOpen = !this.mobileOpen;
    },

    closeMobile() {
        this.mobileOpen = false;
    }
}));

// ——— Start Alpine ———
Alpine.start();

// ——— Swiper Initialization ———
document.addEventListener('DOMContentLoaded', () => {
    // Featured products swiper (mobile only via CSS breakpoint)
    const featuredSwiper = document.querySelector('.swiper-featured');
    if (featuredSwiper) {
        new Swiper(featuredSwiper, {
            modules: [Navigation, Pagination, Autoplay],
            slidesPerView: 1.2,
            spaceBetween: 16,
            centeredSlides: false,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                480: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 2.2,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                    enabled: false, // Disable on desktop
                },
            },
        });
    }
});
