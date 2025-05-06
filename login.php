<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Master Data Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #f0f4f4, #e8f0f1);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      background-color: #00695c;
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
      color: #ffffff !important;
    }

    .login-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 15px;
    }

    .login-card {
      background-color: #ffffff;
      border: none;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }

    .login-card h3 {
      margin-bottom: 25px;
      color: #00695c;
      font-weight: 600;
    }

    footer {
      background-color: #00695c;
      color: #ffffff;
      padding: 15px 0;
      text-align: center;
      font-size: 0.9rem;
    }

    .form-control:focus {
      border-color: #26a69a;
      box-shadow: 0 0 0 0.2rem rgba(38, 166, 154, 0.25);
    }

    .btn-custom {
      background-color: #26a69a;
      color: #fff;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #1d8a80;
    }

    .text-link {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">MDM System</a>
    </div>
  </nav>

  <!-- Login Form -->
  <!-- Login Form -->
<div class="login-container">
  <div class="login-card">
    <h3 class="text-center">Login</h3>
    <form action="login_process.php" method="POST"> <!-- Set action to login_handler.php -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn btn-custom w-100">Login</button>
      <div class="text-center mt-3 text-link">
        <a href="signin.php">Don't have an account? Register here</a>
      </div>
    </form>
  </div>
</div>


  <!-- Footer -->
  <footer>
    &copy; 2025 Master Data Management System. All rights reserved.
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
