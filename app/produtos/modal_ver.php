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
            <h5 class="modal-title" id="exampleModalLabel">Produtos</h5>
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

                  $sql = 'SELECT * FROM produtos WHERE id_produto = "'.$id.'"';
          
                  if($stmt = $pdo->prepare($sql)){         
                      if($stmt->execute()){

                          if($stmt->rowCount() != 0){
                            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
                    
              ?>
              <div class="row">
                <h3 class="rosa">Detalhes</h3>
              </div>

              <br>
              <div class="row">
                  <div class="col-md-4 customize-input">
                      <label>Nome</label>
                      <p><?=$linha['nome_produto']?></p>
                  </div>

                  <div class="col-md-4 customize-input">
                      <label>Valor</label>
                      <p>R$<?=number_format($linha['valor_produto'], 2, ",", ".")?></p>
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
                      url: 'produtos/post.php',
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
    