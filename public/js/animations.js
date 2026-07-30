/**
 * AKSO PHARMA — GSAP Animations
 *
 * All scroll-triggered animations, hero reveals,
 * and CountUp effects. Loaded via CDN <script> in layout.
 * This file runs after GSAP + ScrollTrigger are available globally.
 */

document.addEventListener('DOMContentLoaded', () => {
    // Ensure GSAP is loaded
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Animations disabled.');
        // Make hidden elements visible as fallback
        document.querySelectorAll('.animate-on-scroll, .stagger-children > *').forEach(el => {
            el.style.opacity = '1';
        });
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    // ============================================
    // GLOBAL: Scroll Reveal for .animate-on-scroll
    // ============================================
    ScrollTrigger.batch('.animate-on-scroll', {
        onEnter: (elements) => {
            gsap.fromTo(elements,
                { opacity: 0, y: 60 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    stagger: 0.15,
                    overwrite: true,
                }
            );
        },
        start: 'top 85%',
        once: true,
    });

    // ============================================
    // GLOBAL: Stagger Children
    // ============================================
    document.querySelectorAll('.stagger-children').forEach(container => {
        const children = container.children;
        if (children.length === 0) return;

        gsap.fromTo(children,
            { opacity: 0, y: 40 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.12,
                scrollTrigger: {
                    trigger: container,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    });

    // ============================================
    // GLOBAL: Page Intro Animation
    // ============================================
    const pageIntro = document.querySelector('.page-intro');
    if (pageIntro) {
        gsap.fromTo(pageIntro,
            { opacity: 0, y: 30 },
            { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }
        );
    }

    // ============================================
    // HOME: Hero Timeline
    // ============================================
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        const tl = gsap.timeline({ defaults: { ease: "power3.out" } });
        
        const overlines = heroSection.querySelectorAll('.hero-overline');
        const heroWords = heroSection.querySelectorAll('.hero-word');
        if (heroWords.length > 0) {
            tl.fromTo(heroWords,
                { opacity: 0, y: 80, rotateX: -20 },
                {
                    opacity: 1,
                    y: 0,
                    rotateX: 0,
                    duration: 0.7,
                    ease: 'power3.out',
                    stagger: 0.08,
                }
            );
        }

        // Animate subtitle
        const heroSubtitle = heroSection.querySelector('.hero-subtitle');
        if (heroSubtitle) {
            tl.fromTo(heroSubtitle,
                { opacity: 0, y: 30 },
                { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' },
                '-=0.3'
            );
        }

        // Animate CTA buttons
        const heroCtas = heroSection.querySelectorAll('.hero-cta');
        if (heroCtas.length > 0) {
            tl.fromTo(heroCtas,
                { opacity: 0, y: 20, scale: 0.9 },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.5,
                    ease: 'back.out(1.5)',
                    stagger: 0.1,
                },
                '-=0.2'
            );
        }

        // Animate hero image
        const heroImage = heroSection.querySelector('.hero-image');
        if (heroImage) {
            tl.fromTo(heroImage,
                { opacity: 0, y: 60, scale: 0.9 },
                { opacity: 1, y: 0, scale: 1, duration: 0.8, ease: 'power2.out' },
                '-=0.4'
            );
        }

        // Hero image parallax on scroll
        if (heroImage) {
            gsap.to(heroImage, {
                yPercent: -15,
                ease: 'none',
                scrollTrigger: {
                    trigger: heroSection,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                },
            });
        }

        // Animate hero overline
        if (overlines.length > 0) {
            tl.fromTo(overlines,
                { opacity: 0, scale: 0.9 },
                {
                    opacity: 1,
                    scale: 1,
                    duration: 0.4,
                    ease: 'back.out(1.5)',
                    stagger: 0.08,
                },
                '-=0.3'
            );
        }
    }

    // ============================================
    // COUNTUP: Animated number counters
    // ============================================
    document.querySelectorAll('.countup-value').forEach(el => {
        const target = parseInt(el.dataset.target, 10) || 0;
        const suffix = el.dataset.suffix || '';
        const prefix = el.dataset.prefix || '';

        const obj = { value: 0 };

        gsap.to(obj, {
            value: target,
            duration: 2,
            ease: 'power1.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                once: true,
            },
            onUpdate: () => {
                el.textContent = prefix + Math.round(obj.value).toLocaleString() + suffix;
            },
        });
    });

    // ============================================
    // HOME: Category Cards
    // ============================================
    const categoryCards = document.querySelectorAll('.category-card');
    if (categoryCards.length > 0) {
        gsap.fromTo(categoryCards,
            { opacity: 0, y: 40, scale: 0.95 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.12,
                scrollTrigger: {
                    trigger: categoryCards[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // HOME: Why Us Items
    // ============================================
    const whyUsItems = document.querySelectorAll('.why-us-item');
    if (whyUsItems.length > 0) {
        gsap.fromTo(whyUsItems,
            { opacity: 0, x: -30 },
            {
                opacity: 1,
                x: 0,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.15,
                scrollTrigger: {
                    trigger: whyUsItems[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // HOME: Partner Highlight
    // ============================================
    const partnerHighlight = document.querySelector('.partner-highlight');
    if (partnerHighlight) {
        gsap.fromTo(partnerHighlight,
            { opacity: 0, scale: 0.9 },
            {
                opacity: 1,
                scale: 1,
                duration: 1,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: partnerHighlight,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // HOME: CTA Banner
    // ============================================
    const ctaBanner = document.querySelector('.cta-banner');
    if (ctaBanner) {
        gsap.fromTo(ctaBanner,
            { opacity: 0, y: 40 },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: ctaBanner,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // ABOUT: Mission/Vision Cards
    // ============================================
    const mvCards = document.querySelectorAll('.mv-card');
    if (mvCards.length > 0) {
        gsap.fromTo(mvCards,
            { opacity: 0, y: 50 },
            {
                opacity: 1,
                y: 0,
                duration: 0.7,
                ease: 'power2.out',
                stagger: 0.2,
                scrollTrigger: {
                    trigger: mvCards[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // ABOUT: Timeline Items (alternate from left/right)
    // ============================================
    document.querySelectorAll('.timeline-item').forEach((item, i) => {
        const fromX = i % 2 === 0 ? -60 : 60;
        gsap.fromTo(item,
            { opacity: 0, x: fromX },
            {
                opacity: 1,
                x: 0,
                duration: 0.7,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: item,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    });

    // ============================================
    // ABOUT: Distribution Flow Steps
    // ============================================
    const flowSteps = document.querySelectorAll('.flow-step');
    if (flowSteps.length > 0) {
        gsap.fromTo(flowSteps,
            { opacity: 0, y: 30, scale: 0.95 },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.2,
                scrollTrigger: {
                    trigger: flowSteps[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // ABOUT: Compliance Badges
    // ============================================
    const compBadges = document.querySelectorAll('.compliance-badge');
    if (compBadges.length > 0) {
        gsap.fromTo(compBadges,
            { opacity: 0, scale: 0.8 },
            {
                opacity: 1,
                scale: 1,
                duration: 0.5,
                ease: 'back.out(1.5)',
                stagger: 0.1,
                scrollTrigger: {
                    trigger: compBadges[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // PRODUCTS: Filter Bar
    // ============================================
    const filterBar = document.querySelector('.filter-bar');
    if (filterBar) {
        gsap.fromTo(filterBar,
            { opacity: 0, y: -20 },
            { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }
        );
    }

    // ============================================
    // PRODUCT DETAIL: Product Image
    // ============================================
    const productHeroImage = document.querySelector('.product-hero-image');
    if (productHeroImage) {
        gsap.fromTo(productHeroImage,
            { opacity: 0, scale: 0.9 },
            { opacity: 1, scale: 1, duration: 0.8, ease: 'power2.out' }
        );
    }

    // ============================================
    // PRODUCT DETAIL: Info Blocks
    // ============================================
    const infoBlocks = document.querySelectorAll('.product-info-block');
    if (infoBlocks.length > 0) {
        gsap.fromTo(infoBlocks,
            { opacity: 0, y: 40 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.15,
                scrollTrigger: {
                    trigger: infoBlocks[0],
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // PARTNERS: Stats Counters (reuses countup logic)
    // ============================================
    const partnerStats = document.querySelectorAll('.partner-stat');
    if (partnerStats.length > 0) {
        gsap.fromTo(partnerStats,
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.12,
                scrollTrigger: {
                    trigger: partnerStats[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // PARTNERS: Benefit Items
    // ============================================
    const benefitItems = document.querySelectorAll('.benefit-item');
    if (benefitItems.length > 0) {
        gsap.fromTo(benefitItems,
            { opacity: 0, x: -40 },
            {
                opacity: 1,
                x: 0,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.12,
                scrollTrigger: {
                    trigger: benefitItems[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // NEWS: Article Content Children
    // ============================================
    const articleContent = document.querySelector('.article-content');
    if (articleContent) {
        const articleChildren = articleContent.children;
        gsap.fromTo(articleChildren,
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: 'power2.out',
                stagger: 0.05,
                scrollTrigger: {
                    trigger: articleContent,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // CONTACT: Info Cards
    // ============================================
    const contactCards = document.querySelectorAll('.contact-info-card');
    if (contactCards.length > 0) {
        gsap.fromTo(contactCards,
            { opacity: 0, y: 40 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.15,
                scrollTrigger: {
                    trigger: contactCards[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // CONTACT: Form Fields
    // ============================================
    const formGroups = document.querySelectorAll('.form-group');
    if (formGroups.length > 0) {
        gsap.fromTo(formGroups,
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: 'power2.out',
                stagger: 0.1,
                scrollTrigger: {
                    trigger: formGroups[0].parentElement,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    }

    // ============================================
    // Refresh ScrollTrigger on dynamic content load
    // ============================================
    window.addEventListener('load', () => {
        ScrollTrigger.refresh();
    });
});
