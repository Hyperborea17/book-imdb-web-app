<?php session_start();  ?>
<?php if(!isset($_SESSION['username'])):?>
	<?php header('Location: dashboard.php');  ?>
<?php else:  ?>
<?php
include ('config/db.php'); 
$user_id= $_SESSION['id'];
if(isset($_POST['score']))
{
	 $post_id= $_POST['id'];
	 $scores= $_POST['scores'];
	 $sql= "INSERT INTO score (user_id,post_id,scores) VALUES('$user_id','$post_id','$scores')";
	 if($conn->query($sql))
	 {
	 	header('Location: view.php?id='.$post_id);
	 }
}
?>


<?php endif;  ?>