<?php

if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['profile_pic'])){
    echo "All fields are required.";
    exit;
  }
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $profile_pic = $_FILES['profile_pic'];
  

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit;
  }

  $target_dir = "uploads/";
$target_file = $target_dir . date('YmdHis') . '_' . basename($profile_pic['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


$check = getimagesize($profile_pic["tmp_name"]);
if($check === false) {
  echo "File is not an image.";
  $uploadOk = 0;
}

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  
  if ($profile_pic["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    exit;
  } else {
    if (move_uploaded_file($profile_pic["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars(basename($profile_pic["name"])) . " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
      exit;
    }
  }

  $csv_file = './users.csv';
$user_data = array($name, $email, $target_file);
$file = fopen($csv_file, 'a');

fputcsv($file, $user_data);

fclose($file);


session_start();
$_SESSION['name'] = $name;
setcookie('user', $name, time() + (86400 * 30), "/");