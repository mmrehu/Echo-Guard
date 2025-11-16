<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stealth Mode | EchoGuard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Exo+2:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #c0003a 100%);
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--success) 0%, #00a855 100%);
        }
        
        .container {
            max-width: 1400px;
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
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .card-title {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 0;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .status-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .status-active {
            background: rgba(0, 210, 106, 0.2);
            color: var(--success);
        }
        
        .status-inactive {
            background: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }
        
        .status-pending {
            background: rgba(255, 170, 0, 0.2);
            color: var(--warning);
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
        
        .stealth-mode-active {
            background: rgba(0, 198, 255, 0.1);
            border: 1px solid var(--primary);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .stealth-mode-active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(0, 198, 255, 0.1), transparent);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .stealth-icon {
            font-size: 4rem;
            color: var(--primary);
            margin-bottom: 1rem;
            text-shadow: 0 0 20px rgba(0, 198, 255, 0.5);
        }
        
        .app-list {
            list-style: none;
        }
        
        .app-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .app-item:hover {
            background: rgba(0, 198, 255, 0.05);
        }
        
        .app-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: bold;
            color: white;
        }
        
        .app-details {
            flex: 1;
        }
        
        .app-name {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        
        .app-status {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .sandbox-controls {
            display: flex;
            gap: 0.5rem;
        }
        
        .control-btn {
            padding: 0.4rem 0.8rem;
            background: rgba(0, 198, 255, 0.1);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 4px;
            color: var(--light);
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .control-btn:hover {
            background: rgba(0, 198, 255, 0.2);
        }
        
        .virtual-sensors {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .sensor-card {
            padding: 1.5rem;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .sensor-card.active {
            border-color: var(--primary);
            background: rgba(0, 198, 255, 0.1);
        }
        
        .sensor-card:hover {
            transform: translateY(-5px);
        }
        
        .sensor-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .location-presets {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .location-preset {
            padding: 1rem;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .location-preset:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
        }
        
        .location-preset.active {
            border-color: var(--primary);
            background: rgba(0, 198, 255, 0.1);
        }
        
        .location-icon {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .network-rules {
            margin-top: 1.5rem;
        }
        
        .rule-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .rule-item:last-child {
            border-bottom: none;
        }
        
        .rule-info {
            flex: 1;
        }
        
        .rule-name {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        
        .rule-desc {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .auto-reset-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .reset-option {
            padding: 1.5rem;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .reset-option:hover {
            border-color: var(--primary);
        }
        
        .reset-option.active {
            border-color: var(--primary);
            background: rgba(0, 198, 255, 0.1);
        }
        
        .reset-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .protection-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .stat-card {
            padding: 1.5rem;
            background: rgba(0, 198, 255, 0.1);
            border-radius: 8px;
            text-align: center;
            border: 1px solid rgba(0, 198, 255, 0.3);
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
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
        @media (max-width: 1200px) {
            .grid-3 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .grid, .grid-2, .grid-3 {
                grid-template-columns: 1fr;
            }
            
            nav ul {
                gap: 1rem;
            }
            
            .virtual-sensors {
                grid-template-columns: 1fr;
            }
            
            .location-presets {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .auto-reset-options {
                grid-template-columns: 1fr;
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
        <!-- Stealth Mode Page -->
        <div id="stealth" class="page active">
            <h1>Stealth & Sandbox Mode</h1>
            
            <div class="stealth-mode-active">
                <div class="stealth-icon">
                    <i class="fas fa-user-secret"></i>
                </div>
                <h2>Stealth Mode Active</h2>
                <p>Your digital footprint is being masked. Apps are receiving fake data while your real information remains protected.</p>
                <div class="status-indicator status-active">
                    <i class="fas fa-circle"></i>
                    <span>Protection Active - 12 apps sandboxed</span>
                </div>
            </div>
            
            <div class="grid grid-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sandbox Apps</h3>
                        <div class="status-indicator status-active">
                            <i class="fas fa-circle"></i>
                            <span>Active</span>
                        </div>
                    </div>
                    <p>Isolate apps in a secure environment with virtualized data</p>
                    
                    <ul class="app-list">
                        <li class="app-item">
                            <div class="app-icon" style="background: #ff375f;">SC</div>
                            <div class="app-details">
                                <div class="app-name">SocialConnect</div>
                                <div class="app-status">Sandboxed - Virtual data active</div>
                            </div>
                            <div class="sandbox-controls">
                                <button class="control-btn">Configure</button>
                                <button class="control-btn">Remove</button>
                            </div>
                        </li>
                        
                        <li class="app-item">
                            <div class="app-icon" style="background: #ffaa00;">SE</div>
                            <div class="app-details">
                                <div class="app-name">ShopEasy</div>
                                <div class="app-status">Sandboxed - Fake location active</div>
                            </div>
                            <div class="sandbox-controls">
                                <button class="control-btn">Configure</button>
                                <button class="control-btn">Remove</button>
                            </div>
                        </li>
                        
                        <li class="app-item">
                            <div class="app-icon" style="background: #ff375f;">GZ</div>
                            <div class="app-details">
                                <div class="app-name">GameZone</div>
                                <div class="app-status">Sandboxed - Network restricted</div>
                            </div>
                            <div class="sandbox-controls">
                                <button class="control-btn">Configure</button>
                                <button class="control-btn">Remove</button>
                            </div>
                        </li>
                        
                        <li class="app-item">
                            <div class="app-icon" style="background: #7e42ff;">FN</div>
                            <div class="app-details">
                                <div class="app-name">FinanceTracker</div>
                                <div class="app-status">Sandboxed - Virtual sensors</div>
                            </div>
                            <div class="sandbox-controls">
                                <button class="control-btn">Configure</button>
                                <button class="control-btn">Remove</button>
                            </div>
                        </li>
                    </ul>
                    
                    <div style="margin-top: 1.5rem;">
                        <button class="btn btn-outline">
                            <i class="fas fa-plus"></i> Add App to Sandbox
                        </button>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Virtual Sensors</h3>
                        <div class="status-indicator status-active">
                            <i class="fas fa-circle"></i>
                            <span>Active</span>
                        </div>
                    </div>
                    <p>Replace real sensor data with controlled dummy information</p>
                    
                    <div class="virtual-sensors">
                        <div class="sensor-card active">
                            <div class="sensor-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                            <h4>Virtual Camera</h4>
                            <p>Providing fake image feed</p>
                            <div style="margin-top: 1rem;">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="sensor-card active">
                            <div class="sensor-icon">
                                <i class="fas fa-microphone"></i>
                            </div>
                            <h4>Virtual Microphone</h4>
                            <p>Playing silent audio</p>
                            <div style="margin-top: 1rem;">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="sensor-card">
                            <div class="sensor-icon">
                                <i class="fas fa-compass"></i>
                            </div>
                            <h4>Virtual Location</h4>
                            <p>Fake GPS coordinates</p>
                            <div style="margin-top: 1rem;">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <h4>Camera Feed Simulation</h4>
                        <div style="background: rgba(0,0,0,0.3); border-radius: 8px; padding: 1rem; text-align: center; margin-top: 1rem;">
                            <i class="fas fa-camera" style="font-size: 2rem; color: var(--gray); margin-bottom: 0.5rem;"></i>
                            <div>Virtual camera feed active</div>
                            <div style="font-size: 0.8rem; color: var(--gray);">Apps receive synthetic image data</div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Fake Location Mode</h3>
                        <div class="status-indicator status-inactive">
                            <i class="fas fa-circle"></i>
                            <span>Inactive</span>
                        </div>
                    </div>
                    <p>Mask your real location with virtual coordinates</p>
                    
                    <div style="margin-top: 1.5rem;">
                        <h4>Current Location</h4>
                        <div style="background: rgba(0,0,0,0.3); border-radius: 8px; padding: 1rem; margin-top: 0.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-map-marker-alt" style="color: var(--danger);"></i>
                                <span>Real location: San Francisco, CA</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <h4>Fake Location Presets</h4>
                        <div class="location-presets">
                            <div class="location-preset">
                                <div class="location-icon">
                                    <i class="fas fa-snowflake"></i>
                                </div>
                                <div>Oslo, Norway</div>
                            </div>
                            
                            <div class="location-preset">
                                <div class="location-icon">
                                    <i class="fas fa-sun"></i>
                                </div>
                                <div>Sydney, Australia</div>
                            </div>
                            
                            <div class="location-preset active">
                                <div class="location-icon">
                                    <i class="fas fa-tree"></i>
                                </div>
                                <div>Zurich, Switzerland</div>
                            </div>
                            
                            <div class="location-preset">
                                <div class="location-icon">
                                    <i class="fas fa-monument"></i>
                                </div>
                                <div>Tokyo, Japan</div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <h4>Custom Location</h4>
                        <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem;">
                            <input type="text" placeholder="Enter coordinates or address" style="flex: 1; background: rgba(0,0,0,0.3); border: 1px solid rgba(0,198,255,0.3); border-radius: 4px; padding: 0.5rem; color: var(--light);">
                            <button class="btn">Set</button>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <button class="btn">
                            <i class="fas fa-map-marker-alt"></i> Activate Fake Location
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Network Restrictions</h3>
                        <div class="status-indicator status-active">
                            <i class="fas fa-circle"></i>
                            <span>Active</span>
                        </div>
                    </div>
                    <p>Control which apps can access the network and what data they can send</p>
                    
                    <div class="network-rules">
                        <div class="rule-item">
                            <div class="rule-info">
                                <div class="rule-name">No network except whitelisted apps</div>
                                <div class="rule-desc">Only approved apps can access internet</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="rule-item">
                            <div class="rule-info">
                                <div class="rule-name">Block unknown data transfers</div>
                                <div class="rule-desc">Prevent data sending to unverified servers</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="rule-item">
                            <div class="rule-info">
                                <div class="rule-name">Encrypt all network traffic</div>
                                <div class="rule-desc">Add additional encryption layer</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <h4>Network Whitelist</h4>
                        <ul class="app-list">
                            <li class="app-item">
                                <div class="app-icon" style="background: #00d26a;">WN</div>
                                <div class="app-details">
                                    <div class="app-name">WeatherNow</div>
                                    <div class="app-status">Full network access</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </li>
                            
                            <li class="app-item">
                                <div class="app-icon" style="background: #7e42ff;">MM</div>
                                <div class="app-details">
                                    <div class="app-name">MusicMood</div>
                                    <div class="app-status">Streaming only</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Auto-Reset Environment</h3>
                        <div class="status-indicator status-active">
                            <i class="fas fa-circle"></i>
                            <span>Active</span>
                        </div>
                    </div>
                    <p>Automatically reset app environments to prevent data accumulation</p>
                    
                    <div class="auto-reset-options">
                        <div class="reset-option active">
                            <div class="reset-icon">
                                <i class="fas fa-redo"></i>
                            </div>
                            <h4>Every App Launch</h4>
                            <p>Fresh environment each time app opens</p>
                        </div>
                        
                        <div class="reset-option">
                            <div class="reset-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h4>Every 24 Hours</h4>
                            <p>Daily reset at midnight</p>
                        </div>
                        
                        <div class="reset-option">
                            <div class="reset-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <h4>Weekly Reset</h4>
                            <p>Clean slate every Sunday</p>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <h4>Reset Settings</h4>
                        <div class="rule-item">
                            <div class="rule-info">
                                <div class="rule-name">Clear app cache on reset</div>
                                <div class="rule-desc">Remove temporary files and data</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="rule-item">
                            <div class="rule-info">
                                <div class="rule-name">Reset app permissions</div>
                                <div class="rule-desc">Revert to default permission state</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        
                        <div class="rule-item">
                            <div class="rule-info">
                                <div class="rule-name">Preserve login sessions</div>
                                <div class="rule-desc">Keep authentication tokens</div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <button class="btn btn-outline">
                            <i class="fas fa-broom"></i> Reset All Sandboxes Now
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="protection-stats">
                <div class="stat-card">
                    <div class="stat-value">12</div>
                    <div class="stat-label">Apps Sandboxed</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">47</div>
                    <div class="stat-label">Data Requests Blocked</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">2.1MB</div>
                    <div class="stat-label">Fake Data Provided</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value">94%</div>
                    <div class="stat-label">Privacy Improvement</div>
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