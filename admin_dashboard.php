<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard | MDM System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      display: flex;
      height: 100vh;
    }

    .navbar {
      background-color: #00695c;
    }

    .navbar-brand {
      color: white !important;
      font-weight: bold;
      font-size: 1.8rem;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 17%;
      background-color: #004d40;
      height: 100%;
      padding-top: 30px;
      z-index: 1000;
      transition: 0.3s;
    }

    .sidebar a {
      color: white;
      display: block;
      padding: 10px 15px;
      text-decoration: none;
      font-size: 1.1rem;
      margin-bottom: 10px;
    }

    .sidebar a:hover {
      background-color: #26a69a;
      border-radius: 5px;
    }

    /* Content area */
    .container {
      margin-left: 17%;
      width: 83%;
      padding: 20px;
    }

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
      font-size: 1.3rem;
    }

    .card-body {
      padding: 30px;
    }

    .btn-custom {
      background-color: #26a69a;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      margin: 10px 0;
      width: 100%;
    }

    .btn-custom:hover {
      background-color: #1d8a80;
    }

    footer {
      background-color: #00695c;
      color: #fff;
      text-align: center;
      padding: 15px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    .sidebar a.active {
      background-color: #1d8a80;
    }

    
    @media (max-width: 992px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        margin-bottom: 20px;
      }

      .sidebar a {
        text-align: center;
      }

      .container {
        margin-left: 0;
        width: 100%;
      }
    }

    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        left: -250px;
        transition: 0.3s;
      }

      .sidebar.active {
        left: 0;
      }

      .container {
        margin-left: 0;
      }

      .sidebar a {
        text-align: center;
      }

      .navbar-toggler {
        display: block;
      }
    }

    @media (max-width: 576px) {
      .navbar-brand {
        font-size: 1.4rem;
      }

      .card-header {
        font-size: 1.2rem;
      }

      .btn-custom {
        padding: 8px 15px;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <a href="admin_dashboard.php" class="active">Dashboard</a>
    <a href="brand_management.php">Brands</a>
    <a href="category_management.php">Categories</a>
    <a href="item_management.php">Items</a>
    <a href="logout.php" onclick="return confirmLogout()">Logout</a>

    <script>
function confirmLogout() {
    return confirm("Are you sure you want to logout?");
}
</script>
  </div>

  <!-- Content -->
  <div class="container">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">MDM System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav><br>

    <h2 class="text-center text-success mb-4">Admin Dashboard</h2>

   <div class="row">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Ctegory Management</div>
      <div class="card-body text-center">
        <img src="images/image 01.png" alt="Brand Management" style="width: 200px; height: 200px; object-fit: cover;">
        <h5 class="mt-3">Manage Your Category</h5>
      </div>
    </div>
  </div>


  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Brand Management</div>
      <div class="card-body text-center">
        <img src="images/image 02.jfif" alt="Category Management" style="width: 200px; height: 200px; object-fit: cover;">
        <h5 class="mt-3">Manage Your Brand</h5>
      </div>
    </div>
  </div>


  <div class="col-md-6">
    <div class="card">
      <div class="card-header">User Management</div>
      <div class="card-body text-center">
        <img src="images/image 03.avif" alt="Item Management" style="width: 200px; height: 200px; object-fit: cover;">
        <h5 class="mt-3">Manage Users</h5>
      </div>
    </div>
  </div>

  
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Item Management</div>
      <div class="card-body text-center">
        <img src="images/image 04.webp" alt="User Management" style="width: 200px; height: 200px; object-fit: cover;">
        <h5 class="mt-3">Manage Items</h5>
      </div>
    </div>
  </div>
</div>


  <!-- Footer -->
  <footer>
    &copy; 2025 Master Data Management System
  </footer>

  <!-- Bootstrap links -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

  <script>
    // Toggle sidebar on small screens
    const toggleSidebar = () => {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('active');
    }

    const navbarToggler = document.querySelector('.navbar-toggler');
    if (navbarToggler) {
      navbarToggler.addEventListener('click', toggleSidebar);
    }
  </script>

</body>
</html>
