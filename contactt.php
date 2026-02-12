<?php
// contactt.php - All HTML and CSS for the Contact Us page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EventHub - Contact Us</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* Primary: #6366F1, Accent: #F472B6 */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #F0FFF4;
      line-height: 1.6;
    }

    h1 {
      text-align: center;
      color: #1F2937; /* Primary Color */
      margin-top: 60px;
      margin-bottom: 20px;
      font-size: 40px;
      font-weight: 700;
    }

    /* Contact Info Section */
    .about-info {
      margin-top: 40px;
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
    }

    .info-box {
      background: #fff;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      width: 320px;
      transition: transform 0.3s;
      border-left: 5px solid #F472B6; /* Accent bar */
    }

    .info-box:hover {
      transform: translateY(-5px);
    }

    .info-box h3 {
      margin-bottom: 10px;
      color: #333;
      font-size: 20px;
      font-weight: 600;
    }

    .info-box p {
      font-size: 15px;
      line-height: 1.6;
      color: #555;
    }

    /* Map Section */
    .map-container {
      margin: 60px auto;
      width: 90%;
      max-width: 1000px;
      height: 450px;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    iframe {
      width: 100%;
      height: 100%;
      border: 0;
    }

    footer {
      text-align: center;
      background-color: #222;
      color: white;
      padding: 25px 0;
      margin-top: 40px;
    }

  </style>
</head>
<body>

  <h1>Get In Touch</h1>

  <div class="about-info">
    <div class="info-box">
      <h3>📍 Address</h3>
      <p>
        Rani Lake View Point, V259+RVR, GJ SH 10, Idar, Gujarat 383430,<br>
    <br>
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

  <div class="map-container">
    <iframe 
      src="https://maps.google.com/maps?q=Rani+Lake+View+Point+Idar&t=&z=14&ie=UTF8&iwloc=&output=embed" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>

  <footer>
    <p>© 2025 EventHub | All Rights Reserved</p>
  </footer>

</body>
</html>