<?php include "header.php";
if (isset($_SESSION['user_data'])) {
    $author_id=$_SESSION['user_data']['0'];

    $sql="SELECT * FROM catagories";
    $query=mysqli_query($con,$sql);
}

?>

<div class="container">

<h5 class="mb-2 text-gray-800">Blogs</h5>
 <div class="row">
  <div class="col-xl-8 col-lg-6">
    <div class="col-xl-12 col-lg-12">
      <div class="card">
         <div class="card-header">
           <h6 class="font-weight-bold text-primary mt-2">Publish Articles</h6>
         </div>
         <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class=mb-3>
              <input type="text" name="blog_title" placeholder="Blog Title" class="form-control" required >
            </div>
            <div class="mb-3">
              <label>Blog Description</label>
              <textarea class="form-control" name="blog_body" name="blog_body" rows="7" id="blog"></textarea>
            </div>
            <div class="mb-3">
              <input type="file" name="blog_image" class="form-control">
            </div>
            <div class="mb-3">
              <select class="form-control" name="catagory" required>
                  <option value="">Select Catagory</option/>
                    <?php while ($cat=mysqli_fetch_assoc($query)) {

                     ?>
                  <option value="<?= $cat['cat_id'] ?>">
                    <?= $cat['cat_name']; ?>
                  </option>

                  <?php } ?>
                      
              </select>
            </div>
            <div class="mb-3">
            <input type="submit" name="add_blog" Value="Add" placeholder="Catogory Name" class="btn btn-primary" >

            <a href="index.php" class="btn btn-secondary">Back</a>

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
if (isset($_POST['add_blog'])) {
  $title=mysqli_real_escape_string($con,$_POST['blog_title']);
  $body=mysqli_real_escape_string($con,$_POST['blog_body']);
  $filename=$_FILES['blog_image']['name'];
  $tmp_name=$_FILES['blog_image']['tmp_name'];
  $size=$_FILES['blog_image']['size'];
  $image_ext=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
  $allow_type=['jpg','png','jpeg'];
  $destination="upload/".$filename;
  $catagory=mysqli_real_escape_string($con,$_POST['catagory']);
  if (in_array($image_ext,$allow_type)) {
        if ($size <= 2000000) {
          move_uploaded_file($tmp_name,$destination);
          $sql2="INSERT INTO blog(blog_title,blog_body,blog_image,catagory,author_id) VALUES ('$title','$body','$filename','$catagory','$author_id')";
         $query2=mysqli_query($con,$sql2);
         if ($query2) {
          $msg=['Post Published Successfully','alert-success'];
          $_SESSION['msg']=$msg;
          header("location:index.php");
         }else{
          $msg=['Please Try Again','alert-danger'];
          $_SESSION['msg']=$msg;
          header("location:index.php");
         }
          


        }else{
          $msg=['Image size should not be greater than 2mb','alert-danger'];
          $_SESSION['msg']=$msg;
          header("location:index.php");
        }

  }else{
    echo "Invalid file type";
  }

}
?>