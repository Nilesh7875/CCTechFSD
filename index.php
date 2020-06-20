<!DOCTYPE html>
<html>
 <head>
<link href="bootstrap.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>YouFrame</title>
        <style>
        input[type="file"]{
            display:none;
        }
        .upload{
            background:white;
            border-bottom: 3px solid #2c5282;
            font-family: verdana;
            padding:5px 20px;
        }
        h1,h6{
            color:white;
            font-family: verdana;
            text-align: center;
        }
        .images{
            border-radius:2%;
            margin-top:1%;
        }
        .images p{
            bottom:0;
            text-align: center;
        }
        .img{
            background: white;
        }
        .imgbottom{
            background: white;
            width:100%;
            color:#4299e1;
            font-family: verdana;
        }
        
        </style>
 </head>
 <body style="background:  #ebf8ff;">
            
            <div class="container-fluid">
                <div class="row sticky-top" style="background-color: #2c5282;position:fixed;width:100%;top:0;">
                    <div class="col"><h1>Gallery</h1></div>
                </div>
            <div class="row" style="margin-top:7%">
                <div class="col-sm-4 col-lg-4 col-md-4 col-xl-4"></div>
                <div class="col-sm-4 col-lg-4 col-md-4 col-xl-4">
                    <center>
                        <form action="MyTask.php" method="POST" enctype="multipart/form-data">
                        <label for="file"><div class="upload"><i class="fa fa-upload"></i>Upload File</div></label>
                        <input type="file" name="file" id="file"/>
                        </form>
                    </center>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4 col-xl-4"></div>
            </div>
            <center>
            <div class="row" style="margin-bottom: 10%;">
            <?php
            $dir="upload/*.*";
            $images=glob($dir);
            for($i=count($images)-1;$i>=0;$i--){
                ?>
                <div class="col-sm-12 col-lg-4 col-md-12 col-xl-4 images">
                <?php
                $num = $images[$i];
                echo '<img src="'.$num.'" class="img-fluid">';
                ?>
                <div class="imgbottom"><?php echo"Image $i"?></div></div>
                <?php
            }?>
            
            </div>
            </center>
            <div class="row" style="background-color: #2c5282;position:fixed;width:100%;bottom:0">
                <div class="col"><h6>Full Stack Challenge - 2020</h6></div>
            </div>
            </div>
            </body>
</html>

<script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
   return;
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
     $('#uploaded_image').html(data);
     location.reload();
    }
   });
  }
 });
});
</script>