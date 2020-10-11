<?php session_start();  ?>
<?php if(!isset($_SESSION['username'])):?>
	<?php header('Location: dashboard.php');  ?>
<?php else:  ?>
<?php
include ('config/db.php'); 
$user_id= $_SESSION['id'];
if(isset($_POST['postcomment']))
{
	 $userid= $_SESSION['id'];
	 $username=$_SESSION['username'];
	 $postid=$_POST['id'];
	 $comment= $_POST['comment'];
	 if($comment!="")
	 {
	 	 $sql= "INSERT INTO comments (user_id,post_id,username,comment) VALUES('$user_id','$postid','$username','$comment')";
	 if($conn->query($sql))
	 {
	 	header('Location: view.php?id='.$post_id);
	 }
	 }
	
}
?>


<?php endif;  ?>