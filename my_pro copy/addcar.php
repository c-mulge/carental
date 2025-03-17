<?php include('authentication.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator - Add New Car</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        window.history.forward();
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { return null };
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            overflow-y: scroll;
        }
        body::-webkit-scrollbar{
            display: none;
        }
        .input-group:focus-within label {
            color: #3b82f6;
        }
        .input-group:focus-within .icon {
            color: #3b82f6;
        }
    </style>
</head>
<body class="font-inter min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white shadow-2xl rounded-2xl p-10 transform transition-all duration-300 hover:scale-105">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                Add New Car
            </h1>
            <p class="text-gray-600 text-center mb-8">Fill in the details to add a new car to the system</p>
        </div>
        <form id="register" action="upload.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div class="input-group">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-feather="truck" class="icon text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="text" name="carname" id="carname" placeholder="Enter Car Name" required 
                        class="pl-10 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                    <label for="carname" class="sr-only">Car Name</label>
                </div>
            </div>

            <div class="input-group">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-feather="droplet" class="icon text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="text" name="ftype" id="ftype" placeholder="Enter Fuel Type" required 
                        class="pl-10 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                    <label for="ftype" class="sr-only">Fuel Type</label>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="input-group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="users" class="icon text-gray-400 w-5 h-5"></i>
                        </div>
                        <input type="number" name="capacity" id="capacity" placeholder="Capacity" min="1" required 
                            class="pl-10 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        <label for="capacity" class="sr-only">Capacity</label>
                    </div>
                </div>

                <div class="input-group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="dollar-sign" class="icon text-gray-400 w-5 h-5"></i>
                        </div>
                        <input 
                            type="number" name="price" id="price" placeholder="Price (Per Day)" min="1" required 
                            class="pl-10 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        <label for="price" class="sr-only">Price</label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">

                <div class="input-group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="target" class="icon text-gray-400 w-5 h-5"></i>
                        </div>
                        <input 
                            type="number" name="mileage" id="price" placeholder="Milegae" min="2" required 
                            class="pl-10 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        <label for="mileage" class="sr-only">Mileage</label>
                    </div>
                </div>

                <div class="input-group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="dollar-sign" class="icon text-gray-400 w-5 h-5"></i>
                        </div>
                        <input 
                            type="number" name="deposit" id="price" placeholder="Deposit" min="2" required 
                            class="pl-10 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        <label for="deposit" class="sr-only">Deposit</label>
                    </div>
                </div>
            </div>

                <div class="input-group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="sliders" class="icon text-gray-400 w-5 h-5"></i>
                        </div>
                        <select name="transmission" id="cartype" required 
                        class="pl-10 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                            <option value="" disabled selected>Select Car Transmission</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                        <label for="transmission" class="sr-only">Transmission</label>
                    </div>
                </div>

            <div class="input-group">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-feather="tag" class="icon text-gray-400 w-5 h-5"></i>
                    </div>
                <select name="cartype" id="cartype" required 
                class="pl-10 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                    <option value="" disabled selected>Select Car Type</option>
                    <option value="Small">Small Car</option>
                    <option value="Large">Large Car</option>
                    <option value="Premium">Premium Car</option>
                </select>
                <label for="cartype" class="sr-only">Car Type</label>
                </div>
            </div>


            <div class="input-group">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-feather="image" class="icon text-gray-400 w-5 h-5"></i>
                    </div>
                    <input type="file" name="image" id="image" required 
                        class="pl-10 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <label for="image" class="sr-only">Car Image</label>
                </div>
            </div>

            <div>
                <button 
                    type="submit" name="addcar" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:scale-105 active:scale-95">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i data-feather="plus-circle" class="h-5 w-5 text-blue-500 group-hover:text-blue-400"></i>
                    </span>
                    Add Car
                </button>
            </div>
        </form>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>
