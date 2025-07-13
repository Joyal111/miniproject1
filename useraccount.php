<?php
session_start();
include 'db.php';

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$firstname = $_SESSION['firstname'] ?? '';
$lastname = $_SESSION['lastname'] ?? '';
$email = $_SESSION['email'] ?? '';

// Handle update
if (isset($_POST['update_profile'])) {
    $new_firstname = $_POST['firstname'];
    $new_lastname = $_POST['lastname'];
    $new_email = $_POST['email'];
    $new_phone = $_POST['phone'];

    $stmt = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=?, phone=? WHERE user_id=?");
    $stmt->bind_param("ssssi", $new_firstname, $new_lastname, $new_email, $new_phone, $user_id);
    $stmt->execute();
    $stmt->close();

    // Update session values
    $_SESSION['firstname'] = $new_firstname;
    $_SESSION['lastname'] = $new_lastname;
    $_SESSION['email'] = $new_email;

    // Optional: reload to reflect changes
    header("Location: useraccount.php?updated=1");
    exit();
}

// Handle delete
if (isset($_POST['delete_account'])) {
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    session_destroy();
    header("Location: home.php");
    exit();
}

// Fetch phone and joined_at from DB
$phone = '';
$joined_at = '';
$stmt = $conn->prepare("SELECT phone, created_at FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($phone, $joined_at);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DwellKart - My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"/>
    <link rel="stylesheet" href="useraccount.css"/>
   
</head>
<body class="ab">
<!-- --- Header (identical to Home.php) --- -->
<header class="header">
    <div class="container header-container">
        <div class="header-logo">
            <a href="home.php" class="brand-title">DwellKart</a>
        </div>
        <nav class="desktop-nav" id="desktop-nav">
            <a href="home.php" class="nav-link">Home</a>
            <a href="#" class="nav-link">Listings</a>
            <a href="postproperty.php" class="nav-link">Post Property</a>
            <a href="#" class="nav-link">Featured Ads</a>
            <a href="aboutus.php" class="nav-link">About Us</a>
            <a href="useraccount.php" class="account-btn" title="Account"><i class="ri-user-3-line"></i></a>
            <!-- Desktop Nav Logout Button -->
<form action="logout.php" method="post" style="display:inline;">
    <button type="submit" class="account-btn" title="Logout" style="background:#ba2323;color:#fff;margin-left:0.7rem;">
        <i class="ri-logout-box-r-line"></i>
    </button>
</form>
        </nav>
        <button id="mobile-menu-button" class="mobile-menu-btn" aria-label="Open menu">
            <i class="ri-menu-line ri-2x"></i>
        </button>
    </div>
    <div id="mobile-menu" class="mobile-menu">
        <a href="home.php" class="mobile-nav-link">Home</a>
        <a href="#" class="mobile-nav-link">Listings</a>
        <a href="postproperty.php" class="mobile-nav-link">Post Property</a>
        <a href="#" class="mobile-nav-link">Featured Ads</a>
        <a href="aboutus.php" class="mobile-nav-link">About Us</a>
        <a href="useraccount.php" class="account-btn" title="Account"><i class="ri-user-3-line"></i></a>
        <!-- Mobile Nav Logout Button --><?php echo htmlspecialchars($_SESSION['email']); ?>
<form action="logout.php" method="post" style="display:block; margin: 0.7rem 0 0 0;">
    <button type="submit" class="account-btn" title="Logout" style="background:#ba2323;color:#fff;width:100%;border:none;padding:0.6rem 0;border-radius:0.7rem;font-size:1rem;display:flex;align-items:center;justify-content:center;gap:0.5rem;">
        <i class="ri-logout-box-r-line"></i> Logout
    </button>
</form>
    </div>
</header>

<main class="main-content useraccount-main">
    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 1 || $_SESSION['role'] === '1')): ?>
    <a href="admin.php" class="admin-dashboard-link" >Go to Admin Dashboard</a>
