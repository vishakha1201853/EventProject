<?php
// admin_bookings.php - Logic for managing event bookings

// NOTE: This file is included within admin_dashboard.php.

// ------------------------------------
// 1. DELETE BOOKING LOGIC
// ------------------------------------
if (isset($_GET['action']) && $_GET['action'] == 'delete_booking' && isset($_GET['id'])) {
    $booking_id = (int)$_GET['id'];
    
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            $status_message = "Booking ID: {$booking_id} successfully deleted.";
            $message_type = "success";
        } else {
            $status_message = "Error deleting booking: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
    } 
    // Redirect to show status message
    header("Location: admin_dashboard.php?page=bookings&status=" . urlencode($status_message) . "&type=" . $message_type);
    exit();
}

// ------------------------------------
// 2. FETCH ALL BOOKINGS 
// ------------------------------------
// Updated Query with LEFT JOIN to check if client is a registered user
$bookings_query = "
    SELECT 
        b.*, 
        u.fullname AS registered_user_name 
    FROM 
        bookings b 
    LEFT JOIN 
        users u ON b.user_id = u.id 
    ORDER BY 
        b.booking_date DESC
";

$bookings_result = $conn->query($bookings_query);

?>

<h1>Manage Bookings</h1>

<a href="admin_manage_booking.php" class="create-btn">➕ Add New Booking</a>

<?php if ($bookings_result && $bookings_result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client Details</th>
                <th>Booking Info</th>
                <th>Event Date</th>
                <th>Booking Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $bookings_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($booking['id']) ?></td>
                    <td>
                        **Name:** <?= htmlspecialchars($booking['client_name']) ?><br>
                        **Email:** <?= htmlspecialchars($booking['client_email']) ?><br>
                        **Phone:** <?= htmlspecialchars($booking['client_phone']) ?>
                        <?php if ($booking['registered_user_name']): ?>
                           <br><span style="color: #059669; font-weight: 600;">(Registered User)</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        **Event:** <?= htmlspecialchars($booking['event_type']) ?><br>
                        **Service:** <?= htmlspecialchars($booking['service_choice']) ?>
                    </td>
                    <td><?= date("d M Y", strtotime($booking['event_date'])) ?></td>
                    <td><?= date("d M Y H:i", strtotime($booking['booking_date'])) ?></td>
                    <td>
                        <a href="admin_manage_booking.php?id=<?= $booking['id'] ?>" class="action-btn edit-btn">Edit</a>
                        
                        <button onclick="confirmDelete(<?= $booking['id'] ?>, 'booking')" class="action-btn delete-btn">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No event bookings found.</p>
<?php endif; ?>

<script>
// This function is defined here for safety, used by the delete button
function confirmDelete(id, type) {
    if (confirm("Are you sure you want to delete this " + type + " record? This action cannot be undone.")) {
        window.location.href = `admin_dashboard.php?page=bookings&action=delete_${type}&id=${id}`;
    }
}
</script>