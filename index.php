<?php 

include "header.php";
include "connection.php";
//pagination
if (!isset($_GET['pages'])) {
	$pages=1;
}else{
	$pages = $_GET['pages'];
}
$limit=5;
$offset=($pages-1)*$limit;

$sql="SELECT * FROM blog LEFT JOIN catagories ON blog.catagory=catagories.cat_id LEFT JOIN user ON blog.author_id=user.user_id ORDER BY blog.publish_date DESC limit $offset,$limit";
$run=mysqli_query($con,$sql);
$row=mysqli_num_rows($run);


?>
<div class="container mt-2">
	<div class="row">
		<div class="col-lg-8">
			<?php
       if ($row) {
				while ($result=mysqli_fetch_assoc($run)) {

					?>

			
			<div class="card shadow mb-3">

				<div class="card-body d-flex blog_flex">
					<div class="flex-part1">
						<a href="">
						<?php
                $img=$result['blog_image']
						?>
						
						<img src="admin/upload/<?= $img ?>"> </a>
					</div>
					<div class="flex-grow-1 flex-part2">
						  <a href="" id="title">
								<?=  ucfirst($result['blog_title']) ?>
							</a>
						<p>
						  <a href="single_post.php?id= <?= ($result['blog_id']) ?>" id="body">
							<?= strip_tags(substr(($result['blog_body']), 0,500))."..."  ?>
						  </a> <span><br>
                          <a href="single_post.php?id= <?= ($result['blog_id']) ?>" class="btn btn-sm btn-outline-primary">Continue Reading
                          </a></span>
                        </p>
						<ul>
							<li class="me-2"><a class="fw-bolder text-info" href=""> <span>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
																<?=  $result['username']; ?>
															</a>
							</li>
							<li class="me-2">
								<a class="fw-bolder text-dark" href=""> <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
								<?php $date=$result['publish_date']; ?>
								<?= date('d M Y', strtotime($date)); ?>
							</a>
							</li>
							<li>
								<a href="catagory.php?id=<?= $result['cat_id'] ?>" class="fw-bold text-danger"> <span><i class="fa fa-tag" aria-hidden="true"></i></span> 
								<?=  $result['cat_name']; ?>
							</a>
						    </li>
						</ul>
					</div>
				</div>
			</div>

			<?php } } ?>
			<!--PAGINATION-->
			<?php
			$pagination="SELECT * FROM blog";
			$run_q=mysqli_query($con,$pagination);
			$total_post=mysqli_num_rows($run_q);
			$pages=ceil($total_post/$limit);

			?>
			<ul class="pagination pt-2 pb-5">
      <?php for ($i=1; $i <=$pages ; $i++) { ?>

			<li class="page-item">
		  <a href="index.php?pages=<?= $i ?>" class="page-link <?php if($i==$pages) { echo $active="active";
      }else{
	    echo "";
      }  ?>">
		 <?= $i ?>
					</a>

				</li>
				<?php } ?>
			</ul>

		</div>
		<?php
      include "sidebar.php";

		?>
	</div>
</div>
<?php include 'footer.php'; 



?>