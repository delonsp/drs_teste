var doNotShowSecondForm = true;
var data_exame = {};

// Desculpe substitui none
// Dados inválidos

var url = "DataHandler.php";


function runUpdateAjax(id) {

    
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'html',
        data: {no: id, tabela: 'exames'}
    })
    .done(function(result) {
        data_exame = JSON.parse(result);

        //populates the form with the retrieved data
        $('#nomeDoExame').val(data_exame.nome);
        $('#descricao').val(data_exame.descricao);
        $('#usuario_id').val(data_exame.usuario_id);
               

        $('#gravarBtn').removeClass('btn-success').addClass('btn-warning').val("Gravar Mudanças");
        $('#gravarBtn').addClass('update-btn').removeClass('save-btn');

        doNotShowSecondForm = false;
        $('#myModal').modal('hide');
        


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
                $('#gravarBtn').removeClass('update-btn').addClass('save-btn');
            
            } else {
                $('#firstFormRow').hide();
                $('#secondFormRow').removeClass('hidden');
            }

            
        });

});

$('#envioBtn').click(function(event) { // busca de nomeDoExame ativo
    event.preventDefault();
    $('#mostraFormBtn').css({
            visibility: 'visible', // mostra botao de salvar remedio
            
        });
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'html',
        data: {exame: $('#exame').val()
                 }, // busca nomeDoExame no banco de dados
    })
    .done(function(html) {
        $('#myModal').modal('show');
        
            
        $('.modal-body').html(html);
        
        //$('#mostraFormBtn').trigger();

        $('.btn_edit').on('click', function(event) {
            event.preventDefault();
            runUpdateAjax(this.id);
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
    $('#secondFormRow').find("input[type=text], textarea").val("");
  
});

$('#salvarDireto').click(function(event) {
    event.preventDefault();
    $('#firstFormRow').hide();
    $('#secondFormRow').find("input[type=text], textarea").val("");
    $('#secondFormRow').removeClass('hidden');

});

$('.save-btn').on("click", function(event) { // actualy updates or save a new record
    event.preventDefault();
    var myData = { nomeDoExame: $('#nomeDoExame').val(),
                       descricao: $('#descricao').val(),
                       usuario_id: $('#usuario_id').val()
                        // envia dados para gravacao no banco de dados
                       };
                       
    if ($(this).hasClass('update-btn')) {
        myData.no = data_exame.id;
        
    }
    
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'html',
        data: myData
    })
    .done(function(html) {
        if (html.indexOf("Dados inválidos.")!= -1) {
            doNotShowSecondForm = false;
        } else {
            doNotShowSecondForm = true;
        }
        $('#myModal').modal('show'); // mostra modal que insercao no banco de dados foi com sucesso ou não
        $('#myModalLabel').html("Inserção/Edição de Exames");
        $('.modal-body').html(html);
        $('#cancelBtn').html('Fechar');
        $('#mostraFormBtn').css({
            visibility: 'hidden',
            
        });
        
        
        
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
});




