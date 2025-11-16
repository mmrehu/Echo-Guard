    <footer>
        <p>EchoGuard Privacy Dashboard | Stealth Mode | Data shown is simulated for demonstration purposes</p>
        <p>© 2023 EchoGuard Security. All rights reserved.</p>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Safe element query function
        function safeQueryAll(selector, callback) {
            const elements = document.querySelectorAll(selector);
            if (elements.length > 0) {
                callback(elements);
            }
        }
        
        // Toggle switch animation (only if elements exist)
        safeQueryAll('.toggle-switch input', function(toggles) {
            toggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const setting = this.closest('.rule-item') ? 
                        this.closest('.rule-item').querySelector('.rule-name').textContent :
                        'Sensor setting';
                    const state = this.checked ? 'enabled' : 'disabled';
                    console.log(`${setting} ${state}`);
                    
                    // Add visual feedback
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
        
        // Location preset selection (only if elements exist)
        safeQueryAll('.location-preset', function(presets) {
            presets.forEach(preset => {
                preset.addEventListener('click', function() {
                    document.querySelectorAll('.location-preset').forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    
                    const location = this.querySelector('div:last-child').textContent;
                    console.log(`Location preset selected: ${location}`);
                });
            });
        });
        
        // Reset option selection (only if elements exist)
        safeQueryAll('.reset-option', function(options) {
            options.forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.reset-option').forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    
                    const resetType = this.querySelector('h4').textContent;
                    console.log(`Auto-reset set to: ${resetType}`);
                });
            });
        });
        
        // Sensor card interaction (only if elements exist)
        safeQueryAll('.sensor-card', function(cards) {
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    this.classList.toggle('active');
                    
                    const sensor = this.querySelector('h4').textContent;
                    const state = this.classList.contains('active') ? 'activated' : 'deactivated';
                    console.log(`${sensor} ${state}`);
                });
            });
        });
        
        // Sandbox control buttons (only if elements exist)
        safeQueryAll('.control-btn', function(buttons) {
            buttons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const appItem = this.closest('.app-item');
                    if (!appItem) return;
                    
                    const appName = appItem.querySelector('.app-name').textContent;
                    const action = this.textContent;
                    
                    if (action === 'Remove') {
                        if (confirm(`Remove ${appName} from sandbox?`)) {
                            appItem.style.opacity = '0.5';
                            setTimeout(() => {
                                appItem.remove();
                                updateProtectionStats();
                            }, 500);
                        }
                    } else if (action === 'Configure') {
                        alert(`Opening configuration for ${appName}`);
                    }
                });
            });
        });
        
        // Add app to sandbox (only if element exists)
        safeQueryAll('.btn-outline .fa-plus', function(buttons) {
            buttons.forEach(btn => {
                btn.closest('.btn').addEventListener('click', function() {
                    alert('Opening app selection to add to sandbox...');
                });
            });
        });
        
        // Activate fake location (only if element exists)
        safeQueryAll('.btn .fa-map-marker-alt', function(buttons) {
            buttons.forEach(btn => {
                btn.closest('.btn').addEventListener('click', function() {
                    const activePreset = document.querySelector('.location-preset.active');
                    const location = activePreset ? activePreset.querySelector('div:last-child').textContent : 'custom location';
                    
                    const statusIndicator = document.querySelector('.status-indicator.status-inactive');
                    if (statusIndicator) {
                        statusIndicator.className = 'status-indicator status-active';
                        statusIndicator.querySelector('span').textContent = 'Active';
                    }
                    
                    alert(`Fake location activated: ${location}`);
                });
            });
        });
        
        // Reset all sandboxes (only if element exists)
        safeQueryAll('.btn-outline .fa-broom', function(buttons) {
            buttons.forEach(btn => {
                btn.closest('.btn').addEventListener('click', function() {
                    if (confirm('Reset all sandboxed apps to their initial state? This will clear all temporary data.')) {
                        alert('All sandboxes have been reset.');
                    }
                });
            });
        });
        
        function updateProtectionStats() {
            const sandboxedApps = document.querySelectorAll('.app-list .app-item').length;
            const statValue = document.querySelector('.stat-card .stat-value');
            if (statValue) {
                statValue.textContent = sandboxedApps;
            }
            
            // Update the main status indicator
            const statusText = document.querySelector('.stealth-mode-active .status-indicator span');
            if (statusText) {
                statusText.textContent = `Protection Active - ${sandboxedApps} apps sandboxed`;
            }
        }
        
        // Simulate active protection (only if elements exist)
        const blockedRequestsElement = document.querySelectorAll('.stat-card')[1]?.querySelector('.stat-value');
        const fakeDataElement = document.querySelectorAll('.stat-card')[2]?.querySelector('.stat-value');
        
        if (blockedRequestsElement && fakeDataElement) {
            setInterval(() => {
                const currentValue = parseInt(blockedRequestsElement.textContent);
                blockedRequestsElement.textContent = currentValue + Math.floor(Math.random() * 3);
                
                const dataValue = parseFloat(fakeDataElement.textContent);
                fakeDataElement.textContent = (dataValue + 0.1).toFixed(1) + 'MB';
            }, 5000);
        }
    </script>
</body>
</html>