<?php 
include 'connection.php';

include 'header.php';
session_start();
if (isset($_SESSION['user_data'])) {
header ("location:http://localhost/blog/admin/index.php");
}
?>

<form action="" method="POST">
<div class="container">
  <div class="row">
     <div class="col-xl-5 col-md-4 m-auto p-5 mt-5 bg-info">
      <h3 class="text-center">Blog! Login Your Account</h3>
      <div class="mb-3">
        <input class="form-control" type="email" name="email" placeholder="Email Address" required>
      </div>
      <div class="mb-3">
        <input class="form-control" type="password" name="password" placeholder="Password" required>
      </div>
      <div class="mb-3">
        <input class="btn btn-primary" class="form-control" type="submit" name="login_btn" value="Login">
      </div>

      <?php
           if (isset($_SESSION['error'])){
            $error=$_SESSION['error'];
            echo "<p class='bg-danger p-2 text-white'>".$error."</p>";
            unset ($_SESSION['error']);

           } 

       ?>
     </div>  
  <div/>
</div>
</form>

<?php include 'footer.php';
if (isset($_POST['login_btn'])){
  $email=mysqli_real_escape_string($con,$_POST['email']);
  $pass=mysqli_real_escape_string($con,sha1($_POST['password']));
  
  $sql="SELECT * FROM user WHERE email='{$email}' AND password='{$pass}'";
  $query=mysqli_query($con,$sql);
  $data=mysqli_num_rows($query);

  if ($data) {
    $result=mysqli_fetch_assoc($query);
    $user_data=array($result['user_id'],$result['username'],$result['role']);
    $_SESSION['user_data']=$user_data;
    header("location:admin/index.php");
  }else{
    $_SESSION['error']="Invalid email/password";
    header("location:login.php");
  }

}

?>