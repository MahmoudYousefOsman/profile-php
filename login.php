<?php

$title = "Login";
include "layouts/header.php";
include "middleware/guest.php";
include "layouts/nav.php";
// authentication => login
// how to include files in php ?
// include , include_once , require , require_once
// how to store data across pages ?
// using session

///////////////////// authentication task /////////////////////////////


$users = [
  (object)[
    'id' => 1,
    'name' => 'Eng: Mahmoud Yousef Osman',
    "gender" => 'm',
    'image' => '1.jpg',
    'email' => 'mahmoudgold562@gmail.com',
    'password' => 5629
  ],
  (object)[
    'id' => 1,
    'name' => 'sara',
    "gender" => 'm',
    'image' => '2.jpg',
    'email' => 'sara@gmail.com',
    'password' => 1234
  ],
  (object)[
    'id' => 1,
    'name' => 'esraa',
    "gender" => 'f',
    'image' => '3.jpg',
    'email' => 'esraa@gmail.com',
    'password' => 1234
  ],
];

if ($_POST) {
  // validation
  $errors = [];
  if (empty($_POST['email'])) {
    $errors['email'] = "<div class='alert alert-danger'> Email Is Required </div>";
  }
  if (empty($_POST['password'])) {
    $errors['password'] = "<div class='alert alert-danger'> Password Is Required </div>";
  }

  if (empty($errors)) {
    foreach ($users as $index => $user) {
      if ($_POST['email'] == $user->email && $_POST['password'] == $user->password) {
        // authenticated user
        // store user data into session
        $_SESSION['user'] = $user;
        // header => home page
        header('location:home.php');
        die;
        // break loop
      }
    }
    // un authencticated user => print error message
    $errors['wrong-attempt'] = "<div class='alert alert-danger'> Wrong Email Or Password </div>";
  }
}

?>

<div class="contianter mt-5">
  <div class="row">
    <div class="col-12 text-center">
      <h1 class="text-dark h1">Login</h1>
    </div>
    <div class="offset-4 col-4">
      <form method="post">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="<?php if (isset($_POST['email'])) {
                                                                                    echo $_POST['email'];
                                                                                  } ?>" placeholder=""
            aria-describedby="helpId">
          <?php
          if (isset($errors['email'])) {
            echo $errors['email'];
          }
          if (isset($errors['wrong-attempt'])) {
            echo $errors['wrong-attempt'];
          }
          ?>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="email" class="form-control" placeholder=""
            aria-describedby="helpId">
          <?php
          if (isset($errors['password'])) {
            echo $errors['password'];
          }
          ?>
        </div>
        <div class="form-group">
          <button class="btn btn-success rounded"> Login </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include "layouts/footer.php";
?>