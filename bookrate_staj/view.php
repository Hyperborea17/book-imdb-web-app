<?php session_start();  ?>
<?php if(!isset($_SESSION['username'])):?>
	<?php header('Location: dashboard.php');  ?>
<?php else:  ?>
<?php
include ('inc/header.php');  
?>
<?php
include ('config/db.php');  
?>
<div class="container">
	<h1>GÖNDERİYİ İNCELE</h1>
	<?php $id=$_GET['id']; ?>
	<?php 
	$posts_query="SELECT * FROM books WHERE id='$id'";
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
        }
    }
            
	 ?>
	<div class="row justify-content-center">
		<h1 style="text-align: center;"><?php echo $title; ?></h1>
		<div class="col-lg-4">
			<img src=<?php echo $featuredimage; ?> style="width: 150px;">
		</div>
		<div class="col-lg-7">
			<p><?php echo $description; ?></p>
			<p><?php echo "<strong>Sayfa Sayısı: </strong> ".$pages." <strong>Yazarı: </strong> ".$author; ?></p>
			<p><?php echo "<strong>Yayınevi: </strong> ".$publisher;?></p>
			<a href=""><?php echo $types;?></a>
			<br>
			<div class="row">

				<div class="col-lg-2">
					<form action="score.php" method="POST">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<?php 
	$posts_query="SELECT * FROM score WHERE post_id='$id'";
	$posts_result= mysqli_query($conn, $posts_query) or die("error");
	if (mysqli_num_rows($posts_result)>0) {
		while ($posts= mysqli_fetch_assoc($posts_result)) {
			$id= $posts['id'];
			$scores= $posts['scores'];
			$total= $total+$scores;
			$i++;
			$average=$total/$i;
        }
    }
            
	 ?>
						<select name="scores" placeholder="Puan" class="form-control">
        	<option value="1">1</option>
        	<option value="2">2</option>
        	<option value="3">3</option>
        	<option value="4">4</option>
        	<option value="5">5</option>
                   </select>
                   <p><strong>Puan:</strong><?php echo $average; ?></p>
                   <input type="submit" name="score" value="Puanla"class="btn btn-link">
					</form>
				</div>
				<div class="col-lg-2">
					<a href="">Yorum(0)</a>
				</div>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-6">
			<form class="form-horizontal" action="comment.php" method="POST">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<div class="form-group">
					<label class="col-lg-3 control-label">Yorumla</label>
					<div class="col-lg-9">
						<textarea class="form-control" rows="5" cols="10" name="comment" placeholder="Yorum"></textarea>
					</div>
				</div>
				 <input type="submit" name="postcomment" value="Yorum Yap" class="btn btn-primary">
				 <a href="dashboard.php" class="btn btn-link">Geri</a>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-6">
			<hr>
			<h1>Yorumlar</h1>
			<?php 
			$com_query = "SELECT * FROM comments WHERE post_id = '$id' ORDER BY id DESC";
			$coms_result = mysqli_query($conn,$com_query) or die("error");
            
	if (mysqli_num_rows($coms_result)>0) {
		while ($com= mysqli_fetch_assoc($coms_result)) {
			$username= $com['username'];
			$comment=$com['comment'];
		
			?>
			<p><?php echo $comment; ?></p>
			<p><?php echo $username; ?></p>
			<hr>
     
		<?php }}  ?>
		</div>
	</div>
</div>
<?php
include ('inc/footer.php');  
?>
<?php endif;  ?>