<?php endif; ?>
    <div class="container useraccount-container">
        <h1 class="ua-title">My Account</h1>
        <div class="ua-card-grid">
            <!-- User Info Card -->
             
            <div class="ua-card ua-card-info">
                <div class="ua-card-header">
                    <i class="ri-user-3-line ua-card-icon"></i>
                    <span>User Info</span>
                </div>
                <div class="ua-card-body">
                    <div class="ua-info-item"><span class="ua-info-label">Name:</span><span class="ua-info-value"><?= htmlspecialchars($firstname . " " . $lastname) ?></span></div>
                    <div class="ua-info-item"><span class="ua-info-label">Phone:</span><span class="ua-info-value"><?= htmlspecialchars($phone) ?></span></div>
                    <div class="ua-info-item"><span class="ua-info-label">Email:</span><span class="ua-info-value"><?= htmlspecialchars($email) ?></span></div>
                    <div class="ua-info-item"><span class="ua-info-label">Joined At:</span><span class="ua-info-value"><?= $joined_at ? date('F j, Y', strtotime($joined_at)) : "" ?></span></div>
                    <div style="display: flex; gap: 0.7rem; margin-top: 1rem;">
                        <!-- Edit Button triggers modal -->
                        <button type="button" class="account-btn" title="Edit Profile" style="background:#7B5E57;color:#fff;border:none;width:auto;height:auto;padding:0.5rem 1.2rem;font-size:1rem;border-radius:0.7rem;display:inline-flex;align-items:center;gap:0.4rem;" onclick="document.getElementById('editModal').style.display='block'">
                            <i class="ri-edit-line"></i> Edit
                        </button>
                        <!-- Delete Button submits form -->
                        <form method="post" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');" style="display:inline;">
                            <button type="submit" name="delete_account" class="account-btn" title="Delete Account" style="background:#ba2323;color:#fff;border:none;width:auto;height:auto;padding:0.5rem 1.2rem;font-size:1rem;border-radius:0.7rem;display:inline-flex;align-items:center;gap:0.4rem;">
                                <i class="ri-delete-bin-6-line"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- My Listings Card (STATIC) -->
            <div class="ua-card ua-card-listings">
                <div class="ua-card-header">
                    <i class="ri-home-8-line ua-card-icon"></i>
                    <span>My Listings</span>
                </div>
                <div class="ua-card-body">
                    <ul class="ua-listings-list">
                        <li class="ua-listing-item">
                            <div class="ua-listing-title">Sea View Apartment, Mumbai</div>
                            <span class="ua-listing-type">Rent</span>
                            <span class="ua-listing-status active">Active</span>
                            <span class="ua-listing-date">May 10, 2025</span>
                        </li>
                        <li class="ua-listing-item">
                            <div class="ua-listing-title">Luxury Homestay, Lonavala</div>
                            <span class="ua-listing-type">Homestay</span>
                            <span class="ua-listing-status inactive">Inactive</span>
                            <span class="ua-listing-date">Apr 2, 2025</span>
                        </li>
                        <li class="ua-listing-item">
                            <div class="ua-listing-title">Plot Near Pune</div>
                            <span class="ua-listing-type">Sell</span>
                            <span class="ua-listing-status active">Active</span>
                            <span class="ua-listing-date">Jan 15, 2025</span>
                        </li>
                    </ul>
                    <a href="#" class="ua-view-more">View All Listings <i class="ri-arrow-right-line"></i></a>
                </div>
            </div>
            <!-- Booking History Card (STATIC) -->
            <div class="ua-card ua-card-bookings">
                <div class="ua-card-header">
                    <i class="ri-calendar-check-line ua-card-icon"></i>
                    <span>My Booking History</span>
                </div>
                <div class="ua-card-body">
                    <ul class="ua-bookings-list">
                        <li class="ua-booking-item">
                            <div class="ua-booking-title">Hilltop Villa, Ooty</div>
                            <span class="ua-booking-dates">Jul 15 - Jul 18, 2025</span>
                            <span class="ua-booking-status confirmed">Confirmed</span>
                        </li>
                        <li class="ua-booking-item">
                            <div class="ua-booking-title">Beachside Homestay, Goa</div>
                            <span class="ua-booking-dates">May 04 - May 07, 2025</span>
                            <span class="ua-booking-status cancelled">Cancelled</span>
                        </li>
                        <li class="ua-booking-item">
                            <div class="ua-booking-title">Cottage, Munnar</div>
                            <span class="ua-booking-dates">Jan 12 - Jan 15, 2025</span>
                            <span class="ua-booking-status pending">Pending</span>
                        </li>
                    </ul>
                    <a href="#" class="ua-view-more">View All Bookings <i class="ri-arrow-right-line"></i></a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- --- Footer (identical to Home.php) --- -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h3 class="footer-title">DwellKart</h3>
                <p class="footer-desc">Your one-stop solution for all property and accommodation needs.</p>
                <div class="footer-socials">
                    <a href="#" class="footer-social"><i class="ri-facebook-fill ri-lg"></i></a>
                    <a href="#" class="footer-social"><i class="ri-twitter-fill ri-lg"></i></a>
                    <a href="#" class="footer-social"><i class="ri-instagram-fill ri-lg"></i></a>
                    <a href="#" class="footer-social"><i class="ri-linkedin-fill ri-lg"></i></a>
                </div>
            </div>
            <div>
                <h4 class="footer-subtitle">Quick Links</h4>
                <ul class="footer-list">
                    <li><a href="home.php" class="footer-link">Home</a></li>
                    <li><a href="aboutus.php" class="footer-link">About Us</a></li>
                    <li><a href="#" class="footer-link">Contact</a></li>
                    <li><a href="#" class="footer-link">Listings</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-subtitle">Property Types</h4>
                <ul class="footer-list">
                    <li><a href="#" class="footer-link">House & Apartments(sell)</a></li>
                    <li><a href="#" class="footer-link">House & Apartments(rent)</a></li>
                    <li><a href="#" class="footer-link">Land and plots</a></li>
                    <li><a href="#" class="footer-link">Homestays</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-subtitle">Contact Us</h4>
                <ul class="footer-list">
                    <li class="footer-contact"><i class="ri-map-pin-line"></i><span>123 Business Park, Andheri East, Mumbai 400093</span></li>
                    <li class="footer-contact"><i class="ri-phone-line"></i><span>+91 9876543210</span></li>
                    <li class="footer-contact"><i class="ri-mail-line"></i><span>support@dwellkart.com</span></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">© 2025 DwellKart. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="#" class="footer-bottom-link">Privacy Policy</a>
                <a href="#" class="footer-bottom-link">Terms of Service</a>
                <a href="#" class="footer-bottom-link">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
