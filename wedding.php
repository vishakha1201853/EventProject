<?php
// wedding.php - All HTML and CSS for the Wedding Celebration page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wedding Celebration | EventHub</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>


* {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Primary: #6366F1, Accent: #F472B6 */
    body { margin: 0; font-family: 'Poppins', sans-serif; background: #1f2937; }

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










    /* Hero Section */
    .hero {
      height: 650px;
      background: url('images/wedding.jpg') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
      position: relative;
    }
    .hero::after {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5); /* dark overlay for contrast */
    }
    .hero-content {
      position: relative;
      z-index: 1;
    }
    .hero h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      font-weight: 700;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
    }
    
    /* Buttons */
    .btn {
      background: #059669; /* Accent Color */
      color: white;
      padding: 14px 35px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-size: 1.1rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s, transform 0.1s;
      box-shadow: 0 4px 10px rgba(244, 114, 182, 0.4);
    }
    .btn:hover { 
        background: #E55C9C; 
        transform: translateY(-2px);
    }

    /* About Us */
     .about-us {
        display: flex;
        justify-content: center;
        padding: 60px 20px;
        background: #fff;
    }

    .about-box {
        max-width: 900px;
        padding: 40px;
        background: #FEEFF4;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        text-align: center;
        border: 1px solid #eee;
    }

    .about-box h2 {
        color: #8c186f;
        margin-bottom: 20px;
        font-size: 2.2rem;
        font-weight: 700;
    }

    .about-box p {
        font-size: 1rem;
        color: #444;
        line-height: 1.7;
    }


    /* Services - Modern Grid */
    .services {
      display: grid; 
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
      gap: 20px;
      padding: 40px 20px;
      background: #FEEFF4; /* Very light pink background */
    }
    .service {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      font-weight: 600;
      color: #333;
      border-bottom: 4px solid #F472B6; 
      transition: transform 0.3s;
    }
    .service:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    /* Gallery */
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
      gap: 20px;
      padding: 50px 20px;
    }
    .gallery img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }
    .gallery img:hover { transform: scale(1.02); }


    footer {
      background: #222;
      color: white;
      text-align: center;
      padding: 20px;
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
      <h2>Celebrate Your Dream Wedding 💍❤</h2>
      <a href="book_event.php" class="btn">Book Now</a>
    
    </div>
  </section>

  <section class="about-us">
  <div class="about-box">
    <h2>A Lifetime of Memories</h2>
    <p>
      At EventHub, we turn your wedding dreams into reality with elegance and grandeur. From stunning stage décor and elegant
       floral arrangements to delicious cuisine, live music, joyful dance, and professional photography—we manage every detail with perfection.
    </p>
    <p>
        Celebrate the beginning of your forever journey with style, love, and unforgettable moments, while we create a magical experience for you and your guests.
    </p>
  </div>
</section>

  <section class="services">
    <div class="service">💐 Decoration & Flowers</div>
    <div class="service">🍽 Gourmet Catering</div>
    <div class="service">🎶 Live Music & Entertainment</div>
    <div class="service">📸 Photography & Videography</div>
    <div class="service">💃 Stage & Lighting Design</div>
  </section>

  <section class="gallery">
    <img src="images/weddingdecor.jpg" alt="Wedding Decoration">
    <img src="images/weddingcatring.jpg" alt="Wedding Catering">
    <img src="images/weddinglivemusic.jpg" alt="Wedding Live Music">
    <img src="images/weddingphotography.jpg" alt="Wedding Photography">
  </section>

  

  <footer>
    <p>© 2025 EventHub | All Rights Reserved</p>
  </footer>

</body>
</html>