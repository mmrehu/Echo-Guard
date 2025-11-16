<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Threat Alerts | EchoGuard</title>
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
        
        .btn-warning {
            background: linear-gradient(135deg, var(--warning) 0%, #cc8800 100%);
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
        
        .alert {
            display: flex;
            align-items: flex-start;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            background: rgba(255, 55, 95, 0.1);
            border-left: 4px solid var(--danger);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transform: translateX(-100%);
        }
        
        .alert.pulse::before {
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }
        
        .alert.warning {
            background: rgba(255, 170, 0, 0.1);
            border-left-color: var(--warning);
        }
        
        .alert.info {
            background: rgba(0, 198, 255, 0.1);
            border-left-color: var(--primary);
        }
        
        .alert.success {
            background: rgba(0, 210, 106, 0.1);
            border-left-color: var(--success);
        }
        
        .alert-icon {
            margin-right: 1rem;
            font-size: 1.5rem;
            color: var(--danger);
            flex-shrink: 0;
        }
        
        .alert.warning .alert-icon {
            color: var(--warning);
        }
        
        .alert.info .alert-icon {
            color: var(--primary);
        }
        
        .alert.success .alert-icon {
            color: var(--success);
        }
        
        .alert-content {
            flex: 1;
        }
        
        .alert-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }
        
        .alert-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        
        .alert-time {
            font-size: 0.8rem;
            color: var(--gray);
            white-space: nowrap;
            margin-left: 1rem;
        }
        
        .alert-desc {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 1rem;
        }
        
        .alert-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .alert-tag {
            padding: 0.3rem 0.6rem;
            background: rgba(0, 198, 255, 0.2);
            border-radius: 12px;
            font-size: 0.7rem;
            color: var(--primary);
        }
        
        .alert.warning .alert-tag {
            background: rgba(255, 170, 0, 0.2);
            color: var(--warning);
        }
        
        .alert.info .alert-tag {
            background: rgba(0, 198, 255, 0.2);
            color: var(--primary);
        }
        
        .alert-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .alert-btn {
            padding: 0.4rem 0.8rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            color: var(--light);
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .alert-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .alert-btn.resolve {
            background: rgba(0, 210, 106, 0.2);
            border-color: var(--success);
            color: var(--success);
        }
        
        .alert-btn.resolve:hover {
            background: var(--success);
            color: var(--dark);
        }
        
        .alert-btn.ignore {
            background: rgba(255, 170, 0, 0.2);
            border-color: var(--warning);
            color: var(--warning);
        }
        
        .alert-btn.ignore:hover {
            background: var(--warning);
            color: var(--dark);
        }
        
        .alert-btn.block {
            background: rgba(255, 55, 95, 0.2);
            border-color: var(--danger);
            color: var(--danger);
        }
        
        .alert-btn.block:hover {
            background: var(--danger);
            color: white;
        }
        
        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .filter-select {
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 4px;
            padding: 0.5rem 1rem;
            color: var(--light);
            font-family: 'Exo 2', sans-serif;
        }
        
        .filter-btn {
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 4px;
            padding: 0.5rem 1rem;
            color: var(--light);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            background: rgba(0, 198, 255, 0.2);
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.2);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card.critical {
            border-color: var(--danger);
            background: rgba(255, 55, 95, 0.1);
        }
        
        .stat-card.warning {
            border-color: var(--warning);
            background: rgba(255, 170, 0, 0.1);
        }
        
        .stat-card.info {
            border-color: var(--primary);
            background: rgba(0, 198, 255, 0.1);
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            font-family: 'Orbitron', sans-serif;
            margin-bottom: 0.5rem;
        }
        
        .stat-card.critical .stat-value {
            color: var(--danger);
        }
        
        .stat-card.warning .stat-value {
            color: var(--warning);
        }
        
        .stat-card.info .stat-value {
            color: var(--primary);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .resolve-all-section {
            text-align: center;
            margin: 2rem 0;
            padding: 2rem;
            background: rgba(255, 55, 95, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(255, 55, 95, 0.3);
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(5, 7, 15, 0.9);
            backdrop-filter: blur(5px);
            z-index: 1000;
            overflow-y: auto;
            padding: 2rem;
        }
        
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background: rgba(10, 14, 23, 0.95);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 12px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
            position: relative;
            animation: modalFadeIn 0.3s ease;
        }
        
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .modal-close {
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
        
        .modal-close:hover {
            color: var(--primary);
        }
        
        .modal-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 198, 255, 0.3);
        }
        
        .modal-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: var(--danger);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            font-size: 1.5rem;
            color: white;
        }
        
        .modal.warning .modal-icon {
            background: var(--warning);
        }
        
        .modal.info .modal-icon {
            background: var(--primary);
        }
        
        .modal-title {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .modal-subtitle {
            font-size: 1rem;
            color: var(--gray);
        }
        
        .modal-tags {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .modal-tag {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .modal-tag.critical {
            background: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }
        
        .modal-tag.warning {
            background: rgba(255, 170, 0, 0.2);
            color: var(--warning);
        }
        
        .modal-tag.info {
            background: rgba(0, 198, 255, 0.2);
            color: var(--primary);
        }
        
        .modal-section {
            margin-bottom: 2rem;
        }
        
        .modal-section h3 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        
        .impact-scenario {
            padding: 1.5rem;
            background: rgba(255, 55, 95, 0.1);
            border-radius: 8px;
            border-left: 4px solid var(--danger);
            margin-top: 1rem;
        }
        
        .impact-scenario h4 {
            color: var(--danger);
            margin-bottom: 0.5rem;
        }
        
        .recommended-fix {
            padding: 1.5rem;
            background: rgba(0, 210, 106, 0.1);
            border-radius: 8px;
            border-left: 4px solid var(--success);
            margin-top: 1rem;
        }
        
        .recommended-fix h4 {
            color: var(--success);
            margin-bottom: 0.5rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
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
            
            .alert-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .alert-time {
                margin-left: 0;
                margin-top: 0.5rem;
            }
            
            .alert-actions {
                flex-wrap: wrap;
            }
            
            .filter-bar {
                flex-direction: column;
            }
            
            .modal-content {
                padding: 1rem;
            }
            
            .modal-header {
                flex-direction: column;
                text-align: center;
            }
            
            .modal-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .action-buttons {
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
        <!-- Threat Alerts Page -->
        <div id="alerts" class="page active">
            <h1>Threat Alerts & Notifications Hub</h1>
            
            <div class="stats-cards">
                <div class="stat-card critical">
                    <div class="stat-value">8</div>
                    <div class="stat-label">Critical Alerts</div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-value">12</div>
                    <div class="stat-label">Medium Alerts</div>
                </div>
                <div class="stat-card info">
                    <div class="stat-value">5</div>
                    <div class="stat-label">Low Alerts</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">25</div>
                    <div class="stat-label">Total Alerts</div>
                </div>
            </div>
            
            <div class="filter-bar">
                <select class="filter-select">
                    <option>All Alert Types</option>
                    <option>Permission Spikes</option>
                    <option>Night-time Data Access</option>
                    <option>Background Camera Usage</option>
                    <option>Silent Location Pings</option>
                    <option>Clipboard Reading</option>
                    <option>Cross-app Communication</option>
                </select>
                
                <select class="filter-select">
                    <option>All Severity Levels</option>
                    <option>Critical</option>
                    <option>Medium</option>
                    <option>Low</option>
                </select>
                
                <select class="filter-select">
                    <option>All Status</option>
                    <option>New</option>
                    <option>In Progress</option>
                    <option>Resolved</option>
                </select>
                
                <div class="filter-btns">
                    <button class="filter-btn active">All</button>
                    <button class="filter-btn">Unresolved</button>
                    <button class="filter-btn">Today</button>
                </div>
            </div>
            
            <div class="card">
                <h2>Active Security Alerts</h2>
                <p>Real-time notifications of potential privacy threats</p>
                
                <div class="alert pulse" data-alert="permission-spike">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-header">
                            <div class="alert-title">Permission Spike Detected</div>
                            <div class="alert-time">2 minutes ago</div>
                        </div>
                        <div class="alert-desc">SocialConnect accessed microphone 12 times in 2 hours - 400% increase from normal usage patterns.</div>
                        <div class="alert-tags">
                            <span class="alert-tag">Critical</span>
                            <span class="alert-tag">Permission Spike</span>
                            <span class="alert-tag">SocialConnect</span>
                        </div>
                        <div class="alert-actions">
                            <button class="alert-btn resolve">Resolve</button>
                            <button class="alert-btn block">Block App</button>
                            <button class="alert-btn">View Details</button>
                        </div>
                    </div>
                </div>
                
                <div class="alert warning" data-alert="location-pings">
                    <div class="alert-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-header">
                            <div class="alert-title">Silent Location Pings</div>
                            <div class="alert-time">15 minutes ago</div>
                        </div>
                        <div class="alert-desc">ShopEasy requested location 8 times while app was in background without user interaction.</div>
                        <div class="alert-tags">
                            <span class="alert-tag">Medium</span>
                            <span class="alert-tag">Location Tracking</span>
                            <span class="alert-tag">ShopEasy</span>
                        </div>
                        <div class="alert-actions">
                            <button class="alert-btn resolve">Resolve</button>
                            <button class="alert-btn ignore">Ignore</button>
                            <button class="alert-btn">View Details</button>
                        </div>
                    </div>
                </div>
                
                <div class="alert" data-alert="background-camera">
                    <div class="alert-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-header">
                            <div class="alert-title">Background Camera Usage</div>
                            <div class="alert-time">1 hour ago</div>
                        </div>
                        <div class="alert-desc">SocialConnect accessed camera for 45 seconds while app was in background and screen was off.</div>
                        <div class="alert-tags">
                            <span class="alert-tag">Critical</span>
                            <span class="alert-tag">Camera Access</span>
                            <span class="alert-tag">Background</span>
                        </div>
                        <div class="alert-actions">
                            <button class="alert-btn resolve">Resolve</button>
                            <button class="alert-btn block">Block Camera</button>
                            <button class="alert-btn">View Details</button>
                        </div>
                    </div>
                </div>
                
                <div class="alert info" data-alert="clipboard-reading">
                    <div class="alert-icon">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-header">
                            <div class="alert-title">Clipboard Reading</div>
                            <div class="alert-time">3 hours ago</div>
                        </div>
                        <div class="alert-desc">3 apps accessed clipboard without clear user action in the last hour. Clipboard contained sensitive information.</div>
                        <div class="alert-tags">
                            <span class="alert-tag">Medium</span>
                            <span class="alert-tag">Clipboard</span>
                            <span class="alert-tag">Multiple Apps</span>
                        </div>
                        <div class="alert-actions">
                            <button class="alert-btn resolve">Resolve</button>
                            <button class="alert-btn">View Details</button>
                        </div>
                    </div>
                </div>
                
                <div class="alert warning" data-alert="night-access">
                    <div class="alert-icon">
                        <i class="fas fa-moon"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-header">
                            <div class="alert-title">Night-time Data Access</div>
                            <div class="alert-time">5 hours ago</div>
                        </div>
                        <div class="alert-desc">SocialConnect accessed network and sent 2.3MB of data between 2:15 AM and 3:30 AM while user was asleep.</div>
                        <div class="alert-tags">
                            <span class="alert-tag">Medium</span>
                            <span class="alert-tag">Night Activity</span>
                            <span class="alert-tag">Data Transfer</span>
                        </div>
                        <div class="alert-actions">
                            <button class="alert-btn resolve">Resolve</button>
                            <button class="alert-btn ignore">Ignore</button>
                            <button class="alert-btn">View Details</button>
                        </div>
                    </div>
                </div>
                
                <div class="alert" data-alert="cross-app">
                    <div class="alert-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-header">
                            <div class="alert-title">Cross-app Communication</div>
                            <div class="alert-time">Yesterday</div>
                        </div>
                        <div class="alert-desc">SocialConnect and ShopExchanged data through shared storage without user consent or clear purpose.</div>
                        <div class="alert-tags">
                            <span class="alert-tag">Critical</span>
                            <span class="alert-tag">Data Sharing</span>
                            <span class="alert-tag">Multiple Apps</span>
                        </div>
                        <div class="alert-actions">
                            <button class="alert-btn resolve">Resolve</button>
                            <button class="alert-btn block">Sandbox Apps</button>
                            <button class="alert-btn">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="resolve-all-section">
                <h3>Quick Resolution</h3>
                <p>Resolve all active alerts with one click</p>
                <button class="btn btn-danger btn-large" id="resolve-all">
                    <i class="fas fa-bolt"></i> One-Tap "Resolve All"
                </button>
            </div>
            
            <div class="grid grid-2">
                <div class="card">
                    <h3>Alert Statistics</h3>
                    <p>Weekly alert distribution by type and severity</p>
                    <canvas id="alertChart" height="250"></canvas>
                </div>
                
                <div class="card">
                    <h3>Top Alert Sources</h3>
                    <p>Apps generating the most security alerts</p>
                    <ul style="list-style: none; margin-top: 1rem;">
                        <li style="padding: 1rem; display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; align-items: center;">
                                <div style="width: 30px; height: 30px; border-radius: 6px; background: #ff375f; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold; color: white; font-size: 0.8rem;">SC</div>
                                <span>SocialConnect</span>
                            </div>
                            <span class="risk-high">12 alerts</span>
                        </li>
                        <li style="padding: 1rem; display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; align-items: center;">
                                <div style="width: 30px; height: 30px; border-radius: 6px; background: #ffaa00; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold; color: white; font-size: 0.8rem;">SE</div>
                                <span>ShopEasy</span>
                            </div>
                            <span class="risk-medium">8 alerts</span>
                        </li>
                        <li style="padding: 1rem; display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div style="display: flex; align-items: center;">
                                <div style="width: 30px; height: 30px; border-radius: 6px; background: #ff375f; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold; color: white; font-size: 0.8rem;">GZ</div>
                                <span>GameZone</span>
                            </div>
                            <span class="risk-high">5 alerts</span>
                        </li>
                        <li style="padding: 1rem; display: flex; justify-content: space-between;">
                            <div style="display: flex; align-items: center;">
                                <div style="width: 30px; height: 30px; border-radius: 6px; background: #00d26a; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-weight: bold; color: white; font-size: 0.8rem;">WN</div>
                                <span>WeatherNow</span>
                            </div>
                            <span class="risk-low">2 alerts</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Alert Detail Modal -->
    <div class="modal" id="alert-modal">
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            
            <div class="modal-header">
                <div class="modal-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="modal-info">
                    <div class="modal-title" id="modal-alert-title">Permission Spike Detected</div>
                    <div class="modal-subtitle" id="modal-alert-subtitle">SocialConnect accessed microphone 12 times in 2 hours</div>
                    <div class="modal-tags">
                        <span class="modal-tag critical">Critical</span>
                        <span class="modal-tag">Permission Spike</span>
                        <span class="modal-tag">SocialConnect</span>
                    </div>
                </div>
            </div>
            
            <div class="modal-section">
                <h3>Alert Details</h3>
                <p><strong>Time Detected:</strong> <span id="modal-alert-time">2 minutes ago</span></p>
                <p><strong>Affected App:</strong> <span id="modal-alert-app">SocialConnect</span></p>
                <p><strong>Root Cause:</strong> <span id="modal-alert-cause">Background service accessing microphone without user interaction</span></p>
                <p><strong>Data Accessed:</strong> <span id="modal-alert-data">Microphone audio data</span></p>
            </div>
            
            <div class="modal-section">
                <h3>Impact Analysis</h3>
                <p>If this activity had not been blocked, the following could have occurred:</p>
                
                <div class="impact-scenario">
                    <h4>Potential Privacy Breach</h4>
                    <p>Your private conversations could have been recorded and transmitted to third-party servers without your knowledge.</p>
                    <p>The collected audio data could be used for voiceprint analysis, behavioral profiling, or targeted advertising.</p>
                </div>
            </div>
            
            <div class="modal-section">
                <h3>Recommended Fix</h3>
                <p>Take the following actions to resolve this security issue:</p>
                
                <div class="recommended-fix">
                    <h4>Immediate Resolution</h4>
                    <p>Revoke microphone permission from SocialConnect and restrict background access for this app.</p>
                    <p>Consider using the sandbox feature to isolate SocialConnect from sensitive device resources.</p>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn btn-success"><i class="fas fa-check-circle"></i> Apply Fix</button>
                <button class="btn btn-outline"><i class="fas fa-ban"></i> Block App</button>
                <button class="btn btn-outline"><i class="fas fa-box"></i> Sandbox App</button>
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