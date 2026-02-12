<?php
// flower_decor.php - All HTML and CSS for the Flower Decoration page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flower Decoration | Event Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Theme: Floral Green (#388E3C), Primary: #6366F1 */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fcf8; 
            margin: 0;
            padding: 0;
        }
        header {
            background:#1F2937; /* Darker Green Theme Color */
            color: white;
            padding: 30px 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        header h1 {
            font-size: 2.5rem;
            margin-bottom: 5px;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 30px;
            text-align: center;
        }
        .main-img {
            width: 50%;
            max-width: 500px;
            border-radius: 15px;
            margin: 0 auto 30px;
            display: block;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            grid-column: 1 / -1; 
        }
        .package {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            padding: 30px;
            text-align: left;
            border-top: 5px solid #388E3C; /* Green Accent */
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .package:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .package h2 {
            color: #6366F1; /* Primary color for heading */
            margin-top: 0;
            font-size: 1.8rem;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .price {
            font-size: 2.2rem;
            font-weight: 700;
            color: #388E3C; /* Green Theme color for price */
            margin-bottom: 20px;
        }
        ul {
            margin: 15px 0 25px;
            padding-left: 0;
            list-style: none;
        }
        ul li {
            padding: 8px 0;
            color: #444;
            border-bottom: 1px dashed #eee;
            text-indent: -1.5em; 
            padding-left: 1.5em;
        }
        ul li::before {
            content: "🌿"; /* Floral emoji for list item */
            margin-right: 10px;
            font-size: 0.9em;
        }
        .book-btn {
            display: inline-block;
            background: #388E3C; 
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 15px;
            font-weight: 600;
            transition: background 0.3s, transform 0.1s;
        }
        .book-btn:hover {
            background: #2E7D32;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<header>
    <h1>Flower Decoration Services</h1>
    <p>Elegant floral designs to make your events special and memorable.</p>
</header>

<div class="container">

    <img src="images/flower.jpg" alt="Flower Decoration" class="main-img">

    <div class="package">
        <h2>🌸 Basic Flower Decor</h2>
        <p class="price">₹3,000</p>
        <ul>
            <li>Stage Flower Garland</li>
            <li>Entry Gate with Flowers</li>
            <li>Basic Table Centerpieces</li>
        </ul>
        <a href="book_event.php" class="book-btn">Book Now</a>
    </div>

    <div class="package">
        <h2>💐 Premium Flower Decor</h2>
        <p class="price">₹7,500</p>
        <ul>
            <li>Floral Stage Backdrop</li>
            <li>Designer Flower Entry Arch</li>
            <li>Fresh Flower Bouquets & Table Decor</li>
        </ul>
        <a href="book_event.php" class="book-btn">Book Now</a>
    </div>

    <div class="package">
        <h2>🌺 Luxury Flower Decor</h2>
        <p class="price">₹15,000</p>
        <ul>
            <li>Grand Stage Floral Theme</li>
            <li>Flower Walls & Hanging Decor</li>
            <li>Exotic Flowers & Customized Theme Design</li>
        </ul>
        <a href="book_event.php" class="book-btn">Book Now</a>
    </div>

</div>

</body>
</html>