<?php include "header.php";
$id=$_GET['id'];
if (empty($id)) {
  header("location:catagories.php");
}

$id=$_GET['id'];
$sql="SELECT * FROM catagories WHERE cat_id='$id'";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($query);


?>

<div class="container">

<h5 class="mb-2 text-gray-800">Catagories</h5>
 <div class="row">
  <div class="col-xl-6 col-lg-6">
    <div class="col-xl-12 col-lg-12">
      <div class="card">
         <div class="card-header">
           <h6 class="font-weight-bold text-primary mt-2">Edit Catagory</h6>
         </div>
         <div class="card-body">
          <form action="" method="POST">
            <div class=mb-3>
              <input type="text" name="cat_name" placeholder="Catogory Name" class="form-control" required value="<?= $row['cat_name']; ?> " >
            </div>
            <div class="mb-3">
            <input type="submit" name="update_cat" Value="Update" placeholder="Catogory Name" class="btn btn-primary" >

            <a href="catagories.php" class="btn btn-secondary">Back</a>

            </div>

          </form>
         </div>
      </div>
    </div>
   </div>
  </div>
 </div>
</div>

<?php include "footer.php";
if (isset($_POST['update_cat'])) {
  $cat_name=mysqli_real_escape_string($con,$_POST['cat_name']);
  $sql2="UPDATE catagories SET cat_name='{$cat_name}' WHERE cat_id='{$id}'";
  $update=mysqli_query($con,$sql2);

  if ($update) {
    $msg=['Catagory has been updated successfully','alert-success'];
    $_SESSION['msg']=$msg;
    header("location:catagories.php");
}else {
$msg=['Failed ,Please Try Again','alert-danger'];
$_SESSION['msg']=$msg;
header("location:catagories.php");
}



    

}
?>