<?php session_start(); ?>
<?php
include("config/db.php"); 
if(isset($_FILES['featuredimage']))
{
  $title = $_POST['title'];
  $types = $_POST['types'];
  $publisher = $_POST['publisher'];
  $pages = $_POST['pages'];
  $author = $_POST['author'];
$description = $_POST['description'];
  if($title != ""&&$types !=""&&$publisher !=""&&$pages !=""&&$author !=""&&$description !="")
  {
    $uploadok=1;
    $file_name= $_FILES['featuredimage']['name'];
    $file_size= $_FILES['featuredimage']['size'];
    $file_tmp= $_FILES['featuredimage']['tmp_name']; 
    $file_type= $_FILES['featuredimage']['type'];
    $target_dir = "assets/featuredimages";
    $target_file = $target_dir.basename($_FILES['featuredimage']['name']);
    $check = getimagesize($_FILES['featuredimage']['tmp_name']);
    $file_ext = strtolower(end(explode('.',$_FILES['featuredimage']['name'])));
    /*$data =  array(
      'file_name' => $file_name,
      'file_size' => $file_size,
      'file_tmp' => $file_tmp,
      'file_type' => $file_type,
      'target_dir' => $target_dir,
      'file_ext' => $file_ext);
    echo "<pre>";
    print_r($data);
    echo "<pre>";
    exit();*/
    $extensions = array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions) ==false)
    {
      $msg = "Lütfen uzantısı jpeg,jpg,png olan görselleri seçiniz";
    }
    if(file_exists($target_file))
    {
      $msg= "Böyle bir dosya halihazırda bulunmaktadır";
    }
    if($check== false)
    {
      $msg = "Bu dosya bir görsel değildir";
    }
    if(empty($msg) == true)
    {
      move_uploaded_file($file_tmp, "assets/featuredimages/".$file_name);
      $url = $_SERVER['HTTP_REFERER'];
      $seg = explode('/', $url);
      $path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
      $full_url = $path.'/'.'assets/featuredimages/'.$file_name;
      $id = $_SESSION['id'];
     $sql = "INSERT INTO books(featuredimage,title,types,pages,author,publisher,description,user_role) VALUES ('$full_url','$title','$types','$pages','$author','$publisher','$description','$id')";

      
      $query = $conn->query($sql);

      if($query)
      {
      header('Location: dashboard.php');
      }
      else
      {
      $msg = "Görsel Yüklenemedi";
      }
    }
  }
  else
  {
    $msg = "Lütfen Bütün Alanları Doldurunuz";
  }
}
?>
<?php if(!isset($_SESSION['username'])): ?>
	<?php header('Location:dashboard.php'); ?>
	<?php else: ?>
<?php include("inc/header.php");?>
<div class="container">
<form class="form-horizontal" action="post.php" method="POST" enctype="multipart/form-data">
  <fieldset>
    <legend>GÖNDERİ EKLE</legend>

   <div class="row">
        <div class="col-md-6">
        <div class="form-group">
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
        <input type="text" class="form-control" name="title" placeholder="Kitap Adı">
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
            <input type="text" class="form-control" name="pages" placeholder="Sayfa Sayısı">
          </div>
        </div>
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="author" class="col-lg-3 col-form-label">Yazarı</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" name="author" placeholder="Yazarı">
          </div>
        </div>
        
      </div>
    </div>
<div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="publisher" class="col-lg-3 col-form-label">Yayınevi</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" name="publisher" placeholder="Yayınevi">
          </div>
        </div>
        
      </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="description" class="col-lg-3 col-form-label">Açıklama</label>
      <div class="col-lg-9">
        <textarea class="form-control" rows="5" cols="10" name="description"></textarea>
      </div>
    </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <div class="col-lg-10">
        <input type="submit" name="post" value="Gönder" class="btn btn-primary">
       
        <button type="reset" class="btn btn-link">İptal</button>
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