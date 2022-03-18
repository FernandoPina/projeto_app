<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "../inc/config.php";


//validar tipo da operação
if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo'];

    //adicionar novo cliente
    if($tipo == 'adicionaProduto'){
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];

        if (empty($nome) or empty($valor)) {
        	echo '<h4 style="color: brown">Preencha todos os campos!</h4>';
        	exit;
        }      

        try {

        
          $stmt = $pdo->prepare('INSERT INTO produtos (id_produto, nome_produto, valor_produto) VALUES (null, :nome, :valor)');
          $stmt->execute(array(
            ':nome' => $nome,
            ':valor' => $valor
          ));
        
          echo '<h4 style="color: #003641">Cadastro realizado com sucesso</h4>';
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }


       
       	exit;
    }

    //editar cadastro de cliente

    if($tipo == 'updateProduto'){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];

        if (empty($nome) or empty($valor)) {
          echo '<h4 style="color: brown">Preencha todos os campos!</h4>';
          exit;
        }      

        try {

        
          $stmt = $pdo->prepare('UPDATE produtos SET nome_produto = :nome, valor_produto = :valor WHERE id_produto = :id');
          $stmt->execute(array(
            ':id'   => $id,
            ':nome' => $nome,
            ':valor' => $valor
          ));
        
          echo '<h4 style="color: #003641">Cadastro realizado com sucesso</h4>';
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }


       
       	exit;
    }

    //remover cliente cadastrado

    if($tipo == 'removeProduto'){
    	$id = $_POST['id'];

        try {

        
          $stmt = $pdo->prepare('DELETE FROM produtos WHERE id_produto = :id');
          $stmt->execute(array(
            ':id'   => $id
          ));
        
          echo $stmt->rowCount();
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }


       
       	exit;
    }
}
?>