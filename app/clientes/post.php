<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "../inc/config.php";


//validar tipo da operação
if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo'];

    //adicionar novo cliente
    if($tipo == 'adicionaCliente'){
    	$cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];

        if (empty($nome) or empty($cpf) or empty($telefone)) {
        	echo '<h4 style="color: brown">Preencha todos os campos!</h4>';
        	exit;
        }      
        if (!is_numeric($cpf)) {
        	echo '<h4 style="color: brown">Preencha o campo CPF utilizando apenas números</h4>';
        	exit;
        }
        if (strlen($cpf)!=11) {
          echo '<h4 style="color: brown">Informe um CPF válido</h4>';
          exit;
        }
        if (strlen($telefone) < 10 or strlen($telefone)>10) {
        	echo '<h4 style="color: brown">Preencha o campo telefone utilizando 10 digitos</h4>';
        	exit;
        }

        try {

        
          $stmt = $pdo->prepare('INSERT INTO clientes (id_cliente, cpf_cliente, nome_cliente, telefone_cliente) VALUES (null, :cpf, :nome, :telefone)');
          $stmt->execute(array(
            ':cpf'   => $cpf,
            ':nome'   => $nome,
            ':telefone'   => $telefone
          ));
        
          echo '<h4 style="color: #003641">Cadastro realizado com sucesso</h4>';
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }


       
       	exit;
    }

    //editar cadastro de cliente

    if($tipo == 'updateCliente'){
        $cpf = $_POST['cpf'];
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];

        if (empty($nome) or empty($cpf) or empty($telefone)) {
        	echo '<h4 style="color: brown">Preencha todos os campos!</h4>';
        	exit;
        }      
        if (!is_numeric($cpf)) {
        	echo '<h4 style="color: brown">Preencha o campo CPF utilizando apenas números</h4>';
        	exit;
        }
        if (strlen($cpf)!=11) {
          echo '<h4 style="color: brown">Informe um CPF válido</h4>';
          exit;
        }
        if (strlen($telefone) < 10 or strlen($telefone)>10) {
        	echo '<h4 style="color: brown">Preencha o campo telefone utilizando 10 digitos</h4>';
        	exit;
        }

        try {

        
          $stmt = $pdo->prepare('UPDATE clientes SET cpf_cliente = :cpf, nome_cliente = :nome, telefone_cliente = :telefone WHERE id_cliente = :id');
          $stmt->execute(array(
            ':id'   => $id,
            ':cpf' => $cpf,
            ':nome' => $nome,
            ':telefone' => $telefone
          ));
        
          echo '<h4 style="color: #003641">Cadastro realizado com sucesso</h4>';
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }


       
       	exit;
    }

    //remover cliente cadastrado

    if($tipo == 'removeCliente'){
    	$id = $_POST['id'];

        try {

        
          $stmt = $pdo->prepare('DELETE FROM clientes WHERE id_cliente = :id');
          $stmt->execute(array(
            ':id'   => $id
          ));
        
          echo '<h4 style="color: #003641">Cadastro removido com sucesso</h4>';
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }


       
       	exit;
    }
}
?>