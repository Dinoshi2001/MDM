<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

</body>
</html>

<?php
require_once 'classes/db.php';
require_once 'classes/User.php';


$db = (new db())->connect();


$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if ($user->checkEmailExists($email)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Email Already Exists',
                text: 'This email is already registered. Please use a different one.',
            }).then(function() {
                window.location = 'signin.php'; // Redirect to signup.php after error
            });
        </script>";
    } else {
        
        $isRegistered = $user->register($name, $email, $password);
        if ($isRegistered) {
            
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: 'You have successfully registered!',
                }).then(function() {
                    window.location = 'signin.php'; // Redirect to signup.php after success
                });
            </script>";
        } else {
          
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong. Please try again later.',
                }).then(function() {
                    window.location = 'signin.php'; // Redirect to signup.php after error
                });
            </script>";
        }
    }
}
?>
