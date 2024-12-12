<?php include "header.php";
if (isset($_SESSION['user_data'])) {
    $author_id=$_SESSION['user_data']['0'];

// fetch catagories
$sql="SELECT * FROM catagories";
$query=mysqli_query ($con,$sql);

// GET BLOG ID
$blogID = $_GET['id'];
$sql2 = "SELECT * FROM blog LEFT JOIN catagories ON blog.catagory=catagories.cat_id LEFT JOIN user ON blog.author_id=user.user_id WHERE blog_id='$blogID'";

$query2 = mysqli_query($con, $sql2);
$result=mysqli_fetch_assoc ($query2);

}
?>

<div class="container">

<h5 class="mb-2 text-gray-800">Blogs</h5>
 <div class="row">
  <div class="col-xl-8 col-lg-6">
    <div class="col-xl-12 col-lg-12">
      <div class="card">
         <div class="card-header">
           <h6 class="font-weight-bold text-primary mt-2">Edit Article</h6>
         </div>
         <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class=mb-3>
              <input type="text" name="blog_title" placeholder="Blog Title" class="form-control" required value="<?= $result['blog_title'] ?>"
            </div>
            <div class="mb-3">
              <label>Blog Description</label>
              <textarea class="form-control" name="blog_body" name="blog_body" rows="3" id="blog">
                <?= $result['blog_body'] ?>
              </textarea> 
            </div>
            <div class="mb-3">
              <input type="file" name="blog_image" class="form-control">
              <img src="upload/<?= $result['blog_image'] ?>" width:100px; />
            </div>
            <div class="mb-3">
             <select class="form-control" name="catagory" required>
              <?php
               while ($cats=mysqli_fetch_assoc($query)) { ?>
               <option value="<?= $cats['cat_id'] ?>"
               
               <?php
               if ($result['catagory']==$cats['cat_id']) {
                echo "selected";

               }
               else{
                echo "";
               }

               ?>>
                
               
               
               <?= $cats['cat_name'] ?>
              </option>

              <?php } ?>

             </select>
            </div>
            <div class="mb-3">
            <input type="submit" name="edit_blog" Value="Update" placeholder="Catogory Name" class="btn btn-primary" >

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


  if (isset($_POST['edit_blog'])) {
   $title=mysqli_real_escape_string($con,$_POST['blog_title']);
   $body=mysqli_real_escape_string($con,$_POST['blog_body']);

   $filename=$_FILES['blog_image']['name'];
   $tmp_name=$_FILES['blog_image']['tmp_name'];
   $size=$_FILES['blog_image']['size'];
   $image_ext=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
   $allow_type=['jpg','png','jpeg'];
   $destination="upload/".$filename;

   $catagory=mysqli_real_escape_string($con,$_POST['catagory']);
  if (!empty($filename)) {
    
    if (in_array($image_ext,$allow_type)) {
      if ($size <= 2000000) {
        $unlink="upload/".$result['blog_image'];
        unlink($unlink);
        move_uploaded_file($tmp_name,$destination);
        $sql3="UPDATE blog SET blog_title='$title',blog_body='$body',blog_image='$filename',author_id='$author_id',catagory='$catagory' WHERE blog_id='$blogID'";
       $query3=mysqli_query($con,$sql3);
       if ($query3) {
        $msg=['Post Updated Successfully','alert-success'];
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
  $sql3="UPDATE blog SET blog_title='$title',blog_body='$body',catagory='$catagory' WHERE blog_id='$blogID'";
  $query3=mysqli_query($con,$sql3);
  if ($query3) {
   $msg=['Post Updated Successfully','alert-success'];
   $_SESSION['msg']=$msg;
  header("location:index.php");
  }else{
   $msg=['Please Try Again','alert-danger'];
   $_SESSION['msg']=$msg;
   header("location:index.php");
  }
}
  }

 }


?>