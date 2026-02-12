<?php
// events.php - All HTML and CSS for the Event Categories page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events - EventHub</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* Primary: #6366F1, Accent: #F472B6 */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f8fa;
        margin: 0;
        padding: 0;
    }
    .events-section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
        text-align: center;
    }
    .events-section h2 {
        color: #6366F1;
        font-size: 36px;
        margin-bottom: 10px;
        font-weight: 700;
    }
    .subtext {
        font-size: 18px;
        color: #555;
        margin-bottom: 40px;
    }
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }
    .event-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        overflow: hidden;
        text-align: left;
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid #b69b9bff;
    }
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    .event-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .event-card h3 {
        color: #333;
        font-size: 24px;
        margin: 15px 20px 5px;
        font-weight: 600;
    }
    .event-card p {
        color: #666;
        padding: 0 20px 20px;
        font-size: 15px;
        line-height: 1.5;
    }
    .event-card .btn {
        display: block;
        padding: 12px 20px;
        background: #F472B6; /* Accent color */
        color: white;
        text-decoration: none;
        text-align: center;
        font-weight: 600;
        transition: background 0.3s;
        border-radius: 0 0 15px 15px; /* Only bottom corners */
        margin-top: auto; /* Push to bottom */
    }
    .event-card .btn:hover {
        background: #E55C9C;
    }
  </style>
</head>
<body>
  <section class="events-section">
    <h2>Our Event Categories</h2>
    <p class="subtext">Choose from our wide range of event categories and make your day unforgettable.</p>
    
    <div class="events-grid">
      <div class="event-card">
        <img src="birthday.jpg" alt="Birthday Event">
        <div style="padding: 0 0 20px 0;">
            <h3>Birthday Party</h3>
            <p>Celebrate your special day with themes, cakes, and unforgettable memories.</p>
            <a href="book_event.php" class="btn primary">Book Now</a>
        </div>
      </div>
      
      <div class="event-card">
        <img src="wedding.jpg" alt="Wedding Event">
        <div style="padding: 0 0 20px 0;">
            <h3>Wedding</h3>
            <p>From decoration to catering, we make your wedding a grand celebration.</p>
            <a href="book_event.php" class="btn primary">Book Now</a>
        </div>
      </div>
      
      
     
      
      <div class="event-card">
        <img src="festival.jpg" alt="Festival Event">
        <div style="padding: 0 0 20px 0;">
            <h3>Festival / Cultural</h3>
            <p>Organize cultural and festive events with vibrant themes and services.</p>
            <a href="book_event.php" class="btn primary">Book Now</a>
        </div>
      </div>
    </div>
  </section>
</body>
</html>