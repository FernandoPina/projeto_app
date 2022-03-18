<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
// Inicialize a sessão
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: painel.php");
    exit;
}
 
require_once "inc/config.php";
  
if (isset($_POST['user'])) {
	// Prepare uma declaração selecionada
	$sql = "SELECT id_user, user, senha FROM user WHERE user = :user AND senha = :senha";
	        
	if($stmt = $pdo->prepare($sql)){
	    // Vincule as variáveis à instrução preparada como parâmetros
	    $stmt->bindParam(":user", $_POST['user'], PDO::PARAM_STR); 
	    $stmt->bindParam(":senha", $_POST['password'], PDO::PARAM_STR);           
	            
	    // Tente executar a declaração preparada
	    if($stmt->execute()){
	        // Verifique se o nome de usuário existe, se sim, verifique a senha
	        if($stmt->rowCount() == 1){
	            if($row = $stmt->fetch()){
	                $id = $row["id_user"];
	                $username = $row["user"];

	                    session_start();
	                            
	                    // Armazene dados em variáveis de sessão
	                    $_SESSION["loggedin"] = true;
	                    $_SESSION["id"] = $id;
	                    $_SESSION["user"] = $username;                            
	                            
	                    // Redirecionar o usuário para a página de boas-vindas
	                    echo "<script>window.location.href='painel.php';</script>";
	            }
	        } else{
	            // O nome de usuário não existe, exibe uma mensagem de erro genérica
	            $login_err = "Nome de usuário ou senha inválidos.";
	            echo "<script>alert('".$login_err."')</script>";
	        }
	    } else{
	        echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
	    }

	    // Fechar declaração
	    unset($stmt);
	}
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
	<nav class="navbar navbar-dark bg-custom">
	  	<div class="container-fluid">
	    	<a class="navbar-brand" href="#">
	      	<img src="img/shop-icon.png" alt="" width="50" height="50">
	      	Painel - Administrador
	    	</a>
	  	</div>
	</nav>

	<div class="container">
		<div class="col-md-4 offset-md-4">
			<form method="POST" action="#">
				<div class="card text-center" style="margin-top: 50px;">
				  	<div class="card-header">
				    	Administrador
				  	</div>
				  	<div class="card-body">
				    	<div class="input-group mb-3">
						  	<span class="input-group-text bg-custom"><ion-icon class="color-white" name="person-outline"></ion-icon></span>
						  	<input name="user" type="text" class="form-control" aria-label="nome de usuário">
						</div>
						<div class="input-group mb-3">
						  	<span class="input-group-text bg-custom"><ion-icon class="color-white" name="key-outline"></ion-icon></span>
						  	<input name="password" type="password" class="form-control" aria-label="senha">
						</div>
				  	</div>
				  	<input class="btn card-footer text-light bg-custom" type="submit">
				</div>
			</form>				
		</div>
	</div>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>