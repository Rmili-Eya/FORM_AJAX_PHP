<?php


//check if image sent 
if (isset($_FILES['myImage'])  ){
    #Database Connection 
    include 'dbh.php';

    
    $img_name=$_FILES['myImage']['name'];
    $img_size=$_FILES['myImage']['size'];
    $img_tmp=$_FILES['myImage']['tmp_name'];
    $error=$_FILES['myImage']['error'];

    #if there is not error occured while uploading 
    if ($error ===0){
     if ($img_size>100000000){
    #error message 
    $em="Sorry your file is too large !";

    #response array 
    $error =array('error' =>1, 'em'=>$em);

    #Printing out PHP code and converting it into JSON
    echo json_encode($error);
    exit();

     }else {
     #Get image extension and store it in var 

     $img_ext=pathinfo($img_name,PATHINFO_EXTENSION);

     #Convert image extension to lower case 

     $img_ext_lc=strtolower($img_ext);

     /**
      *Create array that stores allowed to upload images extensions 
      */

      $allowed_exs=array("jpg","jpeg","png");

      /**Check if the image extension
       *  is present in the array  */

       if (in_array($img_ext_lc,$allowed_exs)){
         #Renaming the image name with random string 
         $new_img_name=uniqid("IMG-",true).'.'.$img_ext_lc;

         #Creating upload path on root directory 

         $img_upload_path="uploads/".$new_img_name;

         #move uploaded image to uploades folder 
         move_uploaded_file($img_tmp,$img_upload_path);

         #Inserting image name into database 
         $sql="insert into users (name,email,file) values ('','','$new_img_name')";
         mysqli_query($conn,$sql);
         
         #response array 
         $res =array('error' =>0, 'src'=>$new_img_name);
         echo json_encode($res);
         exit();

       }else{
        #error message 
        $em="You can't upload files of this type !";

         #response array 
         $error =array('error' =>1, 'em'=>$em);

         #Printing out PHP code and converting it into JSON
         echo json_encode($error);
         exit();
       }

     }

    }else {
    #error message 
    $em="unknown error occured";

    #response array 
    $error =array('error' =>1, 'em'=>$em);

    #Printing out PHP code and converting it into JSON
    echo json_encode($error);
    exit();
    }

}