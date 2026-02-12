<?php
// book_event.php
// Displays the booking form and handles event booking data submission.

// Include the database connection file
require_once 'db_connect.php';

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize and retrieve input data
    $event_type = trim($_POST['event']);
    $service_choice = trim($_POST['service']);
    $client_name = trim($_POST['name']); 
    $client_email = trim($_POST['email']);
    $client_phone = trim($_POST['phone']);
    $event_date = trim($_POST['date']);
    $booking_date = date("Y-m-d H:i:s"); // Submission timestamp

    // Basic Validation
    if (empty($client_name) || empty($client_email) || empty($event_date)) {
        $error_message = "Name, Email, and Event Date are required fields.";
    } else {
        // 2. Insert booking data using prepared statements
        $stmt = $conn->prepare("INSERT INTO bookings (event_type, service_choice, client_name, client_email, client_phone, event_date, booking_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("sssssss", $event_type, $service_choice, $client_name, $client_email, $client_phone, $event_date, $booking_date);
            
            if ($stmt->execute()) {
                $success_message = "Booking confirmed! We will contact you soon.";
            } else {
                $error_message = "Booking failed. Database error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = "Database query failed: " . $conn->error;
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Your Event</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
      /* Primary: #1F2937, Accent: #059669, Highlight: #F59E0B */
      :root {
        --color-primary: #1F2937;
        --color-accent: #059669;
        --color-highlight: #F59E0B;
        --color-bg-subtle: #F0FFF4;
      }
      
      body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, var(--color-bg-subtle), #E5E7EB);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }

      .form-container {
        background: #fff;
        padding: 35px;
        border-radius: 15px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.25);
        width: 420px;
        max-width: 90%;
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
      }
      .success {
          background-color: #d1fae5;
          color: #059669;
      }


      .form-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: var(--color-primary); /* Charcoal Header */
        font-weight: 700;
      }

      label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 15px;
      }

      input,
      select {
        width: 100%;
        padding: 12px;
        margin-bottom: 18px;
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        transition: 0.3s;
        font-size: 15px;
      }

      input:focus,
      select:focus {
        border-color: var(--color-highlight); /* Soft Gold Focus */
        box-shadow: 0 0 5px rgba(245, 158, 11, 0.4);
      }

      button {
        width: 100%;
        padding: 14px;
        background: var(--color-accent); /* Sage Green CTA */
        border: none;
        color: white;
        font-size: 17px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 10px;
        transition: background 0.3s, transform 0.1s;
        box-shadow: 0 6px 15px rgba(5, 150, 105, 0.4);
      }

      button:hover {
        background: #047857; /* Darker Sage Green */
        transform: translateY(-1px);
      }
  </style>
</head>

<body>
  <div class="form-container">
    <h2>Book Your Event</h2>
    <?php if ($error_message): ?>
        <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php elseif ($success_message): ?>
        <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
    <?php endif; ?>
    <form action="book_event.php" method="POST"> 
        <label for="event">Event</label>
      <select id="event" name="event" required>
        <option value="">-- Select Event --</option>
        <option value="wedding">Wedding</option>
        <option value="birthday">Birthday Party</option>
        <option value="seminar">Seminar</option>
        <option value="engagement">Engagement</option>
      </select>

      <label for="service">Choose Service</label>
      <select id="service" name="service" required>
        <option value="">-- Select Service --</option>
        <option value="Balloon decor">Balloon decor</option>
        <option value="Flower decor">Flower decor</option>
        <option value="Lighting decor">Lighting decor</option>
      </select>

      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="phone">Phone</label>
      <input type="tel" id="phone" name="phone" placeholder="Enter your phone" required>

      <label for="date">Event Date</label>
      <input type="date" id="date" name="date" required>

      <button type="submit">Confirm Booking</button>
    </form>
  </div>
</body>

</html>