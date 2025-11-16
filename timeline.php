<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Access Timeline | EchoGuard</title>
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
            opacity: 0;
            transition: opacity 0.6s ease;
        }

        body.loaded {
            opacity: 1;
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

        .timeline-container {
            display: flex;
            margin-top: 2rem;
        }

        .timeline-hours {
            width: 80px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding-right: 1rem;
            border-right: 1px solid rgba(0, 198, 255, 0.3);
        }

        .timeline-hour {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 1rem;
            font-size: 0.9rem;
            color: var(--gray);
            position: relative;
        }

        .timeline-hour::after {
            content: '';
            position: absolute;
            right: -5px;
            width: 10px;
            height: 1px;
            background: rgba(0, 198, 255, 0.5);
        }

        .timeline-content {
            flex: 1;
            position: relative;
            padding-left: 1rem;
        }

        .timeline-track {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary);
        }

        .timeline-event {
            position: absolute;
            width: 100%;
            margin-bottom: 1rem;
            padding: 1rem;
            border-radius: 8px;
            background: rgba(0, 198, 255, 0.1);
            border-left: 3px solid var(--primary);
            transition: all 0.3s ease;
            cursor: pointer;
            opacity: 0;
            transform: translateX(-20px);
        }

        .timeline-event.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .timeline-event:hover {
            transform: translateX(5px);
            background: rgba(0, 198, 255, 0.15);
        }

        .timeline-event.suspicious {
            background: rgba(255, 55, 95, 0.1);
            border-left-color: var(--danger);
        }

        .timeline-event.suspicious:hover {
            background: rgba(255, 55, 95, 0.15);
        }

        .timeline-event.warning {
            background: rgba(255, 170, 0, 0.1);
            border-left-color: var(--warning);
        }

        .timeline-event.warning:hover {
            background: rgba(255, 170, 0, 0.15);
        }

        .timeline-event::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary);
            border: 2px solid var(--dark);
        }

        .timeline-event.suspicious::before {
            background: var(--danger);
            box-shadow: 0 0 0 2px rgba(255, 55, 95, 0.3);
        }

        .timeline-event.warning::before {
            background: var(--warning);
        }

        .event-time {
            font-size: 0.9rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .event-app {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .app-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            font-size: 0.7rem;
            font-weight: bold;
            color: white;
        }

        .app-name {
            font-weight: 600;
        }

        .event-details {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .event-permissions {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .permission-badge {
            padding: 0.2rem 0.5rem;
            background: rgba(0, 198, 255, 0.2);
            border-radius: 12px;
            font-size: 0.7rem;
            color: var(--primary);
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
            cursor: pointer;
        }

        .playback-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding: 1rem;
            background: rgba(0, 198, 255, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(0, 198, 255, 0.3);
        }

        .playback-btn {
            background: rgba(0, 198, 255, 0.2);
            border: 1px solid var(--primary);
            color: var(--primary);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .playback-btn:hover {
            background: var(--primary);
            color: var(--dark);
        }

        .playback-progress {
            flex: 1;
            height: 6px;
            background: rgba(0, 198, 255, 0.2);
            border-radius: 3px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .playback-progress-bar {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            background: var(--primary);
            width: 0%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .playback-time {
            font-size: 0.9rem;
            color: var(--gray);
            min-width: 120px;
            text-align: center;
        }

        .correlation-analysis {
            margin-top: 2rem;
        }

        .correlation-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 8px;
            background: rgba(0, 198, 255, 0.1);
            margin-bottom: 1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .correlation-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .correlation-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
        }

        .context-view {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .context-item {
            flex: 1;
            text-align: center;
            padding: 1rem;
            background: rgba(0, 198, 255, 0.1);
            border-radius: 8px;
            opacity: 0;
            transform: scale(0.9);
            transition: all 0.5s ease;
        }

        .context-item.visible {
            opacity: 1;
            transform: scale(1);
        }

        .context-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: rgba(0, 198, 255, 0.1);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(0, 198, 255, 0.2);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .stat-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Chart Improvements */
        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 1.5rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid rgba(0, 198, 255, 0.2);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .chart-legend {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .chart-tooltip {
            background: rgba(10, 14, 23, 0.95);
            border: 1px solid var(--primary);
            border-radius: 4px;
            padding: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        .chart-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .chart-btn {
            background: rgba(0, 198, 255, 0.1);
            border: 1px solid rgba(0, 198, 255, 0.3);
            color: var(--primary);
            border-radius: 4px;
            padding: 0.3rem 0.7rem;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .chart-btn:hover {
            background: rgba(0, 198, 255, 0.2);
        }

        .chart-btn.active {
            background: var(--primary);
            color: var(--dark);
        }

        footer {
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(0, 198, 255, 0.2);
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* Loading Skeleton */
        .skeleton {
            background: linear-gradient(90deg, #111 25%, #222 50%, #111 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .skeleton-text { height: 16px; margin: 8px 0; }
        .skeleton-title { height: 24px; width: 60%; }
        .skeleton-event { height: 80px; margin-bottom: 16px; }

        /* Responsive */
        @media (max-width: 1200px) {
            .grid-3 { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .grid, .grid-2, .grid-3 { grid-template-columns: 1fr; }
            .timeline-container { flex-direction: column; }
            .timeline-hours {
                width: 100%; flex-direction: row; overflow-x: auto;
                border-right: none; border-bottom: 1px solid rgba(0, 198, 255, 0.3);
                padding-bottom: 1rem; margin-bottom: 1rem;
            }
            .timeline-hour::after { right: auto; bottom: -6px; left: 50%; width: 1px; height: 10px; }
            .timeline-content { padding-left: 0; }
            .timeline-track { display: none; }
            .timeline-event::before { display: none; }
            .context-view { flex-direction: column; }
            .chart-legend { justify-content: center; }
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
    <div class="container" id="main-content">
        <div id="loading-screen">
            <div class="card" style="text-align: center; padding: 3rem;">
                <h1 class="skeleton skeleton-title" style="width: 300px; margin: 0 auto;"></h1>
                <p class="skeleton skeleton-text" style="width: 60%; margin: 1rem auto;"></p>
                <div class="filter-bar">
                    <div class="skeleton" style="width: 150px; height: 40px;"></div>
                    <div class="skeleton" style="width: 150px; height: 40px;"></div>
                    <div class="skeleton" style="width: 150px; height: 40px;"></div>
                </div>
                <div class="timeline-container">
                    <div class="timeline-hours">
                        <div class="skeleton" style="height: 40px; width: 60px; margin-bottom: 20px;"></div>
                        <div class="skeleton" style="height: 40px; width: 60px; margin-bottom: 20px;"></div>
                        <div class="skeleton" style="height: 40px; width: 60px; margin-bottom: 20px;"></div>
                    </div>
                    <div class="timeline-content" style="flex: 1; padding-left: 1rem;">
                        <div class="skeleton skeleton-event"></div>
                        <div class="skeleton skeleton-event"></div>
                        <div class="skeleton skeleton-event"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="timeline-content" style="display: none;">
            <h1 data-aos="fade-down">Data Access Timeline</h1>

            <div class="card" data-aos="fade-up">
                <h2>Advanced Forensics</h2>
                <p>Monitor all data access events with detailed context and correlation analysis</p>

                <div class="filter-bar">
                    <select class="filter-select" id="filter-date">
                        <option>Today</option>
                        <option>Yesterday</option>
                        <option>Last 7 Days</option>
                        <option>Custom Range</option>
                    </select>
                    <select class="filter-select" id="filter-app">
                        <option value="">All Apps</option>
                        <option value="SocialConnect">SocialConnect</option>
                        <option value="ShopEasy">ShopEasy</option>
                        <option value="WeatherNow">WeatherNow</option>
                        <option value="GameZone">GameZone</option>
                    </select>
                    <select class="filter-select" id="filter-permission">
                        <option value="">All Permissions</option>
                        <option value="Camera">Camera</option>
                        <option value="Microphone">Microphone</option>
                        <option value="Location">Location</option>
                        <option value="Contacts">Contacts</option>
                        <option value="Clipboard">Clipboard</option>
                    </select>
                    <select class="filter-select" id="filter-type">
                        <option value="">All Events</option>
                        <option value="suspicious">Suspicious Only</option>
                        <option value="background">Background Access</option>
                        <option value="night">Night-time Activity</option>
                    </select>
                </div>

                <div class="playback-controls">
                    <div class="playback-btn" id="playback-prev"><i class="fas fa-step-backward"></i></div>
                    <div class="playback-btn" id="playback-play"><i class="fas fa-play"></i></div>
                    <div class="playback-btn" id="playback-pause" style="display: none;"><i class="fas fa-pause"></i></div>
                    <div class="playback-btn" id="playback-next"><i class="fas fa-step-forward"></i></div>
                    <div class="playback-progress" id="progress-container">
                        <div class="playback-progress-bar" id="progress-bar"></div>
                    </div>
                    <div class="playback-time" id="time-display">12:00 AM - 11:59 PM</div>
                    <button class="btn" id="playback-mode-btn">
                        <i class="fas fa-play-circle"></i> <span>Playback Mode</span>
                    </button>
                </div>

                <div class="timeline-container">
                    <div class="timeline-hours" id="hours-container"></div>
                    <div class="timeline-content">
                        <div class="timeline-track"></div>
                        <div id="events-container"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-2">
                <div class="card" data-aos="fade-right">
                    <h3>Correlation Analysis</h3>
                    <p>Detected patterns between different data access events</p>
                    <div class="correlation-analysis" id="correlation-container"></div>
                    <div class="context-view" id="context-container"></div>
                </div>

                <div class="card" data-aos="fade-left">
                    <div class="chart-header">
                        <h3>Access Statistics</h3>
                        <div class="chart-actions">
                            <button class="chart-btn active" data-chart-type="bar">Bar</button>
                            <button class="chart-btn" data-chart-type="line">Line</button>
                            <button class="chart-btn" data-chart-type="pie">Pie</button>
                        </div>
                    </div>
                    <p>Summary of data access patterns over time</p>
                    
                    <div class="chart-container">
                        <canvas id="accessChart"></canvas>
                    </div>
                    
                    <div class="chart-legend" id="chart-legend"></div>
                    
                    <div class="stats-grid" id="stats-container"></div>
                    
                    <div style="margin-top: 1.5rem;">
                        <h4>Most Active Apps</h4>
                        <ul id="app-list" style="list-style: none; margin-top: 1rem;"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>EchoGuard Privacy Dashboard | Stealth Mode | Data shown is simulated for demonstration</p>
        <p>© 2025 EchoGuard Security. All rights reserved.</p>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({ duration: 800, once: true });

        // Simulated Data
        const events = [
            { time: "12:35 AM", app: "SocialConnect", icon: "SC", color: "#ff375f", type: "suspicious", permission: "Microphone", details: "Accessed microphone for 2 minutes while screen was off", bg: true },
            { time: "2:15 AM", app: "ShopEasy", icon: "SE", color: "#ffaa00", type: "normal", permission: "Location", details: "Requested location access - User asleep", bg: true },
            { time: "6:30 AM", app: "WeatherNow", icon: "WN", color: "#00d26a", type: "normal", permission: "Location", details: "Requested location access for weather update", bg: false },
            { time: "8:45 AM", app: "SocialConnect", icon: "SC", color: "#ff375f", type: "suspicious", permission: "Microphone", details: "Accessed microphone for 3 minutes while screen was off", bg: true },
            { time: "9:12 AM", app: "WeatherNow", icon: "WN", color: "#00d26a", type: "normal", permission: "Location", details: "Requested location access - User approved", bg: false },
            { time: "10:30 AM", app: "ShopEasy", icon: "SE", color: "#ffaa00", type: "normal", permission: "Clipboard", details: "Accessed clipboard content - Copied product link", bg: false },
            { time: "11:05 AM", app: "GameZone", icon: "GZ", color: "#ff375f", type: "suspicious", permission: "Contacts", details: "Attempted to access contacts - Blocked by EchoGuard", bg: false },
            { time: "1:20 PM", app: "SocialConnect", icon: "SC", color: "#ff375f", type: "warning", permission: "Camera", details: "Camera accessed in background for 45 seconds", bg: true },
        ];

        const correlations = [
            { icon: "microphone", title: "Mic Activated + Data Sent", desc: "SocialConnect accessed microphone 12 times, followed by data transmission" },
            { icon: "map-marker-alt", title: "Location + Background Activity", desc: "ShopEasy accessed location 8 times while app was in background" },
            { icon: "camera", title: "Camera + Screen Off", desc: "SocialConnect accessed camera 3 times when screen was off" }
        ];

        const context = [
            { value: "67%", label: "Screen Off During Suspicious Access" },
            { value: "42%", label: "User Asleep During Night Access" },
            { value: "82%", label: "Data Sent Over Cellular" }
        ];

        const stats = { total: 47, suspicious: 12, background: 8, night: 5 };
        const appStats = { SocialConnect: 18, ShopEasy: 12, WeatherNow: 8, GameZone: 5 };

        // Extended data for better charts
        const hourlyData = {
            labels: ["12 AM", "2 AM", "4 AM", "6 AM", "8 AM", "10 AM", "12 PM", "2 PM", "4 PM", "6 PM", "8 PM", "10 PM"],
            suspicious: [2, 1, 0, 0, 3, 2, 1, 2, 1, 0, 1, 1],
            normal: [0, 1, 0, 2, 1, 3, 4, 2, 3, 2, 1, 0],
            background: [1, 2, 1, 0, 2, 1, 0, 1, 2, 1, 0, 1]
        };

        // DOM Elements
        const loadingScreen = document.getElementById('loading-screen');
        const timelineContent = document.getElementById('timeline-content');
        const eventsContainer = document.getElementById('events-container');
        const hoursContainer = document.getElementById('hours-container');
        const correlationContainer = document.getElementById('correlation-container');
        const contextContainer = document.getElementById('context-container');
        const statsContainer = document.getElementById('stats-container');
        const appList = document.getElementById('app-list');
        const progressBar = document.getElementById('progress-bar');
        const timeDisplay = document.getElementById('time-display');
        const playBtn = document.getElementById('playback-play');
        const pauseBtn = document.getElementById('playback-pause');
        const modeBtn = document.getElementById('playback-mode-btn');
        const chartLegend = document.getElementById('chart-legend');
        const chartButtons = document.querySelectorAll('.chart-btn');

        let isPlaying = false;
        let playbackInterval;
        let currentChart = null;
        let currentChartType = 'bar';

        // Load Page
        window.addEventListener('load', () => {
            setTimeout(() => {
                loadingScreen.style.display = 'none';
                timelineContent.style.display = 'block';
                document.body.classList.add('loaded');
                renderTimeline();
                renderStats();
                renderChart();
                animateOnLoad();
            }, 1500);
        });

        // Render Hours
        function renderHours() {
            const hours = [];
            for (let h = 0; h < 24; h++) {
                const hour = h === 0 ? '12 AM' : h === 12 ? '12 PM' : h < 12 ? `${h} AM` : `${h-12} PM`;
                hoursContainer.innerHTML += `<div class="timeline-hour">${hour}</div>`;
            }
        }

        // Render Events
        function renderEvents(filtered = events) {
            eventsContainer.innerHTML = '';
            filtered.forEach((event, i) => {
                const top = getTopPosition(event.time);
                const el = document.createElement('div');
                el.className = `timeline-event ${event.type}`;
                el.style.top = `${top}px`;
                el.dataset.index = i;
                el.innerHTML = `
                    <div class="event-time">${event.time}</div>
                    <div class="event-app">
                        <div class="app-icon" style="background: ${event.color};">${event.icon}</div>
                        <div class="app-name">${event.app}</div>
                    </div>
                    <div class="event-details">${event.details}</div>
                    <div class="event-permissions">
                        <span class="permission-badge">${event.permission}</span>
                        ${event.bg ? '<span class="permission-badge">Background</span>' : ''}
                    </div>
                `;
                eventsContainer.appendChild(el);
                setTimeout(() => el.classList.add('visible'), i * 100);
            });
        }

        function getTopPosition(time) {
            const [h, m] = time.split(':');
            const minutes = parseInt(h) * 60 + parseInt(m.split(' ')[0]);
            return (minutes / 1440) * (24 * 60);
        }

        function renderTimeline() {
            renderHours();
            renderEvents();
        }

        function renderStats() {
            statsContainer.innerHTML = '';
            Object.entries(stats).forEach(([key, value], i) => {
                const label = key.charAt(0).toUpperCase() + key.slice(1).replace(/([A-Z])/g, ' $1');
                const card = document.createElement('div');
                card.className = 'stat-card';
                card.innerHTML = `<div class="stat-value">${value}</div><div class="stat-label">${label}</div>`;
                statsContainer.appendChild(card);
                setTimeout(() => card.classList.add('visible'), i * 150);
            });

            appList.innerHTML = '';
            Object.entries(appStats).forEach(([app, count]) => {
                const risk = count > 15 ? 'high' : count > 10 ? 'medium' : 'low';
                const li = document.createElement('li');
                li.style.cssText = 'padding: 0.8rem; display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1);';
                li.innerHTML = `<span>${app}</span><span style="color: ${risk === 'high' ? '#ff375f' : risk === 'medium' ? '#ffaa00' : '#00d26a'}">${count} events</span>`;
                appList.appendChild(li);
            });

            correlations.forEach((c, i) => {
                const item = document.createElement('div');
                item.className = 'correlation-item';
                item.innerHTML = `
                    <div class="correlation-icon"><i class="fas fa-${c.icon}"></i></div>
                    <div class="correlation-details">
                        <div class="correlation-title">${c.title}</div>
                        <div class="correlation-desc">${c.desc}</div>
                    </div>
                `;
                correlationContainer.appendChild(item);
                setTimeout(() => item.classList.add('visible'), i * 200);
            });

            context.forEach((c, i) => {
                const item = document.createElement('div');
                item.className = 'context-item';
                item.innerHTML = `<div class="context-value">${c.value}</div><div class="context-label">${c.label}</div>`;
                contextContainer.appendChild(item);
                setTimeout(() => item.classList.add('visible'), i * 200);
            });
        }

        function renderChart() {
            const ctx = document.getElementById('accessChart').getContext('2d');
            
            // Destroy existing chart if it exists
            if (currentChart) {
                currentChart.destroy();
            }
            
            // Chart configuration based on type
            let config;
            
            if (currentChartType === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: hourlyData.labels,
                        datasets: [
                            {
                                label: 'Suspicious',
                                data: hourlyData.suspicious,
                                backgroundColor: 'rgba(255, 55, 95, 0.7)',
                                borderColor: '#ff375f',
                                borderWidth: 1,
                                borderRadius: 4,
                                borderSkipped: false,
                            },
                            {
                                label: 'Normal',
                                data: hourlyData.normal,
                                backgroundColor: 'rgba(0, 210, 106, 0.7)',
                                borderColor: '#00d26a',
                                borderWidth: 1,
                                borderRadius: 4,
                                borderSkipped: false,
                            },
                            {
                                label: 'Background',
                                data: hourlyData.background,
                                backgroundColor: 'rgba(255, 170, 0, 0.7)',
                                borderColor: '#ffaa00',
                                borderWidth: 1,
                                borderRadius: 4,
                                borderSkipped: false,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(10, 14, 23, 0.95)',
                                titleColor: '#e0f7ff',
                                bodyColor: '#e0f7ff',
                                borderColor: '#00c6ff',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.raw} events`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgba(0, 198, 255, 0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#8a8f98'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 198, 255, 0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#8a8f98',
                                    stepSize: 1
                                }
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        }
                    }
                };
            } else if (currentChartType === 'line') {
                config = {
                    type: 'line',
                    data: {
                        labels: hourlyData.labels,
                        datasets: [
                            {
                                label: 'Suspicious',
                                data: hourlyData.suspicious,
                                backgroundColor: 'rgba(255, 55, 95, 0.2)',
                                borderColor: '#ff375f',
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#ff375f',
                                pointBorderColor: '#0a0e17',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            },
                            {
                                label: 'Normal',
                                data: hourlyData.normal,
                                backgroundColor: 'rgba(0, 210, 106, 0.2)',
                                borderColor: '#00d26a',
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#00d26a',
                                pointBorderColor: '#0a0e17',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            },
                            {
                                label: 'Background',
                                data: hourlyData.background,
                                backgroundColor: 'rgba(255, 170, 0, 0.2)',
                                borderColor: '#ffaa00',
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#ffaa00',
                                pointBorderColor: '#0a0e17',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(10, 14, 23, 0.95)',
                                titleColor: '#e0f7ff',
                                bodyColor: '#e0f7ff',
                                borderColor: '#00c6ff',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.raw} events`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgba(0, 198, 255, 0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#8a8f98'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 198, 255, 0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#8a8f98',
                                    stepSize: 1
                                }
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        }
                    }
                };
            } else if (currentChartType === 'pie') {
                config = {
                    type: 'pie',
                    data: {
                        labels: ['Suspicious', 'Normal', 'Background'],
                        datasets: [{
                            data: [stats.suspicious, stats.total - stats.suspicious - stats.background, stats.background],
                            backgroundColor: [
                                'rgba(255, 55, 95, 0.8)',
                                'rgba(0, 210, 106, 0.8)',
                                'rgba(255, 170, 0, 0.8)'
                            ],
                            borderColor: [
                                '#ff375f',
                                '#00d26a',
                                '#ffaa00'
                            ],
                            borderWidth: 2,
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(10, 14, 23, 0.95)',
                                titleColor: '#e0f7ff',
                                bodyColor: '#e0f7ff',
                                borderColor: '#00c6ff',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} events (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true,
                            duration: 1000,
                            easing: 'easeOutQuart'
                        }
                    }
                };
            }
            
            // Create the chart
            currentChart = new Chart(ctx, config);
            
            // Update legend
            updateChartLegend(config.data.datasets);
        }

        function updateChartLegend(datasets) {
            chartLegend.innerHTML = '';
            
            datasets.forEach(dataset => {
                const legendItem = document.createElement('div');
                legendItem.className = 'legend-item';
                legendItem.innerHTML = `
                    <div class="legend-color" style="background-color: ${dataset.backgroundColor || dataset.borderColor};"></div>
                    <span>${dataset.label}</span>
                `;
                chartLegend.appendChild(legendItem);
            });
        }

        function animateOnLoad() {
            document.querySelectorAll('.card, .stat-card, .correlation-item, .context-item').forEach((el, i) => {
                setTimeout(() => el.style.opacity = '1', i * 100);
            });
        }

        // Chart type switching
        chartButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                chartButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Update chart type and re-render
                currentChartType = this.getAttribute('data-chart-type');
                renderChart();
            });
        });

        // Filters
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', filterEvents);
        });

        function filterEvents() {
            const date = document.getElementById('filter-date').value;
            const app = document.getElementById('filter-app').value;
            const perm = document.getElementById('filter-permission').value;
            const type = document.getElementById('filter-type').value;

            let filtered = events;

            if (app) filtered = filtered.filter(e => e.app === app);
            if (perm) filtered = filtered.filter(e => e.permission === perm);
            if (type === 'suspicious') filtered = filtered.filter(e => e.type === 'suspicious');
            if (type === 'background') filtered = filtered.filter(e => e.bg);
            if (type === 'night') filtered = filtered.filter(e => parseInt(e.time) < 6 || parseInt(e.time) >= 22);

            renderEvents(filtered);
        }

        // Playback
        let currentHour = 0;
        function updatePlayback() {
            const percent = (currentHour / 23) * 100;
            progressBar.style.width = percent + '%';
            const start = currentHour === 0 ? '12 AM' : currentHour === 12 ? '12 PM' : currentHour < 12 ? `${currentHour} AM` : `${currentHour-12} PM`;
            const end = currentHour === 22 ? '11 PM' : currentHour === 11 ? '11 AM' : (currentHour + 1 < 12 ? `${currentHour + 1} AM` : currentHour + 1 === 12 ? '12 PM' : `${currentHour + 1 - 12} PM`);
            timeDisplay.textContent = `${start} - ${end}`;
        }

        playBtn.addEventListener('click', () => {
            isPlaying = true;
            playBtn.style.display = 'none';
            pauseBtn.style.display = 'flex';
            playbackInterval = setInterval(() => {
                currentHour = (currentHour + 1) % 24;
                updatePlayback();
            }, 1000);
        });

        pauseBtn.addEventListener('click', () => {
            isPlaying = false;
            pauseBtn.style.display = 'none';
            playBtn.style.display = 'flex';
            clearInterval(playbackInterval);
        });

        document.getElementById('playback-prev').addEventListener('click', () => {
            currentHour = currentHour === 0 ? 23 : currentHour - 1;
            updatePlayback();
        });

        document.getElementById('playback-next').addEventListener('click', () => {
            currentHour = (currentHour + 1) % 24;
            updatePlayback();
        });

        document.getElementById('progress-container').addEventListener('click', (e) => {
            const rect = e.target.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const percent = x / rect.width;
            currentHour = Math.round(percent * 23);
            updatePlayback();
        });

        // Initialize
        renderTimeline();
        renderStats();
        renderChart();
        updatePlayback();
    </script>
</body>
</html>