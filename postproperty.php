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
    <link rel="stylesheet" href="postproperty.css" />
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
          <a href="#" class="nav-link">Listings</a>
          <a href="postproperty.php" class="nav-link">Post Property</a>
          <a href="#" class="nav-link">Featured Ads</a>
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
        <a href="#" class="mobile-nav-link">Listings</a>
        <a href="postproperty.php" class="mobile-nav-link">Post Property</a>
        <a href="#" class="mobile-nav-link">Featured Ads</a>
        <a href="aboutus.php" class="mobile-nav-link">About Us</a>
        <?php if ($isLoggedIn): ?>
          <a href="useraccount.php" class="account-btn" title="Account"><i class="ri-user-3-line"></i></a>
        <?php else: ?>
          <a href="login.php" class="login-attractive-btn" title="Login">Login</a>
        <?php endif; ?>
      </div>
    </header>
    <main class="main-content">
<br>
<br>

<div class="container">
  <div class="cards-grid">
    <!-- Card 1: Sell Houses & Apartments -->
    <div class="card card-1">
      <div class="card-header">
        <div class="card-icon">🏠</div>
        <h2 class="card-title">Sell Your House</h2>
        <p class="card-subtitle">Apartments • Villas • Flats</p>
      </div>
      <div class="card-body">
        <p class="card-description">
          Ready to sell your house or apartment? We help you reach genuine buyers fast with expert assistance at every step — from listing to closing the deal.
        </p>
        <ul class="features-list">
          <li>Free property listing</li>
          <li>Professional valuation support</li>
          <li>Verified buyer connections</li>
          <li>Legal paperwork assistance</li>
          <li>Secure and transparent process</li>
        </ul>
        <button class="card-button" onclick="handleClick('sell-house')">
          Start Selling
        </button>
      </div>
    </div>

    <!-- Card 2: Sell Land & Plots -->
    <div class="card card-2">
      <div class="card-header">
        <div class="card-icon">🏞️</div>
        <h2 class="card-title">Sell Your Land</h2>
        <p class="card-subtitle">Plots • Farmland • Commercial</p>
      </div>
      <div class="card-body">
        <p class="card-description">
          Planning to sell land or a plot? We make land selling smooth by ensuring proper documentation, verified buyers, and guidance throughout the transaction.
        </p>
        <ul class="features-list">
          <li>Instant land listing</li>
          <li>Document validation help</li>
          <li>Active buyer network</li>
          <li>Land visibility boost</li>
          <li>Dedicated support team</li>
        </ul>
        <button class="card-button" onclick="handleClick('sell-land')">
          Sell Your Land
        </button>
      </div>
    </div>

    <!-- Card 3: List Your Homestay -->
    <div class="card card-3">
      <div class="card-header">
        <div class="card-icon">🏡</div>
        <h2 class="card-title">List Your Homestay</h2>
        <p class="card-subtitle">Earn • Host • Connect</p>
      </div>
      <div class="card-body">
        <p class="card-description">
          Turn your extra space into income by listing it as a homestay. Get discovered by travelers looking for authentic, local experiences and comfort.
        </p>
        <ul class="features-list">
          <li>Easy homestay listing</li>
          <li>Secure guest bookings</li>
          <li>Custom pricing options</li>
          <li>24/7 hosting support</li>
          <li>Instant payout facility</li>
        </ul>
        <button class="card-button" onclick="handleClick('list-homestay')">
          List Now
        </button>
      </div>
    </div>
  </div>
</div>
  <script>

        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(50px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
</body>
</html>








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
    </script>
  </body>
</html>