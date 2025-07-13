<?php
session_start();
include 'db.php'; // Connect to  "mini project" database

// Check if user is already logged in and redirect accordingly
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    // User is already logged in, redirect based on role
    if ($_SESSION['role'] == 1 || $_SESSION['role'] === '1') {
        header("Location: admin.php");
    } else {
        header("Location: Home.php");
    }
    exit();
}

$login_error = "";
$signup_error = "";
$signup_success = "";
$signup_error_field = ""; // Add this line

// Handle Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Regenerate session ID for security
                session_regenerate_id(true);
                
                $_SESSION['user_id'] = $user['user_id'] ?? null;
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['logged_in'] = true;
                $_SESSION['login_time'] = time();
                
                // Redirect admin (role=1) to admin.php
                if ($user['role'] == 1 || $user['role'] === '1') {
                    header("Location: admin.php");
                } else {
                    header("Location: Home.php");
                }
                exit();
            } else {
                $login_error = "Incorrect password. Please check and try again.";
            }
        } else {
            $login_error = "No account found with that email address.";
        }
        $stmt->close();
    } else {
        $login_error = "Sorry, there was a database error. Please try again later.";
    }
}

// Handle Signup
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['signup-email'];
    $phone = $_POST['signup-phone'];
    $password = $_POST['signup-password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Only check for duplicate email/phone and password match (for security)
    if ($password !== $confirmpassword) {
        $signup_error = "Passwords do not match.";
        $signup_error_field = "confirmpassword";
    } else {
        $stmt = $conn->prepare("SELECT email, phone FROM users WHERE email = ? OR phone = ?");
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($existing_email, $existing_phone);
            while ($stmt->fetch()) {
                if ($existing_email === $email) {
                    $signup_error = "This email is already registered. Please use a different email.";
                    $signup_error_field = "email";
                }
                if ($existing_phone === $phone) {
                    $signup_error = "This phone number is already registered. Please use a different phone number.";
                    $signup_error_field = "phone";
                }
            }
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = "user";
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phone, $hashed_password, $role);
            if ($stmt->execute()) {
                $signup_success = "Signup successful! You can now log in.";
            } else {
                $signup_error = "Signup failed. Please try again.";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DwellKart | Login & Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"/>
    <link rel="stylesheet" href="Login.css"/>
    <style>
    .input-error {
        border-color: #e74c3c !important;
        box-shadow: 0 0 2px #e74c3c;
    }
    </style>
</head>
<body class="login-bg">
<?php
// Show signup section if there was a signup error
$show_signup = !empty($signup_error);
?>
    <header class="header">
        <div class="container header-container" style="justify-content: center;">
            <div class="header-logo">
                <a href="Home.php" class="brand-title">DwellKart</a>
            </div>
        </div>
    </header>
    <main class="main-content">
        <!-- Login Section (default visible) -->
        <section class="login-section" id="login-section" style="display: <?php echo $show_signup ? 'none' : 'flex'; ?>;">
            <div class="login-container">
                <div class="login-card">
                    <h2 class="login-title">Welcome Back!</h2>
                    <?php if (!empty($login_error)): ?>
                        <div class="error-message"><?php echo $login_error; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($signup_success)): ?>
                        <div class="success-message"><?php echo $signup_success; ?></div>
                    <?php endif; ?>
                    <form class="login-form" method="POST" autocomplete="off">
                        <div class="login-form-group">
                            <label for="email" class="login-label">Email Address</label>
                            <input type="email" id="email" name="email" class="login-input" placeholder="you@email.com" required/>
                        </div>
                        <div class="login-form-group" style="position:relative;">
                            <label for="password" class="login-label">Password</label>
                            <input type="password" id="password" name="password" class="login-input" placeholder="••••••••" required/>
                            <span class="toggle-password" toggle="#password" style="position:absolute;top:50%;right:1rem;transform:translateY(-50%);cursor:pointer;">
                                <i class="ri-eye-off-line"></i>
                            </span>
                        </div>
                        <button type="submit" name="login" class="login-btn-main">Sign In</button>
                    </form>
                    <div class="login-divider"><span>or</span></div>
                    <div class="login-register-link">
                        <span>Don't have an account?</span>
                        <button id="show-signup-btn" class="login-register" type="button">Create Account</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Signup Section (hidden by default) -->
        <section class="signup-section" id="signup-section" style="display: <?php echo $show_signup ? 'flex' : 'none'; ?>;">
            <div class="signup-container">
                <div class="signup-card">
                    <h2 class="signup-title">Create Your Free Account</h2>
                    <?php if (!empty($signup_error)): ?>
                        <div class="error-message"><?php echo $signup_error; ?></div>
                    <?php endif; ?>
                    <form class="signup-form" method="POST" autocomplete="off" id="signup-form">
                        <div class="signup-form-row">
                            <div class="signup-form-group">
                                <label for="firstname" class="signup-label">First Name</label>
                                <input type="text" id="firstname" name="firstname" class="signup-input<?php if ($signup_error_field == 'firstname') echo ' input-error'; ?>" placeholder="First Name" required value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>"/>
                                <?php if ($signup_error_field == 'firstname'): ?>
                                    <div class="error-message"><?php echo $signup_error; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="signup-form-group">
                                <label for="lastname" class="signup-label">Last Name</label>
                                <input type="text" id="lastname" name="lastname" class="signup-input<?php if ($signup_error_field == 'lastname') echo ' input-error'; ?>" placeholder="Last Name" required value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>"/>
                                <?php if ($signup_error_field == 'lastname'): ?>
                                    <div class="error-message"><?php echo $signup_error; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="signup-form-group">
                            <label for="signup-phone" class="signup-label">Phone Number</label>
                            <input type="text" id="signup-phone" name="signup-phone" class="signup-input<?php if ($signup_error_field == 'phone') echo ' input-error'; ?>" placeholder="10 digit phone number" maxlength="10" required value="<?php echo isset($_POST['signup-phone']) ? htmlspecialchars($_POST['signup-phone']) : ''; ?>"/>
                            <?php if ($signup_error_field == 'phone'): ?>
                                <div class="error-message"><?php echo $signup_error; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="signup-form-group">
                            <label for="signup-email" class="signup-label">Email Address</label>
                            <input type="email" id="signup-email" name="signup-email" class="signup-input<?php if ($signup_error_field == 'email') echo ' input-error'; ?>" placeholder="you@email.com" required value="<?php echo isset($_POST['signup-email']) ? htmlspecialchars($_POST['signup-email']) : ''; ?>"/>
                            <?php if ($signup_error_field == 'email'): ?>
                                <div class="error-message"><?php echo $signup_error; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="signup-form-group" style="position:relative;">
                            <label for="signup-password" class="signup-label">Password</label>
                            <input type="password" id="signup-password" name="signup-password" class="signup-input<?php if ($signup_error_field == 'password') echo ' input-error'; ?>" placeholder="Create a password" required/>
                            <span class="toggle-password" toggle="#signup-password" style="position:absolute;top:50%;right:1rem;transform:translateY(-50%);cursor:pointer;">
                                <i class="ri-eye-off-line"></i>
                            </span>
                            <small id="passwordHelp" style="color: #555;">Password must be at least 8 chars, include uppercase, lowercase, number, and special character.</small>
                            <?php if ($signup_error_field == 'password'): ?>
                                <div class="error-message"><?php echo $signup_error; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="signup-form-group" style="position:relative;">
                            <label for="confirmpassword" class="signup-label">Confirm Password</label>
                            <input type="password" id="confirmpassword" name="confirmpassword" class="signup-input<?php if ($signup_error_field == 'confirmpassword') echo ' input-error'; ?>" placeholder="Re-enter your password" required/>
                            <span class="toggle-password" toggle="#confirmpassword" style="position:absolute;top:50%;right:1rem;transform:translateY(-50%);cursor:pointer;">
                                <i class="ri-eye-off-line"></i>
                            </span>
                            <?php if ($signup_error_field == 'confirmpassword'): ?>
                                <div class="error-message"><?php echo $signup_error; ?></div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" name="signup" class="signup-btn-main">Sign Up</button>
                    </form>
                    <div class="signup-divider"><span>or</span></div>
                    <div class="login-register-link">
                        <span>Already have an account?</span>
                        <button id="show-login-btn" class="login-register" type="button">Sign In</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
// Prevent back button to login page after successful login
window.addEventListener('load', function() {
    if (window.performance.navigation.type === 2) {
        // User came back using back button
        window.location.replace(window.location.href);
    }
});

// Clear browser history to prevent back navigation
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

document.addEventListener("DOMContentLoaded", function () {
    // Toggle between login and signup forms
    document.getElementById('show-signup-btn').onclick = function () {
        document.getElementById('login-section').style.display = 'none';
        document.getElementById('signup-section').style.display = 'flex';
        window.scrollTo(0, 0);
    };
    document.getElementById('show-login-btn').onclick = function () {
        document.getElementById('signup-section').style.display = 'none';
        document.getElementById('login-section').style.display = 'flex';
        window.scrollTo(0, 0);
    };

    // Live validation for First Name and Last Name (only letters)
    function validateName(input) {
        const pattern = /^[A-Za-z]+$/;
        if (!pattern.test(input.value)) {
            input.setCustomValidity('Name must contain only alphabets (A-Z, a-z).');
            input.reportValidity();
            input.classList.add('input-error');
        } else {
            input.setCustomValidity('');
            input.classList.remove('input-error');
        }
    }
    document.getElementById('firstname').addEventListener('input', function() {
        validateName(this);
    });
    document.getElementById('lastname').addEventListener('input', function() {
        validateName(this);
    });

    // Live validation for Phone Number
    document.getElementById('signup-phone').addEventListener('input', function() {
        const pattern = /^[6-9][0-9]{0,9}$/;
        if (!pattern.test(this.value) || this.value.length > 10) {
            this.setCustomValidity('Phone number must start with 6,7,8,9 and be up to 10 digits.');
            this.reportValidity();
            this.classList.add('input-error');
        } else if (this.value.length === 10) {
            this.setCustomValidity('');
            this.classList.remove('input-error');
        } else {
            this.setCustomValidity('');
            this.classList.remove('input-error');
        }
    });

    // Live validation for Password
    document.getElementById('signup-password').addEventListener('input', function() {
        const pwdPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/;
        if (!pwdPattern.test(this.value)) {
            this.setCustomValidity('Password must be at least 8 characters with uppercase, lowercase, number, and special character.');
            this.reportValidity();
            this.classList.add('input-error');
        } else {
            this.setCustomValidity('');
            this.classList.remove('input-error');
        }
    });

    // Live validation for Confirm Password
    document.getElementById('confirmpassword').addEventListener('input', function() {
        const pwd = document.getElementById('signup-password').value;
        if (this.value !== pwd) {
            this.setCustomValidity('Passwords do not match.');
            this.reportValidity();
            this.classList.add('input-error');
        } else {
            this.setCustomValidity('');
            this.classList.remove('input-error');
        }
    });

    // Signup form validation on submit
    document.getElementById('signup-form').onsubmit = function(e) {
    let valid = true;

    // Name validation
    const fname = document.getElementById('firstname');
    const lname = document.getElementById('lastname');
    const phone = document.getElementById('signup-phone');
    const email = document.getElementById('signup-email');
    const pwd = document.getElementById('signup-password');
    const cpwd = document.getElementById('confirmpassword');

    const namePattern = /^[A-Za-z]+$/;
    const phonePattern = /^[6-9][0-9]{9}$/;
    const pwdPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Reset custom validity
    [fname, lname, phone, email, pwd, cpwd].forEach(input => {
        input.setCustomValidity('');
        input.classList.remove('input-error');
    });

    if (!namePattern.test(fname.value)) {
        fname.setCustomValidity('First name must contain only alphabets.');
        fname.classList.add('input-error');
        fname.reportValidity();
        fname.focus();
        valid = false;
    } else if (!namePattern.test(lname.value)) {
        lname.setCustomValidity('Last name must contain only alphabets.');
        lname.classList.add('input-error');
        lname.reportValidity();
        lname.focus();
        valid = false;
    } else if (!phonePattern.test(phone.value)) {
        phone.setCustomValidity('Phone number must start with 6,7,8,9 and be exactly 10 digits.');
        phone.classList.add('input-error');
        phone.reportValidity();
        phone.focus();
        valid = false;
    } else if (!emailPattern.test(email.value)) {
        email.setCustomValidity('Please enter a valid email address.');
        email.classList.add('input-error');
        email.reportValidity();
        email.focus();
        valid = false;
    } else if (!pwdPattern.test(pwd.value)) {
        pwd.setCustomValidity('Password must be at least 8 characters and include uppercase, lowercase, number, and special character.');
        pwd.classList.add('input-error');
        pwd.reportValidity();
        pwd.focus();
        valid = false;
    } else if (pwd.value !== cpwd.value) {
        cpwd.setCustomValidity('Password and Confirm Password do not match.');
        cpwd.classList.add('input-error');
        cpwd.reportValidity();
        cpwd.focus();
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
        return false;
    }
    return true;
};
    });


document.querySelectorAll('.toggle-password').forEach(function(toggle) {
    toggle.addEventListener('click', function() {
        const input = document.querySelector(this.getAttribute('toggle'));
        const icon = this.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('ri-eye-off-line');
            icon.classList.add('ri-eye-line');
        } else {
            input.type = "password";
            icon.classList.remove('ri-eye-line');
            icon.classList.add('ri-eye-off-line');
        }
    });
});
</script>
</body>
</html>