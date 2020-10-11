<?php
session_start();
include("config/db.php");
if(isset($_POST['login']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	if($email!=''&&$password!='')
	{
		$passwd = sha1($password);
		$sql = "SELECT * FROM users WHERE email ='$email' AND password ='$passwd'";
		$result = mysqli_query($conn, $sql) or die('Error');
		if(mysqli_num_rows($result)>0)
		{
          while ($row = mysqli_fetch_assoc($result)) {
          	$id = $row['id'];
          	$username = $row['username'];
          	$password = $row['password'];
          	$email = $row['email'];

          	$_SESSION['id'] = $id;
          	$_SESSION['username'] = $username;
          	$_SESSION['email'] = $email;
          	$_SESSION['password'] = $password;
          	header('Location: dashboard.php');
          }
		}
	}
	else
	{
		$error = "Lütfen Bütün Alanları Doldurunuz";
	}
} 
?>
<?php if(isset($_SESSION['username'])): ?>
	<?php header('Location:dashboard.php'); ?>
	<?php else: ?>
<?php include("inc/header.php");?>
<div class="container">
<form class="form-horizontal" action="login.php" method="POST">
  <fieldset>
    <legend>ÜYE GİRİŞİ</legend>
   
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
        <input type="submit" name="login" value="Giriş" class="btn btn-primary">
        <button type="reset" class="btn btn-link">İptal</button>
      </div>
    </div>
  </div>
</div>
    <div class="row">
      <div class="form-group">
        <div class="col-lg-6">
        <?php if(isset($_POST['login'])):?>
        <div class="alert alert-dissmissible alert-warning"><p><?php echo $error; ?></p></div>
        <?php endif; ?>
      </div>
      </div>
      
    </div>
    
  </fieldset>
</form>
</div>
<?php include("inc/footer.php");?>
<?php endif; ?>