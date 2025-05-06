<?php

include 'classes/db.php';
include 'classes/User.php';


$emailError = $passwordError = '';
$loginError = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $user = new User($conn);

    // Validate form fields
    if (empty($fullname) || empty($email) || empty($password)) {
        $loginError = 'Please fill in all fields.';
    } else {
        // Check if email already exists
        $emailExists = $user->checkEmailExists($email);

        if ($emailExists) {
            $loginError = 'Email already registered.';
        } else {
            // Encrypt password 
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Save user data into the database
            $isRegistered = $user->register($fullname, $email, $hashedPassword);

            if ($isRegistered) {
                // Redirect or display success message
                header("Location: login.php");
                exit();
            } else {
                $loginError = 'Registration failed. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | MDM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background: linear-gradient(135deg, #f0f4f4, #e8f0f1);
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      background-color: #00695c;
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: bold;
      font-size: 1.5rem;
    }

    .container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px 15px;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      padding: 30px;
      width: 100%;
      max-width: 500px;
    }

    .btn-custom {
      background-color: #26a69a;
      color: white;
    }

    .btn-custom:hover {
      background-color: #1d8a80;
    }

    .progress {
      height: 6px;
      margin-top: 5px;
    }

    .form-text {
      font-size: 0.85rem;
      color: #666;
    }

    footer {
      background-color: #00695c;
      color: #fff;
      text-align: center;
      padding: 15px 0;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MDM System</a>
  </div>
</nav>

<div class="container">
  <div class="card">
    <h3 class="text-center text-success mb-4">Create Account</h3>
    <?php if (!empty($loginError)): ?>
      <div class="alert alert-danger"><?= $loginError ?></div>
    <?php endif; ?>
    <form id="registerForm" method="POST" action="signup.php" novalidate>
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="example@example.com">
        <div class="invalid-feedback" id="emailError"></div>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <div class="form-text">
          Password must be at least 8 characters and include:
          1 uppercase letter, 1 lowercase letter, 1 number, and 1 symbol.
        </div>
        <div class="progress">
          <div class="progress-bar" id="strengthBar"></div>
        </div>
        <div class="invalid-feedback" id="passwordError"></div>
      </div>

      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required placeholder="Re-enter your password">
        <div class="invalid-feedback" id="confirmError"></div>
      </div>

      <button type="submit" class="btn btn-custom w-100">Register</button>
    </form>

    <div class="text-center mt-3 text-link">
        <a href="login.php">Already you have an account? login here</a>
      </div>
  </div>
</div>

<footer>
  &copy; 2025 Master Data Management System
</footer>

<script>
  const form = document.getElementById('registerForm');
  const email = document.getElementById('email');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirmPassword');
  const strengthBar = document.getElementById('strengthBar');

  function validateEmail(emailValue) {
    const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    return pattern.test(emailValue);
  }

  function checkPasswordStrength(pw) {
    let strength = 0;
    if (pw.length >= 8) strength += 1;
    if (/[A-Z]/.test(pw)) strength += 1;
    if (/[a-z]/.test(pw)) strength += 1;
    if (/\d/.test(pw)) strength += 1;
    if (/[@$!%*?&#]/.test(pw)) strength += 1;
    return strength;
  }

  password.addEventListener('input', () => {
    const value = password.value;
    const strength = checkPasswordStrength(value);
    strengthBar.style.width = (strength * 20) + '%';

    if (strength <= 2) {
      strengthBar.className = 'progress-bar bg-danger';
    } else if (strength <= 4) {
      strengthBar.className = 'progress-bar bg-warning';
    } else {
      strengthBar.className = 'progress-bar bg-success';
    }
  });

  form.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission by default
    
    let valid = true;

    if (!validateEmail(email.value)) {
      email.classList.add('is-invalid');
      document.getElementById('emailError').textContent = 'Invalid email format.';
      valid = false;
    } else {
      email.classList.remove('is-invalid');
      document.getElementById('emailError').textContent = '';
    }

    const passValue = password.value;
    const strength = checkPasswordStrength(passValue);
    if (strength < 5) {
      password.classList.add('is-invalid');
      document.getElementById('passwordError').textContent = 'Weak password. Follow the required format.';
      valid = false;
    } else {
      password.classList.remove('is-invalid');
      document.getElementById('passwordError').textContent = '';
    }

    if (passValue !== confirmPassword.value) {
      confirmPassword.classList.add('is-invalid');
      document.getElementById('confirmError').textContent = 'Passwords do not match.';
      valid = false;
    } else {
      confirmPassword.classList.remove('is-invalid');
      document.getElementById('confirmError').textContent = '';
    }

    if (valid) {
      // Display SweetAlert confirmation prompt
      Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to submit the registration form?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Submit',
        cancelButtonText: 'No, Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // If confirmed, submit the form
          form.submit();
        }
      });
    }
  });
</script>

</body>
</html>
