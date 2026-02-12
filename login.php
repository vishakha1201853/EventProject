<?php
// login.php - Final Working Version (User and Admin)

session_start();
// Zaroori: Aapki db_connect.php file isi folder mein honi chahiye.
require_once 'db_connect.php';

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 1. Get and sanitize input
 $email = strtolower(trim($conn->real_escape_string($_POST['email'])));
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    $error_message = "Email and password are required.";
  } else {
    // 2. Retrieve user data (FIX: Added is_admin to SELECT query)
    $stmt = $conn->prepare("SELECT id, fullname, password_hash, is_admin FROM users WHERE email = ?");

    if ($stmt) {
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($user = $result->fetch_assoc()) {
        // 3. Verify password
        if (password_verify($password, $user['password_hash'])) {

          // Password is correct, set session variables
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['user_name'] = $user['fullname'];
          $_SESSION['logged_in'] = true;

          // 4. Admin Check and Redirect
          if ($user['is_admin'] == 1) {
            header("Location: admin_dashboard.php");
            exit();
          } else {
            // Normal user redirect
            header("Location: index.php");
            exit();
          }

        } else {
          // Password verification failed
          $error_message = "Invalid email or password.";
        }
      } else {
        // User not found
        $error_message = "Invalid email or password.";
      }

      $stmt->close();
    } else {
      // Database error check failed
      $error_message = "Database query failed: " . $conn->error;
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  
  <meta charset="utf-8" />
  
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* New Color Palette: Primary #1F2937, Accent #059669, Highlight #F59E0B */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --color-primary: #1F2937;
      --color-accent: #059669;
      --color-highlight: #F59E0B;
    }

    body {
      min-height: 100vh;
      display: grid;
      place-items: center;
      font-family: 'Poppins', sans-serif;
      background: #F0FFF4;
      /* Soft Background */
      padding: 24px;
    }

    /* Card */
    .card {
      width: 420px;
      max-width: calc(100% - 40px);
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      padding: 35px 40px;
      border: 1px solid #eee;
    }

    /* Message Boxes */
    .message {
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      font-weight: 600;
      text-align: center;
    }

    .error {
      background-color: #fee2e2;
      color: #ef4444;
      border: 1px solid #fca5a5;
    }

    .success {
      background-color: #d1fae5;
      color: #059669;
      border: 1px solid #a7f3d0;
    }

    /* Title */
    .card h1 {
      text-align: center;
      font-size: 30px;
      margin-bottom: 25px;
      font-weight: 700;
      color: var(--color-primary);
      /* Charcoal */
    }

    /* Form layout */
    form .field {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-size: 15px;
      color: #333;
      margin-bottom: 8px;
      font-weight: 600;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 14px;
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 15px;
      color: #222;
      background: #fff;
      outline: none;
      transition: box-shadow .12s ease, border-color .12s ease;
    }

    input:focus {
      border-color: var(--color-highlight);
      /* Soft Gold Focus */
      box-shadow: 0 0 8px rgba(245, 158, 11, 0.3);
    }

    .actions {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .btn {
      padding: 12px 35px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: 600;
      font-size: 16px;
      background: var(--color-accent);
      /* Sage Green Accent Color */
      color: white;
      box-shadow: 0 6px 16px rgba(5, 150, 105, 0.3);
      transition: background 0.2s, transform .08s ease;
    }

    .btn:hover {
      background: #047857;
    }

    .btn:active {
      transform: translateY(1px);
    }

    /* bottom small text */
    .card .footer {
      text-align: center;
      font-size: 14px;
      color: #666;
      margin-top: 10px;
    }

    .card .footer a {
      color: var(--color-primary);
      /* Link Color */
      text-decoration: none;
      margin-left: 6px;
      font-weight: 600;
      transition: color 0.2s;
    }
  </style>
</head>

<body>

  <main class="card" role="main" aria-labelledby="login-title">
    <h1 id="login-title">Login</h1>

    <?php
    if ($error_message) {
      echo '<div class="message error">' . htmlspecialchars($error_message) . '</div>';
    }
    if ($success_message) {
      echo '<div class="message success">' . htmlspecialchars($success_message) . '</div>';
    }
    ?>

    <form id="loginForm" action="login.php" method="POST" novalidate>
      <div class="field">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="Enter your email" required />
        </div>

      <div class="field">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Enter your password" required
          minlength="6" />
        </div>

      <div class="actions">
        <button type="submit" class="btn" aria-label="Login">Login</button>
        </div>

      <div class="footer">
        Don't have an account?
        <a href="register.php">Sign Up</a>
        </div>
      </form>
    
  </main>

</body>

</html>