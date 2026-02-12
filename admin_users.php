<?php
// admin_users.php - Logic for managing registered users

// NOTE: This file is included within admin_dashboard.php.

// ------------------------------------
// 1. DELETE USER LOGIC
// ------------------------------------
if (isset($_GET['action']) && $_GET['action'] == 'delete_user' && isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    
    // Use a prepared statement for safe deletion
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $status_message = "User ID: {$user_id} successfully deleted.";
            $message_type = "success";
        } else {
            $status_message = "Error deleting user: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
    } else {
        $status_message = "Database Error (Delete): " . $conn->error;
        $message_type = "error";
    }
    // Redirect to show status message
    header("Location: admin_dashboard.php?page=users&status=" . urlencode($status_message) . "&type=" . $message_type);
    exit();
}

// ------------------------------------
// 2. FETCH ALL USERS
// ------------------------------------
// Fetching only non-admin users (is_admin = 0)
$users_result = $conn->query("SELECT id, fullname, email, reg_date, is_admin FROM users ORDER BY reg_date DESC");

?>

<h1>Manage Users</h1>

<a href="admin_manage_user.php" class="create-btn">➕ Add New User</a>

<?php if ($users_result && $users_result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registered On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $users_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['fullname']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['is_admin'] ? '<span style="color: #F59E0B; font-weight: 700;">Admin</span>' : 'User' ?></td>
                    <td><?= date("d M Y", strtotime($user['reg_date'])) ?></td>
                    <td>
                        <a href="admin_manage_user.php?id=<?= $user['id'] ?>" class="action-btn edit-btn">Edit</a>
                        
                        <button onclick="confirmDelete(<?= $user['id'] ?>, 'user')" class="action-btn delete-btn" 
                                <?= $user['is_admin'] ? 'disabled style="opacity: 0.5;" title="Cannot delete Admin"' : '' ?>>
                            Delete
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No registered users found.</p>
<?php endif; ?>

<script>
// This function is defined here for safety, used by the delete button
function confirmDelete(id, type) {
    if (confirm("Are you sure you want to delete this " + type + " record? This action cannot be undone.")) {
        // Redirect to admin_dashboard.php with delete action
        window.location.href = `admin_dashboard.php?page=users&action=delete_${type}&id=${id}`;
    }
}
</script>