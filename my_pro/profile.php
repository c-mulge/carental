<?php 
require_once('connection.php');
include('user_auth.php');

$value = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE EMAIL='$value'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_fname = mysqli_real_escape_string($con, $_POST['fname']);
    $new_lname = mysqli_real_escape_string($con, $_POST['lname']);
    $new_phone = mysqli_real_escape_string($con, $_POST['phone']);
    
    $update_sql = "UPDATE users SET FNAME='$new_fname', LNAME='$new_lname', PHONE_NUMBER='$new_phone' WHERE EMAIL='$value'";
    if (mysqli_query($con, $update_sql)) {
        $_SESSION['fname'] = $new_fname;
        header('Location: profile.php?success=1');
        exit();
    } else {
        $error = "Failed to update user information.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - CaRental</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/profile.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex flex-col font-inter">
    <header class="bg-white shadow-md">
            <nav class="navbar">
                <a href="#" class="navbar-brand">CaRental</a>
                <div class="navbar-toggle" onclick="toggleMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="navbar-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="co.html">Contact</a></li>
                </ul>
            </nav>
    </header>

    <main class="flex-grow container mx-auto px-6 py-12">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6">
                <h1 class="text-3xl font-bold text-white text-center">User Profile</h1>
            </div>
            
            <div class="p-8">
                <?php if (isset($_GET['success'])) { ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                        <p class="text-green-700">Profile updated successfully!</p>
                    </div>
                <?php } ?>
                <?php if (isset($error)) { ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <p class="text-red-700"><?php echo $error; ?></p>
                    </div>
                <?php } ?>

                <form method="POST" action="profile.php" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="fname" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" id="fname" name="fname" value="<?php echo $user['FNAME']; ?>" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                        </div>
                        <div>
                            <label for="lname" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" id="lname" name="lname" value="<?php echo $user['LNAME']; ?>" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $user['PHONE_NUMBER']; ?>" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email (Read-Only)</label>
                        <input type="email" id="email" value="<?php echo $user['EMAIL']; ?>" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" readonly>
                    </div>

                    <div>
                        <label for="license" class="block text-sm font-medium text-gray-700 mb-2">License Number (Read-Only)</label>
                        <input type="text" id="license" value="<?php echo $user['LIC_NUM']; ?>" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" readonly>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                            <i data-feather="save" class="mr-2"></i>Save Changes
                        </button>
                        <a href="cardetails.php" class="text-blue-600 hover:underline mt-4 sm:mt-0">
                            <i data-feather="arrow-left" class="inline-block mr-1 -mt-1"></i>Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto px-4 text-center flex items-center justify-center space-x-4">
            <span>&copy; 2024 CaRental. All rights reserved.</span>
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>
