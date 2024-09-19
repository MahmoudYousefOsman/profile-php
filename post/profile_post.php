<?php
session_start();
// if the request is get
if (empty($_POST)) {
  header('location:../errors/404.php');
  die;
}

// print_r($_POST);die;
// print_r($_FILES);die;
// validation

$errors = [];
if (empty($_POST['name'])) {
  $errors['name'] = "<div class='alert alert-danger'> Name Is Required </div>";
}

if (empty($_POST['email'])) {
  $errors['email'] = "<div class='alert alert-danger'> Email Is Required </div>";
}

if (empty($_POST['gender'])) {
  $errors['gender'] = "<div  > Gender Is Required </div>";
}


// if no validation errors
if (empty($errors)) {
  // check if photo is exists
  if ($_FILES['image']['error'] == 0) {
    // validation
    $maxUploadSize = 1000000;
    // validate on size
    if ($_FILES['image']['size'] > $maxUploadSize) {
      $errors['image-size'] = "<div class='alert alert-danger'> You Must Upload Image Less Than $maxUploadSize Bytes </div>";
    }
    $allowedExtensions = ["png", 'jpg', 'jpeg'];
    // validate on extension
    $photoExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if (!in_array($photoExtension, $allowedExtensions)) {
      $errors['image-extension'] = "<div class='alert alert-danger'> You Must Upload Image With " . implode(",", $allowedExtensions) . " Extensions </div>";
    }

    if (empty($errors)) {
      $photoDir = "../images/users/";
      $photoName = time() . '-' . $_SESSION['user']->id . '.' . $photoExtension; // 523153152-1.png
      $photoPath = $photoDir . $photoName; // images/users/523153152-1.png
      // upload image
      move_uploaded_file($_FILES['image']['tmp_name'], $photoPath);
      $_SESSION['user']->image = $photoName;
    }
  }
  // update on session
  $_SESSION['user']->name = $_POST['name'];
  $_SESSION['user']->email = $_POST['email'];
  $_SESSION['user']->gender = $_POST['gender'];
}
if (empty($errors)) {
  $_SESSION['success'] = "<div class='alert alert-success'> Data Updated Successfully </div>";
}
$_SESSION['errors'] = $errors;
header('location:../profile.php');
