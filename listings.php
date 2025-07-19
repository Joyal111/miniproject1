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
<?php
session_start();
include 'db.php'; // Assumes db.php sets up $conn

// Get all listings from the database
$sql = "SELECT * FROM sell_rent_listings ORDER BY listing_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listings</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .filters {
            padding: 30px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 3px solid #667eea;
        }

        .filter-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .filter-title {
            font-size: 1.4em;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-bar {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        .search-bar:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.2);
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .filter-group select,
        .filter-group input {
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.2);
        }

        .price-range {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .filter-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .filter-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .clear-btn {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        }

        .clear-btn:hover {
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        .results-count {
            text-align: center;
            padding: 15px;
            background: #667eea;
            color: white;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .listings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            padding: 30px;
        }

        .listing-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .listing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .listing-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #667eea;
        }

        .listing-content {
            padding: 20px;
        }

        .listing-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .listing-title {
            font-size: 1.3em;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .listing-type {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: bold;
            text-transform: uppercase;
        }

        .listing-price {
            font-size: 1.4em;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .listing-location {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.95em;
        }

        .listing-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .detail-item {
            text-align: center;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 8px;
            font-size: 0.9em;
        }

        .detail-value {
            font-weight: bold;
            color: #333;
        }

        .detail-label {
            color: #666;
            font-size: 0.8em;
        }

        .listing-furnishing {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8em;
            margin-bottom: 10px;
        }

        .listing-description {
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .listing-contact {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            margin-top: 15px;
        }

        .no-listings {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .no-listings h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .add-listing-btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s;
            margin-top: 20px;
        }

        .add-listing-btn:hover {
            transform: translateY(-2px);
        }

        /* Dialog Styles - Brown Theme */
        .dialog-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            padding: 20px;
        }

        .dialog-content {
            background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            position: relative;
            color: white;
        }

        .dialog-header {
            background: linear-gradient(135deg, #654321 0%, #8B4513 100%);
            padding: 25px;
            text-align: center;
            border-bottom: 3px solid #D2691E;
        }

        .dialog-title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #F5DEB3;
        }

        .dialog-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 2em;
            color: #F5DEB3;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .dialog-close:hover {
            background: rgba(245, 222, 179, 0.2);
        }

        .dialog-body {
            padding: 30px;
            overflow-y: auto;
            max-height: 70vh;
        }

        .dialog-images {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .dialog-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 15px;
            border: 3px solid #D2691E;
            transition: transform 0.3s;
        }

        .dialog-image:hover {
            transform: scale(1.05);
        }

        .dialog-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-section {
            background: linear-gradient(135deg, #A0522D 0%, #8B4513 100%);
            padding: 20px;
            border-radius: 15px;
            border: 2px solid #D2691E;
        }

        .info-section h3 {
            color: #F5DEB3;
            font-size: 1.3em;
            margin-bottom: 15px;
            text-align: center;
            border-bottom: 2px solid #D2691E;
            padding-bottom: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(210, 105, 30, 0.3);
        }

        .info-label {
            font-weight: bold;
            color: #F5DEB3;
        }

        .info-value {
            color: #FFEFD5;
            text-align: right;
        }

        .description-section {
            background: linear-gradient(135deg, #A0522D 0%, #8B4513 100%);
            padding: 20px;
            border-radius: 15px;
            border: 2px solid #D2691E;
            margin-bottom: 20px;
        }

        .description-section h3 {
            color: #F5DEB3;
            font-size: 1.3em;
            margin-bottom: 15px;
            text-align: center;
            border-bottom: 2px solid #D2691E;
            padding-bottom: 10px;
        }

        .description-text {
            line-height: 1.6;
            color: #FFEFD5;
            text-align: justify;
        }

        .contact-section {
            background: linear-gradient(135deg, #654321 0%, #8B4513 100%);
            padding: 20px;
            border-radius: 15px;
            border: 2px solid #D2691E;
            text-align: center;
        }

        .contact-section h3 {
            color: #F5DEB3;
            font-size: 1.3em;
            margin-bottom: 15px;
        }

        .contact-info {
            font-size: 1.2em;
            color: #FFEFD5;
            font-weight: bold;
        }

        .price-highlight {
            background: linear-gradient(135deg, #CD853F 0%, #D2691E 100%);
            color: white;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 20px;
            border: 2px solid #F5DEB3;
        }

        @media (max-width: 768px) {
            .listings-grid {
                grid-template-columns: 1fr;
                padding: 20px;
            }
            
            .filter-group {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group select,
            .filter-group input {
                width: 100%;
            }

            .dialog-content {
                margin: 10px;
                max-height: 95vh;
            }

            .dialog-info {
                grid-template-columns: 1fr;
            }

            .dialog-images {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏠 Property Listings</h1>
            <p>Find your dream property in Kerala</p>
        </div>

        <div class="filters">
            <div class="filter-section">
                <div class="filter-title">🔍 Search & Filter Properties</div>
                
                <input type="text" id="searchBar" class="search-bar" placeholder="Search by title, location, city, or description...">
                
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="filter-label">Listing Type</label>
                        <select id="filterType">
                            <option value="">All Types</option>
                            <option value="sell">For Sale</option>
                            <option value="rent">For Rent</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">District</label>
                        <select id="filterDistrict">
                            <option value="">All Districts</option>
                            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                            <option value="Kollam">Kollam</option>
                            <option value="Pathanamthitta">Pathanamthitta</option>
                            <option value="Alappuzha">Alappuzha</option>
                            <option value="Kottayam">Kottayam</option>
                            <option value="Idukki">Idukki</option>
                            <option value="Ernakulam">Ernakulam</option>
                            <option value="Thrissur">Thrissur</option>
                            <option value="Palakkad">Palakkad</option>
                            <option value="Malappuram">Malappuram</option>
                            <option value="Kozhikode">Kozhikode</option>
                            <option value="Wayanad">Wayanad</option>
                            <option value="Kannur">Kannur</option>
                            <option value="Kasaragod">Kasaragod</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Property Type</label>
                        <select id="filterPropertyType">
                            <option value="">All Properties</option>
                            <option value="1">House</option>
                            <option value="2">Apartment</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Bedrooms</label>
                        <select id="filterBedrooms">
                            <option value="">Any</option>
                            <option value="1">1+ Bedroom</option>
                            <option value="2">2+ Bedrooms</option>
                            <option value="3">3+ Bedrooms</option>
                            <option value="4">4+ Bedrooms</option>
                        </select>
                    </div>
                </div>
                
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="filter-label">Price Range (₹)</label>
                        <div class="price-range">
                            <input type="number" id="filterMinPrice" placeholder="Min Price">
                            <input type="number" id="filterMaxPrice" placeholder="Max Price">
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Furnishing</label>
                        <select id="filterFurnishing">
                            <option value="">Any</option>
                            <option value="Unfurnished">Unfurnished</option>
                            <option value="SemiFurnished">Semi-Furnished</option>
                            <option value="FullyFurnished">Fully Furnished</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Area (Sq Ft)</label>
                        <input type="number" id="filterMinArea" placeholder="Min Area">
                    </div>
                </div>
                
                <div class="filter-buttons">
                    <button class="filter-btn" onclick="applyFilters()">🔍 Apply Filters</button>
                    <button class="filter-btn clear-btn" onclick="clearFilters()">🔄 Clear All</button>
                </div>
            </div>
            
            <div class="results-count" id="resultsCount">
                Showing all properties
            </div>
        </div>

        <div class="listings-grid" id="listingsGrid">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $propertyType = ($row['property_id'] == 1) ? 'House' : 'Apartment';
                    $priceFormatted = '₹' . number_format($row['price']);
                    
                    // Prepare all images for dialog
                    $images = [];
                    for ($i = 1; $i <= 5; $i++) {
                        $imageField = 'image' . $i;
                        if (!empty($row[$imageField]) && file_exists($row[$imageField])) {
                            $images[] = $row[$imageField];
                        }
                    }
                    
                    echo '<div class="listing-card" 
                            onclick="openDialog(this)"
                            data-type="' . $row['listing_type'] . '" 
                            data-district="' . $row['district'] . '" 
                            data-price="' . $row['price'] . '" 
                            data-bedrooms="' . $row['bedrooms'] . '"
                            data-bathrooms="' . $row['bathrooms'] . '"
                            data-property-type="' . $row['property_id'] . '"
                            data-furnishing="' . $row['furnishing'] . '"
                            data-area="' . $row['area_sqft'] . '"
                            data-location="' . htmlspecialchars($row['location']) . '"
                            data-city="' . htmlspecialchars($row['city']) . '"
                            data-title="' . htmlspecialchars($row['title']) . '"
                            data-description="' . htmlspecialchars($row['description']) . '"
                            data-contact="' . htmlspecialchars($row['contact_number']) . '"
                            data-images="' . htmlspecialchars(json_encode($images)) . '"
                            data-search-text="' . strtolower($row['title'] . ' ' . $row['location'] . ' ' . $row['city'] . ' ' . $row['description']) . '">';
                    
                    // Display main image
                    if (!empty($row['image1']) && file_exists($row['image1'])) {
                        echo '<img src="' . $row['image1'] . '" alt="Property Image" class="listing-image">';
                    } else {
                        echo '<div class="listing-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3em;">🏠</div>';
                    }
                    
                    echo '<div class="listing-content">';
                    echo '<div class="listing-header">';
                    echo '<div>';
                    echo '<div class="listing-title">' . htmlspecialchars($row['title']) . '</div>';
                    echo '<div class="listing-price">' . $priceFormatted . '</div>';
                    echo '</div>';
                    echo '<div class="listing-type">' . ucfirst($row['listing_type']) . '</div>';
                    echo '</div>';
                    
                    echo '<div class="listing-location">📍 ' . htmlspecialchars($row['location']) . ', ' . htmlspecialchars($row['city']) . ', ' . htmlspecialchars($row['district']) . '</div>';
                    
                    echo '<div class="listing-details">';
                    echo '<div class="detail-item"><div class="detail-value">' . $row['bedrooms'] . '</div><div class="detail-label">Bedrooms</div></div>';
                    echo '<div class="detail-item"><div class="detail-value">' . $row['bathrooms'] . '</div><div class="detail-label">Bathrooms</div></div>';
                    echo '<div class="detail-item"><div class="detail-value">' . number_format($row['area_sqft']) . '</div><div class="detail-label">Sq Ft</div></div>';
                    echo '</div>';
                    
                    echo '<div class="listing-furnishing">' . htmlspecialchars($row['furnishing']) . '</div>';
                    
                    echo '<div class="listing-description">' . htmlspecialchars($row['description']) . '</div>';
                    
                    echo '<div class="listing-contact">📞 Contact: ' . htmlspecialchars($row['contact_number']) . '</div>';
                    
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="no-listings">';
                echo '<h3>No listings found</h3>';
                echo '<p>Be the first to add a property listing!</p>';
                echo '<a href="sell_rent_listings.php" class="add-listing-btn">Add Your Property</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Dialog Modal -->
    <div class="dialog-overlay" id="dialogOverlay">
        <div class="dialog-content">
            <div class="dialog-header">
                <h2 class="dialog-title" id="dialogTitle"></h2>
                <button class="dialog-close" onclick="closeDialog()">&times;</button>
            </div>
            <div class="dialog-body">
                <div class="price-highlight" id="dialogPrice"></div>
                
                <div class="dialog-images" id="dialogImages"></div>
                
                <div class="dialog-info">
                    <div class="info-section">
                        <h3>🏠 Property Details</h3>
                        <div class="info-row">
                            <span class="info-label">Type:</span>
                            <span class="info-value" id="dialogPropertyType"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Listing Type:</span>
                            <span class="info-value" id="dialogListingType"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Bedrooms:</span>
                            <span class="info-value" id="dialogBedrooms"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Bathrooms:</span>
                            <span class="info-value" id="dialogBathrooms"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Area:</span>
                            <span class="info-value" id="dialogArea"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Furnishing:</span>
                            <span class="info-value" id="dialogFurnishing"></span>
                        </div>
                    </div>
                    
                    <div class="info-section">
                        <h3>📍 Location Details</h3>
                        <div class="info-row">
                            <span class="info-label">Location:</span>
                            <span class="info-value" id="dialogLocation"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">City:</span>
                            <span class="info-value" id="dialogCity"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">District:</span>
                            <span class="info-value" id="dialogDistrict"></span>
                        </div>
                    </div>
                </div>
                
                <div class="description-section">
                    <h3>📄 Description</h3>
                    <div class="description-text" id="dialogDescription"></div>
                </div>
                
                <div class="contact-section">
                    <h3>📞 Contact Information</h3>
                    <div class="contact-info" id="dialogContact"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Real-time search functionality
        document.getElementById('searchBar').addEventListener('input', function() {
            applyFilters();
        });

        // Apply filters and search
        function applyFilters() {
            const searchTerm = document.getElementById('searchBar').value.toLowerCase();
            const filterType = document.getElementById('filterType').value;
            const filterDistrict = document.getElementById('filterDistrict').value;
            const filterPropertyType = document.getElementById('filterPropertyType').value;
            const filterBedrooms = document.getElementById('filterBedrooms').value;
            const filterMinPrice = document.getElementById('filterMinPrice').value;
            const filterMaxPrice = document.getElementById('filterMaxPrice').value;
            const filterFurnishing = document.getElementById('filterFurnishing').value;
            const filterMinArea = document.getElementById('filterMinArea').value;
            
            const listings = document.querySelectorAll('.listing-card');
            let visibleCount = 0;
            
            listings.forEach(listing => {
                let showListing = true;
                
                // Search filter
                if (searchTerm && !listing.getAttribute('data-search-text').includes(searchTerm)) {
                    showListing = false;
                }
                
                // Listing type filter
                if (filterType && listing.getAttribute('data-type') !== filterType) {
                    showListing = false;
                }
                
                // District filter
                if (filterDistrict && listing.getAttribute('data-district') !== filterDistrict) {
                    showListing = false;
                }
                
                // Property type filter
                if (filterPropertyType && listing.getAttribute('data-property-type') !== filterPropertyType) {
                    showListing = false;
                }
                
                // Bedrooms filter
                if (filterBedrooms && parseInt(listing.getAttribute('data-bedrooms')) < parseInt(filterBedrooms)) {
                    showListing = false;
                }
                
                // Price range filter
                const listingPrice = parseInt(listing.getAttribute('data-price'));
                if (filterMinPrice && listingPrice < parseInt(filterMinPrice)) {
                    showListing = false;
                }
                if (filterMaxPrice && listingPrice > parseInt(filterMaxPrice)) {
                    showListing = false;
                }
                
                // Furnishing filter
                if (filterFurnishing && listing.getAttribute('data-furnishing') !== filterFurnishing) {
                    showListing = false;
                }
                
                // Area filter
                if (filterMinArea && parseInt(listing.getAttribute('data-area')) < parseInt(filterMinArea)) {
                    showListing = false;
                }
                
                listing.style.display = showListing ? 'block' : 'none';
                if (showListing) visibleCount++;
            });
            
            // Update results count
            updateResultsCount(visibleCount);
        }
        
        function clearFilters() {
            document.getElementById('searchBar').value = '';
            document.getElementById('filterType').value = '';
            document.getElementById('filterDistrict').value = '';
            document.getElementById('filterPropertyType').value = '';
            document.getElementById('filterBedrooms').value = '';
            document.getElementById('filterMinPrice').value = '';
            document.getElementById('filterMaxPrice').value = '';
            document.getElementById('filterFurnishing').value = '';
            document.getElementById('filterMinArea').value = '';
            
            const listings = document.querySelectorAll('.listing-card');
            listings.forEach(listing => {
                listing.style.display = 'block';
            });
            
            updateResultsCount(listings.length);
        }
        
        function updateResultsCount(count) {
            const resultsCount = document.getElementById('resultsCount');
            if (count === 0) {
                resultsCount.textContent = 'No properties found matching your criteria';
                resultsCount.style.background = '#dc3545';
            } else if (count === 1) {
                resultsCount.textContent = 'Showing 1 property';
                resultsCount.style.background = '#28a745';
            } else {
                resultsCount.textContent = `Showing ${count} properties`;
                resultsCount.style.background = '#667eea';
            }
        }

        // Dialog functionality
        function openDialog(card) {
            const overlay = document.getElementById('dialogOverlay');
            
            // Get data from card
            const title = card.getAttribute('data-title');
            const price = '₹' + parseInt(card.getAttribute('data-price')).toLocaleString();
            const type = card.getAttribute('data-type');
            const propertyType = card.getAttribute('data-property-type') === '1' ? 'House' : 'Apartment';
            const bedrooms = card.getAttribute('data-bedrooms');
            const bathrooms = card.getAttribute('data-bathrooms');
            const area = parseInt(card.getAttribute('data-area')).toLocaleString() + ' Sq Ft';
            const furnishing = card.getAttribute('data-furnishing');
            const location = card.getAttribute('data-location');
            const city = card.getAttribute('data-city');
            const district = card.getAttribute('data-district');
            const description = card.getAttribute('data-description');
            const contact = card.getAttribute('data-contact');
            const images = JSON.parse(card.getAttribute('data-images') || '[]');
            
            // Populate dialog
            document.getElementById('dialogTitle').textContent = title;
            document.getElementById('dialogPrice').textContent = price;
            document.getElementById('dialogPropertyType').textContent = propertyType;
            document.getElementById('dialogListingType').textContent = type.charAt(0).toUpperCase() + type.slice(1);
            document.getElementById('dialogBedrooms').textContent = bedrooms;
            document.getElementById('dialogBathrooms').textContent = bathrooms;
            document.getElementById('dialogArea').textContent = area;
            document.getElementById('dialogFurnishing').textContent = furnishing;
            document.getElementById('dialogLocation').textContent = location;
            document.getElementById('dialogCity').textContent = city;
            document.getElementById('dialogDistrict').textContent = district;
            document.getElementById('dialogDescription').textContent = description;
            document.getElementById('dialogContact').textContent = contact;
            
            // Populate images
            const imagesContainer = document.getElementById('dialogImages');
            imagesContainer.innerHTML = '';
            
            if (images.length > 0) {
                images.forEach(imageSrc => {
                    const img = document.createElement('img');
                    img.src = imageSrc;
                    img.alt = 'Property Image';
                    img.className = 'dialog-image';
                    imagesContainer.appendChild(img);
                });
            } else {
                imagesContainer.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: linear-gradient(135deg, #A0522D 0%, #8B4513 100%); border-radius: 15px; border: 2px solid #D2691E; color: #F5DEB3; font-size: 3em;">🏠<br><span style="font-size: 0.3em;">No images available</span></div>';
            }
            
            // Show dialog
            overlay.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeDialog() {
            const overlay = document.getElementById('dialogOverlay');
            overlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close dialog when clicking outside
        document.getElementById('dialogOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDialog();
            }
        });

        // Close dialog with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDialog();
            }
        });
        
        // Initialize results count on page load
        window.addEventListener('load', function() {
            const totalListings = document.querySelectorAll('.listing-card').length;
            updateResultsCount(totalListings);
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>

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