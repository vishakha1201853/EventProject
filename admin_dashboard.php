<?php
// admin_dashboard.php - Main Admin Panel Structure and Overview
session_start();
require_once 'db_connect.php'; 

// --- SECURITY CHECK (Temporarily DISABLED for direct viewing) ---
// *******************************************************************
/* if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
// Check for Admin role (is_admin = 1).
$admin_check = $conn->query("SELECT is_admin FROM users WHERE id = " . $_SESSION['user_id'])->fetch_assoc();

if (!$admin_check || $admin_check['is_admin'] != 1) {
    session_destroy();
    header("Location: login.php");
    exit();
}
*/
// *******************************************************************
// --- END SECURITY CHECK ---

$page = isset($_GET['page']) ? $_GET['page'] : 'overview';
$status_message = isset($_GET['status']) ? urldecode($_GET['status']) : '';
$message_type = isset($_GET['type']) ? $_GET['type'] : '';

// Fetch Summary Data for Overview
$total_users = 0; $total_bookings = 0; $total_feedback = 0;
if ($conn) {
    $users_count = $conn->query("SELECT COUNT(*) FROM users WHERE is_admin = 0");
    if ($users_count) { $total_users = $users_count->fetch_row()[0]; }
    $bookings_count = $conn->query("SELECT COUNT(*) FROM bookings");
    if ($bookings_count) { $total_bookings = $bookings_count->fetch_row()[0]; }
    $feedback_count = $conn->query("SELECT COUNT(*) FROM feedback");
    if ($feedback_count) { $total_feedback = $feedback_count->fetch_row()[0]; }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | EventHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #1F2937; /* Dark Charcoal */
            --color-accent: #059669;  /* Sage Green */
            --color-bg-light: #F9FAFB;
            --color-danger: #ef4444;
        }
        body { margin: 0; font-family: 'Poppins', sans-serif; background-color: var(--color-bg-light); color: var(--color-primary); }
        .dashboard-container { display: flex; min-height: 100vh; }

        /* Sidebar Navigation */
        .sidebar {
            width: 250px; background: var(--color-primary); color: white; padding: 20px 0; box-shadow: 2px 0 5px rgba(0,0,0,0.2); position: fixed; height: 100%;
        }
        .sidebar h2 { text-align: center; margin-bottom: 30px; color: var(--color-accent); font-size: 1.8rem; }
        .sidebar a {
            display: block; padding: 15px 20px; text-decoration: none; color: #ccc; font-weight: 600; transition: background 0.2s, color 0.2s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: #2D3748; color: white; border-left: 5px solid var(--color-accent); padding-left: 15px;
        }

        /* Main Content */
        .content {
            flex-grow: 1; margin-left: 250px; padding: 40px;
        }
        .content h1 { color: var(--color-primary); margin-bottom: 30px; font-size: 2.5rem; }

        /* Status Messages */
        .status-message {
            padding: 15px; margin-bottom: 20px; border-radius: 8px; font-weight: 600;
        }
        .status-message.success { background-color: #d1fae5; color: var(--color-accent); border: 1px solid #a7f3d0; }
        .status-message.error { background-color: #fee2e2; color: var(--color-danger); border: 1px solid #fca5a5; }

        /* New: Create Button (For Add New ...) */
        .create-btn {
            display: inline-block; padding: 10px 20px; background: var(--color-accent); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; margin-bottom: 20px; transition: background 0.2s; border: none; cursor: pointer;
        }
        .create-btn:hover { background: #047857; }
        
        /* General Table Style */
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f4f6f8; font-weight: 700; color: var(--color-primary); }
        tr:hover { background-color: #fcfcfc; }
        
        /* Action Buttons */
        .action-btn { 
            padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; margin-right: 5px; transition: background 0.2s; text-decoration: none;
        }
        .edit-btn { background: #F59E0B; color: white; }
        .edit-btn:hover { background: #d97706; }
        .delete-btn { background: var(--color-danger); color: white; }
        .delete-btn:hover { background: #b91c1c; }

        /* Dashboard Stats Grid */
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-top: 30px;
        }
        .stat-card {
            background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-left: 5px solid var(--color-accent); transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-card .value { font-size: 2.5rem; font-weight: 700; color: var(--color-primary); margin-bottom: 5px; }
        .stat-card .label { font-size: 1rem; color: #6B7280; font-weight: 600; }
        .stat-card.users { border-left-color: #F59E0B; } 
        .stat-card.bookings { border-left-color: #059669; } 
        .stat-card.feedback { border-left-color: #ef4444; } 
    </style>
</head>
<body>

<div class="dashboard-container">
    <nav class="sidebar">
        <h2>EventHub Admin</h2>
        <a href="?page=overview" class="<?= ($page == 'overview' ? 'active' : '') ?>">Dashboard Overview</a>
        <a href="?page=users" class="<?= ($page == 'users' ? 'active' : '') ?>">Manage Users</a>
        <a href="?page=bookings" class="<?= ($page == 'bookings' ? 'active' : '') ?>">Manage Bookings</a>
        <a href="?page=feedback" class="<?= ($page == 'feedback' ? 'active' : '') ?>">Manage Feedback</a>
        <hr style="border-color: #333; margin: 15px 20px;">
        <a href="logout.php">Logout</a>
    </nav>

    <main class="content">
        <?php if ($status_message): ?>
            <div class="status-message <?= $message_type ?>">
                <?= htmlspecialchars($status_message) ?>
            </div>
        <?php endif; ?>

        <?php 
        switch ($page) {
            case 'users':
                include 'admin_users.php';
                break;
            case 'bookings':
                include 'admin_bookings.php';
                break;
            case 'feedback':
                include 'admin_feedback.php';
                break;
            case 'overview':
            default:
                echo '<h1>Dashboard Overview</h1>';
                echo '<p>Welcome back! Here is a snapshot of your EventHub platform.</p>';
                ?>
                
                <div class="stats-grid">
                    <div class="stat-card users">
                        <div class="value"><?= htmlspecialchars($total_users) ?></div>
                        <div class="label">Registered Users</div>
                    </div>

                    <div class="stat-card bookings">
                        <div class="value"><?= htmlspecialchars($total_bookings) ?></div>
                        <div class="label">Total Bookings Received</div>
                    </div>

                    <div class="stat-card feedback">
                        <div class="value"><?= htmlspecialchars($total_feedback) ?></div>
                        <div class="label">New Feedback Entries</div>
                    </div>
                </div>

                <?php
                break;
        }
        ?>

    </main>
</div>

</body>
</html>