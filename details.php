<?php
include('config/db_connect.php');


if(isset($_POST['delete']))
{
	$id_to_delete =mysqli_real_escape_string($conn,$_POST['id_to_delete']);
	$sql="DELETE  FROM pizzas WHERE  id =$id_to_delete";
	if(mysqli_query($conn,$sql))
	{
		header("location: index.php");
	}else
	{
		echo "query error " . mysqli_error($conn);
	}


}
//check get request
if(isset($_GET['id']))
{

  $id =mysqli_real_escape_string($conn,$_GET['id']);

  //make sql
  $sql="SELECT * FROM pizzas WHERE ID=$id";

  //get data
  $result=mysqli_query($conn,$sql);

  //fetch it
  $pizza=mysqli_fetch_assoc($result);

  //free data
  mysqli_free_result($result);

  mysqli_close($conn);

}


 ?>

 <html>

 <?php  include ('templates/header.php') ;?>


 <div class="container center grey-text">
 	<?php if($pizza): ?>

 		<h4> <?php  echo htmlspecialchars($pizza['title']);?></h4>
 		<p>created by :<?php echo htmlspecialchars($pizza['email']);  ?></p>
 		<p><?php echo date($pizza['created_at']); ?></p>
 		<h5>ingerdients </h5>
 		<p>  <?php echo htmlspecialchars($pizza ['ingredients']); ?></p>


   
      <form action="details.php" method="POST">
      	<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?> ">
      	<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0"></input>
      </form>

 	<?php else:   ?>
 		<h5>No such pizzas exsits!</h5>
 	<?php endif; ?>
 	
 </div>


 <?php  include ('templates/footer.php') ;?>

 
 </style>

 </html>
