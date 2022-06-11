<?php
 session_start();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // CODE .... 

    if (!empty($_FILES['image']['name'])) {

        $tempName  = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];

        $extensionArray = explode('/', $imageType);
        $extension =  strtolower( end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];    // PNG 

        if (in_array($extension, $allowedExtensions)) {

            $finalName = uniqid() . time() . '.' . $extension;

            $disPath = 'uploads/' . $finalName;

            if (move_uploaded_file($tempName, $disPath)) {
                echo 'File Uploaded Successfully';
            } else {
                echo 'File Uploaded Failed';
            }
        } else {
            echo 'File Type Not Allowed';
        }
    } else {
        echo 'Please Select File';
    }
}


?>