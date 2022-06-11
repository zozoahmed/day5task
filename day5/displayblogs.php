<?php

session_start();
echo '<h3>'.$_SESSION['title']. '</h3> <br>';
echo '<p>'.$_SESSION['content']. '</p> <br>';

     
// foreach($_SESSION['titleData']  as $Key => $value) {
//     echo $Key . ' : ' .$value . '<br>';
// }



?>

<?php
// $file = fopen('file.txt' ,'w'  ) or die('unable to open file!');

// // var_dump($file);
// fwrite($file , $text);

// fclose($file);


#TEXT file

$file =   fopen('file.txt','a') or die('Unable to open file!');

   $text = " 33333\n";

    fwrite($file,$text); 

    $text = " 2222\n";

    fwrite($file,$text); 

    fclose($file);



#Read  File . . . 

$file = fopen('file.txt', 'r') or die('Unable to open file!');


while (!feof($file)) {

  echo  strtoupper(fgets($file)) . '<br>';
 }

fclose($file);
?>




<html>
    <div>
        <form>
     <button type="submit" class="btn btn-primary">Submit</button>   

        </form>
    </div>
</html>