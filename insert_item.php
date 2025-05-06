<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item Submission</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<?php
include_once 'classes/item.php';
include_once 'classes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['brand_id'], $_POST['category_id'], $_POST['code'], $_POST['name'], $_POST['status'])) {

        $brand_id = $_POST['brand_id'];
        $category_id = $_POST['category_id'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $status = $_POST['status'];
        $attachment = "";

        // File upload
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
            $fileTmpPath = $_FILES['attachment']['tmp_name'];
            $fileName = $_FILES['attachment']['name'];
            $uploadDir = 'uploads/';
            $filePath = $uploadDir . basename($fileName);

            if (getimagesize($fileTmpPath)) {
                if (move_uploaded_file($fileTmpPath, $filePath)) {
                    $attachment = $filePath;
                } else {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire('Error', 'Error uploading the file.', 'error');
                        });
                    </script>";
                    exit;
                }
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire('Error', 'Uploaded file is not an image.', 'error');
                    });
                </script>";
                exit;
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire('Error', 'No file uploaded or there was an upload error.', 'error');
                });
            </script>";
            exit;
        }

        
        try {
            $item = new Item();
            $result = $item->insertItem($brand_id, $category_id, $code, $name, $attachment, $status);

            if ($result) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Item created successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'item_management.php'; // <-- Change this to your target page
                        });
                    });
                </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire('Error', 'Unknown error occurred while saving the item.', 'error');
                    });
                </script>";
            }

        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            if (strpos($errorMsg, '1062 Duplicate entry') !== false) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire('Duplicate Entry', 'The item code already exists. Please use a different code.', 'error');
                    });
                </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire('Database Error', " . json_encode($errorMsg) . ", 'error');
                    });
                </script>";
            }
        }

    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire('Warning', 'All form fields are required.', 'warning');
            });
        </script>";
    }
}
?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>
</html>
