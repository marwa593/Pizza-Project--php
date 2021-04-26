<?php
include('config/db_connect.php');

$email=$title=$ingredients="";

$errors=array('email'=>"" ,'title'=>"" , 'ingredients'=>"");
if(isset($_POST['submit']))
{

//check email
 if(empty($_POST['email']))
{
	$errors['email']= 'an email is required' . "<br/>";
}
else{
	$email=$_POST['email'];
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$errors['email'] ="email must be a vaild email address";
	}
}

//check title
if(empty($_POST['title']))
{
	$errors['title'] ='the title is required' . "<br/>";
}
else{
	
	$title=$_POST['title'];
	if(!preg_match('/^[a-zA-Z\s]+$/',$title))
	{
		$errors['title']= 'title must be letters and spaces only';
	}
}


if(empty($_POST['ingredients']))
{
	$errors['ingredients'] ='the ingredients is required' . "<br/>";
}
else{
	$ingredients= $_POST['ingredients'];
	if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients))
	{
		$errors['ingredients'] ='ingredients must be a comma seprated list';
	}
}



if(array_filter($errors))
{
	echo "there is an error" ;
}
else {

	$email =mysqli_real_escape_string($conn,$_POST['email']);
	$title=mysqli_real_escape_string($conn,$_POST['title']);
	$ingredients=mysqli_escape_string($conn,$_POST['ingredients']);



   //create sql
  $sql="INSERT INTO PIZZAS(email,title,ingredients) VALUES('$email','$title','$ingredients')";

  //save data and check
	if(mysqli_query($conn, $sql))
	{  
		header('location: index.php');
    } else {
	 echo "error is : " . mysqli_error($conn);
    }

} 
}//check post

 ?>


<html>

<?php  include ('templates/header.php') ;?>

<section class="container grey-text">
	<h4 class="center"> Add A Pizza  </h4>
	<form class="white" action="" method="POST">
		<label>Your Email: </label>
		<input type="text" name="email" value ="<?php  echo $email ;?>" >
		<div class="red-text"><?php echo $errors['email'] ;?></div>

		<label>Pizza Title: </label>
		<input type="text" name="title" value ="<?php  echo $title ;?>">
		<div class="red-text"> <?php echo $errors['title']?></div>

		<label>Ingredients (comma seperated): </label>
		<input type="text" name="ingredients" value ="<?php  echo $ingredients ;?>">
		<div class="red-text"><?php echo $errors['ingredients'] ;?></div>
		<div calss="center"> 
		<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></div>
		
	</form>


</section>

<?php  include ('templates/footer.php') ;?>
</html>