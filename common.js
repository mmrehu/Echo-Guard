// Safe element query function
function safeQueryAll(selector, callback) {
    const elements = document.querySelectorAll(selector);
    if (elements.length > 0) {
        callback(elements);
    }
}

// Initialize AOS
AOS.init({
    duration: 800,
    once: true
});

// Common toggle switch functionality
safeQueryAll('.toggle-switch input', function(toggles) {
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const slider = this.nextElementSibling;
            if (this.checked) {
                slider.style.boxShadow = '0 0 10px rgba(0, 198, 255, 0.5)';
            } else {
                slider.style.boxShadow = 'none';
            }
            
            setTimeout(() => {
                slider.style.boxShadow = 'none';
            }, 500);
        });
    });
});