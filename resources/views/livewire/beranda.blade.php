<div>
    <title>Queen's Food S</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .hover-effect:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

                /* Animasi Floating */
        @keyframes floatUpDownSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes floatUpDownFast {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        /* Terapkan animasi */
        .animate-float-slow {
            animation: floatUpDownSlow 3s ease-in-out infinite;
        }

        .animate-float-fast {
            animation: floatUpDownFast 2s ease-in-out infinite;
        }
    </style>

   <!-- Main Banner -->
<section class="bg-blue-100 py-16 relative overflow-hidden">
    <div class="container mx-auto px-6 md:px-12 flex flex-col md:flex-row items-center">
        <!-- Teks Promo -->
        <div class="md:w-1/2 text-center md:text-left">
            <!-- Badge Promo -->
            <div class="bg-red-500 text-white px-4 py-2 inline-block mb-4 rounded-lg shadow-lg animate-float-slow">
                🍔 LIMITED TIME OFFER
            </div>
            <h1 class="text-5xl font-bold text-gray-900 mb-4 leading-tight">
                Fresh & Tasty <span class="text-green-600">Everyday</span>!
            </h1>
            <p class="text-gray-800 text-lg mb-6">
                Get up to <span class="font-bold text-red-500">30% OFF</span> on selected items.
            </p>
            <button class="bg-green-500 text-white px-8 py-3 rounded-lg text-lg font-semibold shadow-md
                           hover:bg-green-600 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                Order Now 🚀
            </button>
        </div>

        <!-- Gambar -->
        <div class="md:w-1/2 flex justify-center md:justify-end mt-8 md:mt-0">
            <img alt="Assorted vegetables on a wooden plate"
                 class="rounded-full shadow-lg animate-float-fast transition-transform duration-300"
                 src="https://storage.googleapis.com/a1aa/image/bkhKVowTxQmGdAd5WJCnWvlrGew8Xf1xbRPnh0JCOmE.jpg"/>
        </div>
    </div>
</sectio
   <!-- About Us -->
   <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-6">About Queen's Food Store</h2>
        <p class="text-gray-700 max-w-2xl mx-auto">We bring you fresh, organic, and delicious food straight from the farm. Our mission is to provide the highest quality products with great deals and discounts for our valued customers.</p>
    </div>
</section>

<!-- Recommended Products -->
<section class="py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-8">Recommended Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-xl transition">
                <img src="{{ asset('images/buah.jpeg') }}" alt="Fresh Fruits" class="rounded-lg hover-effect mb-4">
                <h3 class="text-xl font-bold">Fresh Fruits</h3>
            </div>
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-xl transition">
                <img src="{{ asset('images/organik.jpeg') }}" alt="Organic Vegetables" class="rounded-lg hover-effect mb-4">
                <h3 class="text-xl font-bold">Organic Vegetables</h3>
            </div>
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-xl transition">
                <img src="{{ asset('images/buket.jpeg') }}" alt="Flower Bouquet" class="rounded-lg hover-effect mb-4">
                <h3 class="text-xl font-bold">Beautiful Bouquets</h3>
            </div>
        </div>
    </div>
</section>


<!-- Best Sellers -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-8 text-green-700">Best Sellers</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-xl transition transform hover:scale-105">
                <img src="{{ asset('images/banana.jpeg') }}" alt="Banana" class="rounded-lg mb-4 w-full h-100 object-cover">
                <h3 class="text-xl font-bold">Banana - $19.00</h3>
            </div>
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-xl transition transform hover:scale-105">
                <img src="{{ asset('images/carrot.jpeg') }}" alt="Carrot" class="rounded-lg mb-4 w-full h-100 object-cover">
                <h3 class="text-xl font-bold">Carrot - $188.00</h3>
            </div>
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-xl transition transform hover:scale-105">
                <img src="{{ asset('images/jus.jpeg') }}" alt="Grape Juice" class="rounded-lg mb-4 w-full h-100 object-cover">
                <h3 class="text-xl font-bold">Grape Juice - $179.00</h3>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<footer class="py-8 bg-blue-900 text-white text-center">
    <p>&copy; 2025 Queen's Food Store. All Rights Reserved.</p>
</footer>
</div>
