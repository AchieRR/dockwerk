import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

gsap.registerPlugin(ScrollTrigger);

export function startHomeMotion() {
    const motion = gsap.matchMedia();
    motion.add('(prefers-reduced-motion: no-preference) and (pointer: fine)', () => {
        const glacier = document.querySelector('.glacier');
        const lenis = new Lenis({ autoRaf: true, anchors: { offset: -16 }, duration: 0.8 });
        lenis.on('scroll', ScrollTrigger.update);
        gsap.fromTo(glacier.querySelector('.glacier-glow'), { x: -10 }, {
            x: 10, ease: 'none', scrollTrigger: { trigger: glacier, start: 'top bottom', end: 'bottom top', scrub: true },
        });
        return () => lenis.destroy();
    });
}
