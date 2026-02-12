<?php
// balloon_decor.php - All HTML and CSS for the Balloon Decoration page
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Balloon Decoration | Event Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Primary: #6366F1 (Indigo), Accent: #F472B6 (Pink) */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f4f8;
            /* Softer background */
            margin: 0;
            padding: 0;
        }

        header {

            background: #1F2937;
            color: #ffffff;
            padding: 30px 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            /* Responsive grid */
            gap: 30px;
            text-align: center;
        }

        .main-img {
            width: 50%;
            max-width: 500px;
            border-radius: 15px;
            margin: 0 auto 30px;
            display: block;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            grid-column: 1 / -1;
            /* Span across all columns */
        }

        .package {
            background: white;
            border-radius: 15px;
            /* Modern, subtle shadow */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: left;
            border-top: 5px solid #F472B6;
            /* Accent design element */
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .package:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .package h2 {
            color: #6366F1;
            /* Primary color for heading */
            margin-top: 0;
            font-size: 1.8rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .price {
            font-size: 2.2rem;
            font-weight: 700;
            color: #F472B6;
            /* Accent color for price */
            margin-bottom: 20px;
        }

        ul {
            margin: 15px 0 25px;
            padding-left: 0;
            list-style: none;
            /* Remove default list style */
        }

        ul li {
            padding: 8px 0;
            color: #444;
            border-bottom: 1px dashed #eee;
            /* Simple checkmark style */
            text-indent: -1.5em;
            padding-left: 1.5em;
        }

        ul li::before {
            content: "✅";
            margin-right: 10px;
            color: #4CAF50;
            font-size: 0.9em;
        }

        .book-btn {
            display: inline-block;
            background: #F472B6;
            /* Accent color */
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 15px;
            font-weight: 600;
            transition: background 0.3s, transform 0.1s;
        }

        .book-btn:hover {
            background: #E55C9C;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>

    <header>
        <h1>Balloon Decoration Services</h1>
        <p>Make your event colorful & memorable with our modern balloon designs!</p>
    </header>

    <div class="container">
        <img src="images/balloon.jpg" alt="Balloon Decoration" class="main-img">

        <div class="package">
            <h2>🎈 Basic Decor</h2>
            <p class="price">₹2,000</p>
            <ul>
                <li>50 Balloons (2 Colors)</li>
                <li>Simple Balloon Arch</li>
                <li>Balloon Bouquet for Stage</li>
            </ul>
            <a href="book_event.php" class="book-btn">Book Now</a>
        </div>

        <div class="package">
            <h2>✨ Premium Decor</h2>
            <p class="price">₹5,000</p>
            <ul>
                <li>150 Balloons (Multi-color)</li>
                <li>Designer Balloon Backdrop</li>
                <li>Balloon Pillars & Table Decor</li>
            </ul>
            <a href="book_event.php" class="book-btn">Book Now</a>
        </div>

        <div class="package">
            <h2>🌟 Luxury Decor</h2>
            <p class="price">₹10,000</p>
            <ul>
                <li>300 Balloons (Theme Based)</li>
                <li>Grand Balloon Arch & Stage Decor</li>
                <li>Balloon Chandelier & Entry Gate Design</li>
            </ul>
            <a href="book_event.php" class="book-btn">Book Now</a>
        </div>

    </div>

</body>

</html>