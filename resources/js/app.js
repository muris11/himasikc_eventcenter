/**
 * HIMA-SIKC Event Center V2 - Main JavaScript Entry
 * With error handling to prevent infinite reload loops
 */

import "./bootstrap";

// Alpine.js is automatically injected by Livewire 3
// No need to import manually to avoid conflicts

// Import React and ReactDOM for components
import React from 'react';
import ReactDOM from 'react-dom/client';

// Import UI Components with error handling
let InteractiveCard, AnimatedCounter, GlassmorphismModal, MasonryGrid, SkeletonLoader;
let useScrollAnimation;

try {
    InteractiveCard = require('./components/ui/InteractiveCard').default;
    AnimatedCounter = require('./components/ui/AnimatedCounter').default;
    GlassmorphismModal = require('./components/ui/GlassmorphismModal').default;
    MasonryGrid = require('./components/ui/MasonryGrid').default;
    SkeletonLoader = require('./components/ui/SkeletonLoader').default;
    useScrollAnimation = require('./hooks/useScrollAnimation').useScrollAnimation;
} catch (error) {
    console.warn('Some components failed to load:', error);
}

// Initialize scroll animations on page load
document.addEventListener('DOMContentLoaded', () => {
    try {
        // Scroll animations
        const scrollElements = document.querySelectorAll('.scroll-fade-in');
        
        if (scrollElements.length > 0) {
            const scrollObserver = new IntersectionObserver(
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

            scrollElements.forEach((el) => scrollObserver.observe(el));
        }

        // Mount React components if they exist
        mountReactComponents();
    } catch (error) {
        console.error('DOMContentLoaded initialization error:', error);
    }
});

// Function to mount React components with error handling
function mountReactComponents() {
    try {
        // Mount InteractiveCard components
        if (InteractiveCard) {
            document.querySelectorAll('[data-react-interactive-card]').forEach((element) => {
                try {
                    const props = JSON.parse(element.dataset.reactInteractiveCard || '{}');
                    const root = ReactDOM.createRoot(element);
                    root.render(React.createElement(InteractiveCard, props));
                } catch (e) {
                    console.warn('Failed to mount InteractiveCard:', e);
                }
            });
        }

        // Mount AnimatedCounter components
        if (AnimatedCounter) {
            document.querySelectorAll('[data-react-counter]').forEach((element) => {
                try {
                    const props = JSON.parse(element.dataset.reactCounter || '{}');
                    const root = ReactDOM.createRoot(element);
                    root.render(React.createElement(AnimatedCounter, props));
                } catch (e) {
                    console.warn('Failed to mount AnimatedCounter:', e);
                }
            });
        }

        // Mount MasonryGrid components
        if (MasonryGrid) {
            document.querySelectorAll('[data-react-masonry]').forEach((element) => {
                try {
                    const props = JSON.parse(element.dataset.reactMasonry || '{}');
                    const root = ReactDOM.createRoot(element);
                    root.render(React.createElement(MasonryGrid, props));
                } catch (e) {
                    console.warn('Failed to mount MasonryGrid:', e);
                }
            });
        }
    } catch (error) {
        console.error('React components mounting error:', error);
    }
}

// Export components for use in other modules
export {
  AnimatedCounter,
  GlassmorphismModal, InteractiveCard, MasonryGrid,
  SkeletonLoader, useScrollAnimation
};

// Smooth scroll to anchors with error handling
document.addEventListener('click', (e) => {
    try {
        const target = e.target.closest('a[href^="#"]');
        if (target && target.hash) {
            e.preventDefault();
            const element = document.querySelector(target.hash);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    } catch (error) {
        console.warn('Smooth scroll error:', error);
    }
});

// Page transition loader with error handling
window.addEventListener('beforeunload', () => {
    try {
        document.body.classList.add('page-transition');
    } catch (error) {
        // Silently fail on beforeunload
    }
});
