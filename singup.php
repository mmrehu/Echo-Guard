<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard | Create Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Exo+2:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem 1rem;
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
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: var(--primary);
            text-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
            margin-bottom: 1.5rem;
            animation: logoPulse 3s infinite alternate;
        }
        
        @keyframes logoPulse {
            from { text-shadow: 0 0 5px rgba(0, 198, 255, 0.5); }
            to { text-shadow: 0 0 15px rgba(0, 198, 255, 0.8), 0 0 20px rgba(0, 198, 255, 0.6); }
        }
        
        .logo i {
            color: var(--accent);
            animation: rotate 10s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .signup-container {
            background: rgba(10, 14, 23, 0.8);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 12px;
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
            animation: containerSlideIn 0.8s ease-out;
        }
        
        @keyframes containerSlideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .signup-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 198, 255, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .signup-container:hover::before {
            left: 100%;
        }
        
        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }
        
        .subtitle {
            text-align: center;
            color: var(--gray);
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }
        
        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .form-row .input-group {
            flex: 1;
            margin-bottom: 0;
        }
        
        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--light);
            font-weight: 500;
        }
        
        .input-group input, .input-group select {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(5, 7, 15, 0.7);
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 6px;
            color: var(--light);
            font-family: 'Exo 2', sans-serif;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 198, 255, 0.2);
        }
        
        .input-group i {
            position: absolute;
            right: 1rem;
            top: 2.4rem;
            color: var(--gray);
            transition: color 0.3s ease;
        }
        
        .input-group input:focus + i, .input-group select:focus + i {
            color: var(--primary);
        }
        
        .password-strength {
            margin-top: 0.5rem;
            height: 5px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: all 0.3s ease;
        }
        
        .strength-weak {
            background: var(--danger);
            width: 25%;
        }
        
        .strength-medium {
            background: var(--warning);
            width: 50%;
        }
        
        .strength-strong {
            background: var(--success);
            width: 75%;
        }
        
        .strength-very-strong {
            background: var(--success);
            width: 100%;
        }
        
        .strength-text {
            font-size: 0.8rem;
            margin-top: 0.3rem;
            text-align: right;
        }
        
        .terms-privacy {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .terms-privacy input {
            margin-top: 0.2rem;
        }
        
        .terms-privacy a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .terms-privacy a:hover {
            color: var(--accent);
            text-decoration: underline;
        }
        
        .btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-family: 'Exo 2', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            width: 100%;
            margin-bottom: 1.5rem;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 198, 255, 0.4);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--gray);
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(0, 198, 255, 0.3);
        }
        
        .divider span {
            padding: 0 1rem;
            font-size: 0.8rem;
        }
        
        .social-signup {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .social-btn {
            flex: 1;
            padding: 0.7rem;
            border: 1px solid rgba(0, 198, 255, 0.3);
            border-radius: 6px;
            background: rgba(5, 7, 15, 0.7);
            color: var(--light);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .social-btn:hover {
            background: rgba(0, 198, 255, 0.1);
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .login-link {
            text-align: center;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .login-link a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .login-link a:hover {
            color: var(--accent);
            text-decoration: underline;
        }
        
        .security-tip {
            background: rgba(0, 198, 255, 0.1);
            border-left: 3px solid var(--primary);
            padding: 0.8rem;
            border-radius: 0 4px 4px 0;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            animation: pulse 3s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(5, 7, 15, 0.95);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(0, 198, 255, 0.3);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 1.5rem;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .loading-text {
            font-size: 1.2rem;
            color: var(--primary);
            text-align: center;
            animation: textGlow 2s infinite alternate;
        }
        
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background-color: var(--primary);
            border-radius: 50%;
            opacity: 0;
            animation: particleFloat 15s infinite linear;
        }
        
        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 0.7;
            }
            90% {
                opacity: 0.7;
            }
            100% {
                transform: translateY(-100px) translateX(20px);
                opacity: 0;
            }
        }
        
        .toggle-password {
            cursor: pointer;
        }
        
        .validation-message {
            font-size: 0.8rem;
            margin-top: 0.3rem;
            display: none;
        }
        
        .validation-success {
            color: var(--success);
            display: block;
        }
        
        .validation-error {
            color: var(--danger);
            display: block;
        }
        
        /* Responsive adjustments */
        @media (max-width: 500px) {
            .signup-container {
                padding: 2rem 1.5rem;
                margin: 0 1rem;
            }
            
            .social-signup {
                flex-direction: column;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    <div class="glow"></div>
    <div class="particles" id="particles"></div>
    
    <div class="logo">
        <i class="fas fa-shield-alt"></i>
        <span>EchoGuard</span>
    </div>
    
    <div class="signup-container">
        <h1>Create Account</h1>
        <p class="subtitle">Join EchoGuard to protect your digital privacy</p>
        
        <form id="signupForm">
            <div class="form-row">
                <div class="input-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" placeholder="Enter your first name" required>
                    <i class="fas fa-user"></i>
                    <div class="validation-message" id="firstNameValidation"></div>
                </div>
                
                <div class="input-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" placeholder="Enter your last name" required>
                    <i class="fas fa-user"></i>
                    <div class="validation-message" id="lastNameValidation"></div>
                </div>
            </div>
            
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" placeholder="Enter your email" required>
                <i class="fas fa-envelope"></i>
                <div class="validation-message" id="emailValidation"></div>
            </div>
            
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Choose a username" required>
                <i class="fas fa-at"></i>
                <div class="validation-message" id="usernameValidation"></div>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Create a strong password" required>
                <i class="fas fa-lock"></i>
                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                <div class="password-strength">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                <div class="strength-text" id="passwordStrengthText"></div>
                <div class="validation-message" id="passwordValidation"></div>
            </div>
            
            <div class="input-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" placeholder="Confirm your password" required>
                <i class="fas fa-lock"></i>
                <i class="fas fa-eye toggle-password" id="toggleConfirmPassword"></i>
                <div class="validation-message" id="confirmPasswordValidation"></div>
            </div>
            
            <div class="input-group">
                <label for="securityQuestion">Security Question</label>
                <select id="securityQuestion" required>
                    <option value="" disabled selected>Select a security question</option>
                    <option value="1">What was your first pet's name?</option>
                    <option value="2">What city were you born in?</option>
                    <option value="3">What is your mother's maiden name?</option>
                    <option value="4">What was your first car?</option>
                    <option value="5">What is the name of your elementary school?</option>
                </select>
                <i class="fas fa-chevron-down"></i>
                <div class="validation-message" id="securityQuestionValidation"></div>
            </div>
            
            <div class="input-group">
                <label for="securityAnswer">Security Answer</label>
                <input type="text" id="securityAnswer" placeholder="Enter your answer" required>
                <i class="fas fa-key"></i>
                <div class="validation-message" id="securityAnswerValidation"></div>
            </div>
            
            <div class="terms-privacy">
                <input type="checkbox" id="terms" required>
                <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
            </div>
            
            <div class="terms-privacy">
                <input type="checkbox" id="newsletter">
                <label for="newsletter">Send me security updates and privacy tips</label>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
            
            <div class="divider">
                <span>Or sign up with</span>
            </div>
            
            <div class="social-signup">
                <button type="button" class="social-btn">
                    <i class="fab fa-google"></i> Google
                </button>
                <button type="button" class="social-btn">
                    <i class="fab fa-microsoft"></i> Microsoft
                </button>
            </div>
            
            <div class="login-link">
                Already have an account? <a href="login.php">Sign in</a>
            </div>
            
            <div class="security-tip">
                <i class="fas fa-shield-alt"></i> Your data is encrypted end-to-end and never shared with third parties.
            </div>
        </form>
    </div>
    
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Creating Secure Account</div>
    </div>

    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random position and animation delay
                const size = Math.random() * 3 + 1;
                const left = Math.random() * 100;
                const delay = Math.random() * 15;
                const duration = Math.random() * 10 + 15;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${left}%`;
                particle.style.animationDelay = `${delay}s`;
                particle.style.animationDuration = `${duration}s`;
                
                particlesContainer.appendChild(particle);
            }
        }
        
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            
            // Add animation effect
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
        
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('confirmPassword');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            
            // Add animation effect
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
        
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');
            
            // Reset classes
            strengthBar.className = 'password-strength-bar';
            
            if (password.length === 0) {
                strengthBar.style.width = '0%';
                strengthText.textContent = '';
                return;
            }
            
            // Calculate password strength
            let strength = 0;
            let feedback = '';
            
            // Length check
            if (password.length >= 8) strength += 25;
            
            // Contains lowercase
            if (/[a-z]/.test(password)) strength += 25;
            
            // Contains uppercase
            if (/[A-Z]/.test(password)) strength += 25;
            
            // Contains numbers or special characters
            if (/[0-9]/.test(password) || /[^A-Za-z0-9]/.test(password)) strength += 25;
            
            // Set strength bar and text
            strengthBar.style.width = `${strength}%`;
            
            if (strength <= 25) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Weak';
                strengthText.style.color = 'var(--danger)';
            } else if (strength <= 50) {
                strengthBar.classList.add('strength-medium');
                strengthText.textContent = 'Medium';
                strengthText.style.color = 'var(--warning)';
            } else if (strength <= 75) {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Strong';
                strengthText.style.color = 'var(--success)';
            } else {
                strengthBar.classList.add('strength-very-strong');
                strengthText.textContent = 'Very Strong';
                strengthText.style.color = 'var(--success)';
            }
        });
        
        // Form validation
        function validateField(field, validationId) {
            const value = field.value.trim();
            const validationElement = document.getElementById(validationId);
            
            // Reset validation
            validationElement.className = 'validation-message';
            
            // Check if field is empty
            if (value === '') {
                validationElement.textContent = 'This field is required';
                validationElement.classList.add('validation-error');
                return false;
            }
            
            // Specific validations based on field type
            if (field.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    validationElement.textContent = 'Please enter a valid email address';
                    validationElement.classList.add('validation-error');
                    return false;
                }
            }
            
            if (field.id === 'username') {
                if (value.length < 3) {
                    validationElement.textContent = 'Username must be at least 3 characters';
                    validationElement.classList.add('validation-error');
                    return false;
                }
            }
            
            if (field.id === 'password') {
                if (value.length < 8) {
                    validationElement.textContent = 'Password must be at least 8 characters';
                    validationElement.classList.add('validation-error');
                    return false;
                }
            }
            
            if (field.id === 'confirmPassword') {
                const password = document.getElementById('password').value;
                if (value !== password) {
                    validationElement.textContent = 'Passwords do not match';
                    validationElement.classList.add('validation-error');
                    return false;
                }
            }
            
            // If all validations pass
            validationElement.textContent = 'Looks good!';
            validationElement.classList.add('validation-success');
            return true;
        }
        
        // Real-time validation
        const formFields = document.querySelectorAll('#signupForm input, #signupForm select');
        formFields.forEach(field => {
            field.addEventListener('blur', function() {
                const validationId = `${this.id}Validation`;
                validateField(this, validationId);
            });
        });
        
        // Form submission with loading animation
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const loadingOverlay = document.getElementById('loadingOverlay');
            let formIsValid = true;
            
            // Validate all fields
            formFields.forEach(field => {
                const validationId = `${field.id}Validation`;
                if (!validateField(field, validationId)) {
                    formIsValid = false;
                    
                    // Shake animation for invalid fields
                    field.style.borderColor = 'var(--danger)';
                    field.style.animation = 'shake 0.5s';
                    setTimeout(() => {
                        field.style.animation = '';
                    }, 500);
                } else {
                    field.style.borderColor = 'rgba(0, 198, 255, 0.3)';
                }
            });
            
            // Check if terms are accepted
            const termsCheckbox = document.getElementById('terms');
            if (!termsCheckbox.checked) {
                const termsLabel = termsCheckbox.parentElement;
                termsLabel.style.color = 'var(--danger)';
                termsLabel.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    termsLabel.style.animation = '';
                }, 500);
                formIsValid = false;
            } else {
                termsCheckbox.parentElement.style.color = '';
            }
            
            if (!formIsValid) {
                return;
            }
            
            // Show loading overlay
            loadingOverlay.classList.add('active');
            
            // Simulate account creation process
            setTimeout(() => {
                // In a real application, you would create the account here
                // For demo purposes, we'll redirect to the dashboard
                window.location.href = 'dashboard.html';
            }, 3000);
        });
        
        // Input field focus effects
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = 'var(--primary)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = 'var(--gray)';
            });
        });
        
        // Social button animations
        const socialButtons = document.querySelectorAll('.social-btn');
        socialButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Add pulse animation
                this.style.animation = 'pulse 0.5s';
                setTimeout(() => {
                    this.style.animation = '';
                }, 500);
            });
        });
        
        // Initialize particles on page load
        window.addEventListener('load', function() {
            createParticles();
            
            // Add shake animation to CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
                }
                
                @keyframes textGlow {
                    from { text-shadow: 0 0 5px rgba(0, 198, 255, 0.5); }
                    to { text-shadow: 0 0 15px rgba(0, 198, 255, 0.8), 0 0 20px rgba(0, 198, 255, 0.6); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>