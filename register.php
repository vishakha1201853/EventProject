<?php
// register.php
// Displays the sign-up form and handles user registration.

// Include the database connection file
require_once 'db_connect.php';

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Retrieve and validate input data
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (empty($fullname) || empty($email) || empty($password) || empty($cpassword)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $cpassword) {
        $error_message = "Passwords do not match.";
    } else {
        // 2. Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // 3. Check if email already exists
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error_message = "This email is already registered.";
        } else {
            // 4. Insert new user data
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, password_hash) VALUES (?, ?, ?)");
            
            if ($stmt) {
                $stmt->bind_param("sss", $fullname, $email, $password_hash);
                
                if ($stmt->execute()) {
                    $success_message = "Registration successful! You can now log in.";
                    // Optionally redirect
                    // header("Refresh: 2; URL=login.php"); 
                } else {
                    $error_message = "Registration failed: " . $stmt->error;
                }
                $stmt->close();
            } else {
                 $error_message = "Database error during preparation: " . $conn->error;
            }
        }
        $check_stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* New Color Palette: Primary #1F2937, Accent #059669, Highlight #F59E0B */
        body {
            font-family: 'Poppins', sans-serif;
            background: #F0FFF4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-box {
            background: #fff;
            padding: 35px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.1); 
            border: 1px solid #eee;
        }
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
        }
        .success {
            background-color: #d1fae5;
            color: #059669;
        }
        .form-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1F2937; /* Primary color */
            font-weight: 600;
        }
        .form-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-box input:focus {
            border-color: #F59E0B; /* Highlight color on focus */
            box-shadow: 0 0 5px rgba(245, 158, 11, 0.3);
        }
        .form-box button {
            width: 100%;
            padding: 12px;
            background: #059669; /* Sage Green Accent button color */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            margin-top: 15px;
            transition: background 0.3s, transform 0.1s;
        }
        .form-box button:hover {
            background: #047857; /* Darker Sage Green */
            transform: translateY(-1px);
        }
        .form-box p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .form-box a {
            color: #1F2937; /* Primary link color */
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Create Account</h2>
        <?php if ($error_message): ?>
            <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php elseif ($success_message): ?>
            <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST"> 
            <input type="text" name="fullname" placeholder="Enter your name" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <input type="password" name="cpassword" placeholder="Confirm password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>