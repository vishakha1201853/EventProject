<?php
// admin_manage_feedback.php - Handle Add and Edit Feedback functionality

session_start();
require_once 'db_connect.php'; 

// --- SECURITY CHECK ---
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
// --- END SECURITY CHECK ---

$feedback_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$mode = $feedback_id > 0 ? 'Edit' : 'Add';
$title = $mode . ' Feedback';
$error_message = '';
$feedback_data = [
    'name' => '', 'email' => '', 'phone' => '', 
    'city' => '', 'fb_date' => '', 'fb_type' => '', 'comments' => ''
];

// ------------------------------------
// 1. FETCH DATA FOR EDIT MODE
// ------------------------------------
if ($mode === 'Edit') {
    $stmt = $conn->prepare("SELECT * FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $feedback_data = $result->fetch_assoc();
    } else {
        header("Location: admin_dashboard.php?page=feedback&status=" . urlencode("Feedback ID not found.") . "&type=error");
        exit();
    }
    $stmt->close();
}

// ------------------------------------
// 2. HANDLE FORM SUBMISSION (ADD/EDIT)
// ------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $city = $conn->real_escape_string($_POST['city']);
    $fb_date = $conn->real_escape_string($_POST['fb_date']);
    $fb_type = $conn->real_escape_string($_POST['fb_type']);
    $comments = $conn->real_escape_string($_POST['comments']);

    if (empty($name) || empty($comments)) {
        $error_message = "Name and Comments are required.";
    } else {
        if ($mode === 'Add') {
            // Add Feedback Logic
            $stmt = $conn->prepare("INSERT INTO feedback (name, email, phone, city, fb_date, fb_type, comments) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $email, $phone, $city, $fb_date, $fb_type, $comments);
            
            if ($stmt->execute()) {
                header("Location: admin_dashboard.php?page=feedback&status=" . urlencode("Feedback from **{$name}** successfully added.") . "&type=success");
                exit();
            } else {
                $error_message = "Error adding feedback: " . $stmt->error;
            }
            $stmt->close();

        } elseif ($mode === 'Edit') {
            // Edit Feedback Logic
            $sql = "UPDATE feedback SET name = ?, email = ?, phone = ?, city = ?, fb_date = ?, fb_type = ?, comments = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi", $name, $email, $phone, $city, $fb_date, $fb_type, $comments, $feedback_id);
            
            if ($stmt->execute()) {
                header("Location: admin_dashboard.php?page=feedback&status=" . urlencode("Feedback ID: **{$feedback_id}** successfully updated.") . "&type=success");
                exit();
            } else {
                $error_message = "Error updating feedback: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    // Update data array for form sticky values after an error
    $feedback_data = compact('name', 'email', 'phone', 'city', 'fb_date', 'fb_type', 'comments');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Shared form styles from admin_manage_user.php */
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; padding: 20px; }
        .container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h1 { color: #1F2937; margin-bottom: 30px; border-bottom: 2px solid #059669; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: #4B5563; }
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="tel"], .form-group input[type="date"], .form-group select, .form-group textarea {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;
        }
        .form-group textarea { height: 100px; resize: vertical; }
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

    <form method="POST" action="admin_manage_feedback.php<?= $mode === 'Edit' ? '?id=' . $feedback_id : '' ?>">
        
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($feedback_data['name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($feedback_data['email']) ?>">
        </div>
        
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($feedback_data['phone']) ?>">
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="<?= htmlspecialchars($feedback_data['city']) ?>">
        </div>

        <div class="form-group">
            <label for="fb_date">Feedback Date</label>
            <input type="date" id="fb_date" name="fb_date" value="<?= htmlspecialchars($feedback_data['fb_date']) ?>">
        </div>
        
        <div class="form-group">
            <label for="fb_type">Feedback Type</label>
            <select id="fb_type" name="fb_type">
                <option value="">-- Select Type --</option>
                <?php 
                    $feedback_types = ['Suggestion', 'Complaint', 'Testimonial', 'General'];
                    foreach ($feedback_types as $type):
                ?>
                    <option value="<?= $type ?>" <?= $feedback_data['fb_type'] === $type ? 'selected' : '' ?>>
                        <?= $type ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="comments">Comments *</label>
            <textarea id="comments" name="comments" required><?= htmlspecialchars($feedback_data['comments']) ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit"><?= $mode === 'Edit' ? 'Update Feedback' : 'Add Feedback' ?></button>
            <a href="admin_dashboard.php?page=feedback" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>