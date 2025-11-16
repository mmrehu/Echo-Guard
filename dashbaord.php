<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard | Privacy Dashboard</title>
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
        
        .grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }
        
        .privacy-score {
            text-align: center;
            padding: 2rem;
            position: relative;
        }
        
        .score-circle {
            width: 200px;
            height: 200px;
            margin: 0 auto 1.5rem;
            position: relative;
        }
        
        .score-value {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            font-weight: 700;
            font-family: 'Orbitron', sans-serif;
            color: var(--success);
        }
        
        .score-trend {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        
        .trend-up {
            color: var(--danger);
        }
        
        .trend-down {
            color: var(--success);
        }
        
        .threat-monitor {
            position: relative;
            overflow: hidden;
        }
        
        .threat-list {
            list-style: none;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .threat-item {
            padding: 0.8rem;
            border-left: 3px solid var(--danger);
            margin-bottom: 0.8rem;
            background: rgba(255, 55, 95, 0.1);
            border-radius: 0 4px 4px 0;
            animation: pulse 2s infinite;
        }
        
        .threat-item.medium {
            border-left-color: var(--warning);
            background: rgba(255, 170, 0, 0.1);
            animation: none;
        }
        
        .threat-item.low {
            border-left-color: var(--primary);
            background: rgba(0, 198, 255, 0.1);
            animation: none;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        
        .threat-app {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        
        .threat-desc {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .action-btn {
            flex: 1;
            min-width: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.2);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            background: rgba(0, 198, 255, 0.1);
            border-color: var(--primary);
            transform: translateY(-5px);
        }
        
        .action-icon {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .heatmap {
            height: 200px;
            display: flex;
            align-items: flex-end;
            gap: 4px;
            margin-top: 1rem;
        }
        
        .heatbar {
            flex: 1;
            background: linear-gradient(to top, var(--primary), var(--secondary));
            border-radius: 2px 2px 0 0;
            position: relative;
        }
        
        .heatbar-label {
            position: absolute;
            bottom: -25px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 0.8rem;
            color: var(--gray);
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
        
        .app-permissions {
            display: flex;
            gap: 5px;
            margin-top: 0.5rem;
        }
        
        .permission-badge {
            padding: 0.2rem 0.5rem;
            background: rgba(0, 198, 255, 0.2);
            border-radius: 12px;
            font-size: 0.7rem;
            color: var(--primary);
        }
        
        .risk-high {
            color: var(--danger);
        }
        
        .risk-medium {
            color: var(--warning);
        }
        
        .risk-low {
            color: var(--success);
        }
        
        .timeline {
            position: relative;
            padding-left: 2rem;
            margin-top: 2rem;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary);
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary);
        }
        
        .timeline-item.suspicious::before {
            background: var(--danger);
            box-shadow: 0 0 0 3px rgba(255, 55, 95, 0.3);
        }
        
        .timeline-time {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .alert {
            display: flex;
            align-items: flex-start;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            background: rgba(255, 55, 95, 0.1);
            border-left: 4px solid var(--danger);
        }
        
        .alert-icon {
            margin-right: 1rem;
            font-size: 1.5rem;
            color: var(--danger);
        }
        
        .alert-content {
            flex: 1;
        }
        
        .alert-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .alert-desc {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .simulation-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .simulation-scenario {
            padding: 1.5rem;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .simulation-scenario:hover {
            background: rgba(0, 198, 255, 0.1);
            transform: translateY(-5px);
        }
        
        .simulation-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }
        
        .simulation-icon {
            font-size: 1.5rem;
            color: var(--primary);
        }
        
        .permission-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        .permission-active {
            background: var(--danger);
            animation: blink 1.5s infinite;
        }
        
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0.3; }
            100% { opacity: 1; }
        }
        
        .permission-inactive {
            background: var(--gray);
        }
        
        /* Simulation Modal Styles */
        .simulation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(5, 7, 15, 0.95);
            z-index: 1000;
            overflow-y: auto;
        }
        
        .simulation-content {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid var(--primary);
            max-width: 800px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .close-simulation {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: var(--light);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .close-simulation:hover {
            color: var(--primary);
        }
        
        .simulation-step {
            margin: 1.5rem 0;
            padding: 1.5rem;
            background: rgba(10, 14, 23, 0.7);
            border-radius: 8px;
            border: 1px solid rgba(0, 198, 255, 0.2);
        }
        
        .simulation-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .simulation-choice {
            padding: 1rem;
            background: rgba(0, 198, 255, 0.1);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .simulation-choice:hover {
            background: rgba(0, 198, 255, 0.2);
            transform: translateY(-3px);
        }
        
        .simulation-result {
            padding: 1.5rem;
            margin-top: 1.5rem;
            border-radius: 8px;
            display: none;
        }
        
        .result-success {
            background: rgba(0, 210, 106, 0.2);
            border: 1px solid var(--success);
        }
        
        .result-failure {
            background: rgba(255, 55, 95, 0.2);
            border: 1px solid var(--danger);
        }
        
        .simulation-progress {
            display: flex;
            justify-content: space-between;
            margin: 1.5rem 0;
        }
        
        .progress-step {
            flex: 1;
            text-align: center;
            padding: 0.5rem;
            position: relative;
        }
        
        .progress-step.active {
            color: var(--primary);
            font-weight: 600;
        }
        
        .progress-step.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 25%;
            width: 50%;
            height: 2px;
            background: var(--primary);
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
            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .grid, .grid-2, .grid-3, .grid-4 {
                grid-template-columns: 1fr;
            }
            
            nav ul {
                gap: 1rem;
            }
            
            .quick-actions {
                flex-direction: column;
            }
            
            .simulation-choices {
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
$page_title = "App Permissions Center | EchoGuard";
include 'header.php';
?>
    
    <div class="container">
        <!-- Dashboard Page -->
        <div id="dashboard" class="page active">
            <h1>Privacy Dashboard</h1>
            
            <div class="grid grid-3">
                <div class="card privacy-score">
                    <h2>Privacy Score</h2>
                    <div class="score-circle">
                        <canvas id="scoreChart"></canvas>
                        <div class="score-value">78</div>
                    </div>
                    <p>Your digital privacy is better than 65% of users</p>
                    <div class="score-trend">
                        <i class="fas fa-arrow-down trend-down"></i>
                        <span>Improved by 12 points this week</span>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Live Threat Monitor</h3>
                        <span class="permission-indicator permission-active"></span>
                    </div>
                    <ul class="threat-list">
                        <li class="threat-item">
                            <div class="threat-app">SocialSync</div>
                            <div class="threat-desc">Accessed microphone in background without user interaction</div>
                        </li>
                        <li class="threat-item medium">
                            <div class="threat-app">ShopEasy</div>
                            <div class="threat-desc">Location accessed 47 times in last 24 hours</div>
                        </li>
                        <li class="threat-item low">
                            <div class="threat-app">WeatherNow</div>
                            <div class="threat-desc">Unusual network activity detected during night hours</div>
                        </li>
                        <li class="threat-item">
                            <div class="threat-app">GameZone</div>
                            <div class="threat-desc">Attempted to access contacts without permission</div>
                        </li>
                    </ul>
                </div>
                
                <div class="card">
                    <h3>Data Access Heatmap</h3>
                    <p>Sensor usage in the last 24 hours</p>
                    <div class="heatmap">
                        <div class="heatbar" style="height: 80%;">
                            <div class="heatbar-label">Mic</div>
                        </div>
                        <div class="heatbar" style="height: 45%;">
                            <div class="heatbar-label">Camera</div>
                        </div>
                        <div class="heatbar" style="height: 95%;">
                            <div class="heatbar-label">Location</div>
                        </div>
                        <div class="heatbar" style="height: 30%;">
                            <div class="heatbar-label">Files</div>
                        </div>
                        <div class="heatbar" style="height: 65%;">
                            <div class="heatbar-label">Clipboard</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-2">
                <div class="card">
                    <h3>Zero-Day Watchlist</h3>
                    <p>Apps behaving strangely after recent updates</p>
                    <ul class="app-list">
                        <li class="app-item">
                            <div class="app-icon" style="background: #ff375f;">SC</div>
                            <div class="app-details">
                                <div class="app-name">SocialConnect</div>
                                <div>Added 3 new permissions in v4.2</div>
                                <div class="app-permissions">
                                    <span class="permission-badge">Camera</span>
                                    <span class="permission-badge">Contacts</span>
                                    <span class="permission-badge">Location</span>
                                </div>
                            </div>
                            <div class="risk-high">High Risk</div>
                        </li>
                        <li class="app-item">
                            <div class="app-icon" style="background: #ffaa00;">FN</div>
                            <div class="app-details">
                                <div class="app-name">FinanceTracker</div>
                                <div>Background data usage increased by 240%</div>
                                <div class="app-permissions">
                                    <span class="permission-badge">Files</span>
                                    <span class="permission-badge">Network</span>
                                </div>
                            </div>
                            <div class="risk-medium">Medium Risk</div>
                        </li>
                    </ul>
                </div>
                
                <div class="card">
                    <h3>Quick Action Bar</h3>
                    <p>One-tap privacy controls</p>
                    <div class="quick-actions">
                        <div class="action-btn" id="revokeMics">
                            <i class="fas fa-microphone-slash action-icon"></i>
                            <span>Revoke All Mics</span>
                        </div>
                        <div class="action-btn" id="pauseLocation">
                            <i class="fas fa-map-marker-alt action-icon"></i>
                            <span>Pause Location</span>
                        </div>
                        <div class="action-btn" id="stealthMode">
                            <i class="fas fa-user-secret action-icon"></i>
                            <span>Stealth Mode</span>
                        </div>
                        <div class="action-btn" id="runScan">
                            <i class="fas fa-shield-alt action-icon"></i>
                            <span>Run Scan</span>
                        </div>
                    </div>
                    
                    <h4 style="margin-top: 2rem;">Why Your Score Dropped</h4>
                    <p>SocialConnect accessed your microphone 12 times without clear reason in the last 48 hours.</p>
                    
                    <h4 style="margin-top: 1.5rem;">Top 3 Risky Apps Today</h4>
                    <ol style="margin-left: 1.5rem;">
                        <li>SocialConnect - High risk</li>
                        <li>ShopEasy - Medium risk</li>
                        <li>GameZone - Medium risk</li>
                    </ol>
                </div>
            </div>
        </div>
        
        <!-- App Permissions Page -->
        <div id="permissions" class="page">
            <h1>App Permissions Center</h1>
            
            <div class="card">
                <h2>Application Risk Assessment</h2>
                <p>Monitor and control what each app can access on your device</p>
                
                <ul class="app-list">
                    <li class="app-item">
                        <div class="app-icon" style="background: #ff375f;">SC</div>
                        <div class="app-details">
                            <div class="app-name">SocialConnect</div>
                            <div>Social Media • 142 MB • Updated 2 days ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Camera</span>
                                <span class="permission-badge">Mic</span>
                                <span class="permission-badge">Location</span>
                                <span class="permission-badge">Files</span>
                                <span class="permission-badge">Contacts</span>
                            </div>
                        </div>
                        <div class="risk-high">High Risk</div>
                    </li>
                    <li class="app-item">
                        <div class="app-icon" style="background: #ffaa00;">SE</div>
                        <div class="app-details">
                            <div class="app-name">ShopEasy</div>
                            <div>Shopping • 87 MB • Updated 1 week ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Location</span>
                                <span class="permission-badge">Files</span>
                                <span class="permission-badge">Clipboard</span>
                            </div>
                        </div>
                        <div class="risk-medium">Medium Risk</div>
                    </li>
                    <li class="app-item">
                        <div class="app-icon" style="background: #00d26a;">WN</div>
                        <div class="app-details">
                            <div class="app-name">WeatherNow</div>
                            <div>Weather • 34 MB • Updated 3 days ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Location</span>
                            </div>
                        </div>
                        <div class="risk-low">Low Risk</div>
                    </li>
                    <li class="app-item">
                        <div class="app-icon" style="background: #7e42ff;">MM</div>
                        <div class="app-details">
                            <div class="app-name">MusicMood</div>
                            <div>Music • 56 MB • Updated 2 weeks ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Files</span>
                                <span class="permission-badge">Network</span>
                            </div>
                        </div>
                        <div class="risk-low">Low Risk</div>
                    </li>
                </ul>
            </div>
            
            <div class="grid grid-2">
                <div class="card">
                    <h3>Permission Usage Timeline</h3>
                    <p>SocialConnect - Last 7 days</p>
                    <canvas id="permissionChart" height="200"></canvas>
                </div>
                
                <div class="card">
                    <h3>Hidden Trackers Detected</h3>
                    <p>Third-party services embedded in your apps</p>
                    <ul style="list-style: none; margin-top: 1rem;">
                        <li style="padding: 0.8rem; border-left: 3px solid var(--danger); margin-bottom: 0.8rem; background: rgba(255, 55, 95, 0.1);">
                            <strong>Facebook Analytics</strong> - Found in SocialConnect, ShopEasy
                        </li>
                        <li style="padding: 0.8rem; border-left: 3px solid var(--warning); margin-bottom: 0.8rem; background: rgba(255, 170, 0, 0.1);">
                            <strong>Google AdMob</strong> - Found in GameZone, ShopEasy
                        </li>
                        <li style="padding: 0.8rem; border-left: 3px solid var(--primary); margin-bottom: 0.8rem; background: rgba(0, 198, 255, 0.1);">
                            <strong>Amplitude</strong> - Found in WeatherNow
                        </li>
                    </ul>
                    
                    <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
                        <button class="btn" id="autoRestrict"><i class="fas fa-ban"></i> Auto Restrict</button>
                        <button class="btn btn-outline" id="sandboxApp"><i class="fas fa-box"></i> Sandbox</button>
                        <button class="btn btn-outline" id="reportApp"><i class="fas fa-flag"></i> Report</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Data Timeline Page -->
        <div id="timeline" class="page">
            <h1>Data Access Timeline</h1>
            
            <div class="card">
                <h2>Advanced Forensics</h2>
                <p>Monitor all data access events with detailed context</p>
                
                <div class="timeline">
                    <div class="timeline-item suspicious">
                        <div class="timeline-time">08:45 AM</div>
                        <div class="card" style="margin-bottom: 0;">
                            <div class="app-name">SocialConnect</div>
                            <p>Accessed microphone for 2 minutes while screen was off</p>
                            <div class="app-permissions">
                                <span class="permission-badge">Microphone</span>
                                <span class="permission-badge">Background</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-time">09:12 AM</div>
                        <div class="card" style="margin-bottom: 0;">
                            <div class="app-name">WeatherNow</div>
                            <p>Requested location access - User approved</p>
                            <div class="app-permissions">
                                <span class="permission-badge">Location</span>
                                <span class="permission-badge">Foreground</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-time">10:30 AM</div>
                        <div class="card" style="margin-bottom: 0;">
                            <div class="app-name">ShopEasy</div>
                            <p>Accessed clipboard content - Copied product link</p>
                            <div class="app-permissions">
                                <span class="permission-badge">Clipboard</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item suspicious">
                        <div class="timeline-time">11:05 AM</div>
                        <div class="card" style="margin-bottom: 0;">
                            <div class="app-name">GameZone</div>
                            <p>Attempted to access contacts - Blocked by EchoGuard</p>
                            <div class="app-permissions">
                                <span class="permission-badge">Contacts</span>
                                <span class="permission-badge">Blocked</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; text-align: center;">
                    <button class="btn" id="playbackMode"><i class="fas fa-play-circle"></i> Playback Mode: "Show me what happened today"</button>
                </div>
            </div>
            
            <div class="grid grid-2">
                <div class="card">
                    <h3>Correlation Analysis</h3>
                    <p>Mic activated + Data sent correlation detected</p>
                    <canvas id="correlationChart" height="200"></canvas>
                </div>
                
                <div class="card">
                    <h3>Context View</h3>
                    <p>Device and user state during access events</p>
                    <ul style="list-style: none; margin-top: 1rem;">
                        <li style="padding: 0.8rem; display: flex; justify-content: space-between;">
                            <span>Screen State:</span>
                            <span>Off during 67% of suspicious accesses</span>
                        </li>
                        <li style="padding: 0.8rem; display: flex; justify-content: space-between;">
                            <span>User Activity:</span>
                            <span>Asleep during 42% of night accesses</span>
                        </li>
                        <li style="padding: 0.8rem; display: flex; justify-content: space-between;">
                            <span>Network:</span>
                            <span>82% of data sent over cellular</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Threat Alerts Page -->
        <div id="alerts" class="page">
            <h1>Threat Alerts & Notifications</h1>
            
            <div class="card">
                <h2>Active Security Alerts</h2>
                
                <div class="alert">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Permission Spike Detected</div>
                        <div class="alert-desc">SocialConnect accessed microphone 12 times in 2 hours - 400% increase from normal</div>
                        <div style="margin-top: 0.5rem;">
                            <span class="permission-badge">Severity: High</span>
                            <span class="permission-badge">Root Cause: Background Service</span>
                        </div>
                    </div>
                </div>
                
                <div class="alert">
                    <div class="alert-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Silent Location Pings</div>
                        <div class="alert-desc">ShopEasy requested location 8 times while app was in background</div>
                        <div style="margin-top: 0.5rem;">
                            <span class="permission-badge">Severity: Medium</span>
                            <span class="permission-badge">Root Cause: Geofencing API</span>
                        </div>
                    </div>
                </div>
                
                <div class="alert">
                    <div class="alert-icon">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Clipboard Reading</div>
                        <div class="alert-desc">3 apps accessed clipboard without clear user action in last hour</div>
                        <div style="margin-top: 0.5rem;">
                            <span class="permission-badge">Severity: Medium</span>
                            <span class="permission-badge">Root Cause: Auto-fill detection</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-2">
                <div class="card">
                    <h3>Alert Statistics</h3>
                    <p>Weekly alert distribution by type</p>
                    <canvas id="alertChart" height="250"></canvas>
                </div>
                
                <div class="card">
                    <h3>Recommended Actions</h3>
                    <p>Based on your current threat profile</p>
                    
                    <ul style="list-style: none; margin-top: 1rem;">
                        <li style="padding: 1rem; border-left: 3px solid var(--danger); margin-bottom: 1rem; background: rgba(255, 55, 95, 0.1);">
                            <strong>Revoke microphone permission from SocialConnect</strong>
                            <p style="margin-top: 0.5rem; font-size: 0.9rem;">This app has accessed microphone 47 times this week without clear user benefit.</p>
                            <button class="btn applyFix" data-app="SocialConnect" data-permission="Microphone">Apply Fix</button>
                        </li>
                        
                        <li style="padding: 1rem; border-left: 3px solid var(--warning); margin-bottom: 1rem; background: rgba(255, 170, 0, 0.1);">
                            <strong>Restrict ShopEasy to foreground-only location</strong>
                            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Prevent unnecessary location tracking when not actively using the app.</p>
                            <button class="btn applyFix" data-app="ShopEasy" data-permission="Location">Apply Fix</button>
                        </li>
                    </ul>
                    
                    <div style="margin-top: 1.5rem; text-align: center;">
                        <button class="btn btn-danger" id="resolveAll"><i class="fas fa-bolt"></i> One-Tap "Resolve All"</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Security Simulation Page -->
        <div id="simulation" class="page">
            <h1>Security Simulation Center</h1>
            
            <div class="card">
                <h2>Interactive Privacy Training</h2>
                <p>Test your knowledge against common privacy threats in a safe environment</p>
                
                <div class="simulation-container">
                    <div class="simulation-scenario" data-simulation="breach">
                        <div class="simulation-title">
                            <i class="fas fa-virus simulation-icon"></i>
                            <h3>Live Breach Simulation</h3>
                        </div>
                        <p>Experience what happens when an app tries to exfiltrate your personal data without permission.</p>
                        <div style="margin-top: 1rem;">
                            <button class="btn start-simulation" data-simulation="breach"><i class="fas fa-play"></i> Start Simulation</button>
                        </div>
                    </div>
                    
                    <div class="simulation-scenario" data-simulation="phishing">
                        <div class="simulation-title">
                            <i class="fas fa-fish simulation-icon"></i>
                            <h3>Phishing Permission Prompt</h3>
                        </div>
                        <p>Learn to identify fake permission requests designed to trick you into granting unnecessary access.</p>
                        <div style="margin-top: 1rem;">
                            <button class="btn start-simulation" data-simulation="phishing"><i class="fas fa-play"></i> Start Simulation</button>
                        </div>
                    </div>
                    
                    <div class="simulation-scenario" data-simulation="malicious">
                        <div class="simulation-title">
                            <i class="fas fa-code-branch simulation-icon"></i>
                            <h3>Malicious Update Scenario</h3>
                        </div>
                        <p>Discover how seemingly innocent app updates can introduce new privacy risks.</p>
                        <div style="margin-top: 1rem;">
                            <button class="btn start-simulation" data-simulation="malicious"><i class="fas fa-play"></i> Start Simulation</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-2">
                <div class="card">
                    <h3>Your Simulation Score</h3>
                    <div style="text-align: center; padding: 2rem;">
                        <div style="font-size: 3rem; font-weight: bold; color: var(--success);">84%</div>
                        <p>Privacy Defense Rating</p>
                        <div style="margin-top: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span>Threat Detection:</span>
                                <span>92%</span>
                            </div>
                            <div style="height: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; overflow: hidden;">
                                <div style="height: 100%; width: 92%; background: var(--success);"></div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; margin: 1rem 0 0.5rem;">
                                <span>Response Time:</span>
                                <span>76%</span>
                            </div>
                            <div style="height: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; overflow: hidden;">
                                <div style="height: 100%; width: 76%; background: var(--warning);"></div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; margin: 1rem 0 0.5rem;">
                                <span>Preventive Actions:</span>
                                <span>88%</span>
                            </div>
                            <div style="height: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; overflow: hidden;">
                                <div style="height: 100%; width: 88%; background: var(--success);"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <h3>Leaderboard</h3>
                    <p>Compare your privacy skills with other EchoGuard users</p>
                    
                    <ul style="list-style: none; margin-top: 1rem;">
                        <li style="padding: 1rem; display: flex; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div style="width: 30px; height: 30px; border-radius: 50%; background: gold; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold;">1</div>
                            <div style="flex: 1;">
                                <div>PrivacyPro92</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Score: 96%</div>
                            </div>
                            <div class="risk-low">Elite</div>
                        </li>
                        
                        <li style="padding: 1rem; display: flex; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div style="width: 30px; height: 30px; border-radius: 50%; background: silver; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold;">2</div>
                            <div style="flex: 1;">
                                <div>DataGuardian</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Score: 93%</div>
                            </div>
                            <div class="risk-low">Expert</div>
                        </li>
                        
                        <li style="padding: 1rem; display: flex; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div style="width: 30px; height: 30px; border-radius: 50%; background: #cd7f32; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold;">3</div>
                            <div style="flex: 1;">
                                <div>SecureUser</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Score: 89%</div>
                            </div>
                            <div class="risk-low">Expert</div>
                        </li>
                        
                        <li style="padding: 1rem; display: flex; align-items: center;">
                            <div style="width: 30px; height: 30px; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold;">7</div>
                            <div style="flex: 1;">
                                <div>You</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Score: 84%</div>
                            </div>
                            <div class="risk-medium">Advanced</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Stealth Mode Page -->
        <div id="stealth" class="page">
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
    
    <!-- Simulation Modal -->
    <div id="simulationModal" class="simulation-modal">
        <div class="simulation-content">
            <button class="close-simulation">&times;</button>
            <div id="simulationModalContent">
                <!-- Simulation content will be loaded here -->
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

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Page navigation
      
        
        // Simulation Modal Functionality
        const simulationModal = document.getElementById('simulationModal');
        const closeSimulationBtn = document.querySelector('.close-simulation');
        const simulationModalContent = document.getElementById('simulationModalContent');
        
        // Close simulation modal
        closeSimulationBtn.addEventListener('click', function() {
            simulationModal.style.display = 'none';
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === simulationModal) {
                simulationModal.style.display = 'none';
            }
        });
        
        // Start simulation function
       
        
        // Make all simulation buttons work
        document.querySelectorAll('.start-simulation').forEach(button => {
            button.addEventListener('click', function() {
                const simulationType = this.getAttribute('data-simulation');
                startSimulation(simulationType);
            });
        });
        
        // Make quick action buttons work
        document.getElementById('revokeMics').addEventListener('click', function() {
            alert('All microphone permissions have been revoked from apps. SocialConnect and 3 other apps affected.');
        });
        
        document.getElementById('pauseLocation').addEventListener('click', function() {
            alert('Location access paused for all apps. Will resume in 1 hour or when manually enabled.');
        });
        
        document.getElementById('stealthMode').addEventListener('click', function() {
            // Navigate to stealth mode page
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.querySelector('[data-page="stealth"]').classList.add('active');
            document.getElementById('stealth').classList.add('active');
        });
        
        document.getElementById('runScan').addEventListener('click', function() {
            alert('Security scan initiated...\nScanning 24 apps for privacy risks...\nScan complete: 3 high-risk apps detected.');
        });
        
        // Make permission page buttons work
        document.getElementById('autoRestrict').addEventListener('click', function() {
            alert('Auto-restrict enabled. High-risk permissions will be automatically restricted for new apps.');
        });
        
        document.getElementById('sandboxApp').addEventListener('click', function() {
            alert('App sandboxing enabled. Selected apps will run in isolated environments with fake data.');
        });
        
        document.getElementById('reportApp').addEventListener('click', function() {
            alert('Privacy violation report submitted. Our team will review the app for policy violations.');
        });
        
        // Make timeline page button work
        document.getElementById('playbackMode').addEventListener('click', function() {
            alert('Starting privacy event playback...\nShowing all data access events from today in chronological order.');
        });
        
        // Make threat alerts page buttons work
        document.querySelectorAll('.applyFix').forEach(button => {
            button.addEventListener('click', function() {
                const app = this.getAttribute('data-app');
                const permission = this.getAttribute('data-permission');
                alert(`Fixed applied: ${permission} access revoked for ${app}.`);
                this.textContent = 'Fixed ✓';
                this.disabled = true;
            });
        });
        
        document.getElementById('resolveAll').addEventListener('click', function() {
            alert('All recommended fixes applied automatically.\n• Microphone access revoked for SocialConnect\n• Location restricted to foreground for ShopEasy\n• Clipboard access blocked for GameZone');
            document.querySelectorAll('.applyFix').forEach(button => {
                button.textContent = 'Fixed ✓';
                button.disabled = true;
            });
        });
        
        // Initialize charts (simplified version)
        window.addEventListener('load', function() {
            // Privacy score chart
            const scoreCtx = document.getElementById('scoreChart');
            if (scoreCtx) {
                const scoreChart = new Chart(scoreCtx, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [78, 22],
                            backgroundColor: [
                                'rgba(0, 210, 106, 0.8)',
                                'rgba(255, 55, 95, 0.2)'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        cutout: '70%',
                        responsive: true,
                        maintainAspectRatio: true
                    }
                });
            }
        });
    </script>
</body>
</html>