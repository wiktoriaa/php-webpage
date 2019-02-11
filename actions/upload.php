<?php
	
	require '../vendor/autoload.php';
	require_once 'database/user.php';
	session_start();

   

  function shadow_text($im, $size, $x, $y, $font, $text)
  {
    $black = imagecolorallocate($im, 0, 0, 0);
    $white = imagecolorallocate($im, 255, 255, 255);
    imagettftext($im, $size, 0, $x + 1, $y + 1, $black, $font, $text);
    imagettftext($im, $size, 0, $x + 0, $y + 1, $black, $font, $text);
    imagettftext($im, $size, 0, $x + 0, $y + 0, $white, $font, $text);
  }




	if (isset($_FILES['image'])) {

      $errors	 = array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp  = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext  = strtolower(end(explode('.',$_FILES['image']['name'])));

      $user = new User;
      $role = 'public';

      if (isset($_POST['private']))
      	$role = 'private';

      
      $expensions = array("jpg","png");
      
      if (in_array($file_ext,$expensions) === false){
         $errors[] = "extension not allowed, please choose a JPG or PNG file.";
         header("Location: ../?page=panel&err=1");
         exit();
      }
      
      if ($file_size > 1048576){
         $errors[] = 'File size must be excately 1 MB';
         header("Location: ../?page=panel&err=1");
         exit();
      }
      
      
      if (empty($errors) == true) {

         $file_name = $user->send_image($_SESSION['user'], $file_name, $role);

         move_uploaded_file($file_tmp,"../img/upload/".$file_name);

         /* tworzenie minitury */

         $img = imagecreatefromjpeg("../img/upload/".$file_name);
         $width  = imagesx($img);
    		 $height = imagesy($img);

    		 $width_mini = 200;
    		 $height_mini = 125;
    		 $img_mini = imagecreatetruecolor($width_mini, $height_mini);
    		 imagecopyresampled($img_mini, $img, 0, 0, 0, 0, $width_mini , $height_mini, $width  , $height);
    		 imagejpeg($img_mini, "../img/mini/".$file_name, 80);
    		 imagedestroy($img);
    		 imagedestroy($img_mini);

         /*watermark */

         $im = imagecreatefromjpeg("../img/upload/".$file_name);
         $font = 'arial.ttf';
         $size = 11;

         # calculate maximum height of a character 
         $bbox = imagettfbbox($size, 0, $font, 'ky');
         $x = 8; $y = 8 - $bbox[5];

         $text = 'text to be added';
         shadow_text($im, $size, $x, $y, $font, $text);


         imagejpeg($im, "../img/watermark/".$file_name, 90);

         echo "Success";

      }

      else
         header("Location: ../?page=panel&err=1");
      
   }

	header("Location: ../?page=panel");

?>