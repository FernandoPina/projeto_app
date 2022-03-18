<?php 
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

session_start();
include('inc/mask.php');

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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
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
		a{
			text-decoration: none;
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
		          		<a class="nav-link" aria-current="page" href="index.php">Home</a>
		        	</li>
		        	<li class="nav-item">
		          		<a class="nav-link" href="clientes.php">Clientes</a>
		        	</li>
			        <li class="nav-item">
			          	<a class="nav-link" href="produtos.php">Produtos</a>
			        </li>
			        <li class="nav-item">
			          	<a class="nav-link active" href="pedidos.php">Pedidos</a>
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
		<h2 align="center">Pedidos</h2>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-4 offset-md-2">
				<form class="d-flex">
			        <input class="form-control me-2" type="search" placeholder="Buscar por cliente" aria-label="Search" name="id">
			        <button class="btn btn-outline-success" type="submit">Buscar</button>
			    </form>
			</div>
		</div>
		<div class="col-md-8 offset-md-2" style="margin-top: 20px;">
			<table class="table table-striped">
			  	<thead>
			    	<tr>
			      	<th scope="col">ID Pedido</th>
			      	<th scope="col">Cliente</th>
			      	<th scope="col">Data</th>
			      	<th scope="col">Valor</th>
			      	<th scope="col">Porcentagem</th>
			    </tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		if (isset($_GET['id'])) {
			  			$id = $_GET['id'];			  		
			  			$valorTotal = 0;
			  			$totalPedidos = 0;
			  			$porcentagem = 0;	
			  			require_once "inc/config.php";

			  			$sqlValor = $pdo->prepare("SELECT valor_pedido FROM pedidos WHERE id_cliente = '".$id."'");
			  			$sqlValor->execute();
			  			while($rowValor = $sqlValor->fetch()){
			  				$valorTotal += $rowValor['valor_pedido'];
			  				$totalPedidos++;
			  			}

			  			$sql = "SELECT pedidos.id_pedidos, pedidos.id_cliente, pedidos.data_pedido, pedidos.valor_pedido, clientes.nome_cliente FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id_cliente WHERE pedidos.id_cliente = '".$id."'";
	        
						if($stmt = $pdo->prepare($sql)){         
						    if($stmt->execute()){
						        if($stmt->rowCount() != 0){
						            while($row = $stmt->fetch()){
					?>

					<tr>
			      		<th scope="row"><?=$row['id_pedidos']?></th>
			      		<td><?=$row['nome_cliente']?></td>
			      		<td><?=$row['data_pedido']?></td>
			      		<td>R$<?=number_format($row['valor_pedido'], 2, ",", ".")?></td>
			      		<td>
			      			<?php
			      				$porcentagem = ($row['valor_pedido']*100)/$valorTotal;
			      				$porcentagem = number_format($porcentagem, 2, '.', '');
			      				echo $porcentagem.'%';
			      			?>			      				
			      		</td>
			    	</tr>

					<?php
									}
								}
							}
						}
					?>
			    	
			  	</tbody>
			</table>
		</div>
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-2 offset-md-2">
				<b>Total de pedidos: </b>
				<?php
					if ($stmt->rowCount() != 0) {
						echo $totalPedidos;
					}else{
						echo '0';
					}
					
				 ?>
			</div>
			<div class="col-md-2 offset-md-4">
				<b>Valor total: </b>
				R$<?php
					if ($stmt->rowCount() != 0) {
						echo number_format($valorTotal, 2, ",", ".");
					}else{
						echo '0,00';
					}
					
				  ?>
			</div>
		</div>
	<?php }?>
	</div>

</body>

</html>