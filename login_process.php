<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title></title>
</head>
<body>

</body>
</html>

<?php
session_start(); 

require_once 'classes/db.php'; 
require_once 'classes/User.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $db = new db();
    $conn = $db->connect();

   
    $user = new User($conn);

    
    if ($user->checkEmailExists($email)) {
        // Query to get the user details by email
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Fetch the user data
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the password matches
        if (password_verify($password, $userData['password'])) {
            // Login successful, set session variables
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_name'] = $userData['name'];

            // Redirect to the dashboard page
            header("Location: index.php");
            exit();
        } else {
            // Incorrect password -message box
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid password!',
                        confirmButtonText: 'Try Again'
                    }).then(function() {
                        window.location.href = 'login.php';
                    });
                  </script>";
        }
    } else {
        // Email doesn't exist - message box
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email not found!',
                    confirmButtonText: 'Try Again'
                }).then(function() {
                    window.location.href = 'login.php';
                });
              </script>";
    }
}
?>
