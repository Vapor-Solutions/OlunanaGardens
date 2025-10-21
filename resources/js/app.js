/**
 * Feather Icons
 * Beautiful, minimal icon library
 */
import feather from 'feather-icons';
window.feather = feather;

// Replace all feather icon elements with SVG
document.addEventListener('DOMContentLoaded', function () {
    if (window.feather) {
        window.feather.replace();
    }
});

// Also replace icons when Livewire updates the DOM
if (typeof Livewire !== 'undefined') {
    Livewire.on('update', () => {
        if (window.feather) {
            window.feather.replace();
        }
    });
}
