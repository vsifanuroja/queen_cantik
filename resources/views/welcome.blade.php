<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Queen's Food Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .hero-bg {
            background: url('{!! asset('images/coba.jpg') !!}') center/cover no-repeat;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
        }
        .text-shadow {
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8);
        }
        .btn-primary {
            background-color: #4caf50;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #388e3c;
        }
        .logo-animation {
            animation: bounce 1s infinite alternate;
        }
        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <section class="hero-bg relative">
        <div class="overlay"></div>
        <div class="absolute top-0 left-0 p-4">
            <img src="{{ asset('images/logo.png') }}" alt="Organic Logo" class="h-20 w-20 rounded-full logo-animation"/>
        </div>
        <div class="absolute top-0 right-0 p-4">
            <a href="{{ route('login') }}" class="bg-white text-green-600 py-2 px-4 rounded-lg shadow-lg hover:bg-gray-200">Login</a>
        </div>
        <div class="content container mx-auto px-6">
            <h1 class="text-5xl font-bold text-shadow">Let's Go Back to the Pure Food!</h1>
            <p class="text-lg text-shadow mt-4">Organic, natural, and supporting local farmers.</p>
            <div class="mt-6 flex justify-center gap-4">
                <a href="/about" class="bg-green-600 text-white py-3 px-6 rounded-lg text-lg btn-primary">Shop Now</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10 mt-10">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">
            <div>
                <h2 class="text-lg font-bold">Queen's Food Store</h2>
                <p class="mt-2 text-gray-400">Bringing you the best organic products.</p>
            </div>
            <div>
                <h2 class="text-lg font-bold">Quick Links</h2>
                <ul class="mt-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Shop</a></li>
                    <li><a href="" class="text-gray-400 hover:text-white">About Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h2 class="text-lg font-bold">Follow Us</h2>
                <div class="flex justify-center md:justify-start mt-2 space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-6 text-gray-500">
            &copy; 2025 Queen's Food Store. All rights reserved.
        </div>
    </footer>
</body>
</html>
