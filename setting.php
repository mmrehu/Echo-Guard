<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | EchoGuard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Exo+2:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        :root {
            --primary: #00c6ff;
            --secondary: #0072ff;
            --accent: #7e42ff;
            --dark: #0a0e17;
            --darker: #05070f;
            --light: #e0f7ff;
            --danger: #ff375f;
            --warning: #ffaa00;
            --success: #00d26a;
            --gray: #8a8f98;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            color: var(--light);
            font-family: 'Exo 2', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        .cyber-grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 198, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 198, 255, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: -1;
            opacity: 0.3;
        }
        
        .glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(0, 198, 255, 0.1) 0%, rgba(0, 114, 255, 0.05) 40%, rgba(5, 7, 15, 0) 70%);
            pointer-events: none;
            z-index: -1;
        }
        
        header {
            background: rgba(5, 7, 15, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 198, 255, 0.2);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
            text-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
        }
        
        .logo i {
            color: var(--accent);
        }
        
        nav ul {
            display: flex;
            list-style: none;
            gap: 2rem;
        }
        
        nav a {
            color: var(--light);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }
        
        nav a:hover, nav a.active {
            color: var(--primary);
        }
        
        nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }
        
        nav a:hover::after, nav a.active::after {
            width: 100%;
        }
        
        .user-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            font-family: 'Exo 2', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 198, 255, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .page {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .page.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        h1, h2, h3, h4 {
            font-family: 'Orbitron', sans-serif;
            margin-bottom: 1rem;
            color: var(--light);
        }
        
        h1 {
            font-size: 2.5rem;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 2rem;
        }
        
        h2 {
            font-size: 1.8rem;
            color: var(--primary);
            border-bottom: 1px solid rgba(0, 198, 255, 0.3);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }
        
        .card {
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.2);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }
        
        .card:hover {
            border-color: rgba(0, 198, 255, 0.4);
            box-shadow: 0 6px 25px rgba(0, 198, 255, 0.2);
        }
        
        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .settings-section {
            margin-bottom: 2rem;
        }
        
        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .setting-item:last-child {
            border-bottom: none;
        }
        
        .setting-info {
            flex: 1;
        }
        
        .setting-title {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        
        .setting-desc {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.2);
            transition: .4s;
            border-radius: 24px;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: var(--primary);
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }
        
        .select-wrapper {
            position: relative;
            min-width: 150px;
        }
        
        .select-wrapper select {
            background: rgba(0, 198, 255, 0.1);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 4px;
            padding: 0.5rem 1rem;
            color: var(--light);
            font-family: 'Exo 2', sans-serif;
            width: 100%;
            appearance: none;
            cursor: pointer;
        }
        
        .select-wrapper::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            pointer-events: none;
        }
        
        .theme-options {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .theme-option {
            flex: 1;
            padding: 1.5rem;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .theme-option:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
        }
        
        .theme-option.active {
            border-color: var(--primary);
            background: rgba(0, 198, 255, 0.1);
        }
        
        .theme-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }
        
        .security-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .security-option {
            padding: 1.5rem;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .security-option:hover {
            border-color: var(--primary);
        }
        
        .security-option.active {
            border-color: var(--primary);
            background: rgba(0, 198, 255, 0.1);
        }
        
        .security-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }
        
        .pin-setup {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: rgba(0, 198, 255, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(0, 198, 255, 0.3);
        }
        
        .pin-inputs {
            display: flex;
            gap: 0.5rem;
            margin: 1rem 0;
            justify-content: center;
        }
        
        .pin-input {
            width: 40px;
            height: 40px;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 4px;
            background: rgba(0, 198, 255, 0.1);
            color: var(--light);
            text-align: center;
            font-size: 1.2rem;
            font-family: 'Orbitron', sans-serif;
        }
        
        .pin-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .danger-zone {
            margin-top: 3rem;
            padding: 2rem;
            background: rgba(255, 55, 95, 0.1);
            border: 1px solid rgba(255, 55, 95, 0.3);
            border-radius: 8px;
        }
        
        .danger-zone h3 {
            color: var(--danger);
        }
        
        .danger-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #c0003a 100%);
        }
        
        .app-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .info-item {
            padding: 1rem;
            background: rgba(0, 198, 255, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        
        .info-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .info-label {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        footer {
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(0, 198, 255, 0.2);
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Responsive adjustments */
        @media (max-width: 968px) {
            .settings-grid {
                grid-template-columns: 1fr;
            }
            
            .security-options {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            nav ul {
                gap: 1rem;
            }
            
            .theme-options {
                flex-direction: column;
            }
            
            .danger-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    <div class="glow"></div>
    
      <?php
// Set the page title for each page
$page_title = "Page Name | EchoGuard";
include 'header.php';
?>
    
    
    <div class="container">
        <!-- Settings Page -->
        <div id="settings" class="page active">
            <h1>Settings & Preferences</h1>
            
            <div class="settings-grid">
                <div class="settings-column">
                    <!-- Notification Levels -->
                    <div class="card">
                        <h2>Notification Levels</h2>
                        <p>Configure how and when you receive security alerts</p>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Push Notifications</div>
                                <div class="setting-desc">Receive instant alerts for critical threats</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Email Reports</div>
                                <div class="setting-desc">Daily or weekly summary of privacy events</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Alert Sound</div>
                                <div class="setting-desc">Play sound for high-priority alerts</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Vibration</div>
                                <div class="setting-desc">Vibrate device for critical alerts</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Quiet Hours</div>
                                <div class="setting-desc">Silence notifications during specified hours</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Alert Priority</div>
                                <div class="setting-desc">Only show high and critical alerts</div>
                            </div>
                            <div class="select-wrapper">
                                <select>
                                    <option>All Alerts</option>
                                    <option>High & Critical Only</option>
                                    <option>Critical Only</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Simulation Difficulty -->
                    <div class="card">
                        <h2>Simulation Difficulty</h2>
                        <p>Adjust the challenge level of security training scenarios</p>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Difficulty Level</div>
                                <div class="setting-desc">Set the complexity of simulation scenarios</div>
                            </div>
                            <div class="select-wrapper">
                                <select>
                                    <option>Beginner</option>
                                    <option>Intermediate</option>
                                    <option>Advanced</option>
                                    <option>Expert</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Time Pressure</div>
                                <div class="setting-desc">Add time limits to simulation scenarios</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Hints & Tips</div>
                                <div class="setting-desc">Show helpful guidance during simulations</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Realistic Scenarios</div>
                                <div class="setting-desc">Use actual threat patterns from real-world data</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Auto Updates -->
                    <div class="card">
                        <h2>Auto Updates</h2>
                        <p>Manage how EchoGuard stays up-to-date with the latest protections</p>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Threat Database</div>
                                <div class="setting-desc">Automatically download latest threat signatures</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">App Updates</div>
                                <div class="setting-desc">Automatically install EchoGuard updates</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Update Frequency</div>
                                <div class="setting-desc">How often to check for updates</div>
                            </div>
                            <div class="select-wrapper">
                                <select>
                                    <option>Daily</option>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                    <option>Manual Only</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Wi-Fi Only</div>
                                <div class="setting-desc">Only download updates when connected to Wi-Fi</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="settings-column">
                    <!-- Theme Settings -->
                    <div class="card">
                        <h2>Theme & Appearance</h2>
                        <p>Customize the look and feel of EchoGuard</p>
                        
                        <div class="theme-options">
                            <div class="theme-option active">
                                <div class="theme-icon">
                                    <i class="fas fa-moon"></i>
                                </div>
                                <div class="theme-title">Dark Mode</div>
                                <div class="theme-desc">Default cyber theme</div>
                            </div>
                            
                            <div class="theme-option">
                                <div class="theme-icon">
                                    <i class="fas fa-sun"></i>
                                </div>
                                <div class="theme-title">Light Mode</div>
                                <div class="theme-desc">Bright interface</div>
                            </div>
                            
                            <div class="theme-option">
                                <div class="theme-icon">
                                    <i class="fas fa-palette"></i>
                                </div>
                                <div class="theme-title">Glow Mode</div>
                                <div class="theme-desc">Enhanced visual effects</div>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Font Size</div>
                                <div class="setting-desc">Adjust text size for better readability</div>
                            </div>
                            <div class="select-wrapper">
                                <select>
                                    <option>Small</option>
                                    <option>Medium</option>
                                    <option>Large</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Animation Effects</div>
                                <div class="setting-desc">Enable/disable interface animations</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Reduce Motion</div>
                                <div class="setting-desc">Minimize animations for accessibility</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- PIN & Biometric Lock -->
                    <div class="card">
                        <h2>PIN & Biometric Lock</h2>
                        <p>Secure access to EchoGuard with additional authentication</p>
                        
                        <div class="security-options">
                            <div class="security-option active">
                                <div class="security-icon">
                                    <i class="fas fa-fingerprint"></i>
                                </div>
                                <div class="security-title">Biometric</div>
                                <div class="security-desc">Use fingerprint or face recognition</div>
                            </div>
                            
                            <div class="security-option">
                                <div class="security-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="security-title">PIN Code</div>
                                <div class="security-desc">Set a numeric PIN for access</div>
                            </div>
                        </div>
                        
                        <div class="pin-setup">
                            <h4>Setup PIN Code</h4>
                            <p>Enter a 4-digit PIN to secure EchoGuard</p>
                            
                            <div class="pin-inputs">
                                <input type="password" class="pin-input" maxlength="1" pattern="[0-9]">
                                <input type="password" class="pin-input" maxlength="1" pattern="[0-9]">
                                <input type="password" class="pin-input" maxlength="1" pattern="[0-9]">
                                <input type="password" class="pin-input" maxlength="1" pattern="[0-9]">
                            </div>
                            
                            <div class="setting-item">
                                <div class="setting-info">
                                    <div class="setting-title">Auto Lock</div>
                                    <div class="setting-desc">Require authentication after app is inactive</div>
                                </div>
                                <div class="select-wrapper">
                                    <select>
                                        <option>Immediately</option>
                                        <option>After 1 minute</option>
                                        <option>After 5 minutes</option>
                                        <option>After 15 minutes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Privacy Sandbox Settings -->
                    <div class="card">
                        <h2>Privacy Sandbox</h2>
                        <p>Advanced settings for enhanced privacy protection</p>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Auto Revoke at 12AM</div>
                                <div class="setting-desc">Reset permissions for all apps daily</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Foreground Location Only</div>
                                <div class="setting-desc">Prevent background location access</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Mic Whitelist Only</div>
                                <div class="setting-desc">Only allow microphone for approved apps</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Block Unknown Data Transfers</div>
                                <div class="setting-desc">Prevent data transfer to unknown servers</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Protection Mode</div>
                                <div class="setting-desc">Balance between security and convenience</div>
                            </div>
                            <div class="select-wrapper">
                                <select>
                                    <option>Strict Mode</option>
                                    <option>Smart Mode</option>
                                    <option>Balanced Mode</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- App Information -->
            <div class="card">
                <h2>App Information</h2>
                <p>Details about your EchoGuard installation</p>
                
                <div class="app-info">
                    <div class="info-item">
                        <div class="info-value">v2.4.1</div>
                        <div class="info-label">App Version</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-value">1,247</div>
                        <div class="info-label">Threats Blocked</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-value">94%</div>
                        <div class="info-label">Privacy Score</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-value">28 days</div>
                        <div class="info-label">Active Protection</div>
                    </div>
                </div>
                
                <div class="setting-item">
                    <div class="setting-info">
                        <div class="setting-title">Export Data</div>
                        <div class="setting-desc">Download your privacy reports and logs</div>
                    </div>
                    <button class="btn btn-outline">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
                
                <div class="setting-item">
                    <div class="setting-info">
                        <div class="setting-title">Reset Statistics</div>
                        <div class="setting-desc">Clear all usage data and start fresh</div>
                    </div>
                    <button class="btn btn-outline">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                </div>
            </div>
            
            <!-- Danger Zone -->
            <div class="danger-zone">
                <h3>Danger Zone</h3>
                <p>These actions are irreversible. Proceed with caution.</p>
                
                <div class="danger-actions">
                    <button class="btn btn-outline">
                        <i class="fas fa-trash"></i> Clear All Data
                    </button>
                    
                    <button class="btn btn-danger">
                        <i class="fas fa-skull-crossbones"></i> Factory Reset
                    </button>
                    
                    <button class="btn btn-outline">
                        <i class="fas fa-user-slash"></i> Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
    
        <footer>
        <p>EchoGuard Privacy Dashboard | Stealth Mode | Data shown is simulated for demonstration purposes</p>
        <p>© 2023 EchoGuard Security. All rights reserved.</p>
    </footer>

    <script src="common.js"></script>
    <?php 
    // Load page-specific JavaScript
    $current_page = basename($_SERVER['PHP_SELF']);
    $js_file = str_replace('.php', '.js', $current_page);
    if (file_exists($js_file)) {
        echo '<script src="' . $js_file . '"></script>';
    }
    ?>
</body>
</html>