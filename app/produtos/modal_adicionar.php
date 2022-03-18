<!-- Modal -->
<div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar produto</h5>
            <button onclick="fecharModal(myModalView)" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <h3 class="rosa">Detalhes</h3>
              </div>

              <br>
              <form id="formUpdate" method="POST">
              <div class="row">
                  <div class="col-md-4 customize-input">
                      <label>Nome</label>
                      <input class="form-control" type="text" id="nome" name="nome" value="">
                  </div>

                  <div class="col-md-4 customize-input">
                      <label>Valor</label>
                      <input class="form-control" type="text" id="valor" name="valor" placeholder="Ex: 1000.75">
                  </div>
              </div>

              <br>

              
                <input type="hidden" value="adicionaProduto" id="tipo" name="tipo">
            <br>

            
            <button type="submit" class="btn bg-custom" style="color: #FFF; float: right;">Adicionar</button>

          </form>
    
            <br><br>
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
                          document.getElementById('response').innerHTML = data;
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
    