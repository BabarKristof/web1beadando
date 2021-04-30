<?php

if(isset($_SESSION['lusername']) && !empty($_SESSION['lusername']) )
	{
						
?>


<form action="" method="post" enctype="multipart/form-data">
  <table id="gallery_table">
    <tr><td><input type="file" name="image" ></td></tr>
    <tr><td> <input type="submit" value="Feltöltés" name="btn"></td></tr>
  </table>
</form>
<?php
	}else{
?>
<h2>Képfeltöltéshez kérem jelentkezzen be</h2>
<?php
	}
?>

 <?php
 
 ///KÉP BEKÉR
if(isset($_POST['btn'])){
     $image=$_FILES['image']['name']; 
     $imageArr=explode('.',$image); 
     $rand=rand(10000,99999); 
     $newImageName=$imageArr[0].$rand.'.'.$imageArr[1]; 
     $uploadPath="uploads/".$newImageName; 
     $isUploaded=move_uploaded_file($_FILES["image"]["tmp_name"],$uploadPath);
     if($isUploaded)
       echo 'Sikeres feöltöltés';
     else
       echo 'Sikertelen feltöltés'; 
   }
   
 /// KÉP KIOLVAS
$dir_name = "uploads/";
$images = glob($dir_name."*.{jpg,png,gif,jpeg}", GLOB_BRACE);
foreach($images as $image) {
   echo '<img id="imageblock" src="'.$image.'" />';
}

 ?>
