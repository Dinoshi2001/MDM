<?php
require_once 'classes/brand.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['codeName'];
    $name = $_POST['brandName'];
    $status = $_POST['status'];

    $brand = new Brand();
    $result = $brand->create($code, $name, $status);

    echo "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <title>Brand Response</title>
    </head>
    <body>";

    if ($result === true) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Brand created successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'brand_management.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'brand_management.php';
                });
              </script>";
    }

    echo "</body></html>";
}
?>
