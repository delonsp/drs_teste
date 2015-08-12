var doNotShowSecondForm = true;
var data_exame = {};

// Desculpe substitui none
// Dados inválidos

var url = "PharmaHandler.php";


function runIncludeLocal(id) {

    
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'html',
        data: {no: id}
    })
    .done(function(result) {

        doNotShowSecondForm = true;               
        
        $('.modal-body').html(result);
        $('#cancelBtn').html('Fechar');
        
        


    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
        
}






$(function() {
   
    $('#myModal').on('hidden.bs.modal', function () { 
            // habilita callback para mostrar de novo o formulario inicial de nomeDoExame ativo
            // e esconder o formulario de nova medicacao.


            if (doNotShowSecondForm) {
                
                $('#firstFormRow').show();
                $('#secondFormRow').addClass('hidden');
                $('#gravarBtn').addClass('btn-success').removeClass('btn-warning').val("Gravar");
                // $('#gravarBtn').removeClass('update-btn').addClass('save-btn');
            
            } else {
                $('#firstFormRow').hide();
                $('#secondFormRow').removeClass('hidden');
            }

            
        });

});

$('#buscar_pharma').click(function(event) { // busca de nome de farmácias
    event.preventDefault();
    $('#mostraFormBtn').css({
            visibility: 'visible', // mostra botao de salvar local
            
        });
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'html',
        data: {busca_pharma: $('#input_busca_pharma').val()
                 }, // busca nomeDoExame no banco de dados
    })
    .done(function(html) {
        $('#myModal').modal('show');
        
            
        $('.modal-body').html(html);
        
        $('.btn-warning').click(function(event) { // editar medicacao
                  
            // put code to edit recipes

            runIncludeLocal(this.id);

        });
        
        
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
});

$('#mostraFormBtn').click(function(event) { // esconde formulario de nomeDoExame e mostra formulario para dar entrada com medicamento
    doNotShowSecondForm = false;
    $('#myModal').modal('hide');
  
});

$('#salvarDireto').click(function(event) {
    event.preventDefault();
    $('#firstFormRow').hide();
    $('#secondFormRow').removeClass('hidden');

});

$('#cancelForm').on('click', function(event) {
    event.preventDefault();
    location.reload();
});

$('.save-btn').on("click", function(event) {
    event.preventDefault();
    var myData = { nome_pharma: $('#input_nome_pharma').val(),
                       emails_pharma: $('#input_emails_pharma').val(),
                       enviar_email: $('#input_enviar_email_pharma').is(':checked')
                        // envia dados para gravacao no banco de dados
                       };
                       
    // if ($(this).hasClass('update-btn')) {
    //     myData.no = data_exame.id;
        
    // }
    
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'html',
        data: myData
    })
    .done(function(html) {
        $('#myModal').modal('show'); // mostra modal que insercao no banco de dados foi com sucesso ou não
        $('#myModalLabel').html("Inserção/Edição de Farmácias");
        $('.modal-body').html(html);
        $('#cancelBtn').html('Fechar');
        $('#mostraFormBtn').css({
            visibility: 'hidden',
            
        });
        if (html.indexOf("Dados inválidos.")!=-1) {
            doNotShowSecondForm = false;
        } else {
            doNotShowSecondForm = true;
        }
        
        
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
});




