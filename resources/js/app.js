import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Dark Mode Manager
const DarkModeManager = {
    init() {
        // Check for saved theme preference or default to system preference
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },

    toggle() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        return isDark;
    },

    isDark() {
        return document.documentElement.classList.contains('dark');
    }
};

// Initialize dark mode
DarkModeManager.init();

// Make DarkModeManager available globally
window.DarkModeManager = DarkModeManager;

// Alpine.js dark mode component
document.addEventListener('alpine:init', () => {
    Alpine.data('darkMode', () => ({
        isDark: DarkModeManager.isDark(),
        
        toggle() {
            this.isDark = DarkModeManager.toggle();
        }
    }));

    // Sidebar toggle for mobile
    Alpine.data('sidebar', () => ({
        open: false,
        
        toggle() {
            this.open = !this.open;
        }
    }));
});

Alpine.start();
