<?php
include "header.php";

if (isset($_POST['add_user'])) {
  $username=mysqli_real_escape_string($con,$_POST['username']);
  $email=mysqli_real_escape_string($con,$_POST['email']);
  $pass=mysqli_real_escape_string($con,sha1($_POST['password']));
  $c_pass=mysqli_real_escape_string($con,sha1($_POST['c_password']));
  $role=mysqli_real_escape_string($con,$_POST['role']);
}
  if (strlen($username) < 4 || strlen($username) > 100) {
    $error="Username must be Btw 4 to 100 Characters";
  }elseif (strlen($pass) < 4 ) {
    $error="Password must be of 4 Characters";
  }elseif ($pass!=$c_pass) {
    $error="Password doesnot Match";
  }else{
    $sql="SELECT * FROM user WHERE email='$email'";
    $query=mysqli_query($con,$sql);
    $row=mysqli_num_rows($query);
    if ($row >= 1) {
      $error="Email already exist";
    }else {
      $sql2 = "INSERT INTO user (username, email, password, role) VALUES ('$username', '$email', '$pass', '$role')";
$query2 = mysqli_query($con, $sql2);

if ($query2) {
    $msg = ['User has been added successfully', 'alert-success'];
    $_SESSION['msg'] = $msg;
    header("Location: users.php");
    exit; // Ensures the script stops after redirecting
} else {
    $error = "Failed, Please Try Again: " . mysqli_error($con); // Add error message for debugging
    $_SESSION['msg'] = [$error, 'alert-danger']; // Store error in session if needed
    header("Location: users.php");
    exit; // Ensures the script stops after redirecting
}

  }

}

?>


<div class="container">
  <div class="row">
    <div class="col-md-5 m-auto bg-info p-4">
      <?php
       if (!empty($error)) {
        echo "<p class='bg-danger text-white fw-bold p-3'>".$error."</p>";
       }

      ?>
      <div class="mb-3">
        <h3 class="text-center"></h3>
       <form action="" method="POST">
        <h3 class="text-center text-white fw-bolder">Create New User</h3>
       <input type="text" name="username" placeholder="Username" class="form-control" required >
        <br>
        <input type="email" name="email" placeholder="Email" class="form-control" required>
        <br>
        <input type="password" name="password" placeholder="Password" class="form-control" required>
        <br>
        <input type="password" name="c_password" placeholder="Confirm Password" class="form-control" required>
        <div class="mt-3 mb-3">
          <select class="form-control" name="role">
            <option selected value="">Select Role</option>
            <option value="1">Admin</option>
            <option value="0">Co-Admin</option>
          </select>
        </div>
        <div class="mb-3">
          <input type="submit" name="add_user" class="btn btn-primary" value="Create">
        </div>

       </form>
        
      </div>
    </div>
  </div>
</div>





<?php
include "footer.php";

?>