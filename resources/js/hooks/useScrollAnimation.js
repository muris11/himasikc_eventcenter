import { useEffect } from 'react';

/**
 * useScrollAnimation - Trigger animations on scroll
 * Auto-detects elements with scroll-fade-in class
 */
export const useScrollAnimation = () => {
  useEffect(() => {
    const elements = document.querySelectorAll('.scroll-fade-in');
    
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
          }
        });
      },
      {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px',
      }
    );

    elements.forEach((el) => observer.observe(el));

    return () => {
      elements.forEach((el) => observer.unobserve(el));
    };
  }, []);
};

export default useScrollAnimation;
