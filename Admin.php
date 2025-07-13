<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DwellKart Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Google Fonts and Remixicon -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
     <link rel="stylesheet" href="admin.css" />
   
  </head>
  <body>
    <header class="header">
      <div class="container header-container">
        <div class="header-logo">
          <a href="Home.html" class="brand-title">
            DwellKart Admin
          </a>
        </div>
        <nav class="desktop-nav" id="desktop-nav">
          <a href="admin.html" class="nav-link active">Dashboard</a>
          <a href="Home.php" class="nav-link">Main Site</a>
          <a href="logout.php" class="login-btn">Logout</a>
        </nav>
        <button id="mobile-menu-button" class="mobile-menu-btn" aria-label="Open menu">
          <i class="ri-menu-line ri-2x"></i>
        </button>
      </div>
      <div id="mobile-menu" class="mobile-menu">
        <a href="admin.html" class="mobile-nav-link">Dashboard</a>
        <a href="Home.php" class="mobile-nav-link">Main Site</a>
        <a href="logout.php" class="mobile-login-btn">Logout</a>
      </div>
    </header>

    <main class="main-content">
      <div class="container">
        <h1 class="admin-title">Admin Dashboard</h1>
        
        <div class="admin-grid">
          <!-- 1. Users List Card -->
          <div class="admin-card">
            <div class="admin-card-header">
              <i class="ri-group-line admin-icon"></i>
              <h2>Users List</h2>
            </div>
            <div class="admin-card-content">
              <ul>
                <li>
                  <i class="ri-user-3-line"></i>
                  <span>Joyal111</span>
                  <span class="user-role admin">Admin</span>
                </li>
                <li>
                  <i class="ri-user-3-line"></i>
                  <span>Priya Gupta</span>
                  <span class="user-role">User</span>
                </li>
                <li>
                  <i class="ri-user-3-line"></i>
                  <span>Rahul Sharma</span>
                  <span class="user-role seller">Seller</span>
                </li>
                <li>
                  <i class="ri-user-3-line"></i>
                  <span>Ayesha Singh</span>
                  <span class="user-role">User</span>
                </li>
                <li>
                  <i class="ri-user-3-line"></i>
                  <span>John Doe</span>
                  <span class="user-role landlord">Landlord</span>
                </li>
                <li>
                  <i class="ri-user-3-line"></i>
                  <span>Sarah Wilson</span>
                  <span class="user-role">User</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 2. Houses for Sale Card -->
          <div class="admin-card">
            <div class="admin-card-header">
              <i class="ri-home-4-line admin-icon"></i>
              <h2>Houses for Sale</h2>
            </div>
            <div class="admin-card-content">
              <ul>
                <li>
                  <i class="ri-home-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>4 BHK Villa</div>
                      <div class="property-location">Bandra West, Mumbai</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
                <li>
                  <i class="ri-home-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>3 BHK Independent House</div>
                      <div class="property-location">Koregaon Park, Pune</div>
                    </div>
                    <span class="status-badge status-pending">Pending</span>
                  </div>
                </li>
                <li>
                  <i class="ri-home-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>2 BHK Duplex</div>
                      <div class="property-location">Sector 62, Noida</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
                <li>
                  <i class="ri-home-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>5 BHK Luxury Villa</div>
                      <div class="property-location">Whitefield, Bangalore</div>
                    </div>
                    <span class="status-badge status-rejected">Rejected</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- 3. Houses for Rent Card -->
          <div class="admin-card">
            <div class="admin-card-header">
              <i class="ri-home-2-line admin-icon"></i>
              <h2>Houses for Rent</h2>
            </div>
            <div class="admin-card-content">
              <ul>
                <li>
                  <i class="ri-home-2-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>2 BHK House</div>
                      <div class="property-location">Thane West, Mumbai</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
                <li>
                  <i class="ri-home-2-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>3 BHK Independent House</div>
                      <div class="property-location">HSR Layout, Bangalore</div>
                    </div>
                    <span class="status-badge status-pending">Pending</span>
                  </div>
                </li>
                <li>
                  <i class="ri-home-2-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>1 BHK Cottage</div>
                      <div class="property-location">Viman Nagar, Pune</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- 4. Apartments for Sale Card -->
          <div class="admin-card">
            <div class="admin-card-header">
              <i class="ri-building-line admin-icon"></i>
              <h2>Apartments for Sale</h2>
            </div>
            <div class="admin-card-content">
              <ul>
                <li>
                  <i class="ri-building-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>3 BHK Apartment</div>
                      <div class="property-location">Andheri East, Mumbai</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
                <li>
                  <i class="ri-building-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>4 BHK Penthouse</div>
                      <div class="property-location">Powai, Mumbai</div>
                    </div>
                    <span class="status-badge status-pending">Pending</span>
                  </div>
                </li>
                <li>
                  <i class="ri-building-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>2 BHK Flat</div>
                      <div class="property-location">Gachibowli, Hyderabad</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- 5. Apartments for Rent Card -->
          <div class="admin-card">
            <div class="admin-card-header">
              <i class="ri-building-2-line admin-icon"></i>
              <h2>Apartments for Rent</h2>
            </div>
            <div class="admin-card-content">
              <ul>
                <li>
                  <i class="ri-building-2-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>1 BHK Studio</div>
                      <div class="property-location">Dadar, Mumbai</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
                <li>
                  <i class="ri-building-2-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>2 BHK Apartment</div>
                      <div class="property-location">Malad West, Mumbai</div>
                    </div>
                    <span class="status-badge status-pending">Pending</span>
                  </div>
                </li>
                <li>
                  <i class="ri-building-2-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>3 BHK Flat</div>
                      <div class="property-location">Indiranagar, Bangalore</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- 6. Homestays Card -->
          <div class="admin-card">
            <div class="admin-card-header">
              <i class="ri-hotel-bed-line admin-icon"></i>
              <h2>Homestays</h2>
            </div>
            <div class="admin-card-content">
              <ul>
                <li>
                  <i class="ri-hotel-bed-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>Sea View Homestay</div>
                      <div class="property-location">Calangute, Goa</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
                <li>
                  <i class="ri-hotel-bed-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>Hilltop Cottage</div>
                      <div class="property-location">Lonavala, Maharashtra</div>
                    </div>
                    <span class="status-badge status-pending">Pending</span>
                  </div>
                </li>
                <li>
                  <i class="ri-hotel-bed-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>Mountain View Homestay</div>
                      <div class="property-location">Manali, Himachal Pradesh</div>
                    </div>
                    <span class="status-badge status-approved">Approved</span>
                  </div>
                </li>
                <li>
                  <i class="ri-hotel-bed-line"></i>
                  <div class="property-info">
                    <div class="property-details">
                      <div>Beach House</div>
                      <div class="property-location">Alibaug, Maharashtra</div>
                    </div>
                    <span class="status-badge status-rejected">Rejected</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- 7. Feedback & Reviews Card -->
          <div class="admin-card">
            <div class="admin-card-header">
              <i class="ri-star-line admin-icon"></i>
              <h2>Feedback & Reviews</h2>
            </div>
            <div class="admin-card-content">
              <ul>
                <li class="feedback-item">
                  <div class="feedback-header">
                    <span class="feedback-user">Priya Gupta</span>
                    <span class="feedback-date">June 20, 2025</span>
                  </div>
                  <div class="feedback-content">Great experience! The listing process was easy and fast. Highly recommend this platform.</div>
                </li>
                <li class="feedback-item">
                  <div class="feedback-header">
                    <span class="feedback-user">Rahul Sharma</span>
                    <span class="feedback-date">June 22, 2025</span>
                  </div>
                  <div class="feedback-content">Very clean and well-maintained property. The owner was very responsive.</div>
                </li>
                <li class="feedback-item">
                  <div class="feedback-header">
                    <span class="feedback-user">Ayesha Singh</span>
                    <span class="feedback-date">June 21, 2025</span>
                  </div>
                  <div class="feedback-content">Please add more photo upload options. Otherwise, great service!</div>
                </li>
                <li class="feedback-item">
                  <div class="feedback-header">
                    <span class="feedback-user">John Doe</span>
                    <span class="feedback-date">June 22, 2025</span>
                  </div>
                  <div class="feedback-content">Loved the quick booking experience! Will definitely use again.</div>
                </li>
              </ul>
            </div>
          </div>

          <!-- 8. Complaints Card -->
          <div class="admin-card">
            <div class="admin-card-header">
              <i class="ri-alert-line admin-icon"></i>
              <h2>Complaints</h2>
            </div>
            <div class="admin-card-content">
              <ul>
                <li class="complaint-item">
                  <div class="complaint-header">
                    <span class="complaint-user">Sarah Wilson</span>
                    <span class="complaint-date">June 24, 2025</span>
                  </div>
                  <div class="complaint-content">Property listing had incorrect information about amenities. Wasted my time visiting.</div>
                  <span class="complaint-status">Open</span>
                </li>
                <li class="complaint-item">
                  <div class="complaint-header">
                    <span class="complaint-user">Mike Johnson</span>
                    <span class="complaint-date">June 23, 2025</span>
                  </div>
                  <div class="complaint-content">Owner was not responding to calls and messages. Very unprofessional behavior.</div>
                  <span class="complaint-status">In Progress</span>
                </li>
                <li class="complaint-item">
                  <div class="complaint-header">
                    <span class="complaint-user">Lisa Brown</span>
                    <span class="complaint-date">June 21, 2025</span>
                  </div>
                  <div class="complaint-content">Payment was deducted but booking was not confirmed. Need refund immediately.</div>
                  <span class="complaint-status">Resolved</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script>
      // Mobile menu toggle
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
      
      // Close menu on link click
      mobileMenu.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function () {
          mobileMenu.classList.remove("active");
        });
      });

      // Add smooth scrolling to cards
      document.querySelectorAll('.admin-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-8px)';
        });
        
        card.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0)';
        });
      });
    </script>
  </body>
</html>