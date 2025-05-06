<?php
require_once 'classes/db.php';
require_once 'classes/category.php';
require_once 'classes/brand.php';
require_once 'classes/item.php';

// Initialize objects
$categoryObj = new Category();
$brandObj = new Brand();
$itemObj = new Item();

// Fetch data
$categories = $categoryObj->getActiveCategories();
$brands = $brandObj->getActiveBrands();
$items = $itemObj->getAllItems();

// Initialize edit item data
$editItem = null;
if (isset($_GET['edit_id'])) {
    $editId = (int) $_GET['edit_id'];
    $editItem = $itemObj->getItemById($editId);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Item Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <a class="navbar-brand" href="#">Item Management</a>
      </div>
    </nav>

    <!-- Content Section -->
    <div class="container">
      <h2 class="text-center text-success mb-4">Manage Your Items</h2>

      <!-- Button to Create New Item -->
      <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#createItemModal">Create New Item</button>



      <!-- Create Item Modal -->

<div class="modal fade" id="createItemModal" tabindex="-1" aria-labelledby="createItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createItemModalLabel">Create New Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="createItemForm" method="POST" action="insert_item.php" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="itemBrand" class="form-label">Brand</label>
            <select class="form-select" id="itemBrand" name="brand_id" required>
              <option selected disabled value="">Select brand</option>
              <?php
              foreach ($brands as $brand) {
                  echo "<option value='" . $brand['id'] . "'>" . $brand['name'] . "</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="itemCategory" class="form-label">Category</label>
            <select class="form-select" id="itemCategory" name="category_id" required>
              <option selected disabled value="">Select category</option>
              <?php
              foreach ($categories as $category) {
                  echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="itemCode" class="form-label">Code</label>
            <input type="text" class="form-control" id="itemCode" name="code" required>
          </div>

          <div class="mb-3">
            <label for="itemName" class="form-label">Name</label>
            <input type="text" class="form-control" id="itemName" name="name" required>
          </div>

          <div class="mb-3">
            <label for="itemAttachment" class="form-label">Attachment (Image)</label>
            <input type="file" class="form-control" id="itemAttachment" name="attachment" accept="image/*" required>
          </div>

          <div class="mb-3">
            <label for="itemStatus" class="form-label">Status</label>
            <select class="form-select" id="itemStatus" name="status" required>
              <option selected disabled value="">Select status</option>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>

          <button type="submit" class="btn btn-custom">Create Item</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('createItemForm');

  form.addEventListener('submit', function (e) {
    e.preventDefault(); // Stop the default form submission

    Swal.fire({
      title: 'Are you sure?',
      text: 'Do you want to create this item?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, create it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit(); 
      }
    });
  });
});
</script>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Brand</th>
      <th scope="col">Category</th>
      <th scope="col">Code</th>
      <th scope="col">Name</th>
      
      <th scope="col">Attachment</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $item): ?>
      <tr>
        <th scope="row"><?= htmlspecialchars($item['id']) ?></th>
        <td><?= htmlspecialchars($item['brand']) ?></td>
        <td><?= htmlspecialchars($item['category']) ?></td>
        <td><?= htmlspecialchars($item['code']) ?></td>
        <td><?= htmlspecialchars($item['name']) ?></td>
        
        <td>
          <!-- Display Image -->
          <?php if (!empty($item['attachment'])): ?>
            <img src="<?= htmlspecialchars($item['attachment']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 100px; height: auto;">
          <?php else: ?>
            No image available
          <?php endif; ?>
        </td>
        <td>
          <span class="badge bg-<?= ($item['status'] == 'Active') ? 'success' : 'secondary' ?>">
            <?= htmlspecialchars($item['status']) ?>
          </span>
        </td>
        <td>
<a href="?edit_id=<?= $item['id'] ?>" class="btn btn-primary btn-sm">Edit</a>










          
          <button class="btn btn-danger btn-sm btn-delete" onclick="deleteItem(<?= $item['id'] ?>)">Delete</button>


        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script>
function deleteItem(itemId) {
   
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            
            fetch('delete_item.php', {
                method: 'POST',
                body: JSON.stringify({ id: itemId }),  
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json()) 
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire(
                        'Deleted!',
                        'The item has been deleted.',
                        'success'
                    ).then(() => {
                        
                        const row = document.querySelector(`tr[data-id="${itemId}"]`);
                        if (row) {
                            row.remove();
                        }
                    });
                } else {
                    
                    Swal.fire(
                        'Error!',
                        'There was a problem deleting the item.',
                        'error'
                    );
                }
            })
            .catch(error => {
              
                Swal.fire(
                    'Error!',
                    'Something went wrong.',
                    'error'
                );
            });
        }
    });
}


</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('createItemForm');

  form.addEventListener('submit', function (e) {
    e.preventDefault(); 

    Swal.fire({
      title: 'Are you sure?',
      text: 'Do you want to create this item?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, create it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit(); 
      }
    });
  });
});
</script>

 
<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="update_item.php" enctype="multipart/form-data">

          <!-- Hidden field for item id -->
          <div class="mb-3">
            <label for="editItemId" class="form-label">Id</label>
            <input type="text" name="item_id" class="form-control" value="<?= $editItem['id'] ?? '' ?>" readonly>
          </div>

          <!-- Brand selection -->
          <div class="mb-3">
            <label for="editBrand" class="form-label">Brand</label>
            <select name="brand_id" class="form-select" required>
              <option value="">Select Brand</option>
              <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['id'] ?>" <?= ($editItem && $editItem['brand_id'] == $brand['id']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($brand['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Category selection -->
          <div class="mb-3">
            <label for="editCategory" class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
              <option value="">Select Category</option>
              <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= ($editItem && $editItem['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($cat['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Code input -->
          <div class="mb-3">
            <label for="editCode" class="form-label">Code</label>
            <input type="text" name="code" class="form-control" value="<?= $editItem['code'] ?? '' ?>" required>
          </div>

          <!-- Name input -->
          <div class="mb-3">
            <label for="editName" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $editItem['name'] ?? '' ?>" required>
          </div>

          


          <!-- Status selection -->
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="">Select Status</option>
              <option value="Active" <?= (isset($editItem['status']) && $editItem['status'] == 'Active') ? 'selected' : '' ?>>Active</option>
              <option value="Inactive" <?= (isset($editItem['status']) && $editItem['status'] == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-success">Update Item</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if ($editItem): ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var editModal = new bootstrap.Modal(document.getElementById('editItemModal'));
    editModal.show();
  });
</script>
<?php endif; ?>



<?php if (isset($_GET['message'])): ?>
      <script>
        <?php if ($_GET['message'] === 'success'): ?>
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Item updated successfully.',
            confirmButtonColor: '#3085d6'
          });
        <?php elseif ($_GET['message'] === 'error'): ?>
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to update item.',
            confirmButtonColor: '#d33'
          });
        <?php endif; ?>
      </script>
    <?php endif; ?>
  <!-- Footer -->
  <footer>
    &copy; 2025 Item Management System
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
