<?php

session_start();

function clean($input){
    $input = trim($input);
    $input = stripcslashes($input);
    $input = strip_tags($input);
    return $input;
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $title = clean($_POST['title']);
    $content = clean($_POST['content']);
    // $image = clean($_POST['image']);



    $errors = [];

    #validate title 

    if(empty($title))
     {
        $errors['title']  = 'field is required';
     }
    elseif  (strlen($title)<30)
    {
        $errors['title']='title must be chars';
    }

    if(empty($content)) 
    {
        $errors['content']  = 'field is required';
    }
    elseif  (strlen($content)<30)
    {
        $errors['content']='content must be at least 30 chars';
    }

    // if(empty($image)) 
    // {
    //     $errors['image']  = 'field is required';
    // }
    // elseif  (strlen($image)<30)
    // {
    //     $errors['content']='content must be at least 30 chars';
    // }

    
$_SESSION['title']=$title;
$_SESSION['content']=$content;

if(count($errors) > 0 )
{
    foreach($errors as $key => $value )
    {
        echo $key. ' : ' ,$value . ' <br>' ;
    }
}
else 
{
    
        $file = fopen('file.txt', 'a') or die('Unable to open file!');

  $text = time().rand(1,30). $title . "||" . $content . "||" . $image . "\n"; "\n";

        // $text = $title . "||" . $content . "||" . $image . "\n";

        fwrite($file, $text);

        fclose($file);
    echo 'data passed success';

     
}
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
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Upload Image</h2>
         <form method="post" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control" name="title" id="exampleInputTitle" aria-describedby="" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <label for="exampleInputContent">content</label>
                <input type="text" class="form-control" name="content" id="exampleInputContent" aria-describedby="ContentHelp" placeholder="Enter content">
            </div>
               <div class="form-group">
                <label for="exampleInputImage">Image</label>
                <input type="file" name="image">
            </div>
          <button type="submit" class="btn btn-primary">Submit</button>   
        </form>
    </div>
 
</body>

</html>
