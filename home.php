<?php
$title = "Home";
include "layouts/header.php";
include "middleware/auth.php";
include "layouts/nav.php";
// print_r($_SESSION);die;

?>

<h1 class="text-center text-success mt-5">welcome <?= $_SESSION['user']->name ?></h1>
<?php


if ($_POST) {
  switch ($_POST['user']) {

    case 'Eng: Mahmoud Osman':
      $name = $_POST['user'];
      $id = 1;
      $phone = '01001706328';
      $email = "mahmoudgold@gmail.com";
      $password = '5629';
      $gender = "male";
      break;
    case 'Sara':
      $name = $_POST['user'];
      $id = 3;
      $phone = '0166666666';
      $email = "Sara@gmail.com";
      $password = '1234';
      $gender = "female";
      break;
    default:
      $name = $_POST['user'];
      $id = 2;
      $phone = '012222222';
      $email = "Esraa@gmail.com";
      $password = '1234';
      $gender = "female";
  }


  $message = "<div class='alert alert-success'>
        <ul>
            <li>
                ID : $id
            </li> 
            <li>
                Name : $name
            </li>
            <li>
                Phone : $phone
            </li> 
            <li>
                Email : $email
            </li> 
            <li>
                Password : $password
            </li> 
            <li>
                Gender : $gender
            </li>
        </ul> 
      </div>";
}

?>

<div class="container">
  <div class="row">
    <div class="col-12 mt-5">
      <h1 class="text-dark text-center h1"> Users </h1>
    </div>
    <div class="offset-4 col-4">
      <form method="post">
        <div class="form-group">
          <label for="users">Users</label>
          <select name="user" class="form-control" id="users">
            <option value="Eng: Mahmoud Osman">Eng: Mahmoud Osman</option>
            <option value="Sara">Sara</option>
            <option value="Esraa">Esraa</option>
          </select>
        </div>
        <div class="form-group">
          <button name="sale" class="btn btn-warning rounded">Get Data!</button>
        </div>
      </form>
      <?php if (isset($message)) {
        echo $message;
      } ?>
    </div>
  </div>
</div>

<?php
include "layouts/footer.php";
?>