<?php
include('authentication.php');

if (isset($_POST['addcar'])) {
    require_once('connection.php');

    // Debugging - Print the uploaded file info
    echo "<pre>";
    print_r($_FILES['image']);
    echo "</pre>";

    // Image upload variables
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    if ($error === 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        // Allowed image extensions
        $allowed_exs = array("jpg", "jpeg", "png", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_exs)) {
            // Unique image name
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'images/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            // Escaping form data
            $carname = mysqli_real_escape_string($con, $_POST['carname']);
            $ftype = mysqli_real_escape_string($con, $_POST['ftype']);
            $capacity = mysqli_real_escape_string($con, $_POST['capacity']);
            $price = mysqli_real_escape_string($con, $_POST['price']);
            $cartype = mysqli_real_escape_string($con, $_POST['cartype']); 
            $mileage = mysqli_real_escape_string($con, $_POST['mileage']);  
            $deposit = mysqli_real_escape_string($con, $_POST['deposit']);  
            $transmission = mysqli_real_escape_string($con, $_POST['transmission']);  
            $available = "Y";

            // Insert query with CAR_TYPE included
            $query = "INSERT INTO cars (CAR_NAME, FUEL_TYPE, CAPACITY, PRICE, CAR_IMG, AVAILABLE, CAR_TYPE, TRANSMISSION, MILEAGE, DEPOSITE_SECURITY) 
                      VALUES ('$carname', '$ftype', $capacity, $price, '$new_img_name', '$available', '$cartype','$transmission','$mileage','$deposit')";
            
            $res = mysqli_query($con, $query);

            if ($res) {
                echo '<script>alert("New Car Added Successfully!!")</script>';
                echo '<script>window.location.href = "adminvehicle.php";</script>';
            } else {
                echo '<script>alert("Error adding car. Please try again.")</script>';
                echo '<script>window.location.href = "addcar.php";</script>';
            }

        } else {
            echo '<script>alert("Cannot upload this type of image")</script>';
            echo '<script>window.location.href = "addcar.php";</script>';
        }

    } else {
        $em = "Unknown error occurred";
        header("Location: addcar.php?error=$em");
    }

} else {
    echo "false";
}
?>
