<?php
include "header.php";
include "connection.php";
$id=$_GET['id'];
if (empty($id)) {
  header("location:index.php");
}
$sql="SELECT * FROM blog WHERE blog_id='$id'";
$run=mysqli_query($con,$sql);
$post=mysqli_fetch_assoc($run);


?>

<div class="container mt-3">
  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow">
        <div class="card-body">
          <div id="single_img">
            <?php $img=$post['blog_image']  ?>
           <a href="">
             <img src="admin/upload/<?= $img ?>"
             alt="">
           </a>
          </div>
          <div class="mt-3">
            <h5>
              <?= $post['blog_title'] ?>
            </h5>
            <p>
            <?= $post['blog_body'] ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php
    include "sidebar.php";
    ?>
  </div>
</div>




<?php
include "footer.php";
?>