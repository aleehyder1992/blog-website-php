<?php include "header.php"; ?>

<div class="container">

<h5 class="mb-2 text-gray-800">Catagories</h5>
 <div class="row">
  <div class="col-xl-6 col-lg-6">
    <div class="col-xl-12 col-lg-12">
      <div class="card">
         <div class="card-header">
           <h6 class="font-weight-bold text-primary mt-2">Add Catagory</h6>
         </div>
         <div class="card-body">
          <form action="" method="POST">
            <div class=mb-3>
              <input type="text" name="cat_name" placeholder="Catogory Name" class="form-control" required >
            </div>
            <div class="mb-3">
            <input type="submit" name="add_cat" Value="Add" placeholder="Catogory Name" class="btn btn-primary" >

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
if (isset($_POST['add_cat'])) {
  $cat_name=mysqli_real_escape_string($con,$_POST['cat_name']);
  $sql="SELECT * FROM catagories WHERE cat_name='{$cat_name}'";
  $query=mysqli_query($con,$sql);
  $row=mysqli_num_rows($query);
  if ($row) {
    $msg= ['Catagory Name Already Exit','alert-danger'];
    $_SESSION['msg']=$msg;
    header("location:catagories.php");
  }else{
    $sql2="INSERT INTO catagories (cat_name) VALUES ('$cat_name')";
    $query2=mysqli_query($con,$sql2);
    if ($query2) {
          $msg=['Catagory has been added successfully','alert-success'];
          $_SESSION['msg']=$msg;
          header("location:catagories.php");
    }else {
      $msg=['Failed ,Please Try Again','alert-danger'];
      $_SESSION['msg']=$msg;
      header("location:catagories.php");
    }

  }

}

?>