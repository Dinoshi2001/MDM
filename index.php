<?php

include_once 'classes/db.php';
include_once 'classes/item.php';


$item = new item();


$items = $item->getAllItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      margin: 0;
    }

    /* Navbar */
    .navbar {
      background-color: #00695c;
    }

    .navbar-brand {
      color: white !important;
      font-weight: bold;
      font-size: 1.8rem;
    }

    .navbar-nav .nav-link {
      color: white !important;
    }

    .navbar-nav .nav-link:hover {
      background-color: #26a69a;
      border-radius: 5px;
    }

    /* Hero Section */
    .hero-section {
      background-color: #004d40;
      color: white;
      text-align: center;
      padding: 100px 20px;
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .hero-section p {
      font-size: 1.2rem;
    }

    .btn-primary {
      background-color: #26a69a;
      color: white;
      padding: 12px 25px;
      border-radius: 5px;
      font-size: 1rem;
      margin-top: 20px;
    }

    .btn-primary:hover {
      background-color: #1d8a80;
    }

    /* Footer */
    footer {
      background-color: #00695c;
      color: #fff;
      text-align: center;
      padding: 15px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    /* Card Section */
    .card {
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      background-color: white;
      margin-bottom: 30px;
    }

    .card-header {
      background-color: #26a69a;
      color: white;
      font-weight: bold;
    }

    .card-body {
      text-align: center;
      padding: 20px;
    }

    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 12px;
    }

    .btn-status {
      background-color: #00796b;
      color: white;
      border: none;
      padding: 8px 20px;
      font-size: 1rem;
      border-radius: 5px;
      margin-top: 15px;
    }

    .btn-status:disabled {
      background-color: #004d40;
      cursor: not-allowed;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero-section h1 {
        font-size: 2.5rem;
      }

      .hero-section p {
        font-size: 1rem;
      }

      .btn-primary {
        width: 100%;
      }
    }



    .pagination {
      justify-content: center;
      margin-top: 30px;
    }

    
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MDM System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" disabled>
    <span class="navbar-toggler-icon"></span>
</button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero-section">
    <h1>Welcome to ABCD Computers</h1>
    <p>Best Place For Computers.Join With Us Today.</p>
    <a href="#" class="btn-primary">Get Started</a>
  </div>

  <!-- Cards Section -->
  <!-- Cards Section -->
  <div class="container mt-5">
    <h2 class="text-center text-success mb-4">View Our Items</h2>
    <div class="row">
      <?php
        if (!empty($items)) {
          foreach ($items as $item) {
           
            echo '
              <div class="col-md-4">
                <div class="card">
                  <img src="' . $item['attachment'] . '" class="card-img-top" alt="' . $item['name'] . '">
                  <div class="card-header"></div>
                  <div class="card-body">
                    <h5 class="card-title">Product Name: <strong>' . $item['name'] . '</strong></h5>
                    <p><strong>Brand:</strong> ' . $item['brand'] . '</p>
                    <p><strong>Category:</strong> ' . $item['category'] . '</p>
                    <button class="btn-status" disabled>Status: ' . $item['status'] . '</button>
                  </div>
                </div>
              </div>
            ';
          }
        } else {
          echo '<p>No items found.</p>';
        }
      ?>


    </div>
  </div>
  <br>
  <br>

  
  

  <!-- Footer -->
  <footer>
    &copy; 2025 Master Data Management System
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
