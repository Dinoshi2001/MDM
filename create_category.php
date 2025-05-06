<?php
require_once 'classes/category.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['categoryCode'];
    $name = $_POST['categoryName'];
    $status = $_POST['categoryStatus'];

    $category = new Category();
    $result = $category->create($code, $name, $status);

    echo "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <title>Category Response</title>
    </head>
    <body>";

    if ($result === true) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Pet category created successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'category_management.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to create category.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'category_management.php';
                });
              </script>";
    }

    echo "</body></html>";
}
?>
