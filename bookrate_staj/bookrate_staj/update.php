<?php session_start(); ?>
<?php
include("config/db.php"); 
if(isset($_FILES['featuredimage']))
{
	$post_id= $_POST['id'];
  $title = $_POST['title'];
  $upl_feat_image= $_POST['featuredimage'];
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
      'file_tmp' => $d.php');
      }
      else
 file_tmp,
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
      $image_path= explode('/', $upl_feat_image);
      $image= $image_path[6]; 
      $full_url= $path.'/'.'assets/featuredimages/'.$file_name;
      $id = $_SESSION['id'];
      $sql = "UPDATE books SET featuredimage= '$full_url',description='$description',title='$title',author='$author',publisher='$publisher',pages='$pages',types='$types' 
      WHERE id='$post_id'";
      unlink("assets/featuredimages".$image);
      
      $query = $conn->query($sql);

      if($query)
      {
      header('Location: dashboard.php');     
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