<!-- Edit Profile Modal -->
<div id="editModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.35);align-items:center;justify-content:center;">
    <div style="background:#fff;padding:2rem 2.5rem;border-radius:1rem;max-width:400px;margin:5vh auto;position:relative;">
        <button onclick="document.getElementById('editModal').style.display='none'" style="position:absolute;top:1rem;right:1rem;background:none;border:none;font-size:1.5rem;color:#7B5E57;cursor:pointer;"><i class="ri-close-line"></i></button>
        <h2 style="margin-bottom:1.2rem;color:#7B5E57;">Edit Profile</h2>
        <form method="post" autocomplete="off">
            <div style="margin-bottom:1rem;">
                <label>First Name</label>
                <input type="text" name="firstname" value="<?= htmlspecialchars($firstname) ?>" required style="width:100%;padding:0.5rem;margin-top:0.2rem;">
            </div>
            <div style="margin-bottom:1rem;">
                <label>Last Name</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($lastname) ?>" required style="width:100%;padding:0.5rem;margin-top:0.2rem;">
            </div>
            <div style="margin-bottom:1rem;">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required style="width:100%;padding:0.5rem;margin-top:0.2rem;">
            </div>
            <div style="margin-bottom:1rem;">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>" required style="width:100%;padding:0.5rem;margin-top:0.2rem;">
            </div>
            <button type="submit" name="update_profile" style="background:#7B5E57;color:#fff;padding:0.5rem 1.5rem;border:none;border-radius:0.7rem;font-size:1rem;">Save</button>
        </form>
    </div>
</div>
<script>
    // Close modal on outside click
    window.onclick = function(event) {
        var modal = document.getElementById('editModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<!-- Mobile Menu Toggle Script -->
<script>
    const menuBtn = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");
    menuBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        mobileMenu.classList.toggle("active");
    });
    document.addEventListener("click", function (e) {
        if (
            mobileMenu.classList.contains("active") &&
            !mobileMenu.contains(e.target) &&
            e.target !== menuBtn
        ) {
            mobileMenu.classList.remove("active");
        }
    });
    mobileMenu.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function () {
            mobileMenu.classList.remove("active");
        });
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Edit Profile Modal validation
    var editForm = document.querySelector('#editModal form');
    if(editForm) {
        editForm.onsubmit = function(e) {
            var fname = editForm.querySelector('input[name="firstname"]');
            var lname = editForm.querySelector('input[name="lastname"]');
            var email = editForm.querySelector('input[name="email"]');
            var phone = editForm.querySelector('input[name="phone"]');

            var namePattern = /^[A-Za-z]+$/;
            var phonePattern = /^[6-9][0-9]{9}$/;
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // First Name
            if (!namePattern.test(fname.value)) {
                alert('First name must contain only alphabets.');
                fname.focus();
                e.preventDefault();
                return false;
            }
            // Last Name
            if (!namePattern.test(lname.value)) {
                alert('Last name must contain only alphabets.');
                lname.focus();
                e.preventDefault();
                return false;
            }
            // Email
            if (!emailPattern.test(email.value)) {
                alert('Please enter a valid email address.');
                email.focus();
                e.preventDefault();
                return false;
            }
            // Phone
            if (!phonePattern.test(phone.value)) {
                alert('Phone number must start with 6,7,8,9 and be exactly 10 digits.');
                phone.focus();
                e.preventDefault();
                return false;
            }
            return true;
        };
    }
});
</script>
</body>
</html>