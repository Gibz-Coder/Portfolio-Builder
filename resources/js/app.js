import './bootstrap';

import Alpine from 'alpinejs';

// Make Alpine available globally before starting
window.Alpine = Alpine;

// Start Alpine.js immediately
try {
    Alpine.start();
} catch (error) {
    // Silent error handling
}

// Alpine.js initialization events
document.addEventListener('alpine:init', () => {
    // Alpine.js initialized
});

document.addEventListener('alpine:initialized', () => {
    // Alpine.js fully initialized
});
