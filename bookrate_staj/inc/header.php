<!DOCTYPE html>
<html>
<head>
<title>BOOKRATE</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/css/logo.css">
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="col-lg-10"> 
		<a class="navbar-brand" href="#"><img src="img/logo2.png" id="logo"></a>
	</div>
	<div class="col-lg-2" style="margin-top: 8px;">
		<div class="btn-group">
			<a href="#" class="btn btn-primary">Ayarlar</a>
			<a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<?php  $login_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];?>
				<?php if($login_url == 'http://localhost/bookrate_staj/index.php'):?>
				<li><a href="login.php">Giriş Yap</a></li>
				<?php elseif(isset($_SESSION['username'])): ?>
					<li><a href="dashboard.php">Anasayfa</a></li>
					<li><a href="profile.php">Profil Ekle</a></li>
                <li><a href="post.php">Gönderi Ekle</a></li>
                <li><a href="logout.php">Çıkış Yap</a></li>
				
				<?php else: ?>
					<li><a href="index.php">Üye Ol</a></li>
				<?php endif; ?>
				<!---
				--->
			</ul>
		</div>
	</div>
 
</nav>
