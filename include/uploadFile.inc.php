<?php 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActuallExt = strtolower(end($fileExt));

    $allow = ['jpeg','jpg','png'];

    if(in_array($fileActuallExt,$allow)){

        if($fileError === 0){

            if($fileSize <= 1000000){

                $fileNewName = uniqid('',true).'.'.$fileActuallExt;
                $fileDestination = 'Images/'.$fileNewName;
                move_uploaded_file($fileTmpName,'../Images/'.$fileNewName);

                $array = [$fileNewName, $fileDestination];

                echo $array[0].' '.$array[1];

            } else echo 'too big';

        } else echo 'error';
    
    } else echo 'extension not allowed';

} else  header('location: ../index.php');

