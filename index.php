<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="./style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<div class="container d-flex justify-content-between align-items-center height">
    <div class="card py-3">
        <div class="p-3 d-flex align-items-center justify-content-center">
            <h5>Formulaire</h5>
        </div>
        <form id='form' method="POST" action="test.php" enctype="multipart/form-data" class="p-3 px-4 py-2"> 
            <span  class="font-weight-normal quote">Your Name</span> 
            <input id="mail-name" type="text" class="form-control mb-2" placeholder="your name" /> 
            <span class="font-weight-normal quote">Mail</span> 
            <input id="mail-email" type="text" class="form-control mb-2" placeholder="your email address" />
             <span class="font-weight-normal quote">Message</span>
            <div class="form"> 
                <input id="mail-file" type="file" name='file'  class="form-control mb-3 description-area" >
                </input> 
            </div>
            <div class="text-right">
                 <button id="mail-submit" type="submit" class="btn btn-danger send">Send Message</button> 
            </div>
        </form>
        <p id="form-message"></p>

    </div>
    <div class="gallery">
        <img src="./uploads/default image.jpg" id="preImg" alt="erreur">
    </div>
</div>
<script>

   $(document).ready(function (){
   $('#form').submit( function(e){
   e.preventDefault();
   let name=$('#mail-name').val();
   let  email=$('#mail-email').val();
   let img=$('#mail-file')[0].files;
   let submit=$('#mail-submit').val();
   //let fileI = $('#mail-file').val();


   if (img.length>0){
    let temp = document.getElementById('mail-file');
;

 let form_data= new FormData();
  for (const file of temp.files){
    form_data.append('myImage',file);

  }

   //write ajax 
   $.ajax({
    url:"test.php",
       type:"POST",
       data:form_data,
       contentType: false,
       processData: false,
       success:function(res){   
       const data=JSON.parse(res);
       console.log(res)

       if (data.error!=1){
    let path="uploads/"+data.src;
    $('#preImg').attr('src',path);

       }else{
           $('#form-message').text(data.em);

       }

       }

   })}else{
    $('#form-message').html("<p>Please select an image !</p>");

     }
  })
  } )

    
</script>
</body>
</html>