<?php  

include "connection.php";
$select="SELECT * FROM catagories";
$query=mysqli_query($con,$select);
// RECENT POSTS
$select2="SELECT * FROM blog ORDER BY publish_date limit 5";
$query2=mysqli_query($con,$select2);

?>

<div class="col-lg-4">
			<div class="card">
				<div class="card-body d-flex right-section">
					<div id="categories">
						<h6>Categories</h6>
						<ul>
							<?php while($cats=mysqli_fetch_assoc($query)) {?>
							<li>
								<a class="text-danger fw-bolder" href="catagory.php?id=<?= $cats['cat_id'] ?>"><?= $cats['cat_name'] ?></a>
							</li>
							<?php } ?>
						</ul>
					</div>
				    <div id="posts">
						<h6>Recent Posts</h6>
						<ul>
						<?php while($posts=mysqli_fetch_assoc($query2)) {?>
							<li>
								<a class="fw-bolder text-dark" href="single_post.php?id=<?= $posts['blog_id'] ?>">
									<?= $posts['blog_title'] ?>
								</a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>