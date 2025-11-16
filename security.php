<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Simulation Center | EchoGuard</title>
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
        
        .simulation-scenario {
            padding: 2rem;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .simulation-scenario::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 198, 255, 0.1) 0%, rgba(126, 66, 255, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .simulation-scenario:hover::before {
            opacity: 1;
        }
        
        .simulation-scenario:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
        }
        
        .simulation-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .simulation-icon {
            font-size: 2rem;
            color: var(--primary);
        }
        
        .simulation-difficulty {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: auto;
        }
        
        .difficulty-beginner {
            background: rgba(0, 210, 106, 0.2);
            color: var(--success);
        }
        
        .difficulty-intermediate {
            background: rgba(255, 170, 0, 0.2);
            color: var(--warning);
        }
        
        .difficulty-advanced {
            background: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }
        
        .simulation-description {
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .simulation-progress {
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .progress-bar {
            height: 100%;
            border-radius: 3px;
            background: var(--primary);
            transition: width 0.5s ease;
        }
        
        .simulation-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: var(--gray);
            position: relative;
            z-index: 1;
        }
        
        .simulation-active {
            display: none;
            margin-top: 2rem;
        }
        
        .simulation-container {
            background: rgba(10, 14, 23, 0.9);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
            position: relative;
            min-height: 400px;
        }
        
        .simulation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 198, 255, 0.3);
        }
        
        .simulation-back {
            background: none;
            border: none;
            color: var(--primary);
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .simulation-back:hover {
            transform: translateX(-5px);
        }
        
        .simulation-content {
            margin-bottom: 2rem;
        }
        
        .simulation-prompt {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            animation: fadeIn 0.5s ease;
        }
        
        .simulation-choices {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .choice-btn {
            padding: 1.2rem;
            background: rgba(0, 198, 255, 0.1);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 8px;
            color: var(--light);
            font-family: 'Exo 2', sans-serif;
            font-size: 1rem;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .choice-btn:hover {
            background: rgba(0, 198, 255, 0.2);
            border-color: var(--primary);
            transform: translateX(5px);
        }
        
        .choice-btn.selected {
            background: rgba(0, 198, 255, 0.3);
            border-color: var(--primary);
            box-shadow: 0 0 15px rgba(0, 198, 255, 0.3);
        }
        
        .choice-btn.correct {
            background: rgba(0, 210, 106, 0.2);
            border-color: var(--success);
            box-shadow: 0 0 15px rgba(0, 210, 106, 0.3);
        }
        
        .choice-btn.incorrect {
            background: rgba(255, 55, 95, 0.2);
            border-color: var(--danger);
            box-shadow: 0 0 15px rgba(255, 55, 95, 0.3);
        }
        
        .choice-icon {
            font-size: 1.2rem;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(0, 198, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }
        
        .choice-btn.correct .choice-icon {
            background: rgba(0, 210, 106, 0.3);
        }
        
        .choice-btn.incorrect .choice-icon {
            background: rgba(255, 55, 95, 0.3);
        }
        
        .simulation-feedback {
            display: none;
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 2rem;
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .feedback-correct {
            background: rgba(0, 210, 106, 0.1);
            border-left: 4px solid var(--success);
        }
        
        .feedback-incorrect {
            background: rgba(255, 55, 95, 0.1);
            border-left: 4px solid var(--danger);
        }
        
        .feedback-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .feedback-correct .feedback-title {
            color: var(--success);
        }
        
        .feedback-incorrect .feedback-title {
            color: var(--danger);
        }
        
        .simulation-next {
            display: none;
            margin-top: 1.5rem;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }
        
        .score-display {
            text-align: center;
            padding: 2rem;
        }
        
        .score-value {
            font-size: 4rem;
            font-weight: 700;
            font-family: 'Orbitron', sans-serif;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .score-label {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 2rem;
        }
        
        .score-breakdown {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .score-metric {
            text-align: center;
            padding: 1.5rem;
            background: rgba(0, 198, 255, 0.1);
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .score-metric:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 198, 255, 0.2);
        }
        
        .metric-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .metric-label {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .leaderboard {
            margin-top: 2rem;
        }
        
        .leaderboard-list {
            list-style: none;
        }
        
        .leaderboard-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .leaderboard-item:hover {
            background: rgba(0, 198, 255, 0.05);
        }
        
        .leaderboard-rank {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        
        .rank-1 {
            background: gold;
            color: var(--dark);
            box-shadow: 0 0 10px gold;
        }
        
        .rank-2 {
            background: silver;
            color: var(--dark);
            box-shadow: 0 0 10px silver;
        }
        
        .rank-3 {
            background: #cd7f32;
            color: var(--dark);
            box-shadow: 0 0 10px #cd7f32;
        }
        
        .rank-other {
            background: rgba(0, 198, 255, 0.2);
            color: var(--primary);
        }
        
        .leaderboard-user {
            flex: 1;
        }
        
        .leaderboard-score {
            font-weight: 700;
            color: var(--primary);
        }
        
        .simulation-complete {
            text-align: center;
            padding: 3rem;
            display: none;
        }
        
        .completion-badge {
            font-size: 4rem;
            color: var(--success);
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .completion-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }
        
        .completion-message {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 2rem;
        }
        
        .simulation-effects {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
            display: none;
        }
        
        .effect-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--primary);
            animation: float 3s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0; }
            50% { transform: translateY(-20px) translateX(10px); opacity: 1; }
        }
        
        .effect-success {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 5rem;
            color: var(--success);
            opacity: 0;
            animation: explode 1s ease-out;
        }
        
        @keyframes explode {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 0; }
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
            
            .simulation-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .choice-btn {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    <div class="glow"></div>
    
      <?php
// Set the page title for each page
$page_title = "Security Simulation Center | EchoGuard";
include 'header.php';
?>
    
    
    <div class="container">
        <!-- Security Simulation Page -->
        <div id="simulation" class="page active">
            <h1>Security Simulation Center</h1>
            
            <div class="card">
                <h2>Interactive Privacy Training</h2>
                <p>Test your knowledge against common privacy threats in a safe environment. Improve your skills and climb the leaderboard!</p>
                
                <div class="score-display">
                    <div class="score-value">84%</div>
                    <div class="score-label">Your Privacy Defense Rating</div>
                    
                    <div class="score-breakdown">
                        <div class="score-metric">
                            <div class="metric-value">92%</div>
                            <div class="metric-label">Threat Detection</div>
                        </div>
                        <div class="score-metric">
                            <div class="metric-value">76%</div>
                            <div class="metric-label">Response Time</div>
                        </div>
                        <div class="score-metric">
                            <div class="metric-value">88%</div>
                            <div class="metric-label">Preventive Actions</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-3">
                <div class="simulation-scenario" data-scenario="phishing">
                    <div class="simulation-title">
                        <i class="fas fa-fish simulation-icon"></i>
                        <h3>Phishing Permission Prompt</h3>
                        <span class="simulation-difficulty difficulty-beginner">Beginner</span>
                    </div>
                    <div class="simulation-description">
                        <p>Learn to identify fake permission requests designed to trick you into granting unnecessary access.</p>
                    </div>
                    <div class="simulation-progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <div class="simulation-stats">
                        <span>Completed</span>
                        <span>Score: 95%</span>
                    </div>
                </div>
                
                <div class="simulation-scenario" data-scenario="data-exfiltration">
                    <div class="simulation-title">
                        <i class="fas fa-database simulation-icon"></i>
                        <h3>Data Exfiltration Scenario</h3>
                        <span class="simulation-difficulty difficulty-intermediate">Intermediate</span>
                    </div>
                    <div class="simulation-description">
                        <p>Experience what happens when an app tries to exfiltrate your personal data without permission.</p>
                    </div>
                    <div class="simulation-progress">
                        <div class="progress-bar" style="width: 75%"></div>
                    </div>
                    <div class="simulation-stats">
                        <span>3/4 Complete</span>
                        <span>Score: 82%</span>
                    </div>
                </div>
                
                <div class="simulation-scenario" data-scenario="malicious-update">
                    <div class="simulation-title">
                        <i class="fas fa-code-branch simulation-icon"></i>
                        <h3>Malicious Update Scenario</h3>
                        <span class="simulation-difficulty difficulty-advanced">Advanced</span>
                    </div>
                    <div class="simulation-description">
                        <p>Discover how seemingly innocent app updates can introduce new privacy risks.</p>
                    </div>
                    <div class="simulation-progress">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                    <div class="simulation-stats">
                        <span>2/4 Complete</span>
                        <span>Score: 78%</span>
                    </div>
                </div>
                
                <div class="simulation-scenario" data-scenario="sensor-fingerprinting">
                    <div class="simulation-title">
                        <i class="fas fa-fingerprint simulation-icon"></i>
                        <h3>Sensor Fingerprinting Attack</h3>
                        <span class="simulation-difficulty difficulty-advanced">Advanced</span>
                    </div>
                    <div class="simulation-description">
                        <p>Learn how apps can use sensors to create a unique fingerprint of your device.</p>
                    </div>
                    <div class="simulation-progress">
                        <div class="progress-bar" style="width: 25%"></div>
                    </div>
                    <div class="simulation-stats">
                        <span>1/4 Complete</span>
                        <span>Score: 70%</span>
                    </div>
                </div>
                
                <div class="simulation-scenario" data-scenario="fake-vs-real">
                    <div class="simulation-title">
                        <i class="fas fa-mask simulation-icon"></i>
                        <h3>Fake App vs Real App Test</h3>
                        <span class="simulation-difficulty difficulty-intermediate">Intermediate</span>
                    </div>
                    <div class="simulation-description">
                        <p>Test your ability to distinguish between legitimate apps and malicious clones.</p>
                    </div>
                    <div class="simulation-progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                    <div class="simulation-stats">
                        <span>Not Started</span>
                        <span>Score: 0%</span>
                    </div>
                </div>
                
                <div class="simulation-scenario" data-scenario="live-breach">
                    <div class="simulation-title">
                        <i class="fas fa-virus simulation-icon"></i>
                        <h3>Live Breach Simulation</h3>
                        <span class="simulation-difficulty difficulty-advanced">Advanced</span>
                    </div>
                    <div class="simulation-description">
                        <p>Experience a simulated real-time data breach and learn how to respond effectively.</p>
                    </div>
                    <div class="simulation-progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                    <div class="simulation-stats">
                        <span>Not Started</span>
                        <span>Score: 0%</span>
                    </div>
                </div>
            </div>
            
            <!-- Active Simulation Container -->
            <div class="simulation-active" id="active-simulation">
                <div class="simulation-container">
                    <div class="simulation-header">
                        <button class="simulation-back" id="simulation-back">
                            <i class="fas fa-arrow-left"></i> Back to Scenarios
                        </button>
                        <div>
                            <h3 id="active-simulation-title">Phishing Permission Prompt</h3>
                            <div id="active-simulation-progress">Question 1 of 4</div>
                        </div>
                        <div id="simulation-timer">Time: 02:15</div>
                    </div>
                    
                    <div class="simulation-content">
                        <div class="simulation-prompt" id="simulation-prompt">
                            A new app called "FlashLight Pro" is requesting access to your contacts, microphone, and location. The app description says it's a simple flashlight utility. What should you do?
                        </div>
                        
                        <div class="simulation-choices" id="simulation-choices">
                            <button class="choice-btn" data-choice="allow">
                                <div class="choice-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div>
                                    <div class="choice-title">Allow All Permissions</div>
                                    <div class="choice-desc">The app might need these for enhanced features</div>
                                </div>
                            </button>
                            
                            <button class="choice-btn" data-choice="deny">
                                <div class="choice-icon">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div>
                                    <div class="choice-title">Deny All Permissions</div>
                                    <div class="choice-desc">A flashlight shouldn't need contacts or microphone</div>
                                </div>
                            </button>
                            
                            <button class="choice-btn" data-choice="custom">
                                <div class="choice-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div>
                                    <div class="choice-title">Allow Only Camera (for flashlight)</div>
                                    <div class="choice-desc">Grant minimal permissions needed for core functionality</div>
                                </div>
                            </button>
                            
                            <button class="choice-btn" data-choice="sandbox">
                                <div class="choice-icon">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div>
                                    <div class="choice-title">Sandbox the App</div>
                                    <div class="choice-desc">Run it in isolation with fake data to see its behavior</div>
                                </div>
                            </button>
                        </div>
                        
                        <div class="simulation-feedback" id="simulation-feedback">
                            <div class="feedback-title">
                                <i class="fas fa-check-circle"></i>
                                <span>Correct!</span>
                            </div>
                            <div class="feedback-content">
                                A flashlight app requesting contacts and microphone is a major red flag. These permissions are unnecessary for its stated purpose and indicate potential malicious intent. The safest approach is to deny all permissions or sandbox the app to observe its behavior.
                            </div>
                        </div>
                        
                        <div class="simulation-next" id="simulation-next">
                            <button class="btn" id="next-question-btn">Next Question <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Simulation Complete Screen -->
            <div class="simulation-complete" id="simulation-complete">
                <div class="completion-badge">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="completion-title">Simulation Complete!</div>
                <div class="completion-message" id="completion-message">
                    You've successfully completed the Phishing Permission Prompt simulation with a score of 95%.
                </div>
                <div class="action-buttons">
                    <button class="btn" id="review-simulation-btn">
                        <i class="fas fa-redo"></i> Review Answers
                    </button>
                    <button class="btn btn-success" id="next-simulation-btn">
                        <i class="fas fa-arrow-right"></i> Next Simulation
                    </button>
                    <button class="btn btn-outline" id="back-to-scenarios-btn">
                        <i class="fas fa-home"></i> Back to Scenarios
                    </button>
                </div>
            </div>
            
            <div class="grid grid-2">
                <div class="card">
                    <h3>Your Simulation Score</h3>
                    <p>Performance breakdown across all simulation categories</p>
                    <canvas id="simulationChart" height="250"></canvas>
                </div>
                
                <div class="card leaderboard">
                    <h3>Leaderboard</h3>
                    <p>Compare your privacy skills with other EchoGuard users</p>
                    
                    <ul class="leaderboard-list">
                        <li class="leaderboard-item">
                            <div class="leaderboard-rank rank-1">1</div>
                            <div class="leaderboard-user">
                                <div>PrivacyPro92</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Elite Defender</div>
                            </div>
                            <div class="leaderboard-score">96%</div>
                        </li>
                        
                        <li class="leaderboard-item">
                            <div class="leaderboard-rank rank-2">2</div>
                            <div class="leaderboard-user">
                                <div>DataGuardian</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Expert Analyst</div>
                            </div>
                            <div class="leaderboard-score">93%</div>
                        </li>
                        
                        <li class="leaderboard-item">
                            <div class="leaderboard-rank rank-3">3</div>
                            <div class="leaderboard-user">
                                <div>SecureUser</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Expert Analyst</div>
                            </div>
                            <div class="leaderboard-score">89%</div>
                        </li>
                        
                        <li class="leaderboard-item">
                            <div class="leaderboard-rank rank-other">7</div>
                            <div class="leaderboard-user">
                                <div>You</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Advanced Defender</div>
                            </div>
                            <div class="leaderboard-score">84%</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Simulation Effects Overlay -->
    <div class="simulation-effects" id="simulation-effects">
        <div class="effect-particles" id="effect-particles"></div>
        <div class="effect-success" id="effect-success">
            <i class="fas fa-check-circle"></i>
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
        
       
        // Simulation Data
        const simulations = {
            'phishing': {
                title: 'Phishing Permission Prompt',
                difficulty: 'Beginner',
                questions: [
                    {
                        prompt: 'A new app called "FlashLight Pro" is requesting access to your contacts, microphone, and location. The app description says it\'s a simple flashlight utility. What should you do?',
                        choices: [
                            {
                                text: 'Allow All Permissions',
                                description: 'The app might need these for enhanced features',
                                correct: false
                            },
                            {
                                text: 'Deny All Permissions',
                                description: 'A flashlight shouldn\'t need contacts or microphone',
                                correct: true
                            },
                            {
                                text: 'Allow Only Camera (for flashlight)',
                                description: 'Grant minimal permissions needed for core functionality',
                                correct: true
                            },
                            {
                                text: 'Sandbox the App',
                                description: 'Run it in isolation with fake data to see its behavior',
                                correct: true
                            }
                        ],
                        feedback: {
                            correct: 'A flashlight app requesting contacts and microphone is a major red flag. These permissions are unnecessary for its stated purpose and indicate potential malicious intent. The safest approach is to deny all permissions or sandbox the app to observe its behavior.',
                            incorrect: 'Granting unnecessary permissions to apps can lead to data theft and privacy violations. Always question why an app needs specific permissions and whether they align with its stated functionality.'
                        }
                    },
                    {
                        prompt: 'You receive a notification that looks like a system alert, asking you to verify your account by entering your password. The message claims it\'s from "Apple Security". What do you do?',
                        choices: [
                            {
                                text: 'Enter your password immediately',
                                description: 'It might be an important security alert',
                                correct: false
                            },
                            {
                                text: 'Ignore and delete the notification',
                                description: 'Real system alerts don\'t ask for passwords this way',
                                correct: true
                            },
                            {
                                text: 'Check if you\'re logged out of your account',
                                description: 'Verify the request through official channels',
                                correct: true
                            },
                            {
                                text: 'Report the notification as phishing',
                                description: 'Help protect others from this scam',
                                correct: true
                            }
                        ],
                        feedback: {
                            correct: 'Legitimate system alerts never ask for passwords through notifications. This is a classic phishing attempt designed to steal your credentials. Always verify security requests through official apps or websites.',
                            incorrect: 'Entering your password in response to unsolicited notifications is extremely dangerous. Attackers use fake system alerts to trick users into revealing sensitive information.'
                        }
                    }
                ]
            },
            'data-exfiltration': {
                title: 'Data Exfiltration Scenario',
                difficulty: 'Intermediate',
                questions: [
                    {
                        prompt: 'You notice that a weather app you installed last week is sending large amounts of data in the background, even when you\'re not using it. What\'s the best course of action?',
                        choices: [
                            {
                                text: 'Ignore it - weather data can be large',
                                description: 'Maybe it\'s downloading forecast maps',
                                correct: false
                            },
                            {
                                text: 'Check what data it\'s accessing',
                                description: 'Review app permissions and network activity',
                                correct: true
                            },
                            {
                                text: 'Immediately uninstall the app',
                                description: 'Better safe than sorry',
                                correct: false
                            },
                            {
                                text: 'Restrict its background data usage',
                                description: 'Limit what it can do when not in use',
                                correct: true
                            }
                        ],
                        feedback: {
                            correct: 'Monitoring app behavior is crucial for privacy. Weather apps shouldn\'t need to transfer large amounts of data constantly. Investigating permissions and restricting background activity are smart privacy practices.',
                            incorrect: 'Ignoring unusual data transfers can leave you vulnerable to data exfiltration. Even seemingly harmless apps can be collecting and sending your personal information without your knowledge.'
                        }
                    }
                ]
            }
        };
        
        // Current simulation state
        let currentSimulation = null;
        let currentQuestionIndex = 0;
        let userScore = 0;
        let timerInterval = null;
        let timeRemaining = 120; // 2 minutes in seconds
        
        // DOM Elements
        const activeSimulation = document.getElementById('active-simulation');
        const simulationBackBtn = document.getElementById('simulation-back');
        const simulationTitle = document.getElementById('active-simulation-title');
        const simulationProgress = document.getElementById('active-simulation-progress');
        const simulationTimer = document.getElementById('simulation-timer');
        const simulationPrompt = document.getElementById('simulation-prompt');
        const simulationChoices = document.getElementById('simulation-choices');
        const simulationFeedback = document.getElementById('simulation-feedback');
        const simulationNext = document.getElementById('simulation-next');
        const nextQuestionBtn = document.getElementById('next-question-btn');
        const simulationComplete = document.getElementById('simulation-complete');
        const completionMessage = document.getElementById('completion-message');
        const reviewSimulationBtn = document.getElementById('review-simulation-btn');
        const nextSimulationBtn = document.getElementById('next-simulation-btn');
        const backToScenariosBtn = document.getElementById('back-to-scenarios-btn');
        const simulationEffects = document.getElementById('simulation-effects');
        const effectParticles = document.getElementById('effect-particles');
        const effectSuccess = document.getElementById('effect-success');
        
        // Start simulation when clicking on a scenario
        document.querySelectorAll('.simulation-scenario').forEach(scenario => {
            scenario.addEventListener('click', function() {
                const scenarioId = this.getAttribute('data-scenario');
                startSimulation(scenarioId);
            });
        });
        
        // Back button functionality
        simulationBackBtn.addEventListener('click', function() {
            resetSimulation();
            activeSimulation.style.display = 'none';
        });
        
        // Next question button
        nextQuestionBtn.addEventListener('click', function() {
            currentQuestionIndex++;
            if (currentQuestionIndex < simulations[currentSimulation].questions.length) {
                displayQuestion(currentQuestionIndex);
            } else {
                completeSimulation();
            }
        });
        
        // Simulation complete buttons
        reviewSimulationBtn.addEventListener('click', function() {
            currentQuestionIndex = 0;
            displayQuestion(currentQuestionIndex);
            simulationComplete.style.display = 'none';
            activeSimulation.style.display = 'block';
        });
        
        nextSimulationBtn.addEventListener('click', function() {
            // In a real app, this would load the next available simulation
            alert('Loading next simulation...');
            resetSimulation();
            simulationComplete.style.display = 'none';
        });
        
        backToScenariosBtn.addEventListener('click', function() {
            resetSimulation();
            simulationComplete.style.display = 'none';
        });
        
        // Start a simulation
        function startSimulation(scenarioId) {
            currentSimulation = scenarioId;
            currentQuestionIndex = 0;
            userScore = 0;
            timeRemaining = 120;
            
            // Update UI
            simulationTitle.textContent = simulations[scenarioId].title;
            activeSimulation.style.display = 'block';
            
            // Start timer
            startTimer();
            
            // Display first question
            displayQuestion(currentQuestionIndex);
        }
        
        // Display a question
        function displayQuestion(questionIndex) {
            const question = simulations[currentSimulation].questions[questionIndex];
            
            // Update progress
            simulationProgress.textContent = `Question ${questionIndex + 1} of ${simulations[currentSimulation].questions.length}`;
            
            // Update prompt
            simulationPrompt.textContent = question.prompt;
            
            // Clear previous choices
            simulationChoices.innerHTML = '';
            
            // Add new choices
            question.choices.forEach((choice, index) => {
                const choiceBtn = document.createElement('button');
                choiceBtn.className = 'choice-btn';
                choiceBtn.setAttribute('data-choice', index);
                
                choiceBtn.innerHTML = `
                    <div class="choice-icon">
                        <i class="fas fa-${getChoiceIcon(index)}"></i>
                    </div>
                    <div>
                        <div class="choice-title">${choice.text}</div>
                        <div class="choice-desc">${choice.description}</div>
                    </div>
                `;
                
                choiceBtn.addEventListener('click', function() {
                    handleChoiceSelection(choiceBtn, choice.correct, question.feedback);
                });
                
                simulationChoices.appendChild(choiceBtn);
            });
            
            // Hide feedback and next button
            simulationFeedback.style.display = 'none';
            simulationNext.style.display = 'none';
        }
        
        // Handle choice selection
        function handleChoiceSelection(choiceBtn, isCorrect, feedback) {
            // Disable all choice buttons
            document.querySelectorAll('.choice-btn').forEach(btn => {
                btn.disabled = true;
            });
            
            // Mark selected button
            choiceBtn.classList.add('selected');
            
            // Show correct/incorrect styling
            if (isCorrect) {
                choiceBtn.classList.add('correct');
                userScore += 1;
                showSuccessEffect();
            } else {
                choiceBtn.classList.add('incorrect');
                
                // Also show the correct answer
                document.querySelectorAll('.choice-btn').forEach(btn => {
                    const choiceIndex = parseInt(btn.getAttribute('data-choice'));
                    if (simulations[currentSimulation].questions[currentQuestionIndex].choices[choiceIndex].correct) {
                        btn.classList.add('correct');
                    }
                });
            }
            
            // Show feedback
            simulationFeedback.className = `simulation-feedback ${isCorrect ? 'feedback-correct' : 'feedback-incorrect'}`;
            simulationFeedback.querySelector('.feedback-title i').className = isCorrect ? 'fas fa-check-circle' : 'fas fa-exclamation-triangle';
            simulationFeedback.querySelector('.feedback-title span').textContent = isCorrect ? 'Correct!' : 'Incorrect';
            simulationFeedback.querySelector('.feedback-content').textContent = isCorrect ? feedback.correct : feedback.incorrect;
            simulationFeedback.style.display = 'block';
            
            // Show next button
            simulationNext.style.display = 'block';
        }
        
        // Complete simulation
        function completeSimulation() {
            // Calculate final score
            const totalQuestions = simulations[currentSimulation].questions.length;
            const percentage = Math.round((userScore / totalQuestions) * 100);
            
            // Update completion message
            completionMessage.textContent = `You've successfully completed the ${simulations[currentSimulation].title} simulation with a score of ${percentage}%.`;
            
            // Hide active simulation, show completion screen
            activeSimulation.style.display = 'none';
            simulationComplete.style.display = 'block';
            
            // Stop timer
            clearInterval(timerInterval);
            
            // Update progress on scenario card
            updateScenarioProgress(currentSimulation, percentage);
        }
        
        // Reset simulation state
        function resetSimulation() {
            currentSimulation = null;
            currentQuestionIndex = 0;
            userScore = 0;
            clearInterval(timerInterval);
            timeRemaining = 120;
        }
        
        // Start timer
        function startTimer() {
            updateTimerDisplay();
            
            timerInterval = setInterval(function() {
                timeRemaining--;
                updateTimerDisplay();
                
                if (timeRemaining <= 0) {
                    clearInterval(timerInterval);
                    // Auto-submit if time runs out
                    if (simulationNext.style.display === 'none') {
                        document.querySelectorAll('.choice-btn')[0].click();
                    }
                }
            }, 1000);
        }
        
        // Update timer display
        function updateTimerDisplay() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            simulationTimer.textContent = `Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            // Change color when time is running low
            if (timeRemaining < 30) {
                simulationTimer.style.color = 'var(--danger)';
                simulationTimer.style.animation = 'pulse 1s infinite';
            } else if (timeRemaining < 60) {
                simulationTimer.style.color = 'var(--warning)';
            } else {
                simulationTimer.style.color = 'var(--light)';
                simulationTimer.style.animation = 'none';
            }
        }
        
        // Get icon for choice based on index
        function getChoiceIcon(index) {
            const icons = ['check', 'times', 'cog', 'box', 'shield-alt', 'user-secret'];
            return icons[index] || 'circle';
        }
        
        // Update scenario progress
        function updateScenarioProgress(scenarioId, percentage) {
            const scenarioCard = document.querySelector(`.simulation-scenario[data-scenario="${scenarioId}"]`);
            if (scenarioCard) {
                const progressBar = scenarioCard.querySelector('.progress-bar');
                const stats = scenarioCard.querySelector('.simulation-stats');
                
                // Update progress bar
                progressBar.style.width = `${percentage}%`;
                
                // Update stats
                if (percentage === 100) {
                    stats.innerHTML = '<span>Completed</span><span>Score: ' + percentage + '%</span>';
                } else {
                    stats.innerHTML = '<span>In Progress</span><span>Score: ' + percentage + '%</span>';
                }
            }
        }
        
        // Show success effect
        function showSuccessEffect() {
            simulationEffects.style.display = 'block';
            
            // Create particles
            createParticles();
            
            // Show success icon
            effectSuccess.style.display = 'block';
            effectSuccess.style.animation = 'explode 1s ease-out';
            
            // Hide effects after animation
            setTimeout(() => {
                simulationEffects.style.display = 'none';
                effectSuccess.style.display = 'none';
            }, 1000);
        }
        
        // Create floating particles
        function createParticles() {
            effectParticles.innerHTML = '';
            
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random position
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.top = Math.random() * 100 + 'vh';
                
                // Random size
                const size = Math.random() * 6 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                
                // Random color
                const colors = ['var(--primary)', 'var(--success)', 'var(--accent)'];
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                
                // Random animation delay
                particle.style.animationDelay = Math.random() * 3 + 's';
                
                effectParticles.appendChild(particle);
            }
        }
        
        // Initialize charts
        window.addEventListener('load', function() {
            // Simulation performance chart
            const simulationCtx = document.getElementById('simulationChart');
            if (simulationCtx) {
                const simulationChart = new Chart(simulationCtx, {
                    type: 'radar',
                    data: {
                        labels: ['Threat Detection', 'Response Time', 'Preventive Actions', 'Risk Assessment', 'Data Protection'],
                        datasets: [{
                            label: 'Your Skills',
                            data: [85, 70, 90, 80, 75],
                            backgroundColor: 'rgba(0, 198, 255, 0.2)',
                            borderColor: 'rgba(0, 198, 255, 1)',
                            pointBackgroundColor: 'rgba(0, 198, 255, 1)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(0, 198, 255, 1)'
                        }, {
                            label: 'Expert Level',
                            data: [95, 90, 95, 90, 90],
                            backgroundColor: 'rgba(126, 66, 255, 0.2)',
                            borderColor: 'rgba(126, 66, 255, 1)',
                            pointBackgroundColor: 'rgba(126, 66, 255, 1)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(126, 66, 255, 1)'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            r: {
                                angleLines: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                },
                                pointLabels: {
                                    color: 'rgba(224, 247, 255, 0.7)'
                                },
                                ticks: {
                                    color: 'rgba(224, 247, 255, 0.5)',
                                    backdropColor: 'transparent'
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
        });
    </script>
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