<?php
// feedback.php
// Displays the feedback form and handles feedback data submission.
require_once 'db_connect.php';

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize and retrieve input data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $city = trim($_POST['city']);
    $fb_date = trim($_POST['date']);
    $fb_type = trim($_POST['type']);
    $comments = trim($_POST['comments']);

    // Basic Validation
    if (empty($name) || empty($email) || empty($comments)) {
        $error_message = "Name, Email, and Comments are required fields.";
    } else {
        // 2. Insert feedback data using prepared statements
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, phone, city, fb_date, fb_type, comments) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("sssssss", $name, $email, $phone, $city, $fb_date, $fb_type, $comments);
            
            if ($stmt->execute()) {
                $success_message = "Thank you! Your feedback has been successfully submitted.";
            } else {
                $error_message = "Submission failed. Database error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = "Database query failed: " . $conn->error;
        }
    }
}
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Feedback Form</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    /* Primary: #1F2937, Accent: #059669, Highlight: #F59E0B */
    :root {
        --color-primary: #1F2937;
        --color-accent: #059669;
        --color-highlight: #F59E0B;
    }
    body{
        font-family: 'Poppins', sans-serif;
        background: #F0FFF4; /* Light BG */
        margin:0;
        padding:0;
    }
    .banner{
        width:100%;
        height:200px;
        background:url('feedback.jpg') center/cover no-repeat;
        display:flex;align-items:center;justify-content:center;
        position: relative;
    }
    .banner::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.3);
    }
    .banner h1 {
        color: white;
        z-index: 1;
        font-size: 40px;
        text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
    }
    .container{
        max-width:700px;
        margin:30px auto 60px;
        background:#fff;
        padding:35px;
        border-radius: 15px;
        box-shadow:0 8px 25px rgba(0,0,0,0.1);
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
    h1{
        margin-top:0;
        font-size:30px;
        color: var(--color-primary); /* Charcoal Header */
        text-align: center;
        margin-bottom: 10px;
    }
    p.lead{
        color:#666;
        margin-bottom:25px;
        text-align: center;
        font-size: 16px;
    }
    label{
        display:block;
        margin:15px 0 6px;
        font-weight:600;
        color: #333;
    }
    input,textarea{
        width:100%;
        padding:12px;
        border:1px solid #ddd;
        border-radius:8px;
        font-size:15px;
        box-sizing:border-box;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    input:focus, textarea:focus {
        border-color: var(--color-highlight); /* Soft Gold Focus */
        box-shadow: 0 0 5px rgba(245, 158, 11, 0.4);
        outline: none;
    }
    textarea{min-height:100px;resize:vertical;}
    .radio-group label{
        display: inline-block;
        margin-right: 20px;
        font-weight: 400;
        cursor: pointer;
    }
    .submit-btn{
        margin-top:25px;
        width: 100%;
        padding:14px;
        background: var(--color-accent); /* Sage Green CTA */
        color:white;
        border:none;
        border-radius:8px;
        cursor:pointer;
        font-size:17px;
        font-weight: 600;
        transition: background 0.3s, transform 0.1s;
        box-shadow: 0 6px 15px rgba(5, 150, 105, 0.4);
    }
    .submit-btn:hover {
        background: #047857;
        transform: translateY(-1px);
    }
    
    footer { 
        background: var(--color-primary); 
        color: white; 
        text-align: center; 
        padding: 20px; 
    }
</style>
</head>
<body>

<div class="banner">
    <h1>FEEDBACK</h1>
</div>

<div class="container">
    <h1>Share Your Thoughts</h1>
    <p class="lead">We value your opinion. Please share your suggestions or concerns so we can serve you better!</p>

    <?php if ($error_message): ?>
        <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php elseif ($success_message): ?>
        <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
    <?php endif; ?>

    <form method="post" action="feedback.php">
        <label>Name</label>
        <input type="text" name="name" placeholder="Your Name" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="you@example.com" required>

        <label>Phone</label>
        <input type="text" name="phone" placeholder="Phone Number">

        <label>City</label>
        <input type="text" name="city" placeholder="Your City">

        <label>Date</label>
        <input type="date" name="date">

        <label>Feedback Type</label>
        <div class="radio-group">
            <label><input type="radio" name="type" value="Comments" checked> Comments</label>
            <label><input type="radio" name="type" value="Suggestions"> Suggestions</label>
            <label><input type="radio" name="type" value="Questions"> Questions</label>
        </div>

        <label>Comments</label>
        <textarea name="comments" placeholder="Write your feedback..." required></textarea>

        <button type="submit" class="submit-btn">Submit Feedback</button>
    </form>
</div>

<footer>
    <p>© 2025 EventHub.</p>
</footer>

</body>
</html>