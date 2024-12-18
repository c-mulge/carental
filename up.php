<?php

if (isset($_POST['addcar'])) {
    $carname = $_POST['carname'];
    $ftype = $_POST['ftype'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $images = $_FILES['images'];

    $upload_dir = "uploads/";

    // Loop through each uploaded file
    for ($i = 0; $i < count($images['name']); $i++) {
        $image_name = basename($images['name'][$i]);
        $target_file = $upload_dir . $image_name;

        // Move the file to the upload directory
        if (move_uploaded_file($images['tmp_name'][$i], $target_file)) {
            echo "Uploaded: $image_name<br>";
        } else {
            echo "Failed to upload: $image_name<br>";
        }

        // Save image details to the database (optional)
        // Example query:
        // INSERT INTO car_images (CAR_ID, IMAGE_PATH) VALUES ($car_id, $image_name);
    }
}

?>