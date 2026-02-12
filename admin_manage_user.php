<?php
// admin_manage_user.php - Handle Add and Edit User functionality

session_start();
require_once 'db_connect.php'; 

// --- SECURITY CHECK (Essential for Admin Panel) ---
// Note: You must enable the security block in admin_dashboard.php 
// for full protection. This file includes only a basic redirect.
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
// --- END SECURITY CHECK ---

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$mode = $user_id > 0 ? 'Edit' : 'Add';
$title = $mode . ' User';
$error_message = '';
$user_data = ['fullname' => '', 'email' => '', 'is_admin' => 0];

// ------------------------------------
// 1. FETCH DATA FOR EDIT MODE
// ------------------------------------
if ($mode === 'Edit') {
    $stmt = $conn->prepare("SELECT id, fullname, email, is_admin FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user_data = $result->fetch_assoc();
    } else {
        // If ID not found, redirect back to the user list
        header("Location: admin_dashboard.php?page=users&status=" . urlencode("User ID not found.") . "&type=error");
        exit();
    }
    $stmt->close();
}

// ------------------------------------
// 2. HANDLE FORM SUBMISSION (ADD/EDIT)
// ------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Password only for Add or Change Password
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    
    if (empty($fullname) || empty($email)) {
        $error_message = "Full Name and Email are required.";
    } else {
        if ($mode === 'Add') {
            // Add User Logic: Password is required
            if (empty($password)) {
                 $error_message = "Password is required for a new user.";
            } else {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (fullname, email, password_hash, is_admin) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssi", $fullname, $email, $password_hash, $is_admin);
                
                if ($stmt->execute()) {
                    header("Location: admin_dashboard.php?page=users&status=" . urlencode("User **{$fullname}** successfully added.") . "&type=success");
                    exit();
                } else {
                    $error_message = "Error adding user: " . $stmt->error;
                }
                $stmt->close();
            }

        } elseif ($mode === 'Edit') {
            // Edit User Logic
            $sql = "UPDATE users SET fullname = ?, email = ?, is_admin = ?";
            $params = "ssi";
            $values = [$fullname, $email, $is_admin];
            
            // If password is provided, update it
            if (!empty($password)) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $sql .= ", password_hash = ?";
                $params .= "s";
                $values[] = $password_hash;
            }
            
            $sql .= " WHERE id = ?";
            $params .= "i";
            $values[] = $user_id;
            
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                // Binding parameters dynamically
                $stmt->bind_param($params, ...$values);
                
                if ($stmt->execute()) {
                    header("Location: admin_dashboard.php?page=users&status=" . urlencode("User ID: **{$user_id}** successfully updated.") . "&type=success");
                    exit();
                } else {
                    $error_message = "Error updating user: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error_message = "Database Error: " . $conn->error;
            }
        }
    }
    // Update data array for form sticky values after an error
    $user_data['fullname'] = $fullname;
    $user_data['email'] = $email;
    $user_data['is_admin'] = $is_admin;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_styles.css"> <style>
        /* Minimal form styles for this example */
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; padding: 20px; }
        .container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h1 { color: #1F2937; margin-bottom: 30px; border-bottom: 2px solid #059669; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: #4B5563; }
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="password"] {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;
        }
        .form-actions { margin-top: 30px; }
        .btn-submit { padding: 10px 20px; background: #059669; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; }
        .btn-cancel { padding: 10px 20px; background: #9CA3AF; color: white; border: none; border-radius: 5px; text-decoration: none; margin-left: 10px; }
        .message.error { background-color: #fee2e2; color: #ef4444; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h1><?= $title ?></h1>

    <?php if ($error_message): ?>
        <div class="message error"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form method="POST" action="admin_manage_user.php<?= $mode === 'Edit' ? '?id=' . $user_id : '' ?>">
        
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user_data['fullname']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user_data['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password (<?= $mode === 'Edit' ? 'Leave blank to keep existing password' : 'Required for new user' ?>)</label>
            <input type="password" id="password" name="password" <?= $mode === 'Add' ? 'required' : '' ?>>
        </div>

        <div class="form-group">
            <input type="checkbox" id="is_admin" name="is_admin" value="1" <?= $user_data['is_admin'] == 1 ? 'checked' : '' ?>>
            <label for="is_admin" style="display: inline; margin-left: 10px;">Is Admin?</label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit"><?= $mode === 'Edit' ? 'Update User' : 'Add User' ?></button>
            <a href="admin_dashboard.php?page=users" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>