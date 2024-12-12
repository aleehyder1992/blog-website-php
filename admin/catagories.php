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

?>



               <!-- Begin Page Content -->
               <div class="container-fluid">
                  <!-- Page Heading -->
                  <h5 class="mb-2 text-gray-800">Catagories</h5>
                  <!-- DataTales Example -->
                  <div class="card shadow">
                     <div class="card-header py-3 d-flex justify-content-between">
                        <div>
                           <a href="add_cat.php">
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
                                    <th>Category Name</th>
                                    
                                    <th colspan="2">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $sql="SELECT * FROM catagories limit $offset,$limit";
                                 $query=mysqli_query($con,$sql);
                                 $rows=mysqli_num_rows($query);
                                 $count=0;
                                 if ($rows) {
                                    while ($row=mysqli_fetch_assoc($query)) {
                                     ?>
                                     <tr>
                                       <td><?= ++$offset  ?></td>
                                       <td class="fw-bold"><?= $row['cat_name']; ?></td>
                                       <td>
                                          <a class="bg-success btn btn-sm text-white" href="edit_cat.php?id=<?= $row['cat_id']; ?>" class="">Edit</a>
                                         
                                       </td>

                                       <td>
                                          <form action="" method="POST" onsubmit="return confirm('Are your want delete')">
                                             <input type="hidden" name="cat_id" value="<?= $row['cat_id'] ?>">
                                             <input type="submit" name="deleteCat" value="Delete" class="btn btn-sm btn-danger">
                                          </form>
                                       </td>


                                     </tr>


                                    <?php


                                    }
                                 }else{
                                    ?>
                                    <tr><td colspan="4">No Record Found</td></tr>

                                    <?php
                              
                              
                                 }



                                  ?>
                              </tbody>
                           </table>
                           <!--PAGINATION-->
			<?php
			$pagination="SELECT * FROM catagories";
			$run_q=mysqli_query($con,$pagination);
			$total_post=mysqli_num_rows($run_q);
			$pages=ceil($total_post/$limit);

			?>
			<ul class="pagination pt-2 pb-5">
      <?php for ($i=1; $i <=$pages ; $i++) { ?>

			<li class="page-item">
		  <a href="catagories.php?pages=<?= $i ?>" class="page-link <?php if($i==$pages) { echo $active="active";
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
            if (isset($_POST['deleteCat'])) {
               $id=$_POST['cat_id'];
               $delete="DELETE FROM catagories WHERE cat_id='$id'";
               $run=mysqli_query($con,$delete);
               if($run){
                  $msg=['Catagory has been deleted successfully','alert-success'];
                  $_SESSION['msg']=$msg;
                  header("location:catagories.php");
            }else{
               $msg=['Failed,please try again','alert-danger'];
               $_SESSION['msg']=$msg;
               header("location:catagories.php");
            }

         }
            
            
            
            ?>
           