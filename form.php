<?php
include_once 'dbh.php';
 if (isset($_POST['submit'])){
$userName=$_POST['userName'];
$userEmail=$_POST['userEmail'];

//getting image data and store them in var 
$img_name=$_FILES['myImage']['name'];
$img_size=$_FILES['myImage']['size'];
$tmp_name=$_FILES['myImage']['tmp-name'];
$error=$_FILES['myImage']['error'];
console.log($img_name);

//if there is error occured while uploading 

if ($error===0){
if ($img_size>1000){
        #error
        $em="Sorry your file is too large! ";

        #response array
        $error=array('error'=>1,'em'=>$em);
        //printing out php array and converting it into json format
        echo json_encode($error);
        exit();
}else{
echo "ok ";
}

}else{
    #error
    $em="unknown error occured ";

    #response array
    $error=array('error'=>1,'em'=>$em);
    //printing out php array and converting it into json format
    echo json_encode($error);
    exit();
}




// $sql="insert into users (name,email,file) values ('$userName','$userEmail','$userFile')";
//     mysqli_query($conn,$sql);
    //header('Location:index.php?success=form');




 }
