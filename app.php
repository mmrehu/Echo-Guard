<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Permissions Center | EchoGuard</title>
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
        
        .app-list {
            list-style: none;
        }
        
        .app-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .app-item:hover {
            background: rgba(0, 198, 255, 0.05);
        }
        
        .app-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: bold;
            color: white;
            font-size: 1.2rem;
        }
        
        .app-details {
            flex: 1;
        }
        
        .app-name {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        
        .app-category {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }
        
        .app-permissions {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
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
            font-weight: 600;
        }
        
        .risk-medium {
            color: var(--warning);
            font-weight: 600;
        }
        
        .risk-low {
            color: var(--success);
            font-weight: 600;
        }
        
        .permission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .permission-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            background: rgba(0, 198, 255, 0.1);
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .permission-item.active {
            background: rgba(255, 55, 95, 0.2);
            border: 1px solid var(--danger);
        }
        
        .permission-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .permission-item.active .permission-icon {
            color: var(--danger);
        }
        
        .permission-name {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .permission-status {
            font-size: 0.8rem;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            background: rgba(0, 210, 106, 0.2);
            color: var(--success);
        }
        
        .permission-item.active .permission-status {
            background: rgba(255, 55, 95, 0.3);
            color: var(--danger);
        }
        
        .tracker-list {
            list-style: none;
            margin-top: 1rem;
        }
        
        .tracker-item {
            padding: 0.8rem;
            border-left: 3px solid var(--danger);
            margin-bottom: 0.8rem;
            background: rgba(255, 55, 95, 0.1);
            border-radius: 0 4px 4px 0;
        }
        
        .tracker-item.medium {
            border-left-color: var(--warning);
            background: rgba(255, 170, 0, 0.1);
        }
        
        .tracker-item.low {
            border-left-color: var(--primary);
            background: rgba(0, 198, 255, 0.1);
        }
        
        .tracker-name {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        
        .tracker-desc {
            font-size: 0.9rem;
            color: var(--gray);
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
            max-width: 1000px;
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
        
        .modal-app-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            font-weight: bold;
            color: white;
            font-size: 1.5rem;
        }
        
        .modal-app-info {
            flex: 1;
        }
        
        .modal-app-name {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .modal-app-category {
            font-size: 1rem;
            color: var(--gray);
        }
        
        .modal-risk-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .risk-high-bg {
            background: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }
        
        .risk-medium-bg {
            background: rgba(255, 170, 0, 0.2);
            color: var(--warning);
        }
        
        .risk-low-bg {
            background: rgba(0, 210, 106, 0.2);
            color: var(--success);
        }
        
        .modal-tabs {
            display: flex;
            border-bottom: 1px solid rgba(0, 198, 255, 0.3);
            margin-bottom: 1.5rem;
        }
        
        .modal-tab {
            padding: 0.8rem 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }
        
        .modal-tab.active {
            border-bottom-color: var(--primary);
            color: var(--primary);
        }
        
        .modal-tab-content {
            display: none;
        }
        
        .modal-tab-content.active {
            display: block;
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
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .search-bar {
            display: flex;
            margin-bottom: 2rem;
        }
        
        .search-input {
            flex: 1;
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 4px 0 0 4px;
            padding: 0.8rem 1rem;
            color: var(--light);
            font-family: 'Exo 2', sans-serif;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .search-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            padding: 0 1.5rem;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
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
        
        /* Simulation Modal Styles */
        .simulation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(5, 7, 15, 0.95);
            z-index: 2000;
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
            
            .modal-content {
                padding: 1rem;
            }
            
            .modal-header {
                flex-direction: column;
                text-align: center;
            }
            
            .modal-app-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .action-buttons {
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
        <!-- App Permissions Page -->
        <div id="permissions" class="page active">
            <h1>App Permissions Center</h1>
            
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search for apps...">
                <button class="search-btn" id="searchBtn"><i class="fas fa-search"></i></button>
            </div>
            
            <div class="filter-bar">
                <select class="filter-select" id="categoryFilter">
                    <option>All Categories</option>
                    <option>Social Media</option>
                    <option>Productivity</option>
                    <option>Entertainment</option>
                    <option>Shopping</option>
                    <option>Utilities</option>
                </select>
                
                <select class="filter-select" id="riskFilter">
                    <option>All Risk Levels</option>
                    <option>High Risk</option>
                    <option>Medium Risk</option>
                    <option>Low Risk</option>
                </select>
                
                <select class="filter-select" id="sortFilter">
                    <option>Sort by: Risk Level</option>
                    <option>Sort by: Name</option>
                    <option>Sort by: Recent Activity</option>
                </select>
            </div>
            
            <div class="card">
                <h2>Application Risk Assessment</h2>
                <p>Monitor and control what each app can access on your device</p>
                
                <ul class="app-list">
                    <li class="app-item" data-app="socialconnect">
                        <div class="app-icon" style="background: #ff375f;">SC</div>
                        <div class="app-details">
                            <div class="app-name">SocialConnect</div>
                            <div class="app-category">Social Media • 142 MB • Updated 2 days ago</div>
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
                    
                    <li class="app-item" data-app="shopeasy">
                        <div class="app-icon" style="background: #ffaa00;">SE</div>
                        <div class="app-details">
                            <div class="app-name">ShopEasy</div>
                            <div class="app-category">Shopping • 87 MB • Updated 1 week ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Location</span>
                                <span class="permission-badge">Files</span>
                                <span class="permission-badge">Clipboard</span>
                            </div>
                        </div>
                        <div class="risk-medium">Medium Risk</div>
                    </li>
                    
                    <li class="app-item" data-app="weathernow">
                        <div class="app-icon" style="background: #00d26a;">WN</div>
                        <div class="app-details">
                            <div class="app-name">WeatherNow</div>
                            <div class="app-category">Weather • 34 MB • Updated 3 days ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Location</span>
                            </div>
                        </div>
                        <div class="risk-low">Low Risk</div>
                    </li>
                    
                    <li class="app-item" data-app="musicmood">
                        <div class="app-icon" style="background: #7e42ff;">MM</div>
                        <div class="app-details">
                            <div class="app-name">MusicMood</div>
                            <div class="app-category">Music • 56 MB • Updated 2 weeks ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Files</span>
                                <span class="permission-badge">Network</span>
                            </div>
                        </div>
                        <div class="risk-low">Low Risk</div>
                    </li>
                    
                    <li class="app-item" data-app="gamezone">
                        <div class="app-icon" style="background: #ff375f;">GZ</div>
                        <div class="app-details">
                            <div class="app-name">GameZone</div>
                            <div class="app-category">Games • 312 MB • Updated 5 days ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Camera</span>
                                <span class="permission-badge">Mic</span>
                                <span class="permission-badge">Location</span>
                                <span class="permission-badge">Contacts</span>
                            </div>
                        </div>
                        <div class="risk-high">High Risk</div>
                    </li>
                    
                    <li class="app-item" data-app="fitlife">
                        <div class="app-icon" style="background: #00d26a;">FL</div>
                        <div class="app-details">
                            <div class="app-name">FitLife</div>
                            <div class="app-category">Health & Fitness • 78 MB • Updated 1 month ago</div>
                            <div class="app-permissions">
                                <span class="permission-badge">Location</span>
                                <span class="permission-badge">Sensors</span>
                            </div>
                        </div>
                        <div class="risk-low">Low Risk</div>
                    </li>
                </ul>
            </div>
            
            <div class="grid grid-3">
                <div class="card">
                    <h3>Permission Distribution</h3>
                    <p>Across all your installed apps</p>
                    <canvas id="permissionChart" height="250"></canvas>
                </div>
                
                <div class="card">
                    <h3>Risk Level Summary</h3>
                    <p>Breakdown of app security status</p>
                    <canvas id="riskChart" height="250"></canvas>
                </div>
                
                <div class="card">
                    <h3>Recent Permission Changes</h3>
                    <p>Apps that modified permissions</p>
                    <ul class="app-list">
                        <li class="app-item">
                            <div class="app-icon" style="background: #ff375f;">SC</div>
                            <div class="app-details">
                                <div class="app-name">SocialConnect</div>
                                <div>Added Camera permission</div>
                            </div>
                            <div class="risk-high">2 days ago</div>
                        </li>
                        <li class="app-item">
                            <div class="app-icon" style="background: #ffaa00;">SE</div>
                            <div class="app-details">
                                <div class="app-name">ShopEasy</div>
                                <div>Added Clipboard access</div>
                            </div>
                            <div class="risk-medium">1 week ago</div>
                        </li>
                        <li class="app-item">
                            <div class="app-icon" style="background: #7e42ff;">MM</div>
                            <div class="app-details">
                                <div class="app-name">MusicMood</div>
                                <div>Removed Location permission</div>
                            </div>
                            <div class="risk-low">2 weeks ago</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- App Detail Modal -->
    <div class="modal" id="app-modal">
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            
            <div class="modal-header">
                <div class="modal-app-icon" id="modal-app-icon">SC</div>
                <div class="modal-app-info">
                    <div class="modal-app-name" id="modal-app-name">SocialConnect</div>
                    <div class="modal-app-category" id="modal-app-category">Social Media • 142 MB • Updated 2 days ago</div>
                </div>
                <div class="modal-risk-badge risk-high-bg" id="modal-risk">High Risk</div>
            </div>
            
            <div class="modal-tabs">
                <div class="modal-tab active" data-tab="permissions">Permissions</div>
                <div class="modal-tab" data-tab="timeline">Usage Timeline</div>
                <div class="modal-tab" data-tab="trackers">Hidden Trackers</div>
                <div class="modal-tab" data-tab="dataflow">Data Sharing</div>
            </div>
            
            <div class="modal-tab-content active" id="permissions-tab">
                <h3>App Permissions</h3>
                <p>Manage what this app can access on your device</p>
                
                <div class="permission-grid">
                    <div class="permission-item active" data-permission="camera">
                        <i class="fas fa-camera permission-icon"></i>
                        <div class="permission-name">Camera</div>
                        <div class="permission-status">Allowed</div>
                    </div>
                    
                    <div class="permission-item active" data-permission="microphone">
                        <i class="fas fa-microphone permission-icon"></i>
                        <div class="permission-name">Microphone</div>
                        <div class="permission-status">Allowed</div>
                    </div>
                    
                    <div class="permission-item" data-permission="location">
                        <i class="fas fa-map-marker-alt permission-icon"></i>
                        <div class="permission-name">Location</div>
                        <div class="permission-status">Denied</div>
                    </div>
                    
                    <div class="permission-item active" data-permission="files">
                        <i class="fas fa-file permission-icon"></i>
                        <div class="permission-name">Files</div>
                        <div class="permission-status">Allowed</div>
                    </div>
                    
                    <div class="permission-item" data-permission="contacts">
                        <i class="fas fa-users permission-icon"></i>
                        <div class="permission-name">Contacts</div>
                        <div class="permission-status">Denied</div>
                    </div>
                    
                    <div class="permission-item active" data-permission="clipboard">
                        <i class="fas fa-clipboard permission-icon"></i>
                        <div class="permission-name">Clipboard</div>
                        <div class="permission-status">Allowed</div>
                    </div>
                    
                    <div class="permission-item" data-permission="bluetooth">
                        <i class="fas fa-bluetooth permission-icon"></i>
                        <div class="permission-name">Bluetooth</div>
                        <div class="permission-status">Denied</div>
                    </div>
                    
                    <div class="permission-item active" data-permission="background-data">
                        <i class="fas fa-network-wired permission-icon"></i>
                        <div class="permission-name">Background Data</div>
                        <div class="permission-status">Allowed</div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <button class="btn" id="autoRestrictBtn"><i class="fas fa-ban"></i> Auto Restrict</button>
                    <button class="btn btn-outline" id="sandboxAppBtn"><i class="fas fa-box"></i> Sandbox App</button>
                    <button class="btn btn-outline" id="reportAppBtn"><i class="fas fa-flag"></i> Report App</button>
                </div>
            </div>
            
            <div class="modal-tab-content" id="timeline-tab">
                <h3>Permission Usage Timeline</h3>
                <p>Recent activity and access patterns</p>
                
                <div class="timeline">
                    <div class="timeline-item suspicious">
                        <div class="timeline-time">Today, 08:45 AM</div>
                        <div class="card" style="margin-bottom: 0;">
                            <div class="app-name">Microphone Access</div>
                            <p>Accessed microphone for 2 minutes while screen was off</p>
                            <div class="app-permissions">
                                <span class="permission-badge">Background</span>
                                <span class="permission-badge">Suspicious</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-time">Today, 10:12 AM</div>
                        <div class="card" style="margin-bottom: 0;">
                            <div class="app-name">Camera Access</div>
                            <p>Used front camera for profile picture update</p>
                            <div class="app-permissions">
                                <span class="permission-badge">Foreground</span>
                                <span class="permission-badge">User-initiated</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item suspicious">
                        <div class="timeline-time">Yesterday, 11:30 PM</div>
                        <div class="card" style="margin-bottom: 0;">
                            <div class="app-name">Location Access</div>
                            <p>Requested precise location while app was in background</p>
                            <div class="app-permissions">
                                <span class="permission-badge">Background</span>
                                <span class="permission-badge">Suspicious</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-time">Yesterday, 07:15 PM</div>
                        <div class="card" style="margin-bottom: 0;">
                            <div class="app-name">Clipboard Access</div>
                            <p>Read clipboard content - detected shared link</p>
                            <div class="app-permissions">
                                <span class="permission-badge">Foreground</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-tab-content" id="trackers-tab">
                <h3>Hidden Trackers Detected</h3>
                <p>Third-party services embedded in this app</p>
                
                <ul class="tracker-list">
                    <li class="tracker-item">
                        <div class="tracker-name">Facebook Analytics</div>
                        <div class="tracker-desc">Collects usage data and shares it with Facebook for advertising purposes</div>
                    </li>
                    <li class="tracker-item medium">
                        <div class="tracker-name">Google AdMob</div>
                        <div class="tracker-desc">Tracks user behavior to serve personalized ads</div>
                    </li>
                    <li class="tracker-item">
                        <div class="tracker-name">Amplitude</div>
                        <div class="tracker-desc">Analytics service that monitors user interactions within the app</div>
                    </li>
                    <li class="tracker-item low">
                        <div class="tracker-name">Crashlytics</div>
                        <div class="tracker-desc">Error reporting service that collects crash data</div>
                    </li>
                </ul>
                
                <div class="action-buttons">
                    <button class="btn" id="blockTrackersBtn"><i class="fas fa-shield-alt"></i> Block All Trackers</button>
                </div>
            </div>
            
            <div class="modal-tab-content" id="dataflow-tab">
                <h3>Data Shared With Third Parties</h3>
                <p>Where your data is being sent</p>
                
                <div class="card">
                    <h4>Data Transmission Map</h4>
                    <p>This app sends data to 7 external servers in 3 countries</p>
                    
                    <div style="display: flex; justify-content: center; margin: 2rem 0;">
                        <div style="text-align: center;">
                            <div style="width: 150px; height: 150px; border-radius: 50%; background: conic-gradient(var(--danger) 0% 40%, var(--warning) 40% 70%, var(--primary) 70% 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                <div style="width: 100px; height: 100px; border-radius: 50%; background: var(--dark); display: flex; align-items: center; justify-content: center; font-weight: bold;">7 servers</div>
                            </div>
                            <div>Data destinations</div>
                        </div>
                    </div>
                    
                    <div class="grid grid-3">
                        <div class="card">
                            <h4>United States</h4>
                            <p>4 servers</p>
                            <ul>
                                <li>Facebook Inc.</li>
                                <li>Google LLC</li>
                                <li>Amazon AWS</li>
                                <li>SocialConnect HQ</li>
                            </ul>
                        </div>
                        
                        <div class="card">
                            <h4>Ireland</h4>
                            <p>2 servers</p>
                            <ul>
                                <li>Facebook Ireland</li>
                                <li>SocialConnect EU</li>
                            </ul>
                        </div>
                        
                        <div class="card">
                            <h4>Singapore</h4>
                            <p>1 server</p>
                            <ul>
                                <li>SocialConnect Asia</li>
                            </ul>
                        </div>
                    </div>
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

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Page navigation
       
        // Safe element query function
        function safeQueryAll(selector, callback) {
            const elements = document.querySelectorAll(selector);
            if (elements.length > 0) {
                callback(elements);
            }
        }
        
        // App Detail Modal Functionality
        const appModal = document.getElementById('app-modal');
        const modalClose = document.querySelector('.modal-close');
        const appItems = document.querySelectorAll('.app-item');
        
        // Open app modal when clicking on app items
        safeQueryAll('.app-item', function(items) {
            items.forEach(item => {
                item.addEventListener('click', function() {
                    const appId = this.getAttribute('data-app');
                    openAppModal(appId);
                });
            });
        });
        
        // Close modal
        modalClose.addEventListener('click', function() {
            appModal.classList.remove('active');
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === appModal) {
                appModal.classList.remove('active');
            }
        });
        
        // Modal tabs functionality
        safeQueryAll('.modal-tab', function(tabs) {
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs and contents
                    document.querySelectorAll('.modal-tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.modal-tab-content').forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked tab and corresponding content
                    this.classList.add('active');
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId + '-tab').classList.add('active');
                });
            });
        });
        
        // Permission toggle functionality
        safeQueryAll('.permission-item', function(items) {
            items.forEach(item => {
                item.addEventListener('click', function() {
                    const permission = this.getAttribute('data-permission');
                    const isActive = this.classList.contains('active');
                    
                    if (isActive) {
                        this.classList.remove('active');
                        this.querySelector('.permission-status').textContent = 'Denied';
                        this.querySelector('.permission-status').style.background = 'rgba(0, 210, 106, 0.2)';
                        this.querySelector('.permission-status').style.color = 'var(--success)';
                        showPermissionSimulation('revoke', permission);
                    } else {
                        this.classList.add('active');
                        this.querySelector('.permission-status').textContent = 'Allowed';
                        this.querySelector('.permission-status').style.background = 'rgba(255, 55, 95, 0.3)';
                        this.querySelector('.permission-status').style.color = 'var(--danger)';
                        showPermissionSimulation('grant', permission);
                    }
                });
            });
        });
        
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
        
        // Search functionality
        document.getElementById('searchBtn').addEventListener('click', function() {
            const searchTerm = document.querySelector('.search-input').value;
            if (searchTerm) {
                alert(`Searching for: "${searchTerm}"\nSimulating search results...`);
            } else {
                alert('Please enter a search term');
            }
        });
        
        // Filter functionality
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const category = this.value;
            if (category !== 'All Categories') {
                alert(`Filtering by category: ${category}\nShowing only ${category} apps`);
            }
        });
        
        document.getElementById('riskFilter').addEventListener('change', function() {
            const risk = this.value;
            if (risk !== 'All Risk Levels') {
                alert(`Filtering by risk level: ${risk}\nShowing only ${risk} apps`);
            }
        });
        
        document.getElementById('sortFilter').addEventListener('change', function() {
            const sort = this.value;
            alert(`Sorting apps by: ${sort}`);
        });
        
        // Modal button functionality
        document.getElementById('autoRestrictBtn').addEventListener('click', function() {
            showAutoRestrictSimulation();
        });
        
        document.getElementById('sandboxAppBtn').addEventListener('click', function() {
            showSandboxSimulation();
        });
        
        document.getElementById('reportAppBtn').addEventListener('click', function() {
            showReportSimulation();
        });
        
        document.getElementById('blockTrackersBtn').addEventListener('click', function() {
            showTrackerBlockSimulation();
        });
        
        // Open app modal with specific app data
        function openAppModal(appId) {
            // Set app-specific data
            const appData = {
                'socialconnect': {
                    name: 'SocialConnect',
                    icon: 'SC',
                    category: 'Social Media • 142 MB • Updated 2 days ago',
                    risk: 'High Risk',
                    riskClass: 'risk-high-bg'
                },
                'shopeasy': {
                    name: 'ShopEasy',
                    icon: 'SE',
                    category: 'Shopping • 87 MB • Updated 1 week ago',
                    risk: 'Medium Risk',
                    riskClass: 'risk-medium-bg'
                },
                'weathernow': {
                    name: 'WeatherNow',
                    icon: 'WN',
                    category: 'Weather • 34 MB • Updated 3 days ago',
                    risk: 'Low Risk',
                    riskClass: 'risk-low-bg'
                },
                'musicmood': {
                    name: 'MusicMood',
                    icon: 'MM',
                    category: 'Music • 56 MB • Updated 2 weeks ago',
                    risk: 'Low Risk',
                    riskClass: 'risk-low-bg'
                },
                'gamezone': {
                    name: 'GameZone',
                    icon: 'GZ',
                    category: 'Games • 312 MB • Updated 5 days ago',
                    risk: 'High Risk',
                    riskClass: 'risk-high-bg'
                },
                'fitlife': {
                    name: 'FitLife',
                    icon: 'FL',
                    category: 'Health & Fitness • 78 MB • Updated 1 month ago',
                    risk: 'Low Risk',
                    riskClass: 'risk-low-bg'
                }
            };
            
            const app = appData[appId];
            
            document.getElementById('modal-app-icon').textContent = app.icon;
            document.getElementById('modal-app-name').textContent = app.name;
            document.getElementById('modal-app-category').textContent = app.category;
            document.getElementById('modal-risk').textContent = app.risk;
            document.getElementById('modal-risk').className = `modal-risk-badge ${app.riskClass}`;
            
            // Reset to permissions tab
            document.querySelectorAll('.modal-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.modal-tab-content').forEach(c => c.classList.remove('active'));
            document.querySelector('.modal-tab[data-tab="permissions"]').classList.add('active');
            document.getElementById('permissions-tab').classList.add('active');
            
            // Show modal
            appModal.classList.add('active');
        }
        
        // Show permission simulation
        function showPermissionSimulation(action, permission) {
            let simulationContent = '';
            
            if (action === 'grant') {
                simulationContent = `
                    <h2>Permission Grant Simulation</h2>
                    <p>You are about to grant ${permission} access to this app.</p>
                    
                    <div class="simulation-progress">
                        <div class="progress-step active">1. Permission Request</div>
                        <div class="progress-step">2. Risk Analysis</div>
                        <div class="progress-step">3. Decision Impact</div>
                    </div>
                    
                    <div class="simulation-step">
                        <h3>Step 1: Permission Request</h3>
                        <p>The app is requesting access to your ${permission}.</p>
                        <div class="simulation-choices">
                            <div class="simulation-choice" data-choice="allow">Allow Access</div>
                            <div class="simulation-choice" data-choice="deny">Deny Access</div>
                        </div>
                    </div>
                    
                    <div class="simulation-result result-success" id="successResult">
                        <h3><i class="fas fa-check-circle"></i> Permission Denied</h3>
                        <p>You've protected your privacy by denying unnecessary ${permission} access. The app will still function but cannot access this sensitive data.</p>
                        <button class="btn" onclick="simulationModal.style.display='none'">Finish Simulation</button>
                    </div>
                    
                    <div class="simulation-result result-failure" id="failureResult">
                        <h3><i class="fas fa-exclamation-triangle"></i> Privacy Risk!</h3>
                        <p>You've granted ${permission} access. This app can now potentially:</p>
                        <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                            <li>Collect sensitive data without your knowledge</li>
                            <li>Share this data with third parties</li>
                            <li>Use it for targeted advertising</li>
                        </ul>
                        <button class="btn" onclick="simulationModal.style.display='none'">Learn More</button>
                    </div>
                `;
            } else {
                simulationContent = `
                    <h2>Permission Revocation Simulation</h2>
                    <p>You are about to revoke ${permission} access from this app.</p>
                    
                    <div class="simulation-progress">
                        <div class="progress-step active">1. Permission Revocation</div>
                        <div class="progress-step">2. App Impact</div>
                        <div class="progress-step">3. Privacy Benefit</div>
                    </div>
                    
                    <div class="simulation-step">
                        <h3>Step 1: Permission Revocation</h3>
                        <p>You're removing ${permission} access from this app. Some features may stop working.</p>
                        <div class="simulation-choices">
                            <div class="simulation-choice" data-choice="revoke">Revoke Access</div>
                            <div class="simulation-choice" data-choice="keep">Keep Access</div>
                        </div>
                    </div>
                    
                    <div class="simulation-result result-success" id="successResult">
                        <h3><i class="fas fa-check-circle"></i> Permission Revoked</h3>
                        <p>You've successfully protected your ${permission} data. The app can no longer access this information, improving your privacy.</p>
                        <button class="btn" onclick="simulationModal.style.display='none'">Finish Simulation</button>
                    </div>
                    
                    <div class="simulation-result result-failure" id="failureResult">
                        <h3><i class="fas fa-exclamation-triangle"></i> Permission Kept</h3>
                        <p>You've decided to keep ${permission} access enabled. The app will continue to have access to this data.</p>
                        <button class="btn" onclick="simulationModal.style.display='none'">Learn More</button>
                    </div>
                `;
            }
            
            simulationModalContent.innerHTML = simulationContent;
            simulationModal.style.display = 'block';
            
            // Add event listeners to simulation choices
            document.querySelectorAll('.simulation-choice').forEach(choice => {
                choice.addEventListener('click', function() {
                    const userChoice = this.getAttribute('data-choice');
                    const successResult = document.getElementById('successResult');
                    const failureResult = document.getElementById('failureResult');
                    
                    // Hide all results first
                    if (successResult) successResult.style.display = 'none';
                    if (failureResult) failureResult.style.display = 'none';
                    
                    // Show appropriate result based on user choice
                    if ((action === 'grant' && userChoice === 'deny') ||
                        (action === 'revoke' && userChoice === 'revoke')) {
                        if (successResult) successResult.style.display = 'block';
                    } else {
                        if (failureResult) failureResult.style.display = 'block';
                    }
                });
            });
        }
        
        // Show auto-restrict simulation
        function showAutoRestrictSimulation() {
            const simulationContent = `
                <h2>Auto-Restrict Simulation</h2>
                <p>Automatically restrict high-risk permissions for this app</p>
                
                <div class="simulation-progress">
                    <div class="progress-step active">1. Risk Analysis</div>
                    <div class="progress-step">2. Permission Review</div>
                    <div class="progress-step">3. Restrictions Applied</div>
                </div>
                
                <div class="simulation-step">
                    <h3>Step 1: Risk Analysis</h3>
                    <p>EchoGuard has identified 3 high-risk permissions that can be automatically restricted:</p>
                    <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                        <li>Camera access in background</li>
                        <li>Microphone access without user interaction</li>
                        <li>Location tracking while app is closed</li>
                    </ul>
                    <div class="simulation-choices">
                        <div class="simulation-choice" data-choice="restrict">Apply Restrictions</div>
                        <div class="simulation-choice" data-choice="manual">Manual Review</div>
                    </div>
                </div>
                
                <div class="simulation-result result-success" id="successResult">
                    <h3><i class="fas fa-check-circle"></i> Restrictions Applied</h3>
                    <p>Auto-restrict has successfully limited high-risk permissions. The app can still function normally but with enhanced privacy protection.</p>
                    <button class="btn" onclick="simulationModal.style.display='none'">Finish Simulation</button>
                </div>
                
                <div class="simulation-result result-failure" id="failureResult">
                    <h3><i class="fas fa-exclamation-triangle"></i> Manual Review Selected</h3>
                    <p>You've chosen to review permissions manually. Remember to check high-risk permissions like camera, microphone, and location access.</p>
                    <button class="btn" onclick="simulationModal.style.display='none'">Continue to Manual Review</button>
                </div>
            `;
            
            simulationModalContent.innerHTML = simulationContent;
            simulationModal.style.display = 'block';
            
            // Add event listeners to simulation choices
            document.querySelectorAll('.simulation-choice').forEach(choice => {
                choice.addEventListener('click', function() {
                    const userChoice = this.getAttribute('data-choice');
                    const successResult = document.getElementById('successResult');
                    const failureResult = document.getElementById('failureResult');
                    
                    // Hide all results first
                    if (successResult) successResult.style.display = 'none';
                    if (failureResult) failureResult.style.display = 'none';
                    
                    // Show appropriate result based on user choice
                    if (userChoice === 'restrict') {
                        if (successResult) successResult.style.display = 'block';
                    } else {
                        if (failureResult) failureResult.style.display = 'block';
                    }
                });
            });
        }
        
        // Show sandbox simulation
        function showSandboxSimulation() {
            const simulationContent = `
                <h2>App Sandbox Simulation</h2>
                <p>Isolate this app in a secure environment with fake data</p>
                
                <div class="simulation-progress">
                    <div class="progress-step active">1. Sandbox Setup</div>
                    <div class="progress-step">2. Data Virtualization</div>
                    <div class="progress-step">3. Protection Active</div>
                </div>
                
                <div class="simulation-step">
                    <h3>Step 1: Sandbox Setup</h3>
                    <p>This app will run in an isolated environment with the following protections:</p>
                    <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                        <li>Fake location data provided to the app</li>
                        <li>Virtual sensors instead of real device sensors</li>
                        <li>Restricted network access</li>
                        <li>Automatic reset after each session</li>
                    </ul>
                    <div class="simulation-choices">
                        <div class="simulation-choice" data-choice="sandbox">Enable Sandbox</div>
                        <div class="simulation-choice" data-choice="cancel">Cancel</div>
                    </div>
                </div>
                
                <div class="simulation-result result-success" id="successResult">
                    <h3><i class="fas fa-check-circle"></i> Sandbox Enabled</h3>
                    <p>The app is now running in a secure sandbox environment. It will receive fake data while your real information remains protected.</p>
                    <button class="btn" onclick="simulationModal.style.display='none'">Finish Simulation</button>
                </div>
                
                <div class="simulation-result result-failure" id="failureResult">
                    <h3><i class="fas fa-exclamation-triangle"></i> Sandbox Not Enabled</h3>
                    <p>The app will continue to run with normal permissions and access to your real data.</p>
                    <button class="btn" onclick="simulationModal.style.display='none'">Continue</button>
                </div>
            `;
            
            simulationModalContent.innerHTML = simulationContent;
            simulationModal.style.display = 'block';
            
            // Add event listeners to simulation choices
            document.querySelectorAll('.simulation-choice').forEach(choice => {
                choice.addEventListener('click', function() {
                    const userChoice = this.getAttribute('data-choice');
                    const successResult = document.getElementById('successResult');
                    const failureResult = document.getElementById('failureResult');
                    
                    // Hide all results first
                    if (successResult) successResult.style.display = 'none';
                    if (failureResult) failureResult.style.display = 'none';
                    
                    // Show appropriate result based on user choice
                    if (userChoice === 'sandbox') {
                        if (successResult) successResult.style.display = 'block';
                    } else {
                        if (failureResult) failureResult.style.display = 'block';
                    }
                });
            });
        }
        
        // Show report simulation
        function showReportSimulation() {
            const simulationContent = `
                <h2>App Reporting Simulation</h2>
                <p>Report this app for privacy violations</p>
                
                <div class="simulation-progress">
                    <div class="progress-step active">1. Violation Details</div>
                    <div class="progress-step">2. Evidence Collection</div>
                    <div class="progress-step">3. Report Submission</div>
                </div>
                
                <div class="simulation-step">
                    <h3>Step 1: Violation Details</h3>
                    <p>Please select the privacy violations you've observed:</p>
                    <div style="margin-top: 1rem;">
                        <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                            <input type="checkbox" id="violation1" style="margin-right: 0.5rem;">
                            <label for="violation1">Excessive data collection</label>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                            <input type="checkbox" id="violation2" style="margin-right: 0.5rem;">
                            <label for="violation2">Background data access without permission</label>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                            <input type="checkbox" id="violation3" style="margin-right: 0.5rem;">
                            <label for="violation3">Data sharing with third parties</label>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                            <input type="checkbox" id="violation4" style="margin-right: 0.5rem;">
                            <label for="violation4">Hidden trackers</label>
                        </div>
                    </div>
                    <div class="simulation-choices">
                        <div class="simulation-choice" data-choice="report">Submit Report</div>
                        <div class="simulation-choice" data-choice="cancel">Cancel</div>
                    </div>
                </div>
                
                <div class="simulation-result result-success" id="successResult">
                    <h3><i class="fas fa-check-circle"></i> Report Submitted</h3>
                    <p>Thank you for reporting this app. Our security team will review the violations and take appropriate action.</p>
                    <button class="btn" onclick="simulationModal.style.display='none'">Finish Simulation</button>
                </div>
                
                <div class="simulation-result result-failure" id="failureResult">
                    <h3><i class="fas fa-exclamation-triangle"></i> Report Cancelled</h3>
                    <p>You've cancelled the reporting process. No report has been submitted.</p>
                    <button class="btn" onclick="simulationModal.style.display='none'">Continue</button>
                </div>
            `;
            
            simulationModalContent.innerHTML = simulationContent;
            simulationModal.style.display = 'block';
            
            // Add event listeners to simulation choices
            document.querySelectorAll('.simulation-choice').forEach(choice => {
                choice.addEventListener('click', function() {
                    const userChoice = this.getAttribute('data-choice');
                    const successResult = document.getElementById('successResult');
                    const failureResult = document.getElementById('failureResult');
                    
                    // Hide all results first
                    if (successResult) successResult.style.display = 'none';
                    if (failureResult) failureResult.style.display = 'none';
                    
                    // Show appropriate result based on user choice
                    if (userChoice === 'report') {
                        if (successResult) successResult.style.display = 'block';
                    } else {
                        if (failureResult) failureResult.style.display = 'block';
                    }
                });
            });
        }
        
        // Show tracker block simulation
        function showTrackerBlockSimulation() {
            const simulationContent = `
                <h2>Tracker Blocking Simulation</h2>
                <p>Block all hidden trackers in this app</p>
                
                <div class="simulation-progress">
                    <div class="progress-step active">1. Tracker Detection</div>
                    <div class="progress-step">2. Blocking Methods</div>
                    <div class="progress-step">3. Protection Active</div>
                </div>
                
                <div class="simulation-step">
                    <h3>Step 1: Tracker Detection</h3>
                    <p>EchoGuard has detected 4 trackers in this app:</p>
                    <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                        <li>Facebook Analytics - High Risk</li>
                        <li>Google AdMob - Medium Risk</li>
                        <li>Amplitude - Medium Risk</li>
                        <li>Crashlytics - Low Risk</li>
                    </ul>
                    <div class="simulation-choices">
                        <div class="simulation-choice" data-choice="block">Block All Trackers</div>
                        <div class="simulation-choice" data-choice="selective">Selective Blocking</div>
                    </div>
                </div>
                
                <div class="simulation-result result-success" id="successResult">
                    <h3><i class="fas fa-check-circle"></i> Trackers Blocked</h3>
                    <p>All 4 trackers have been successfully blocked. The app can no longer send your data to these third-party services.</p>
                    <button class="btn" onclick="simulationModal.style.display='none'">Finish Simulation</button>
                </div>
                
                <div class="simulation-result result-failure" id="failureResult">
                    <h3><i class="fas fa-exclamation-triangle"></i> Selective Blocking</h3>
                    <p>You've chosen selective blocking. Please review each tracker individually to decide which ones to block.</p>
                    <button class="btn" onclick="simulationModal.style.display='none'">Continue to Tracker Review</button>
                </div>
            `;
            
            simulationModalContent.innerHTML = simulationContent;
            simulationModal.style.display = 'block';
            
            // Add event listeners to simulation choices
            document.querySelectorAll('.simulation-choice').forEach(choice => {
                choice.addEventListener('click', function() {
                    const userChoice = this.getAttribute('data-choice');
                    const successResult = document.getElementById('successResult');
                    const failureResult = document.getElementById('failureResult');
                    
                    // Hide all results first
                    if (successResult) successResult.style.display = 'none';
                    if (failureResult) failureResult.style.display = 'none';
                    
                    // Show appropriate result based on user choice
                    if (userChoice === 'block') {
                        if (successResult) successResult.style.display = 'block';
                    } else {
                        if (failureResult) failureResult.style.display = 'block';
                    }
                });
            });
        }
        
        // Initialize charts
        window.addEventListener('load', function() {
            // Permission distribution chart
            const permissionCtx = document.getElementById('permissionChart');
            if (permissionCtx) {
                const permissionChart = new Chart(permissionCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Camera', 'Mic', 'Location', 'Files', 'Contacts', 'Clipboard'],
                        datasets: [{
                            label: 'Apps with Permission',
                            data: [12, 15, 18, 22, 8, 14],
                            backgroundColor: [
                                'rgba(255, 55, 95, 0.7)',
                                'rgba(255, 170, 0, 0.7)',
                                'rgba(0, 198, 255, 0.7)',
                                'rgba(126, 66, 255, 0.7)',
                                'rgba(0, 210, 106, 0.7)',
                                'rgba(255, 170, 0, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255, 55, 95, 1)',
                                'rgba(255, 170, 0, 1)',
                                'rgba(0, 198, 255, 1)',
                                'rgba(126, 66, 255, 1)',
                                'rgba(0, 210, 106, 1)',
                                'rgba(255, 170, 0, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: 'rgba(224, 247, 255, 0.7)'
                                },
                                grid: {
                                    color: 'rgba(224, 247, 255, 0.1)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: 'rgba(224, 247, 255, 0.7)'
                                },
                                grid: {
                                    color: 'rgba(224, 247, 255, 0.1)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'rgba(224, 247, 255, 0.7)'
                                }
                            }
                        }
                    }
                });
            }
            
            // Risk level chart
            const riskCtx = document.getElementById('riskChart');
            if (riskCtx) {
                const riskChart = new Chart(riskCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['High Risk', 'Medium Risk', 'Low Risk'],
                        datasets: [{
                            data: [3, 4, 8],
                            backgroundColor: [
                                'rgba(255, 55, 95, 0.7)',
                                'rgba(255, 170, 0, 0.7)',
                                'rgba(0, 210, 106, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255, 55, 95, 1)',
                                'rgba(255, 170, 0, 1)',
                                'rgba(0, 210, 106, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: 'rgba(224, 247, 255, 0.7)',
                                    padding: 20
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>