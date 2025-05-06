<?php
require_once 'classes/category.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    $category = new Category();
    $success = $category->updateCategory($id, $code, $name, $status);

    if ($success) {
        // Output SweetAlert and redirect
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Update Success</title>
            <!-- Include SweetAlert CSS & JS -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Category updated successfully!',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'category_management.php';
                }
            });
        </script>
        </body>
        </html>
        <?php
        exit();
    } else {
        // On failure
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Update Failed</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Failed to update category.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        </script>
        </body>
        </html>
        <?php
        exit();
    }
} else {
    header("Location: category_management.php");
    exit();
}
?>
