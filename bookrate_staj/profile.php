<?php session_start(); ?>
<?php
include("config/db.php"); 
if(isset($_FILES['avatar']))
{
  $profession = $_POST['profession'];
  if($profession != "")
  {
    $uploadok=1;
    $file_name= $_FILES['avatar']['name'];
    $file_size= $_FILES['avatar']['size'];
    $file_tmp= $_FILES['avatar']['tmp_name']; 
    $file_type= $_FILES['avatar']['type'];
    $target_dir = "assets/uploads";
    $target_file = $target_dir.basename($_FILES['avatar']['name']);
    $check = getimagesize($_FILES['avatar']['tmp_name']);
    $file_ext = strtolower(end(explode('.',$_FILES['avatar']['name'])));
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
      move_uploaded_file($file_tmp, "assets/uploads/".$file_name);
      $url = $_SERVER['HTTP_REFERER'];
      $seg = explode('/', $url);
      $path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
      $full_url = $path.'/'.'assets/uploads/'.$file_name;
      $id = $_SESSION['id'];
      $sql = "INSERT INTO profile(profession,avatar,usr_role) VALUES ('$profession','$full_url','$id')";
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
<form class="form-horizontal" action="profile.php" method="POST" enctype="multipart/form-data">
  <fieldset>
    <legend>PROFİL EKLE</legend>
   
     <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="profession" class="col-lg-2 col-form-label">Ünvan</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="profession" placeholder="Profession">
      </div>
    </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="avatar" class="col-lg-2 col-form-label">Avatar</label>
      <div class="col-lg-10">
        <input type="file" class="form-control" name="avatar" placeholder="Avatar">
      </div>
    </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <div class="col-lg-10">
        <input type="submit" name="profile" value="Profil Ekle" class="btn btn-primary">
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