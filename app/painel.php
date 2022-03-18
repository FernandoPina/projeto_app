<?php 
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION["loggedin"])){
    header("location: index.php");
    exit;
}

if(isset($_GET['sair'])){
    session_destroy();
    echo "<script>window.location.href='index.php';</script>";
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
	<title>Painel - Administrador</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
	<style type="text/css">
		.bg-custom{
			background-color: #003641;
		}
		.color-white{
			color: #FFF;
		}
	</style>

	<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
	  	<div class="container-fluid">
	    	<a class="navbar-brand" href="index.php">
	      		<img src="img/shop-icon.png" alt="" width="50" height="50">
	      		Painel - Administrador
	    	</a>
		    <div class="collapse navbar-collapse" id="navbarNav">
		      	<ul class="navbar-nav">
		        	<li class="nav-item">
		          		<a class="nav-link active" aria-current="page" href="index.php">Home</a>
		        	</li>
		        	<li class="nav-item">
		          		<a class="nav-link" href="clientes.php">Clientes</a>
		        	</li>
			        <li class="nav-item">
			          	<a class="nav-link" href="produtos.php">Produtos</a>
			        </li>
			        <li class="nav-item">
			          	<a class="nav-link" href="pedidos.php">Pedidos</a>
			        </li>
			        <li class="nav-item" style="right:  50px; position: absolute;">
			          	<a class="nav-link" href="?sair">Sair</a>
			        </li>
		      	</ul>
		    </div>
	  	</div>
	</nav>

	<div class="container">
		<br>
		<h2 align="center">Seja bem-vindo <?=$_SESSION["user"]?></h2>
		<div class="col-md-4 offset-md-4">
			<img src="img/shop-icon.png" style="width: 100%; margin-top: 50px;">
		</div>
		
	</div>

</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>