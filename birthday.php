<?php
// birthday.php - All HTML and CSS for the Birthday Party page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Birthday Party | EventHub</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    /* New Reliable Palette: 
       Primary: #1e3a8a (Dark Navy)
       Accent: #06b6d4 (Aqua Blue)
       Background: #f9fafb (Off-White)
    */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body { 
        margin: 0; 
        font-family: 'Poppins', sans-serif; 
        background: #1F2937; 
        color: #1f2937; /* Dark text */
    }

/* Navigation Bar */
    nav {
      width: 100%;
      background: var(--color-primary); /* Charcoal */
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .nav-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 20px;
    }

    .logo {
      color: white;
      font-size: 32px;
      font-weight: 800;
      letter-spacing: -0.5px;
    }

    .nav-menu {
      display: flex;
      list-style: none;
    }

    .nav-item > a {
      color: white;
      text-decoration: none;
      padding: 18px 15px;
      display: block;
      font-weight: 500;
      transition: background 0.2s;
      border-radius: 4px;
    }

    .nav-item > a:hover {
      background: rgba(255,255,255,0.15);
    }

    .dropdown {
      display: none;
      position: absolute;
      background: white;
      min-width: 180px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      border-radius: 6px;
      z-index: 20;
      overflow: hidden;
    }

    .dropdown a {
      color: var(--color-text-dark);
      padding: 12px 18px;
      display: block;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.2s;
    }

    .dropdown a:hover {
      background: #F0FFF4; /* Very light green hover */
      color: var(--color-accent);
    }

    .nav-item:hover .dropdown {
      display: block;
    }

    










    /* --- Hero Section --- */
    .hero {
      height: 600px; 
      background: url('images/birthday1.jpg') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      position: relative;
    }
    
    .hero::before { 
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5); 
    }
    
    .hero-content {
      position: relative;
      z-index: 1;
      color: white; 
    }
    .hero h1 {
      font-size: 3.8rem; 
      margin-bottom: 25px;
      font-weight: 800;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.7);
    }
    .btn {
      background: #059669; /* Aqua Blue Accent */
      color: white;
      padding: 16px 40px; 
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-size: 1.1rem;
      font-weight: 700;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s, transform 0.1s;
      box-shadow: 0 8px 20px rgba(6, 182, 212, 0.4);
    }
    .btn:hover { 
        background: #0891b2; 
        transform: translateY(-2px);
    }

    /* --- About Us Section (Original Structure) --- */
    .about-us {
      display: flex;
      justify-content: center;
      padding: 70px 20px;
      background: white; 
    }

    .about-box {
      max-width: 900px;
      padding: 40px 50px;
      background: #f0f7ff; /* Very light blue tint background */
      border-radius: 18px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      text-align: center;
      border: 1px solid #e0e7ff;
    }

    .about-box h2 {
      color: #1e3a8a; /* Dark Navy Primary color */
      margin-bottom: 20px;
      font-size: 2.5rem;
      font-weight: 800;
    }

    .about-box p {
      font-size: 1rem;
      color: #4b5563;
      line-height: 1.7;
    }
  
    /* --- Services - Enhanced Grid (Using simple colors) --- */
    .services {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      padding: 50px 20px;
      background: #eff6ff; /* Lightest Blue Background */
    }
    .service {
      background: #ffffff;
      text-align: center;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      font-weight: 600;
      color: #1f2937;
      border-bottom: 4px solid #06b6d4; /* Aqua Accent Line */
      transition: transform 0.3s, box-shadow 0.3s, background 0.3s, color 0.3s;
    }
    /* Hover effect */
    .service:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15); 
        background: #1e3a8a; /* Dark Navy hover background */
        color: white; 
    }
    
    /* --- Gallery --- */
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      padding: 60px 20px;
    }
    .gallery img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }
    .gallery img:hover {
        transform: scale(1.02);
    }

    footer {
      background: #1e3a8a; /* Dark Navy Footer */
      color: white;
      text-align: center;
      padding: 30px;
      font-weight: 500;
    }
  </style>
</head>
<body>
<nav>
    <div class="nav-container">
      <div class="logo">EventHub</div>
      <ul class="nav-menu">
        <li class="nav-item"><a href="index.php">Home</a></li>
        <li class="nav-item">
          <a href="#">Events ▼</a>
          <div class="dropdown">
            <a href="birthday.php">Birthday Party</a>
            <a href="wedding.php">Wedding</a>
            <a href="engagement.php">Engagement</a>
            <a href="seminar.php">Seminar</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="#">Services ▼</a>
          <div class="dropdown">
            <a href="balloon.php">Balloon Decor</a>
            <a href="flower.php">Flower Decor</a>
            <a href="lighting.php">Light Decor</a>
          </div>
        </li>
        <li class="nav-item"><a href="#about">About Us</a></li>
        <li class="nav-item"><a href="feedback.php">Feedback</a></li>
        <li class="nav-item"><a href="contactt.php">Contact</a></li>
        <li class="nav-item"><a href="login.php">Login</a></li>
        <li class="nav-item"><a href="register.php">Sign Up</a></li>
      </ul>
    </div>
  </nav>








  <section class="hero">
    <div class="hero-content">
      <h2>Celebrate Your Dream Birthday ❤</h2>
      <a href="book_event.php" class="btn">Book Now</a>
    </div>
  </section>

  <section class="about-us">
    <div class="about-box">
      <h2>Why Book Your Birthday with Us?</h2>
      <p>
        At EventHub, we make birthdays extra special with fun, joy, and unforgettable memories. From vibrant decorations and delicious
        cakes to lively music, entertainment, and professional 
        photography—we take care of every detail to create a perfect celebration. 
      </p>
      <p>
        Celebrate your big day with happiness and style, while we turn your birthday into a magical experience that you and your loved
        ones will cherish forever.
      </p>
    </div>
  </section>

  <section class="services">
    <div class="service">🎈 Decoration</div>
    <div class="service">🎂 Cake & Catering</div>
    <div class="service">🎶 Music & DJ</div>
    <div class="service">📸 Photography & Videography</div>
  </section>

  <section class="gallery">
    <img src="images/decoration.jpg" alt="Decoration">
    <img src="images/cake1.jpg" alt="Cake">
    <img src="images/birthmusic.jpg" alt="Party Setup">
    <img src="images/gift.jpg" alt="Themed Gift Area">
  </section>
  
  <footer>
    <p>© 2025 EventHub.</p>
  </footer>

</body>
</html>