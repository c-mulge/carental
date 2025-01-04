<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success - Rental Request</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        @keyframes checkmark {
            0% { stroke-dashoffset: 50; }
            100% { stroke-dashoffset: 0; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-2xl p-8 text-center transform transition-all duration-300 hover:scale-105">
            <div class="mb-6">
                <svg class="mx-auto mb-4 w-24 h-24" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" style="animation: checkmark 1s forwards;" stroke-dasharray="50" stroke-dashoffset="50" />
                    <polyline points="22 4 12 14.01 9 11.01" style="animation: checkmark 1s forwards;" stroke-dasharray="50" stroke-dashoffset="50" />
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4 animate-fade-in">
                Booking Confirmed!
            </h1>

            <p class="text-gray-600 mb-6 leading-relaxed">
                Great news! Your rental request has been successfully processed. 
                Our team will review your booking and contact you shortly with further details.
            </p>

            <div class="flex flex-col space-y-4">
                <a href="cardetails.php" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center space-x-2 transform hover:scale-105 active:scale-95">
                    <i data-feather="search" class="mr-2"></i>
                    Browse More Cars
                </a>
                <a href="bookings.php" class="w-full border border-blue-600 text-blue-600 py-3 rounded-lg hover:bg-blue-50 transition duration-300 flex items-center justify-center space-x-2">
                    <i data-feather="calendar" class="mr-2"></i>
                    View My Bookings
                </a>
            </div>

            <!-- <div class="mt-6 text-sm text-gray-500">
                Booking Reference: 
                <span class="font-semibold text-blue-600">
                    #<?php //echo rand(10000, 99999); ?>
                </span>
            </div> -->
        </div>

        <div class="text-center mt-4 text-gray-600">
            Need help? 
            <a href="co.html" class="text-blue-600 hover:underline">
                Contact Support
            </a>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>