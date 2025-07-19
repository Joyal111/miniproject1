<?php
session_start();

include 'db.php';

$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DwellKart - Property & Accommodation Management System</title>
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
          <a href="aboutus.php" class="nav-link">About Us</a>
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
        <a href="aboutus.php" class="mobile-nav-link">About Us</a>
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
      <!-- Hero Section -->
      <section class="hero-section">
        <div class="container hero-content">
          <h1 class="hero-title">Find Your Dream Property or Stay</h1>
          <p class="hero-subtitle">Buy, Rent, or Book Homestays All in One Place</p>
          <div class="hero-btns">
            <?php if ($isLoggedIn): ?>
              <a href="listings.php" class="btn btn-primary">Explore Listings</a>
              <a href="postproperty.php" class="btn btn-secondary">Post Your Property</a>
            <?php else: ?>
              <a href="#" class="btn btn-primary" onclick="showLoginPrompt()">Explore Listings</a>
              <a href="#" class="btn btn-secondary" onclick="showLoginPrompt()">Post Your Property</a>
            <?php endif; ?>
          </div>
        </div>
      </section>
   
      <!-- Categories Section -->
      <section class="categories-section">
        <div class="container">
          <h2 class="categories-title">Browse by Category</h2>
          <p class="categories-desc">
            Discover properties and accommodations that match your specific needs
          </p>
          <div class="categories-grid">
            <!-- Category Cards -->
            <div class="category-card fade-in-up delay-1">
              <div class="category-img-wrap">
                <img src="sell.jpg" alt="Sell Houses" class="category-img" />
              </div>
              <div class="category-info">
                <h3 class="category-title">Sell - Houses & Apartments</h3>
                <p class="category-desc">Find your dream home to purchase with full ownership</p>
                <?php if ($isLoggedIn): ?>
                  <a href="listings.php?category=sell-houses" class="category-link">
                    Explore <i class="ri-arrow-right-line align-middle ml-1"></i>
                  </a>
                <?php else: ?>
                  <a href="#" class="category-link" onclick="showLoginPrompt()">
                    Explore <i class="ri-arrow-right-line align-middle ml-1"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <div class="category-card fade-in-up delay-2">
              <div class="category-img-wrap">
                <img src="land.jpg" class="category-img" alt="Sell Land & Plots" />
              </div>
              <div class="category-info">
                <h3 class="category-title">Sell - Land & Plots</h3>
                <p class="category-desc">Invest in land and plots for future development</p>
                <?php if ($isLoggedIn): ?>
                  <a href="listings.php?category=sell-land" class="category-link">
                    Explore <i class="ri-arrow-right-line align-middle ml-1"></i>
                  </a>
                <?php else: ?>
                  <a href="#" class="category-link" onclick="showLoginPrompt()">
                    Explore <i class="ri-arrow-right-line align-middle ml-1"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <div class="category-card fade-in-up delay-3">
              <div class="category-img-wrap">
                <img src="rent.jpg" class="category-img" alt="Rent - Houses & Apartments" />
              </div>
              <div class="category-info">
                <h3 class="category-title">Rent - Houses & Apartments</h3>
                <p class="category-desc">Find rental properties for long-term accommodation</p>
                <?php if ($isLoggedIn): ?>
                  <a href="listings.php?category=rent-houses" class="category-link">
                    Explore <i class="ri-arrow-right-line align-middle ml-1"></i>
                  </a>
                <?php else: ?>
                  <a href="#" class="category-link" onclick="showLoginPrompt()">
                    Explore <i class="ri-arrow-right-line align-middle ml-1"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <div class="category-card fade-in-up delay-4">
              <div class="category-img-wrap">
                <img src="homestay.jpg" class="category-img" alt="Homestays" />
              </div>
              <div class="category-info">
                <h3 class="category-title">Homestays</h3>
                <p class="category-desc">Book unique homestays for short-term accommodation</p>
                <?php if ($isLoggedIn): ?>
                  <a href="listings.php?category=homestays" class="category-link">
                    Explore <i class="ri-arrow-right-line align-middle ml-1"></i>
                  </a>
                <?php else: ?>
                  <a href="#" class="category-link" onclick="showLoginPrompt()">
                    Explore <i class="ri-arrow-right-line align-middle ml-1"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- How it Works Section -->
      <section class="hiw-section">
        <div class="container">
          <h2 class="hiw-title">How DwellKart Works</h2>
          <p class="hiw-desc">
            Simple steps to find or list your property
          </p>
          <div class="hiw-grid">
            <!-- Steps -->
            <div class="hiw-card fade-in-up delay-1">
              <div class="hiw-icon">
                <i class="ri-user-add-line ri-lg"></i>
              </div>
              <h3 class="hiw-step-title">Register/Login</h3>
              <p class="hiw-step-desc">Create your account or login to access all features of DwellKart</p>
              <div class="hiw-arrow"></div>
            </div>
            <div class="hiw-card fade-in-up delay-2">
              <div class="hiw-icon">
                <i class="ri-search-line ri-lg"></i>
              </div>
              <h3 class="hiw-step-title">Post or Explore</h3>
              <p class="hiw-step-desc">List your property or search for properties that match your requirements</p>
              <div class="hiw-arrow"></div>
            </div>
            <div class="hiw-card fade-in-up delay-3">
              <div class="hiw-icon">
                <i class="ri-chat-1-line ri-lg"></i>
              </div>
              <h3 class="hiw-step-title">Contact/Book</h3>
              <p class="hiw-step-desc">Connect with property owners or book accommodations directly</p>
              <div class="hiw-arrow"></div>
            </div>
            <div class="hiw-card fade-in-up delay-4">
              <div class="hiw-icon">
                <i class="ri-star-line ri-lg"></i>
              </div>
              <h3 class="hiw-step-title">Review/Report</h3>
              <p class="hiw-step-desc">Share your experience and help others make informed decisions</p>
            </div>
          </div>
        </div>
      </section>
      
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
                <?php else: ?>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">House & Apartments(sell)</a></li>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">House & Apartments(rent)</a></li>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">Land and plots</a></li>
                  <li><a href="#" class="footer-link" onclick="showLoginPrompt()">Homestays</a></li>
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
      const desktopNav = document.getElementById("desktop-nav");
      
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