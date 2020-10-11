<?php session_start();  ?>
<?php if(!isset($_SESSION['username'])):?>
	<?php header('Location: dashboard.php');  ?>
<?php else:  ?>
	<?php
	include("config/db.php");
    echo $id=$_GET['id'];
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
	<?php include("inc/header.php");?>
<div class="container">
<form class="form-horizontal" action="update.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="hidden" name="featuredimage" value="<?php echo $featuredimage;?>">
  <fieldset>
    <legend>GÖNDERİYİ GÜNCELLE</legend>

   <div class="row">
        <div class="col-md-6">
        <div class="form-g roup">
      <label for="featuredimage" class="col-lg-3 col-form-label">İlgili Görsel</label>
      <div class="col-lg-9">
        <input type="file" class="form-control" name="featuredimage" placeholder="İlgili Görsel">
      </div>
    </div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="title" class="col-lg-3 col-form-label">Kitap Adı</label>
      <div class="col-lg-9">
        <input type="text" value="<?php echo $title;?>"  class="form-control" name="title" placeholder="Kitap Adı">
      </div>
    </div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="types" class="col-lg-3 col-form-label">Tür</label>
      <div class="col-lg-9">
        <select name="types" placeholder="Tür" class="form-control">
        	<option value=<?php echo $types;  ?>><?php echo $types;  ?> </option>
          <option value="Dünya Klasikleri">Dünya Klasikleri</option>
          <option value="Korku-Gerilim">Korku Gerilim</option>
          <option value="Çocuk Kitapları">Çocuk Kitapları</option>
        </select>
      </div>
    </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="pages" class="col-lg-3 col-form-label">Sayfa Sayısı</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" value="<?php echo $pages;  ?>" name="pages" placeholder="Sayfa Sayısı">
          </div>
        </div>
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="author" class="col-lg-3 col-form-label">Yazarı</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" value="<?php echo $author;  ?>" name="author" placeholder="Yazarı">
          </div>
        </div>
        
      </div>
    </div>
<div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="publisher" class="col-lg-3 col-form-label">Yayınevi</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" value="<?php echo $publisher;?>" name="publisher" placeholder="Yayınevi">
          </div>
        </div>
        
      </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="description" class="col-lg-3 col-form-label">Açıklama</label>
      <div class="col-lg-9">
        <textarea class="form-control" rows="5" cols="10" name="description"><?php echo $description;?> </textarea>
      </div>
    </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <div class="col-lg-10">
        <input type="submit" name="post" value="Güncelle" class="btn btn-primary">
         <a href="dashboard.php" class="btn btn-link">Geri</a>
        
      </div>
    </div>
  </div>
</div>
    <div class="row">
      <div class="form-group">
        <div class="col-lg-6">
        <?php if(isset($_POST['profile'])):?>
        <div class="alert alert-dissmissible alert-warning"><p><?php echo $msg; ?></p></div>
        <?php endif; ?>
      </div>
      </div>
      
    </div>
    
  </fieldset>
</form>
</div>
<?php include("inc/footer.php");?>
<?php endif; ?>