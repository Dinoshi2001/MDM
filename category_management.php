<?php
require_once 'classes/db.php';
require_once 'classes/category.php';

// Initialize Category object
$categoryObj = new Category();

// Fetch all categories
$categories = $categoryObj->getAllCategories();

// Initialize edit category data
$editCategory = null;
if (isset($_GET['edit_id'])) {
    $editId = (int) $_GET['edit_id'];
    $editCategory = $categoryObj->getCategoryById($editId);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <a class="navbar-brand" href="#">Category Management</a>
      </div>
    </nav>

    <!-- Content Section -->
    <div class="container">
      <h2 class="text-center text-success mb-4">Manage Your Categories</h2>

      <!-- Button to Create New Category -->
      <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Create New Category</button>

      <!-- Category Table -->
<div class="card">
    <div class="card-header">All Categories</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($category['id']) ?></th>
                    <td><?= htmlspecialchars($category['code']) ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td><?= htmlspecialchars($category['status']) ?></td>
                    <td>
                        
<a href="category_management.php?edit_id=<?= $category['id'] ?>" class="btn btn-primary btn-sm">
    Edit
</a>





                        <button class="btn btn-danger btn-sm btn-delete-category" data-id="<?= $category['id'] ?>">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



          


  <!-- Create Pet Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCategoryModalLabel">Create Pet Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="createCategoryForm" action="create_category.php" method="POST">
          
          <div class="mb-3">
            <label for="categoryCode" class="form-label">Category Code</label>
            <input type="text" class="form-control" id="categoryCode" name="categoryCode" required>
          </div>

          <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
          </div>

          <div class="mb-3">
            <label for="categoryStatus" class="form-label">Status</label>
            <select class="form-select" id="categoryStatus" name="categoryStatus" required>
              <option value="">Select Status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>

          <button type="submit" class="btn btn-custom">Create Category</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
 
  document.getElementById("createCategoryForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Stop default form submission

    Swal.fire({
      title: 'Are you sure?',
      text: "Do you want to create this  category?",
      icon: 'question',
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

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editCategoryForm" method="POST" action="update_category.php">
          <input type="hidden" name="id" value="<?= $editCategory['id'] ?? '' ?>">
          <div class="mb-3">
            <label>Category Code</label>
            <input type="text" class="form-control" name="code" value="<?= $editCategory['code'] ?? '' ?>" required>
          </div>
          <div class="mb-3">
            <label>Category Name</label>
            <input type="text" class="form-control" name="name" value="<?= $editCategory['name'] ?? '' ?>" required>
          </div>
          <div class="mb-3">
            <label>Status</label>
            <select class="form-control" name="status" required>
              <option value="Active" <?= (isset($editCategory['status']) && $editCategory['status'] == 'Active') ? 'selected' : '' ?>>Active</option>
              <option value="Inactive" <?= (isset($editCategory['status']) && $editCategory['status'] == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>
          <button type="button" class="btn btn-primary" id="confirmButton">Update Category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if ($editCategory): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('load', function () {
        var myModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        myModal.show();
    });

    document.getElementById('confirmButton').addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to update the category!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if confirmed
                document.getElementById('editCategoryForm').submit();
            }
        });
    });
</script>
<?php endif; ?>

  <!-- Footer -->
  <footer>
    &copy; 2025 Category Management System
  </footer>

  <script>

document.querySelectorAll('.btn-delete-category').forEach(button => {
  button.addEventListener('click', function () {
    const categoryId = this.getAttribute('data-id');

   
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
      
        fetch('delete_category.php?id=' + categoryId)
          .then(response => response.text())
          .then(data => {
            
            Swal.fire({
              title: 'Deleted!',
              text: 'The category has been deleted successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              location.reload(); 
            });
          })
          .catch(error => {
           
            Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
          });
      }
    });
  });
});

</script>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
