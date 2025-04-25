<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JoyTrip Singapore – Travel Made Easy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include your CSS files here -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header */
        header {
            background-color: #00407a;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        /* Navigation */
        nav {
            background-color: #0269d7;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Hero Section */
        .hero {
            background-image: url('{{ asset('images/hero.webp') }}');
            background-size: cover;
            background-position: center;
            height: 400px;
            position: relative;
        }

        .hero h1 {
            color: white;
            text-align: center;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 48px;
            text-shadow: 2px 2px 5px #000;
        }

        /* Sections */
        .section {
            padding: 50px 20px;
            text-align: center;
        }

        .section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .services, .about, .contact {
            background-color: #f7f7f7;
        }

        /* Footer */
        footer {
            background-color: #00407a;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>JoyTrip Singapore</h1>
        <p>Your Trusted Travel & Visa Partner</p>
    </header>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Visa Services</a></li>
            <li><a href="#">Packages</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Explore the World With Ease</h1>
    </div>

    <!-- About Section -->
    <div class="section about">
        <h2>About JoyTrip</h2>
        <p>JoyTrip Singapore is your one-stop solution for visa processing, holiday packages, and expert travel guidance. We make your journey smooth and stress-free.</p>
        <img src="{{ asset('images/about.jpg') }}" alt="About JoyTrip">
    </div>

    <!-- Services Section -->
    <div class="section services">
        <h2>Our Visa Services</h2>
        <ul style="list-style: none; padding: 0;">
            <li>✔ Singapore Visa</li>
            <li>✔ Malaysia Visa</li>
            <li>✔ Thailand Visa</li>
            <li>✔ UAE Visa</li>
            <li>✔ Worldwide Visa Consulting</li>
        </ul>
        <img src="{{ asset('images/visa.jpg') }}" alt="Visa Services">
    </div>

    <!-- Packages Section -->
    <div class="section packages">
        <h2>Holiday & Tour Packages</h2>
        <p>Discover affordable and luxurious packages tailored for you. Travel smart with JoyTrip!</p>
        <img src="{{ asset('images/packages.jpg') }}" alt="Tour Packages">
    </div>

    <!-- Contact Section -->
    <div class="section contact">
        <h2>Contact Us</h2>
        <p>📍 123 Travel Street, Dhaka, Bangladesh</p>
        <p>📞 +880 123-456-7890</p>
        <p>📧 info@joytripsingapore.com</p>
    </div>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} JoyTrip Singapore. All rights reserved.
    </footer>

</body>
</html>
