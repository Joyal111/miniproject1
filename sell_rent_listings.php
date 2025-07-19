<?php
session_start();
include 'db.php'; // Assumes db.php sets up $conn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $user_id = $_SESSION['user_id'] ?? 0; // Replace with actual user session id
    $listing_type = $_POST['listing_type'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $location = $_POST['location'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $area_sqft = $_POST['area_sqft'];
    $furnishing = $_POST['furnishing'];
    $contact_number = $_POST['contact_number'];
    $description = $_POST['description'];

    // File upload
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image1 = $target_dir . basename($_FILES["image1"]["name"]);
    move_uploaded_file($_FILES["image1"]["tmp_name"], $image1);

    $image2 = !empty($_FILES["image2"]["name"]) ? $target_dir . basename($_FILES["image2"]["name"]) : null;
    if ($image2) move_uploaded_file($_FILES["image2"]["tmp_name"], $image2);

    $image3 = !empty($_FILES["image3"]["name"]) ? $target_dir . basename($_FILES["image3"]["name"]) : null;
    if ($image3) move_uploaded_file($_FILES["image3"]["tmp_name"], $image3);

    // Insert into DB (removed state field)
    $stmt = $conn->prepare("INSERT INTO sell_rent_listings (property_id, user_id, listing_type, title, price, district, city, location, bedrooms, bathrooms, area_sqft, furnishing, contact_number, description, image1, image2, image3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "iissdsssiiissssss",
        $property_id,
        $user_id,
        $listing_type,
        $title,
        $price,
        $district,
        $city,
        $location,
        $bedrooms,
        $bathrooms,
        $area_sqft,
        $furnishing,
        $contact_number,
        $description,
        $image1,
        $image2,
        $image3
    );

    if ($stmt->execute()) {
        echo "<script>alert('Listing submitted successfully!'); window.location.href='sell_rent_listings.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sell/Rent Property Listing</title>
     <link rel="stylesheet" href="sell_rent_listings.css" />

</head>
<body>

<div class="container">
  <h2>Sell / Rent Property Listing</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label>Property Type</label>
      <select name="property_id" required>
        <option value="">-- Select Property Type --</option>
        <option value="1">House</option>
        <option value="2">Apartment</option>
      </select>
    </div>

    <div class="form-group">
      <label>Listing Type</label>
      <select name="listing_type" required>
        <option value="">-- Select Listing Type --</option>
        <option value="sell">Sell</option>
        <option value="rent">Rent</option>
      </select>
    </div>

    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" placeholder="e.g., Beautiful 3BHK Villa in Kochi" required>
    </div>

    <div class="form-group">
      <label>Price (₹)</label>
      <input type="number" name="price" step="0.01" placeholder="e.g., 5000000" required>
    </div>

    <div class="form-group">
      <label>District</label>
      <select name="district" required>
        <option value="">-- Select District --</option>
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

    <div class="form-group">
      <label>City</label>
      <input type="text" name="city" placeholder="e.g., Kochi, Thiruvananthapuram, Kozhikode, Thrissur" required>
    </div>

    <div class="form-group">
      <label>Location</label>
      <input type="text" name="location" placeholder="e.g., MG Road, Kakkanad, Marine Drive" required>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Bedrooms</label>
        <input type="number" name="bedrooms" min="1" max="10" placeholder="e.g., 3" required>
      </div>
      <div class="form-group">
        <label>Bathrooms</label>
        <input type="number" name="bathrooms" min="1" max="10" placeholder="e.g., 2" required>
      </div>
      <div class="form-group">
        <label>Area (sqft)</label>
        <input type="number" name="area_sqft" min="100" placeholder="e.g., 1200" required>
      </div>
    </div>

    <div class="form-group">
      <label>Furnishing</label>
      <select name="furnishing" required>
        <option value="">-- Select Furnishing --</option>
        <option value="Unfurnished">Unfurnished</option>
        <option value="SemiFurnished">Semi-Furnished</option>
        <option value="FullyFurnished">Fully Furnished</option>
      </select>
    </div>

    <div class="form-group">
      <label>Contact Number</label>
      <div class="input-with-validation">
        <input type="tel" name="contact_number" id="contactNumber" placeholder="e.g., 9876543210" required>
        <span class="validation-icon" id="validationIcon"></span>
      </div>
      <div class="contact-validation" id="contactValidation"></div>
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea name="description" rows="4" placeholder="Describe your property in detail including amenities, nearby facilities, and special features..." required></textarea>
    </div>

    <div class="form-group">
      <label>Image 1 (Main Image)</label>
      <div class="file-input-wrapper">
        <input type="file" name="image1" accept="image/*" required id="file1">
        <label for="file1" class="file-input-label">
          📸 Click to upload main image
        </label>
      </div>
    </div>

    <div class="form-group">
      <label>Image 2 (Optional)</label>
      <div class="file-input-wrapper">
        <input type="file" name="image2" accept="image/*" id="file2">
        <label for="file2" class="file-input-label">
          📸 Click to upload additional image
        </label>
      </div>
    </div>

    <div class="form-group">
      <label>Image 3 (Optional)</label>
      <div class="file-input-wrapper">
        <input type="file" name="image3" accept="image/*" id="file3">
        <label for="file3" class="file-input-label">
          📸 Click to upload additional image
        </label>
      </div>
    </div>

    <button type="submit">Submit Listing</button>
  </form>
</div>

<script>
// Live validation for contact number
document.getElementById('contactNumber').addEventListener('input', function(e) {
  const contactNumber = e.target.value;
  const validationDiv = document.getElementById('contactValidation');
  const validationIcon = document.getElementById('validationIcon');
  
  // Check if number starts with 6, 7, 8, or 9 and is exactly 10 digits
  const isValid = /^[6-9]\d{9}$/.test(contactNumber);
  
  if (contactNumber.length === 0) {
    validationDiv.textContent = '';
    validationIcon.textContent = '';
    validationDiv.className = 'contact-validation';
  } else if (contactNumber.length > 0 && contactNumber.length < 10) {
    validationDiv.textContent = 'Contact number must be 10 digits';
    validationDiv.className = 'contact-validation invalid';
    validationIcon.textContent = '❌';
    validationIcon.className = 'validation-icon invalid';
  } else if (contactNumber.length === 10) {
    if (isValid) {
      validationDiv.textContent = 'Valid contact number';
      validationDiv.className = 'contact-validation valid';
      validationIcon.textContent = '✅';
      validationIcon.className = 'validation-icon valid';
    } else {
      validationDiv.textContent = 'Contact number must start with 6, 7, 8, or 9';
      validationDiv.className = 'contact-validation invalid';
      validationIcon.textContent = '❌';
      validationIcon.className = 'validation-icon invalid';
    }
  } else {
    validationDiv.textContent = 'Contact number must be exactly 10 digits';
    validationDiv.className = 'contact-validation invalid';
    validationIcon.textContent = '❌';
    validationIcon.className = 'validation-icon invalid';
  }
});

// Prevent non-numeric input in contact number
document.getElementById('contactNumber').addEventListener('keypress', function(e) {
  if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') {
    e.preventDefault();
  }
});

// File input labels update
document.querySelectorAll('input[type="file"]').forEach(function(input) {
  input.addEventListener('change', function(e) {
    const label = document.querySelector('label[for="' + e.target.id + '"]');
    if (e.target.files.length > 0) {
      label.textContent = '✅ ' + e.target.files[0].name;
      label.style.background = 'linear-gradient(135deg, #c8e6c9, #a5d6a7)';
    }
  });
});

// Form submission validation
document.querySelector('form').addEventListener('submit', function(e) {
  const contactNumber = document.getElementById('contactNumber').value;
  const isValid = /^[6-9]\d{9}$/.test(contactNumber);
  
  if (!isValid) {
    e.preventDefault();
    alert('Please enter a valid contact number that starts with 6, 7, 8, or 9 and contains exactly 10 digits.');
    document.getElementById('contactNumber').focus();
  }
});
</script>

</body>
</html>