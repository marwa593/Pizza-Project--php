<?php
include('config/db_connect.php');

//write query from all pizzas
$sql='Select title,ingredients,id From pizzas Order by created_at';

//make query and get results
$result=mysqli_query($conn,$sql);

//fetch it all as a array
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);

//free result
mysqli_free_result($result);
mysqli_close($conn);

(explode(',', $pizzas[0]['ingredients']));





?>


<html>

<?php  include ('templates/header.php') ;?>

<h4 class="center grey-text">Pizzas!</h4>
<div class="container">
	<div class="row">
		<?php foreach ($pizzas as $pizza) : ?>
			<div class="col s6 md3">
			  <div class="card z-depth-0">
			  	<img src="img/1.png" class="pizza">
				<div class="card-content center">
					<h6><?php echo  htmlspecialchars($pizza['title']); ?></h6>
					<ul>
		                <?php foreach(explode(',' ,$pizza['ingredients']) as $ing) :?>
	                      <li> <?php echo htmlspecialchars($ing); ?> </li>
		  	              <?php endforeach ?>
		              </ul>
				</div>
				<div class="card-action right-align">
					<a class="brand-text" href="details.php?id=<?php echo $pizza['id']?>">more info</a>
				</div>
				</div>

			  </div>


		<?php endforeach ?>
			
		
		
	</div>
	
</div> 



<?php  include ('templates/footer.php') ;?>


</html>