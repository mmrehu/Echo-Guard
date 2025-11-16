<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard | Take Back Control of Your Digital Privacy</title>
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
        
        .btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            font-family: 'Exo 2', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
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
        
        .btn-large {
            padding: 1rem 2rem;
            font-size: 1.1rem;
        }
        
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            padding: 0 2rem;
            overflow: hidden;
        }
        
        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        .hero-text {
            z-index: 2;
        }
        
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .dashboard-preview {
            width: 100%;
            max-width: 500px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(0, 198, 255, 0.3);
            transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
            transition: transform 0.5s ease;
        }
        
        .dashboard-preview:hover {
            transform: perspective(1000px) rotateY(0) rotateX(0);
        }
        
        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--primary);
            text-align: center;
        }
        
        h3 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--light);
        }
        
        .subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: var(--gray);
        }
        
        .hero-btns {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .stats {
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .stat {
            text-align: center;
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            font-family: 'Orbitron', sans-serif;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        section {
            padding: 6rem 2rem;
        }
        
        .section-dark {
            background: rgba(5, 7, 15, 0.7);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .feature-card {
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.2);
            border-radius: 8px;
            padding: 2rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }
        
        .feature-card:hover {
            border-color: rgba(0, 198, 255, 0.4);
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 198, 255, 0.2);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }
        
        .how-it-works {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .step {
            text-align: center;
            padding: 2rem;
            position: relative;
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        .testimonials {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .testimonial {
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.2);
            border-radius: 8px;
            padding: 2rem;
            position: relative;
        }
        
        .testimonial::before {
            content: '"';
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 4rem;
            color: var(--primary);
            opacity: 0.3;
            font-family: Georgia, serif;
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }
        
        .author-info h4 {
            margin-bottom: 0.2rem;
            font-size: 1.1rem;
        }
        
        .author-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .pricing {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .pricing-card {
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.2);
            border-radius: 8px;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .pricing-card.featured {
            border-color: var(--primary);
            transform: scale(1.05);
        }
        
        .pricing-card.featured::before {
            content: 'Most Popular';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary);
            color: var(--dark);
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .pricing-card:hover {
            border-color: rgba(0, 198, 255, 0.4);
            transform: translateY(-10px);
        }
        
        .pricing-card.featured:hover {
            transform: scale(1.05) translateY(-10px);
        }
        
        .price {
            font-size: 3rem;
            font-weight: 700;
            font-family: 'Orbitron', sans-serif;
            color: var(--primary);
            margin: 1.5rem 0;
        }
        
        .price span {
            font-size: 1rem;
            color: var(--gray);
        }
        
        .pricing-features {
            list-style: none;
            margin: 2rem 0;
            text-align: left;
        }
        
        .pricing-features li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .pricing-features li i {
            color: var(--success);
        }
        
        .faq-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .faq-item {
            background: rgba(10, 14, 23, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.2);
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .faq-item:hover {
            border-color: rgba(0, 198, 255, 0.4);
        }
        
        .faq-question {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary);
            font-size: 1.1rem;
        }
        
        .cta {
            text-align: center;
            padding: 6rem 2rem;
            background: linear-gradient(135deg, rgba(5, 7, 15, 0.9) 0%, rgba(10, 14, 23, 0.9) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at center, rgba(0, 198, 255, 0.1) 0%, rgba(0, 114, 255, 0.05) 40%, rgba(5, 7, 15, 0) 70%);
            z-index: -1;
        }
        
        .cta h2 {
            margin-bottom: 1rem;
        }
        
        .cta p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem;
            color: var(--gray);
        }
        
        footer {
            background: rgba(5, 7, 15, 0.9);
            border-top: 1px solid rgba(0, 198, 255, 0.2);
            padding: 4rem 2rem 2rem;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }
        
        .footer-column h4 {
            font-family: 'Orbitron', sans-serif;
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        
        .footer-links a {
            color: var(--gray);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary);
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(0, 198, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light);
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
        
        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: float 5s ease-in-out infinite;
        }
        
        /* Responsive adjustments */
        @media (max-width: 968px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            h1 {
                font-size: 2.8rem;
            }
            
            .hero-btns {
                justify-content: center;
            }
            
            .stats {
                justify-content: center;
            }
        }
        
        @media (max-width: 768px) {
            nav ul {
                display: none;
            }
            
            .hero-btns {
                flex-direction: column;
                align-items: center;
            }
            
            .stats {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .pricing-card.featured {
                transform: scale(1);
            }
            
            .pricing-card.featured:hover {
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    <div class="glow"></div>
    
    <header>
        <div class="logo">
            <i class="fas fa-shield-alt"></i>
            <span>EchoGuard</span>
        </div>
        
        <nav>
            <ul>
                <li><a href="#features">Features</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
        </nav>
        
        <div class="header-btns">
            <a href="login.php" class="btn btn-outline">Log In</a>
            <a href="#pricing" class="btn">Get Started</a>
        </div>
    </header>
    
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <h1>Take Back Control of Your Digital Privacy</h1>
                <p class="subtitle">EchoGuard monitors app permissions in real-time, detects suspicious access, and puts you back in charge of your personal data.</p>
                <div class="hero-btns">
                    <a href="#pricing" class="btn btn-large">Start Free Trial</a>
                    <a href="#features" class="btn btn-outline btn-large">Learn More</a>
                </div>
                <div class="stats">
                    <div class="stat">
                        <div class="stat-value">94%</div>
                        <div class="stat-label">Threats Blocked</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">12.7k</div>
                        <div class="stat-label">Protected Users</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">24/7</div>
                        <div class="stat-label">Real-time Monitoring</div>
                    </div>
                </div>
            </div>
            <div class="hero-visual" data-aos="fade-left">
                <div class="dashboard-preview floating">
                    <!-- This would be an image or an embedded component in a real implementation -->
                    <div style="background: linear-gradient(135deg, #0a0e17, #05070f); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-family: 'Orbitron'; border: 1px solid rgba(0,198,255,0.3);">
                        <div style="text-align: center;">
                            <i class="fas fa-shield-alt" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                            <div>EchoGuard Dashboard Preview</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="features">
        <div class="container">
            <h2 data-aos="fade-up">Advanced Privacy Protection</h2>
            <p class="subtitle" data-aos="fade-up" data-aos-delay="100">Comprehensive tools to monitor, control, and secure your digital footprint</p>
            
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3>Privacy Score</h3>
                    <p>AI-generated privacy score that evaluates your digital footprint and provides actionable insights to improve your security.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Live Threat Monitor</h3>
                    <p>Real-time alerts for suspicious app behavior, unauthorized data access, and potential privacy breaches.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Data Access Heatmap</h3>
                    <p>Visualize which sensors and permissions are being used by your apps with an intuitive heatmap interface.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon">
                        <i class="fas fa-bug"></i>
                    </div>
                    <h3>Zero-Day Watchlist</h3>
                    <p>Detect apps behaving strangely after updates with our advanced behavioral analysis system.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <h3>Stealth Mode</h3>
                    <p>Virtualize your sensors with dummy data to prevent tracking while maintaining app functionality.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="700">
                    <div class="feature-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <h3>Security Simulations</h3>
                    <p>Train your privacy skills with interactive simulations of real-world threats and attacks.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section id="how-it-works" class="section-dark">
        <div class="container">
            <h2 data-aos="fade-up">How EchoGuard Works</h2>
            <p class="subtitle" data-aos="fade-up" data-aos-delay="100">Three simple steps to complete digital privacy protection</p>
            
            <div class="how-it-works">
                <div class="step" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-number">1</div>
                    <h3>Install & Scan</h3>
                    <p>Download EchoGuard and run the initial privacy scan to assess your current security status.</p>
                </div>
                
                <div class="step" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-number">2</div>
                    <h3>Monitor & Alert</h3>
                    <p>EchoGuard continuously monitors app behavior and alerts you to suspicious activities in real-time.</p>
                </div>
                
                <div class="step" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-number">3</div>
                    <h3>Control & Protect</h3>
                    <p>Use one-tap actions to revoke permissions, block trackers, and secure your data with advanced privacy modes.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section id="testimonials">
        <div class="container">
            <h2 data-aos="fade-up">Trusted by Thousands</h2>
            <p class="subtitle" data-aos="fade-up" data-aos-delay="100">See what our users are saying about EchoGuard</p>
            
            <div class="testimonials">
                <div class="testimonial" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-text">
                        "I had no idea how many apps were accessing my microphone in the background. EchoGuard revealed the shocking truth and helped me take back control."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">JS</div>
                        <div class="author-info">
                            <h4>Jamie Smith</h4>
                            <p>Software Engineer</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-text">
                        "The security simulations taught me how to spot phishing attempts and malicious permission requests. I feel so much more secure now."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">MR</div>
                        <div class="author-info">
                            <h4>Maria Rodriguez</h4>
                            <p>Marketing Director</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial" data-aos="fade-up" data-aos-delay="400">
                    <div class="testimonial-text">
                        "As a privacy advocate, I've tried many tools. EchoGuard is by far the most comprehensive and user-friendly solution I've found."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">TK</div>
                        <div class="author-info">
                            <h4>Thomas Kim</h4>
                            <p>Privacy Consultant</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="pricing" class="section-dark">
        <div class="container">
            <h2 data-aos="fade-up">Simple, Transparent Pricing</h2>
            <p class="subtitle" data-aos="fade-up" data-aos-delay="100">Choose the plan that fits your privacy needs</p>
            
            <div class="pricing">
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="200">
                    <h3>Basic</h3>
                    <div class="price">$0 <span>/ forever</span></div>
                    <p>Essential privacy protection for casual users</p>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> Real-time permission monitoring</li>
                        <li><i class="fas fa-check"></i> Basic threat alerts</li>
                        <li><i class="fas fa-check"></i> Privacy score</li>
                        <li><i class="fas fa-times"></i> Advanced simulations</li>
                        <li><i class="fas fa-times"></i> Stealth mode</li>
                        <li><i class="fas fa-times"></i> Priority support</li>
                    </ul>
                    <a href="#" class="btn btn-outline">Get Started</a>
                </div>
                
                <div class="pricing-card featured" data-aos="fade-up" data-aos-delay="300">
                    <h3>Pro</h3>
                    <div class="price">$4.99 <span>/ month</span></div>
                    <p>Complete protection for privacy-conscious users</p>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> All Basic features</li>
                        <li><i class="fas fa-check"></i> Advanced threat detection</li>
                        <li><i class="fas fa-check"></i> Security simulations</li>
                        <li><i class="fas fa-check"></i> Stealth mode</li>
                        <li><i class="fas fa-check"></i> Data access timeline</li>
                        <li><i class="fas fa-check"></i> Priority support</li>
                    </ul>
                    <a href="#" class="btn">Get Started</a>
                </div>
                
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="400">
                    <h3>Family</h3>
                    <div class="price">$9.99 <span>/ month</span></div>
                    <p>Protection for your entire household</p>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> All Pro features</li>
                        <li><i class="fas fa-check"></i> Up to 5 devices</li>
                        <li><i class="fas fa-check"></i> Family dashboard</li>
                        <li><i class="fas fa-check"></i> Child safety features</li>
                        <li><i class="fas fa-check"></i> 24/7 premium support</li>
                        <li><i class="fas fa-check"></i> Monthly privacy reports</li>
                    </ul>
                    <a href="#" class="btn btn-outline">Get Started</a>
                </div>
            </div>
        </div>
    </section>
    
    <section id="faq">
        <div class="container">
            <h2 data-aos="fade-up">Frequently Asked Questions</h2>
            <p class="subtitle" data-aos="fade-up" data-aos-delay="100">Everything you need to know about EchoGuard</p>
            
            <div class="faq-grid">
                <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="faq-question">How does EchoGuard detect suspicious app behavior?</div>
                    <p>EchoGuard uses machine learning algorithms to analyze app behavior patterns, comparing them against known malicious activities and identifying anomalies that indicate potential privacy threats.</p>
                </div>
                
                <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="faq-question">Will EchoGuard slow down my device?</div>
                    <p>No, EchoGuard is designed to be lightweight and efficient. Our optimized algorithms run in the background with minimal impact on device performance or battery life.</p>
                </div>
                
                <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="faq-question">Can I use EchoGuard alongside other security apps?</div>
                    <p>Yes, EchoGuard is compatible with most antivirus and security applications. It focuses specifically on privacy protection rather than malware detection.</p>
                </div>
                
                <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                    <div class="faq-question">How often is the threat database updated?</div>
                    <p>Our threat intelligence database is updated continuously in real-time, with new privacy threats and malicious behavior patterns added as they're discovered.</p>
                </div>
                
                <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                    <div class="faq-question">What happens during the security simulations?</div>
                    <p>Our interactive simulations recreate real-world privacy threats in a safe environment, teaching you how to recognize and respond to various types of digital privacy attacks.</p>
                </div>
                
                <div class="faq-item" data-aos="fade-up" data-aos-delay="700">
                    <div class="faq-question">Is my data stored on EchoGuard servers?</div>
                    <p>No, all monitoring and analysis happens locally on your device. We don't collect or store your personal data - that's the whole point of privacy protection!</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="cta">
        <div class="container">
            <h2 data-aos="fade-up">Ready to Take Back Your Privacy?</h2>
            <p data-aos="fade-up" data-aos-delay="100">Join thousands of users who have already secured their digital lives with EchoGuard</p>
            <a href="#pricing" class="btn btn-large" data-aos="fade-up" data-aos-delay="200">Start Your Free Trial</a>
        </div>
    </section>
    
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h4>EchoGuard</h4>
                <p>Advanced privacy protection for the digital age. Monitor, control, and secure your personal data with our comprehensive toolkit.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
            
            <div class="footer-column">
                <h4>Product</h4>
                <ul class="footer-links">
                    <li><a href="#features">Features</a></li>
                    <li><a href="#how-it-works">How It Works</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#">Download</a></li>
                    <li><a href="#">Release Notes</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Resources</h4>
                <ul class="footer-links">
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Privacy Blog</a></li>
                    <li><a href="#">Security Simulations</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Community</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Company</h4>
                <ul class="footer-links">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Legal</a></li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2023 EchoGuard Security. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
        
        // Smooth scrolling for navigation links
   document.querySelectorAll('nav a, .header-btns a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const targetId = this.getAttribute('href');

        // Only prevent default for in-page anchors (smooth scroll)
        if (targetId.startsWith('#')) {
            e.preventDefault();
            const target = document.querySelector(targetId);
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        }
        // If NOT a hash link (e.g., /login.php), allow normal navigation
    });
});

        // Add scroll effect to header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if(window.scrollY > 100) {
                header.style.background = 'rgba(5, 7, 15, 0.95)';
            } else {
                header.style.background = 'rgba(5, 7, 15, 0.8)';
            }
        });
    </script>
</body>
</html>