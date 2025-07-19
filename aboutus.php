<?php
session_start();

include 'db.php';

$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>About Us - DwellKart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Google Fonts and Remixicon -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
    <link rel="stylesheet" href="home.css" />
  </head>
  <body class="ab">
    <!-- Navigation Bar -->
    <header class="header">
      <div class="container header-container">
        <div class="header-logo">
          <a href="home.php" class="brand-title">
            DwellKart
          </a>
        </div>
        <nav class="desktop-nav" id="desktop-nav">
          <a href="home.php" class="nav-link">Home</a>
          <?php if ($isLoggedIn): ?>
            <a href="listings.php" class="nav-link">Listings</a>
            <a href="postproperty.php" class="nav-link">Post Property</a>
            <a href="featured.php" class="nav-link">Featured Ads</a>
          <?php else: ?>
            <a href="#" class="nav-link" onclick="showLoginPrompt()">Listings</a>
            <a href="#" class="nav-link" onclick="showLoginPrompt()">Post Property</a>
            <a href="#" class="nav-link" onclick="showLoginPrompt()">Featured Ads</a>
          <?php endif; ?>
          <a href="aboutus.php" class="nav-link active">About Us</a>
          <?php if ($isLoggedIn): ?>
            <a href="useraccount.php" class="account-btn" title="Account"><i class="ri-user-3-line"></i></a>
          <?php else: ?>
            <a href="login.php" class="login-attractive-btn" title="Login">Login</a>
          <?php endif; ?>
        </nav>
        <button id="mobile-menu-button" class="mobile-menu-btn" aria-label="Open menu">
          <i class="ri-menu-line ri-2x"></i>
        </button>
      </div>
      <div id="mobile-menu" class="mobile-menu">
        <a href="home.php" class="mobile-nav-link">Home</a>
        <?php if ($isLoggedIn): ?>
          <a href="listings.php" class="mobile-nav-link">Listings</a>
          <a href="postproperty.php" class="mobile-nav-link">Post Property</a>
          <a href="featured.php" class="mobile-nav-link">Featured Ads</a>
        <?php else: ?>
          <a href="#" class="mobile-nav-link" onclick="showLoginPrompt()">Listings</a>
          <a href="#" class="mobile-nav-link" onclick="showLoginPrompt()">Post Property</a>
          <a href="#" class="mobile-nav-link" onclick="showLoginPrompt()">Featured Ads</a>
        <?php endif; ?>
        <a href="aboutus.php" class="mobile-nav-link active">About Us</a>
        <?php if ($isLoggedIn): ?>
          <a href="useraccount.php" class="account-btn" title="Account"><i class="ri-user-3-line"></i></a>
        <?php else: ?>
          <a href="login.php" class="login-attractive-btn" title="Login">Login</a>
        <?php endif; ?>
      </div>
    </header>
    
    <!-- Login Prompt Modal -->
    <div id="loginModal" class="modal" style="display: none;">
      <div class="modal-content">
        <span class="close" onclick="closeLoginPrompt()">&times;</span>
        <h2>Login Required</h2>
        <p>Please login to access this feature and explore all the amazing properties and accommodations we have to offer.</p>
        <div class="modal-buttons">
          <a href="login.php" class="btn btn-primary">Login Now</a>
          <button onclick="closeLoginPrompt()" class="btn btn-secondary">Cancel</button>
        </div>
      </div>
    </div>
    
    <main class="main-content">
      <!-- About Us Content Starts Here -->
      <section class="categories-section" style="background: #EFEBE7;">
        <div class="container">
          <h2 class="categories-title" style="margin-bottom: 0.5rem;">About DwellKart</h2>
          <p class="categories-desc" style="margin-bottom: 2rem;">
            DwellKart is your one-stop solution for all property and accommodation needs. Our mission is to make property transactions seamless, transparent, and accessible for everyone — whether you are looking to buy, sell, rent, or book a stay.
          </p>
          <div class="categories-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="category-card" style="min-height:340px;">
              <div class="category-info">
                <h3 class="category-title">Who We Are</h3>
                <p class="category-desc">
                  DwellKart is an innovative digital platform empowering users to buy, sell, and rent properties, as well as book homestays and PGs, all in one place. Founded with a vision to modernize the real estate and accommodation experience, we prioritize security, convenience, and transparency in every transaction. Our team is driven by the goal of making property dealings easier for all – from first-time tenants to experienced investors.
                </p>
                <h3 class="category-title" style="margin-top:1.5rem;">What We Offer</h3>
                <ul style="color:#7B7267; padding-left:1.1em; font-size: 0.95rem;">
                  <li>Comprehensive listings: Buy, sell, rent, or book houses, apartments, land, homestays, and PGs.</li>
                  <li>Advanced search and filters for precise results.</li>
                  <li>Easy property posting and verification for owners and agents.</li>
                  <li>Secure messaging and direct booking options.</li>
                  <li>Personalized dashboard for managing your listings and favorites.</li>
                </ul>
              </div>
            </div>
            <div class="category-card" style="min-height:340px;">
              <div class="category-info">
                <h3 class="category-title">Why Choose DwellKart?</h3>
                <ul style="color:#7B7267; padding-left:1.1em; font-size: 0.95rem; margin-bottom:1.5rem;">
                  <li>Wide selection of verified, up-to-date listings across India.</li>
                  <li>Intuitive, mobile-friendly platform for users on the go.</li>
                  <li>Strict privacy and security for all transactions and communications.</li>
                  <li>Dedicated support team ready to assist you at every step.</li>
                  <li>Commitment to transparency: clear information, no hidden fees.</li>
                </ul>
                <h3 class="category-title" style="margin-top:1.5rem;">Our Commitment</h3>
                <p class="category-desc">
                  We are committed to creating an ecosystem where buyers, sellers, landlords, tenants, and travelers can connect efficiently and safely. Our platform is continuously updated with new features based on user feedback, ensuring you always have the best tools at your fingertips.
                </p>
                <h3 class="category-title" style="margin-top:1.5rem;">Contact Us</h3>
                <ul style="color:#7B7267; padding-left:1.1em; font-size: 0.95rem;">
                  <li><i class="ri-map-pin-line"></i> 123 Business Park, Andheri East, Mumbai 400093</li>
                  <li><i class="ri-phone-line"></i> +91 9876543210</li>
                  <li><i class="ri-mail-line"></i> support@dwellkart.com</li>
                </ul>
              </div>
            </div>
          </div>
          <div style="margin-top: 3rem;">
            <h2 class="categories-title">Our Vision & Values</h2>
            <div class="category-card" style="margin: 0 auto; max-width:900px;">
              <div class="category-info">
                <ul style="color:#7B7267; font-size: 1rem; list-style:disc inside;">
                  <li>
                    <strong>Empowerment:</strong> We aim to empower property seekers and owners with the right information, tools, and resources to make informed decisions.
                  </li>
                  <li>
                    <strong>Transparency:</strong> No hidden processes or fees—everything is clear, honest, and upfront.
                  </li>
                  <li>
                    <strong>Innovation:</strong> We leverage the latest technology to simplify search, posting, and booking.
                  </li>
                  <li>
                    <strong>Trust & Security:</strong> Verified listings, secure payments, and privacy-first design ensure peace of mind.
                  </li>
                  <li>
                    <strong>Customer Focus:</strong> Your feedback drives our platform. We are always listening and improving.
                  </li>
                </ul>
                <p style="color:#7B7267; font-size: 1rem; margin-top:1.5rem;">
                  Whether you're searching for your first home, a lucrative investment, a comfortable rental, or a unique stay experience, DwellKart is here to make your journey smooth and successful. Join thousands of happy users who trust DwellKart for their property and accommodation needs.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- About Us Content Ends Here -->
      
      <!-- Footer -->
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
                <?php if ($isLoggedIn): ?>
                  <li><a href="listings.php" class="footer-link">Listings</a></li>
                <?php else: ?>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">Listings</a></li>
                <?php endif; ?>
              </ul>
            </div>
            <div>
              <h4 class="footer-subtitle">Property Types</h4>
              <ul class="footer-list">
                <?php if ($isLoggedIn): ?>
                  <li><a href="listings.php?category=sell-houses" class="footer-link">House & Apartments(sell)</a></li>
                  <li><a href="listings.php?category=rent-houses" class="footer-link">House & Apartments(rent)</a></li>
                  <li><a href="listings.php?category=sell-land" class="footer-link">Land and plots</a></li>
                  <li><a href="listings.php?category=homestays" class="footer-link">Homestays</a></li>
                  <li><a href="listings.php?category=pg" class="footer-link">PG (Paying Guest)</a></li>
                <?php else: ?>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">House & Apartments(sell)</a></li>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">House & Apartments(rent)</a></li>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">Land and plots</a></li>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">Homestays</a></li>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">PG (Paying Guest)</a></li>
                <?php endif; ?>
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
    </main>
    
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
      
      // Login prompt functions
      function showLoginPrompt() {
        document.getElementById('loginModal').style.display = 'block';
      }
      
      function closeLoginPrompt() {
        document.getElementById('loginModal').style.display = 'none';
      }
      
      // Close modal when clicking outside of it
      window.onclick = function(event) {
        const modal = document.getElementById('loginModal');
        if (event.target == modal) {
          modal.style.display = 'none';
        }
      }
    </script>
  </body>
</html>