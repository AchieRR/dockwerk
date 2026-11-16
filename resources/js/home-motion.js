import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function startHomeMotion() {
    const motion = gsap.matchMedia();

    motion.add('(prefers-reduced-motion: no-preference)', () => {
        const cover = document.querySelector('.cover');
        const wordmark = cover.querySelector('h1');
        const shutter = cover.querySelector('.cover-shutter');
        const photograph = cover.querySelector('.hero-photo');
        const coverPicture = cover.querySelector('.cover-picture');
        const backdropGlow = document.querySelector('.glacier-glow');

        const intro = gsap.timeline({ defaults: { ease: 'power3.out' } });

        if (shutter) {
            intro
                .fromTo(shutter, { yPercent: -15, y: 0 }, { yPercent: -100, y: 0, ease: 'power2.inOut', duration: 1.18, clearProps: 'transform' }, 0)
                .from(photograph, { scale: 1.11, duration: 1.55 }, 0);
        } else {
            intro.fromTo(photograph,
                { scale: 1.045, filter: 'brightness(0.48) saturate(0.72)' },
                { scale: 1, filter: 'brightness(1) saturate(1)', duration: 1.65, ease: 'power2.inOut', clearProps: 'filter' },
                0,
            );
        }

        intro
            .from(wordmark, { y: 38, opacity: 0.92, duration: 1 }, 0.17)
            .from(cover.querySelector('.cover-meta'), { y: 17, duration: 0.8 }, 0.27);

        gsap.to(coverPicture, {
            yPercent: 13,
            ease: 'none',
            scrollTrigger: { trigger: cover, start: 'top 65px', end: 'bottom top', scrub: 0.55 },
        });

        gsap.to(backdropGlow, {
            xPercent: 6, yPercent: -4, ease: 'none',
            scrollTrigger: { trigger: '#inhoud', start: 'top top', end: 'bottom bottom', scrub: 0.65 },
        });

        for (const element of document.querySelectorAll('[data-appear]')) {
            gsap.from(element, {
                y: 29, duration: 0.76, ease: 'power3.out', clearProps: 'transform',
                scrollTrigger: { trigger: element, start: 'top 94%', once: true },
            });
        }
    });

    motion.add('(prefers-reduced-motion: no-preference) and (pointer: fine)', () => {
        let lenis;
        let disposed = false;

        import('lenis').then(({ default: Lenis }) => {
            if (disposed) return;

            lenis = new Lenis({ autoRaf: true, anchors: { offset: -24 }, duration: 0.86 });
            lenis.on('scroll', ScrollTrigger.update);
        });

        return () => {
            disposed = true;
            lenis?.destroy();
        };
    });
}
