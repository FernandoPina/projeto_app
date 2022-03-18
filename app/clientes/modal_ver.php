<!-- Modal -->
<style type="text/css">
  p{
    font-weight: 600;
    color: #003641;
  }
  label{
    color: #999;
  }
</style>
<div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
            <button onclick="fecharModal(myModalView)" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <?php

                  $id = $_GET['id'];
                  $valorTotal = 0;
                  $totalPedidos = 0;
                  require_once "../inc/mask.php";
                  require_once "../inc/config.php";

                  $stmtPedidos = $pdo->prepare('SELECT valor_pedido FROM pedidos WHERE id_cliente = "'.$id.'"');
                  $stmtPedidos->execute();
                  while($rowPedido = $stmtPedidos->fetch(PDO::FETCH_ASSOC)){
                    $valorTotal += $rowPedido['valor_pedido'];
                    $totalPedidos++;
                  }

                  $sql = 'SELECT * FROM clientes WHERE id_cliente = "'.$id.'"';
          
                  if($stmt = $pdo->prepare($sql)){         
                      if($stmt->execute()){

                          if($stmt->rowCount() != 0){
                            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
                    
              ?>
              <div class="row">
                <h3 class="rosa">Dados pessoais</h3>
              </div>

              <br>
              <div class="row">
                  <div class="col-md-4 customize-input">
                      <label>Nome</label>
                      <p><?=$linha['nome_cliente']?></p>
                  </div>

                  <div class="col-md-4 customize-input">
                      <label>CPF</label>
                      <p><?=mask($linha['cpf_cliente'], '###.###.###-##')?></p>
                  </div>
      
                  <div class="col-md-4 customize-input">
                      <label>Telefone</label>
                      <p><?=mask($linha['telefone_cliente'], '(##) ####-####')?></p>
                  </div>
              </div>

              <div class="row">
                <h3 class="rosa">Pedidos</h3>
              </div>

              <br>
              <div class="row">
                  <div class="col-md-4 customize-input">
                      <label>Total de pedidos</label>
                      <p><?=$totalPedidos?></p>
                  </div>

                  <div class="col-md-4 customize-input">
                      <label>Valor total</label>
                      <p>R$<?=number_format($valorTotal, 2, ",", ".")?></p>
                  </div>
              </div>
    
            <br><br>
              
              <?php  }}} ?>
          </div>
          
        </div>
      </div>
    </div>

  

        <script>
            var myModalView = new bootstrap.Modal(document.getElementById('modalVisualizar'), {
              keyboard: false
            })

            var myModalExample = new bootstrap.Modal(document.getElementById('exampleModal'), {
              keyboard: false
            })

            myModalView.show();

            function fecharModal(modalName){
              modalName.hide();
            }

            $("#formUpdate").submit(function(e) {
              e.preventDefault(); // avoid to execute the actual submit of the form.
              myModalView.hide();
              myModalExample.show();

              var form = $(this);
              var url = form.attr('action');

              setTimeout(
                  function(){ 
                      $.ajax({
                      type: "POST",
                      url: 'clientes/post.php',
                      data: form.serialize(), // serializes the form's elements.
                      success: function(data)
                      {
                          //alert(data); // show response from the php script.
                          document.getElementById('response').innerHTML = '<h4>Cadastro realizado com sucesso!</h4>';
                          document.getElementById("formUsuarios").reset();

                      },
                      error: function (data) {
                          document.getElementById('response').innerHTML = '<h4 style="color: brown">Ocorreu um erro ao realizar o seu cadastro. Tente novamente. Caso o erro persista, entre em contato conosco!</h4>';
                      },
                    }); 
                  }
              , 700);              
            });
        </script>
    