<?php include 'header.php';


if ($admin!=1) {
   header('location: index.php');
}

//pagination
if (!isset($_GET['pages'])) {
	$pages=1;
}else{
	$pages = $_GET['pages'];
}
$limit=5;
$offset=($pages-1)*$limit;


$sql="SELECT * FROM user limit $offset,$limit";
$query=mysqli_query($con,$sql);
$rows=mysqli_num_rows($query);


?>



               <!-- Begin Page Content -->
               <div class="container-fluid">
                  <!-- Page Heading -->
                  <h5 class="mb-2 text-gray-800">Users</h5>
                  <!-- DataTales Example -->
                  <div class="card shadow">
                     <div class="card-header py-3 d-flex justify-content-between">
                        <div>
                           <a href="add_user.php">
                              <h6 class="font-weight-bold text-primary mt-2">Add New</h6>
                           </a>
                        </div>
                        <div>
                           <form class="navbar-search">
                              <div class="input-group">
                                 <input type="text" class="form-control bg-white border-0 small" placeholder="Search for...">
                                 <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"> <i class="fa fa-search"></i> </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                 <tr>
                                    <th>Sr.No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    
                                    <th colspan="2">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                <?php
                                $count=0;
                                if($rows) {
                                 while($result=mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr>
                                       <td><?= ++$offset ?></td>
                                       <td><?= $result['username'] ?></td>
                                       <td><?= $result['email'] ?></td>
                                       <td>

                                          <?php
                                          $role=$result['role'];
                                          if($role==1){
                                             echo "Admin";
                                          }else{
                                             echo "Co-Admin";
                                          }
                                           ?>
                                       </td>
                                       <td>
                                       <form class="mt-2" action="" method="POST" onsubmit="return confirm('Are your want delete')">
                                             <input type="hidden" name="userid" value="<?= $result['user_id'] ?>">
                                             <input type="submit" name="deleteUser" value="Delete" class="btn btn-sm btn-danger">
                                          </form>
                                       </td>
                                     
                                       </tr>
                                            <?php

                                          }
                                }else{
                                 ?>
                                 <tr>
                                    <td>No Record Found</td>
                                 </tr>

                                 <?php
                                }


                                 ?>
                              </tbody>
                              
                           </table>
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
		  <a href="users.php?pages=<?= $i ?>" class="page-link <?php if($i==$pages) { echo $active="active";
      }else{
	    echo "";
      }  ?>">
		 <?= $i ?>
					</a>

				</li>
				<?php } ?>
			</ul>

		</div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </div>
            <?php include 'footer.php';
             if (isset($_POST['deleteUser'])) {
               $id=$_POST['userid'];
               $delete="DELETE FROM user WHERE user_id='$id'";
               $run=mysqli_query($con,$delete);
               if($run){
                  $msg=['User has been deleted successfully','alert-success'];
                  $_SESSION['msg']=$msg;
                  header("location:users.php");
            }else{
               $msg=['Failed,please try again','alert-danger'];
               $_SESSION['msg']=$msg;
               header("location:users.php");
            }

         }
            
            
           
            
            ?>
           