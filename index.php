<?php
// index.php - All HTML and CSS for the Home page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EventHub - Home | Spectacular Events Planning</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    /* New Minimal & Professional Palette: 
       Primary: #1F2937 (Charcoal/Slate)
       Accent: #059669 (Sage Green/Teal)
       Highlight: #F59E0B (Soft Gold/Yellow)
       Background: #F9FAFB (Off-White)
    */
    :root {
        --color-primary: #1F2937;
        --color-accent: #059669;
        --color-highlight: #F59E0B;
        --color-bg-light: #F9FAFB;
        --color-text-dark: #1F2937;
        --color-text-mid: #4B5563;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      line-height: 1.6;
      background-color: var(--color-bg-light);
      color: var(--color-text-dark);
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

    


/* Hero Section */
    .hero {
      width: 100%;
      padding: 80px 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #c8c8c8ff, #e6e0e1ff);
      flex-wrap: wrap;
    }

    .hero-container {
      max-width: 1200px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      flex-wrap: wrap;
    }

    .hero-text {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .circle-box {
      width: 300px;
      height: 300px;
      background: white;
      border-radius: 50%;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 25px;
      transition: transform 0.4s;
    }

    .circle-box:hover {
      transform: scale(1.05);
    }

    .circle-box h1 {
      color: #b33a62ff;
      font-size: 28px;
      margin-bottom: 10px;
    }

    .circle-box p {
      font-size: 15px;
      color: #555;
      margin-bottom: 15px;
    }

    .circle-box .btn {
      background: #e91e63;
      color: white;
      padding: 10px 25px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }

    .circle-box .btn:hover {
      background: #d81b60;
    }

    .hero-image {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .hero-image img {
      width: 200px%;
      max-width: 600px;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      
    }
 
   /* About Us Section (Rectangle) */
    .about-section {
      background: #fff;
      padding: 70px 20px;
      text-align: center;
    }

    .about-rectangle {
      background: white;
      border-radius: 15px;
      width: 80%;
      max-width: 900px;
      margin: auto;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      padding: 50px;
      text-align: center;
      transition: transform 0.4s;
    }

    .about-rectangle:hover {
      transform: scale(1.03);
    }

    .about-rectangle h2 {
      font-size: 32px;
      margin-bottom: 15px;
      color: #667eea;
    }

    .about-rectangle p {
      font-size: 16px;
      color: #444;
      line-height: 1.7;
      margin-bottom: 10px;
    }

    

    /* About Us Section */
    .about-section {
      background: white;
      padding: 80px 20px;
      text-align: center;
    }

    .about-rectangle {
      background: var(--color-bg-light);
      border-radius: 18px;
      width: 90%;
      max-width: 900px;
      margin: auto;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      padding: 60px;
      border: 1px solid #E5E7EB;
    }

    .about-rectangle h2 {
      font-size: 38px;
      margin-bottom: 20px;
      color: var(--color-primary);
      font-weight: 700;
    }

    .about-rectangle p {
      font-size: 17px;
      color: var(--color-text-mid);
      line-height: 1.8;
      margin-bottom: 10px;
    }

    /* Address Section */
    .about-info {
      margin-top: 50px;
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
    }

    .info-box {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      width: 320px;
      text-align: left;
      border-left: 6px solid var(--color-highlight); /* Soft Gold Accent */
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .info-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .info-box h3 {
      margin-bottom: 12px;
      color: var(--color-text-dark);
      font-weight: 700;
      font-size: 20px;
    }

    .info-box p {
      font-size: 16px;
      line-height: 1.7;
      color: #6B7280;
    }

    
    footer {
      background: var(--color-primary); /* Charcoal Footer */
      color: white;
      text-align: center;
      padding: 35px;
      margin-top: 60px;
      font-size: 16px;
      font-weight: 500;
    }

    @media (max-width: 992px) {
      .hero-container {
        flex-direction: column-reverse; 
        text-align: center;
      }
      .hero-text {
        text-align: center;
      }
      .hero-text h1 {
        font-size: 40px;
      }
      .hero-image img {
        max-width: 90%;
        margin-bottom: 30px;
      }
      .about-rectangle {
        padding: 40px;
      }
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
    <div class="hero-container">
      <div class="hero-text">
        <div class="circle-box">
          <h1>Welcome To EventHub</h1>
         
        </div>
      </div>
      <div class="hero-image">
        <img src="images/indeximage1.jpg" alt="EventHub Image">
      </div>
    </div>
  </section>

  <section class="about-section" id="about">
    <div class="about-rectangle">
      <h2>About EventHub</h2>
      <p>EventHub is a Baroda-based establishment working since 2018. 
      We aim at adding life to your events and making memories last forever. 
      Our platform brings all celebration-related services together to make 
      the Event Planning process easier and hassle-free for customers.</p>
      <p>We provide total solutions for every occasion. From weddings to seminars, 
      we ensure that our clients enjoy their events while we handle every detail 
      with creativity, commitment, and care.</p>
    </div>

    <div class="about-info">
      <div class="info-box">
        <h3>📍 Address</h3>
        <p>
          Rani Lake View Point, V259+RVR, GJ SH 10, Idar, Gujarat 383430,<br>
          Gujarat, India
        </p>
      </div>

      <div class="info-box">
        <h3>📞 Contact</h3>
        <p>
          +91 97734 34817<br>
          +91 76007 40060<br>
          eventhub@gmail.com
        </p>
      </div>
    </div>
  </section>
  
  <footer>
    <p>&copy; 2025 EventHub.</p>
  </footer>
</body>
</html>