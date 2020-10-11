<?php 
include("config/db.php");
if(isset($_POST['register']))
{
 $username=$_POST['username'];
 $email=$_POST['email'];
 $password=$_POST['password'];
 if($username!=''&&$email!=''&&$password!='')
 {
   $pwd_hash = sha1($password);
   $sql = "INSERT into users (username,email,password,rol) VALUES ('$username','$email','$pwd_hash',0)";
   $query = $conn->query($sql);
   if($query)
   {
     header('Location:login.php');
   }
   else
   {
    $error = 'Kayıt Başarısız';
   }
 }
 else
 {
  $error = "Lütfen Bütün Alanları Doldurunuz";
 }
}
 ?>

<?php include("inc/header.php");?>
<div class="container">
<form class="form-horizontal" action="index.php" method="POST">
  <fieldset>
    <legend>ÜYE OL</legend>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="username" class="col-lg-2 col-form-label">Kullanıcı Adı</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="username" placeholder="Kullanıcı Adı">
      </div>
    </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="email" class="col-lg-2 col-form-label">Email</label>
      <div class="col-lg-10">
        <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
    </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <label for="password" class="col-lg-2 col-form-label">Şifre</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" name="password" placeholder="Şifre">
      </div>
    </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
      <div class="col-lg-10">
        <input type="submit" name="register" value="Üye Ol" class="btn btn-primary">
        <button type="reset" class="btn btn-link">İptal</button>
      </div>
    </div>
  </div>
</div>
    <div class="row">
      <div class="form-group">
        <div class="col-lg-6">
        <?php if(isset($_POST['register'])):?>
        <div class="alert alert-dissmissible alert-warning"><p><?php echo $error; ?></p></div>
        <?php endif; ?>
      </div>
      </div>
      
    </div>
    
  </fieldset>
</form>
</div>
<?php include("inc/footer.php");?>



