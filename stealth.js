// Stealth mode specific JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Location preset selection
    safeQueryAll('.location-preset', function(presets) {
        presets.forEach(preset => {
            preset.addEventListener('click', function() {
                document.querySelectorAll('.location-preset').forEach(p => p.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
    
    // Add other stealth-specific JavaScript here...
});