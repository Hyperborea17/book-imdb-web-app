<?php
session_start(); 

?>
<?php
include("config/db.php");
$id = $_SESSION['id'];
$query = "SELECT * FROM profile WHERE id= '$id'";

$result = mysqli_query($conn,$query) or die('error');
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
    {
    	$id = $row['id'];
    	$avatar = $row['avatar'];
    	$profession = $row['profession'];
    }
}
?>
<?php if(!$_SESSION['username']): ?>
<?php header('Location: login.php'); ?>
<?php else: ?>	
<?php include("inc/header.php");?>
<div class="container">
	<?php
	$url = $_SERVER['PHP_SELF'];
	$seg = explode('/',$url);
    $path = "http://localhost".$seg[0].'/'.$seg[1];
    $full_url = $path.'/'.'img'.'/'.'avatar.png';
	?>
	
	<h1 style="text-align: center;"><?php echo $_SESSION['username'];?></h1>
	<div class="row">
		<div class="col-lg-12">
			<p style="text-align: center;">
				<?php if(isset($avatar)): ?>
				<img src=<?php echo $avatar;?> style="width: 200px; height: 200px; border-radius: 50%;"/>
				<?php else: ?>
					<img src=<?php echo $full_url;?>>
				<?php endif; ?>
		</p>
		<?php if($_SESSION['id']==1):?>
		<h1 style="text-align: center;">Admin</h1>
    <?php else:?>
    	<h1 style="text-align: center;">Kullanıcı</h1>
    <?php endif;?>
			
		</div>
	</div>
	<h1 style="text-align: center;">TÜM GÖNDERİLER</h1>
	</div>
	<?php 
	$posts_query="SELECT * FROM books";
	$posts_result= mysqli_query($conn, $posts_query) or die("error");
	if (mysqli_num_rows($posts_result)>0) {
		while ($posts= mysqli_fetch_assoc($posts_result)) {
			$id= $posts['id'];
			$title = $posts['title'];
            $types = $posts['types'];
            $publisher = $posts['publisher'];
            $pages = $posts['pages'];
            $author = $posts['author'];
            $description = $posts['description'];
            $featuredimage= $posts['featuredimage'];
            ?>
            <div class="row">
		<div class="col-lg-2">
			<img src=<?php echo $featuredimage;?> style="width: 150px; height: 150px;"/>
		</div>
		<div class="col-lg-10">
			<h3><a href=""><?php echo $title;?></a></h3>
			<p><?php echo $description; ?></p>
			<p><?php echo "<strong>Sayfa Sayısı: </strong> ".$pages." <strong>Yazarı: </strong> ".$author; ?></p>
			<p><?php echo "<strong>Yayınevi: </strong> ".$publisher;?></p>
			<a href=""><?php echo $types;?></a>
			<div class="row">
				<div class="col-lg-1"><a href=view.php?id=<?php echo $id;?>>İNCELE</a></div>
				<div class="col-lg-1"><a href=edit.php?id=<?php echo $id;?>>DÜZENLE</a></div>
				<div class="col-lg-1"><a href="delete.php?id">SİL</a></div>
			</div>
		</div>
	</div>
            <?php
		}
		
	}
	 ?>
	
</div>
<?php include("inc/footer.php");?>

<?php endif; ?>