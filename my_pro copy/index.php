 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
    <style>
        body{
            overflow-y: scroll;
        }
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
    
</head>

<body>
    <div class="container">
        <header class="bg-900 flex items-center justify-between py-4 px-6 hhh" >
         <div class="container mx-auto flex justify-between items-center">
         <div class="logo text-2xl font-bold">Rental</div>
            <nav class="menu space-x-6">
                <a href="index.php" class="hover:underline">Home</a>
                <a href="aboutus2.html" class="hover:underline">About Us</a>
                <a href="co.html" class="hover:underline">Contact</a>
                <a href="adminlogin.php" class="hover:underline">Admin</a>
                <a href="login.php" class="hover:underline">Login</a>
            </nav>
         </div>
        </header>


        <div class="content text-center mt-10">
            
            <h1 class="text-5xl font-bold">FAST AND EASY WAY<br><span>TO RENT A CAR</span></h1>
            <p class="par mt-4">
            Our Car Rental online booking system is designed to meet the specific needs of car rental business owners. 
            This easy-to-use car rental software will let you manage.
            </p>
            <button class="cn mt-6"><a href="register.php" class="text-white">Join Us</a></button>
        </div>
        <section class="py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold mb-8">How it Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <div class="bg-gray-100 p-6 rounded-md shadow-md">
              <!-- <img src="/api/placeholder/200/150" alt="Choose Location" class="mb-4"> -->
              <h3 class="text-xl font-bold mb-2">Choose Location</h3>
              <p class="text-gray-600">Select the pickup and drop-off locations that work best for you.</p>
            </div>
          </div>
          <div>
            <div class="bg-gray-100 p-6 rounded-md shadow-md">
              <!-- <img src="/api/placeholder/200/150" alt="Pick-up Date" class="mb-4"> -->
              <h3 class="text-xl font-bold mb-2">Pick-up Date</h3>
              <p class="text-gray-600">Choose the date and time that you need to pick up your rental car.</p>
            </div>
          </div>
          <div>
            <div class="bg-gray-100 p-6 rounded-md shadow-md">
              <!-- <img src="/api/placeholder/200/150" alt="Book your car" class="mb-4"> -->
              <h3 class="text-xl font-bold mb-2">Book your car</h3>
              <p class="text-gray-600">Complete your booking and we'll have your rental car ready for you.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-100 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold mb-8">Most Popular Car Rental Deals</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="bg-white p-6 rounded-md shadow-md car-listing hover:shadow-lg transition">
            <img src="images/carbg5.jpg" alt="All New Rush" class="mb-4">
            <h3 class="text-xl font-bold mb-2">All New Rush</h3>
            <p class="text-gray-600 font-medium mb-4">$72.00/day</p>
            <button class="more-details bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">More Details</button>
          </div>
          <div class="bg-white p-6 rounded-md shadow-md">
            <img src="images/carbg2.jpg" alt="Large Car" class="mb-4">
            <h3 class="text-xl font-bold mb-2">Large Car</h3>
            <p class="text-gray-600 font-medium mb-4">$75.00/day</p>
            <a href="cardetails.php" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">Rent Now</a>
          </div>
          <div class="bg-white p-6 rounded-md shadow-md">
            <img src="images/ciaz.jpg" alt="Small Car" class="mb-4">
            <h3 class="text-xl font-bold mb-2">Small Car</h3>
            <p class="text-gray-600 font-medium mb-4">$57.00/day</p>
            <a href="cardetails.php" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">Rent Now</a>
          </div>
          <div class="bg-white p-6 rounded-md shadow-md car-listing hover:shadow-lg transition">
            <img src="images/ferrari.jpg" alt="Premium Cars" class="mb-4">
            <h3 class="text-xl font-bold mb-2">Premium Cars</h3>
            <p class="text-gray-600 font-medium mb-4">$80.00/day</p>
            <button class="more-details bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">More Details</button>
          </div>

        </div>
      </div>
    </section>

    <button id="chatBtn" class="fixed bottom-6 right-6 bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg">
    Chat
</button>


    <section class="py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold mb-8">Why choose us</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div class="bg-gray-100 p-6 rounded-md shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <h3 class="text-xl font-bold mb-2">Customer Support</h3>
            <p class="text-gray-600">Our team is available 24/7 to assist you with any questions or concerns.</p>
          </div>
          <div class="bg-gray-100 p-6 rounded-md shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <h3 class="text-xl font-bold mb-2">Best Price Guaranteed</h3>
            <p class="text-gray-600">We offer the best rates on the market, ensuring you get the most value for your money.</p>
          </div>
          <div class="bg-gray-100 p-6 rounded-md shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <h3 class="text-xl font-bold mb-2">Many Locations</h3>
            <p class="text-gray-600">We have an extensive network of rental locations to serve you better.</p>
          </div>
          <div class="bg-gray-100 p-6 rounded-md shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h3 class="text-xl font-bold mb-2">Trusted by Thousands</h3>
            <p class="text-gray-600">Our reliable service has earned the trust of many satisfied customers.</p>
          </div>
        </div>
      </div>
    </section>

    <footer class="py-10 bg-gray-800 text-white mt-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-2xl mb-4 font-bold">CaRental</h3>
                <p>
                    Experience luxury and convenience at your fingertips. We offer a wide range of vehicles for every type of journey.
                </p>
                <p class="mt-4 text-sm text-gray-400">&copy; 2024 CaRental. All rights reserved.</p>
            </div>
            <div>
                <h3 class="text-2xl mb-4 font-bold">Quick Links</h3>
                <ul class="list-none space-y-2">
                    <li><a href="index.php" class="hover:text-gray-300 transition">Home</a></li>
                    <li><a href="aboutus.html" class="hover:text-gray-300 transition">About Us</a></li>
                    <li><a href="contactus.html" class="hover:text-gray-300 transition">Contact</a></li>
                    <li><a href="adminlogin.php" class="hover:text-gray-300 transition">Admin</a></li>
                    <li><a href="login.php" class="hover:text-gray-300 transition">Login</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-2xl mb-4 font-bold">Follow Us</h3>
                <div class="flex space-x-4 social-icons">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <ion-icon name="logo-facebook" size="large"></ion-icon>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <ion-icon name="logo-twitter" size="large"></ion-icon>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <ion-icon name="logo-instagram" size="large"></ion-icon>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <ion-icon name="logo-linkedin" size="large"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-4 text-center">
            <ul class="flex justify-center space-x-6 text-sm">
                <li><a href="privacy.html" class="hover:text-gray-300 transition">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-gray-300 transition">Terms of Service</a></li>
                <li><a href="#" class="hover:text-gray-300 transition">Cookie Policy</a></li>
            </ul>
        </div>
    </div>
</footer>


    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script>
      document.querySelectorAll('.more-details').forEach(button => {
    button.addEventListener('click', function() {
        alert("More details coming soon!");
    });
});

document.getElementById('chatBtn').addEventListener('click', function() {
    alert("Live chat support will be available soon!");
});


    </script>
</body>

</html>
