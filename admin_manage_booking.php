<?php
// admin_manage_booking.php - Handle Add and Edit Booking functionality

session_start();
require_once 'db_connect.php'; 

// --- SECURITY CHECK ---
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
// --- END SECURITY CHECK ---

$booking_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$mode = $booking_id > 0 ? 'Edit' : 'Add';
$title = $mode . ' Booking';
$error_message = '';
$booking_data = [
    'client_name' => '', 'client_email' => '', 'client_phone' => '', 
    'event_type' => '', 'service_choice' => '', 'event_date' => ''
];

// ------------------------------------
// 1. FETCH DATA FOR EDIT MODE
// ------------------------------------
if ($mode === 'Edit') {
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $booking_data = $result->fetch_assoc();
    } else {
        header("Location: admin_dashboard.php?page=bookings&status=" . urlencode("Booking ID not found.") . "&type=error");
        exit();
    }
    $stmt->close();
}

// ------------------------------------
// 2. HANDLE FORM SUBMISSION (ADD/EDIT)
// ------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = $conn->real_escape_string($_POST['client_name']);
    $client_email = $conn->real_escape_string($_POST['client_email']);
    $client_phone = $conn->real_escape_string($_POST['client_phone']);
    $event_type = $conn->real_escape_string($_POST['event_type']);
    $service_choice = $conn->real_escape_string($_POST['service_choice']);
    $event_date = $conn->real_escape_string($_POST['event_date']);

    if (empty($client_name) || empty($event_type) || empty($event_date)) {
        $error_message = "Client Name, Event Type, and Event Date are required.";
    } else {
        if ($mode === 'Add') {
            // Add Booking Logic
            $stmt = $conn->prepare("INSERT INTO bookings (client_name, client_email, client_phone, event_type, service_choice, event_date) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $client_name, $client_email, $client_phone, $event_type, $service_choice, $event_date);
            
            if ($stmt->execute()) {
                header("Location: admin_dashboard.php?page=bookings&status=" . urlencode("Booking for **{$client_name}** successfully added.") . "&type=success");
                exit();
            } else {
                $error_message = "Error adding booking: " . $stmt->error;
            }
            $stmt->close();

        } elseif ($mode === 'Edit') {
            // Edit Booking Logic
            $sql = "UPDATE bookings SET client_name = ?, client_email = ?, client_phone = ?, event_type = ?, service_choice = ?, event_date = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $client_name, $client_email, $client_phone, $event_type, $service_choice, $event_date, $booking_id);
            
            if ($stmt->execute()) {
                header("Location: admin_dashboard.php?page=bookings&status=" . urlencode("Booking ID: **{$booking_id}** successfully updated.") . "&type=success");
                exit();
            } else {
                $error_message = "Error updating booking: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    // Update data array for form sticky values after an error
    $booking_data = compact('client_name', 'client_email', 'client_phone', 'event_type', 'service_choice', 'event_date');
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
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="tel"], .form-group input[type="date"], .form-group select {
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

    <form method="POST" action="admin_manage_booking.php<?= $mode === 'Edit' ? '?id=' . $booking_id : '' ?>">
        
        <h2>Client Details</h2>
        <div class="form-group">
            <label for="client_name">Client Name *</label>
            <input type="text" id="client_name" name="client_name" value="<?= htmlspecialchars($booking_data['client_name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="client_email">Client Email</label>
            <input type="email" id="client_email" name="client_email" value="<?= htmlspecialchars($booking_data['client_email']) ?>">
        </div>
        
        <div class="form-group">
            <label for="client_phone">Client Phone</label>
            <input type="tel" id="client_phone" name="client_phone" value="<?= htmlspecialchars($booking_data['client_phone']) ?>">
        </div>
        
        <h2>Event Details</h2>
        <div class="form-group">
            <label for="event_type">Event Type *</label>
            <select id="event_type" name="event_type" required>
                <option value="">-- Select Event Type --</option>
                <?php 
                    $event_types = ['Wedding', 'Birthday Party', 'Engagement', 'Seminar', 'Other'];
                    foreach ($event_types as $type):
                ?>
                    <option value="<?= $type ?>" <?= $booking_data['event_type'] === $type ? 'selected' : '' ?>>
                        <?= $type ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="service_choice">Service Choice (e.g., Basic/Premium Decor)</label>
            <input type="text" id="service_choice" name="service_choice" value="<?= htmlspecialchars($booking_data['service_choice']) ?>">
        </div>

        <div class="form-group">
            <label for="event_date">Event Date *</label>
            <input type="date" id="event_date" name="event_date" value="<?= htmlspecialchars($booking_data['event_date']) ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit"><?= $mode === 'Edit' ? 'Update Booking' : 'Add Booking' ?></button>
            <a href="admin_dashboard.php?page=bookings" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>