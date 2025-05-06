<?php
require_once 'classes/db.php';
require_once 'classes/brand.php';

// Initialize brand object
$brandObj = new Brand();

// Fetch all brands
$brands = $brandObj->getAllBrands();

// Initialize edit brand data
$editBrandData = null;

// Check if edit_id is present in the URL
if (isset($_GET['edit_id'])) {
    $editId = (int) $_GET['edit_id'];

    // Optional: Use existing brand object method if available
    $editBrandData = $brandObj->getBrandById($editId);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Brand Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      display: flex;
      height: 100vh;
    }

    /* Side Navigation Bar */
    .side-nav {
      height: 100%;
      width: 17%;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #00695c;
      padding-top: 20px;
      padding-left: 15px;
    }

    .side-nav a {
      display: block;
      color: white;
      padding: 10px;
      text-decoration: none;
      margin: 10px 0;
      font-size: 18px;
    }

    .side-nav a:hover {
      background-color: #1d8a80;
    }

    .content {
      margin-left: 17%;
      padding: 20px;
      width: 83%;
      overflow: auto;
    }

    .navbar {
      background-color: #00695c;
    }

    .navbar-brand {
      color: white !important;
      font-weight: bold;
      font-size: 1.8rem;
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
    }

    .btn-custom:hover {
      background-color: #1d8a80;
    }

    .table thead {
      background-color: #26a69a;
      color: white;
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

    .btn-edit, .btn-delete {
      margin-right: 10px;
    }

    /* Pagination styles */
    .pagination {
      justify-content: center;
    }
  </style>
</head>
<body>

  <!-- Side Navigation Bar -->
  <div class="side-nav">
    <h3 class="text-white">Menu</h3>
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

  <!-- Content Area -->
  <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Brand Management</a>
      </div>
    </nav>

    <!-- Content Section -->
    <div class="container">
      <h2 class="text-center text-success mb-4">Manage Your Brands</h2>

      <!-- Button to Create New Brand -->
      <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#createBrandModal">Create New Brand</button>

      <!-- Brand Table -->
     
<div class="card">
    <div class="card-header">All Brands</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($brands as $brand): ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($brand['id']) ?></th>
                    <td><?= htmlspecialchars($brand['code']) ?></td>
                    <td><?= htmlspecialchars($brand['name']) ?></td>
                    <td>
                    
<a href="brand_management.php?edit_id=<?= $item['id'] ?>" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBrandModal">Edit</a>


          <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $brand['id'] ?>">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

  <!-- Create Brand Modal -->

<div class="modal fade" id="createBrandModal" tabindex="-1" aria-labelledby="createBrandModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createBrandModalLabel">Create New Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="createBrandForm" action="create_brand.php" method="POST">

          <div class="mb-3">
            <label for="codeName" class="form-label">Code</label>
            <input type="text" class="form-control" id="codeName" name="codeName" required>
          </div>
          <div class="mb-3">
            <label for="brandName" class="form-label">Brand Name</label>
            <input type="text" class="form-control" id="brandName" name="brandName" required>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
              <option value="">Select Status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>

          <button type="submit" class="btn btn-custom">Create Brand</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
  
  document.getElementById("createBrandForm").addEventListener("submit", function(event) {
    event.preventDefault(); // 

    // Show SweetAlert confirmation message
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you want to create this brand?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, create it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        
        this.submit();
      }
    });
  });
</script>
 


<!-- Edit Brand Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBrandForm" action="update_brand.php" method="POST">
                    <!-- Hidden input to store the brand ID -->
                    <input type="hidden" name="editBrandId" value="<?= isset($editBrandData['id']) ? $editBrandData['id'] : '' ?>">
                    
                    <!-- Brand Code Field -->
                    <div class="mb-3">
                        <label for="editBrandCode" class="form-label">Brand Code</label>
                        <input type="text" class="form-control" id="editBrandCode" name="editBrandCode" value="<?= isset($editBrandData['code']) ? htmlspecialchars($editBrandData['code']) : '' ?>" required>
                    </div>
                    
                    <!-- Brand Name Field -->
                    <div class="mb-3">
                        <label for="editBrandName" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="editBrandName" name="editBrandName" value="<?= isset($editBrandData['name']) ? htmlspecialchars($editBrandData['name']) : '' ?>" required>
                    </div>
                    
                    <!-- Brand Status Field -->
                    <div class="mb-3">
                        <label for="editBrandStatus" class="form-label">Brand Status</label>
                        <select class="form-control" id="editBrandStatus" name="editBrandStatus" required>
                            <option value="Active" <?= isset($editBrandData) && $editBrandData['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= isset($editBrandData) && $editBrandData['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-custom">Update Brand</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (isset($editBrandData)): ?>
    <script>
    window.addEventListener('load', function () {
        // Check if 'edit_id' is in the URL to show the modal
        if (window.location.search.includes("edit_id")) {
            var myModal = new bootstrap.Modal(document.getElementById('editBrandModal'));
            myModal.show();
        }
    });
</script>

<?php endif; ?>



  <!-- Footer -->
  <footer>
    &copy; 2025 Brand Management System
  </footer>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function () {
      const brandId = this.getAttribute('data-id');

      Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch('delete_brand.php?id=' + brandId)
            .then(response => response.text())
            .then(data => {
              Swal.fire('Deleted!', 'Brand has been deleted.', 'success').then(() => {
                location.reload();
              });
            })
            .catch(error => {
              Swal.fire('Error!', 'Something went wrong.', 'error');
            });
        }
      });
    });
  });
</script>

</body>
</html>
