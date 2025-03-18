<?php
session_start();
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $businessName = mysqli_real_escape_string($con, $_POST['businessName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = $_POST['password'];
    $businessLicense = mysqli_real_escape_string($con, $_POST['businessLicense']);
    
    // Validate input data
    $errors = array();
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Check if email already exists
    $stmt = $con->prepare("SELECT OWNER_ID FROM owners WHERE OWNER_EMAIL = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Email already registered";
    }
    
    // Password validation
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    
    // Phone number validation
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Invalid phone number";
    }
    
    // If no errors, proceed with registration
    if (empty($errors)) {
        // Generate unique OWNER_ID
        $owner_id = 'OWN' . substr(uniqid(), -7);
        
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare SQL statement
        $stmt = $con->prepare("INSERT INTO owners (OWNER_ID, OWNER_NAME, OWNER_EMAIL, OWNER_PASSWORD, BUSINESS_NAME, PHONE_NUMBER, BUSINESS_LICENSE) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $owner_id, $fullName, $email, $hashed_password, $businessName, $phone, $businessLicense);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Set success message
            $_SESSION['success'] = "Registration successful! You can now login.";
            header("Location: owner_login.php");
            exit();
        } else {
            $errors[] = "Registration failed. Please try again.";
        }
    }
    
    // If there are errors, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: owner_register.php");
        exit();
    }
}

// Update the owners table structure to include new fields
$sql = "ALTER TABLE owners 
        ADD COLUMN PHONE_NUMBER VARCHAR(15) AFTER OWNER_PASSWORD,
        ADD COLUMN BUSINESS_LICENSE VARCHAR(255) AFTER BUSINESS_NAME";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Registration - CaRental</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
        }
        .invalid-feedback {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full space-y-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800">Owner Registration</h2>
                <p class="mt-2 text-gray-600">Create your account to manage your car rental business</p>
            </div>

            <form id="registrationForm" action="owner_reg.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fullName">
                        Full Name
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                           type="text" id="fullName" name="fullName" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="businessName">
                        Business Name
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                           type="text" id="businessName" name="businessName" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email Address
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                           type="email" id="email" name="email" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Phone Number
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                           type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
                    <small class="text-gray-500">Enter 10 digit phone number</small>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                           type="password" id="password" name="password" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmPassword">
                        Confirm Password
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                           type="password" id="confirmPassword" name="confirmPassword" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="businessLicense">
                        Business License Number
                    </label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                           type="text" id="businessLicense" name="businessLicense" required>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="terms" name="terms" required class="h-4 w-4 text-blue-600">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        I agree to the <a href="#" class="text-blue-600 hover:text-blue-800">Terms and Conditions</a>
                    </label>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                    Register
                </button>
            </form>

            <div class="text-center">
                <p class="text-gray-600">Already have an account? 
                    <a href="owner_login.php" class="text-blue-600 hover:text-blue-800">Login here</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            
            let isValid = true;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            // Password validation
            if (password.length < 8) {
                showError('password', 'Password must be at least 8 characters long');
                isValid = false;
            }
            
            // Password confirmation
            if (password !== confirmPassword) {
                showError('confirmPassword', 'Passwords do not match');
                isValid = false;
            }
            
            // Phone number validation
            const phone = document.getElementById('phone').value;
            if (!phone.match(/^[0-9]{10}$/)) {
                showError('phone', 'Please enter a valid 10-digit phone number');
                isValid = false;
            }
            
            // Email validation
            const email = document.getElementById('email').value;
            if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                showError('email', 'Please enter a valid email address');
                isValid = false;
            }
            
            if (isValid) {
                this.submit();
            }
        });

        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            errorDiv.textContent = message;
            field.parentNode.appendChild(errorDiv);
        }
    </script>
</body>
</html>