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
		          		<a class="nav-link active" href="clientes.php">Clientes</a>
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
		<h2 align="center">Clientes</h2>
		<div class="col-md-8 offset-md-2" style="margin-top: 50px;">
			<a  onclick="modalView('','adicionar')"><span class="badge bg-custom btn" style="float: right;">Adicionar</span></a>
			<table class="table table-striped">
			  	<thead>
			    	<tr>
			      	<th scope="col">#</th>
			      	<th scope="col">Nome</th>
			      	<th scope="col">CPF</th>
			      	<th scope="col">Telefone</th>
			      	<th scope="col">Opções</th>
			    </tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  			require_once "inc/config.php";

			  			$sql = "SELECT * FROM clientes";
	        
						if($stmt = $pdo->prepare($sql)){         
						    if($stmt->execute()){
						        if($stmt->rowCount() != 0){
						            while($row = $stmt->fetch()){?>

					<tr>
			      		<th scope="row"><?=$row['id_cliente']?></th>
			      		<td><?=$row['nome_cliente']?></td>
			      		<td><?=mask($row['cpf_cliente'], '###.###.###-##')?></td>
			      		<td><?=mask($row['telefone_cliente'], '(##) ####-####')?></td>
			      		<td>
			      			<a>
			      				<span class="badge bg-success" onclick="modalView(<?=$row['id_cliente']?>,'ver')">
			      					<i class="fas fa-eye" title="Visualizar"></i>
			      				</span>
			      			</a>

			      			<a>
			      				<span class="badge bg-primary" title="Editar" onclick="modalView(<?=$row['id_cliente']?>,'editar')">
			      					<i class="fas fa-edit" title="Editar"></i>
			      				</span>
			      			</a>

			      			<a>
			      				<span class="badge bg-danger" onclick="modalView(<?=$row['id_cliente']?>,'remover')">
			      					<i class="far fa-trash-alt" title="Remover"></i>
			      				</span>
			      			</a>
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
	</div>

	<div id='getModal'>

    </div>

        <!-- Modal -->
  	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h5 class="modal-title" id="exampleModalLabel">Quase pronto...</h5>
          			<button onclick="document.location.reload(true)" type="button" class="close">
            			<span aria-hidden="true">&times;</span>
          			</button>
        		</div>
        		<div class="modal-body mt-5 mb-5" align="center" id="response">
            		<div class="spinner-border text-success"  style="width: 5rem; height: 5rem;" role="status">
                		<span class="sr-only">Cadastrando...</span>
            		</div>
        		</div>
      		</div>
    	</div>
  	</div>

</body>



<script>
    function modalView(id, tipo){
    	if (tipo == 'ver') {
    		$("#getModal").load('clientes/modal_ver.php?id='+id);
    	}
    	if (tipo == 'editar') {
    		$("#getModal").load('clientes/modal_editar.php?id='+id);
    	}
    	if (tipo == 'remover') {
    		$("#getModal").load('clientes/modal_remover.php?id='+id);
    	}
    	if (tipo == 'adicionar') {
    		$("#getModal").load('clientes/modal_adicionar.php?id='+id);
    	}
       	
    }

    $('.modal-backdrop').remove();
        
        
</script>

</html>