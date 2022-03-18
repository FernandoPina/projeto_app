<?php $id = $_GET['id']; ?>
<div id="modalVisualizar" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Você tem certeza?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Após a remoção, não será possivel recuperar os dados apagados.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="formUpdate" method="POST">
          <input type="hidden" value="<?=$id?>" id="id" name="id">
          <input type="hidden" value="removeProduto" id="tipo" name="tipo">
          <button type="submit" class="btn btn-danger">Remover</button>
        </form>
        
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
            document.getElementById('response').innerHTML = '<h4>Cadastro removido com sucesso!</h4>';
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