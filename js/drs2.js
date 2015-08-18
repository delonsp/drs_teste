var doNotShowSecondForm = true;
var data_receita = {};

// Desculpe substitui none
// Dados inválidos

var url = "DataHandler.php";


function runUpdateAjax(id) {

    
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'html',
        data: {no: id, tabela: 'medicamentos'},
    })
    .done(function(result) {
        data_receita = JSON.parse(result);

        //populates the form with the retrieved data
        $('#nomeDaDoenca').val(data_receita.doenca);
        $('#nomeDaReceita').val(data_receita.nomeDaReceita);
        $('#textoReceita').val(data_receita.descricao);
        $('#usuario_id').val(data_receita.usuario_id);
            

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
            // habilita callback para mostrar de novo o formulario inicial de principio ativo
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

$('#envioBtn').click(function(event) { // busca de principio ativo
    event.preventDefault();
    $('#mostraFormBtn').css({
            visibility: 'visible', // mostra botao de salvar remedio
            
        });
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'html',
        data: {principio: $('#principio').val(),
                man: m }, // busca principio no banco de dados
    })
    .done(function(html) {
        $('#myModal').modal('show');
        
            
        $('.modal-body').html(html);
        
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

$('#mostraFormBtn').click(function(event) { // esconde formulario de principio e mostra formulario para dar entrada com medicamento
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

$('.save-btn').on("click", function(event) { // actually updates or save a new record
    event.preventDefault();
    var myData = { nomeDaReceita: $('#nomeDaReceita').val(),
                       nomeDaDoenca: $('#nomeDaDoenca').val(),
                       textoReceita: $('#textoReceita').val(), // envia dados para gravacao no banco de dados
                       usuario_id: $('#usuario_id').val(),
                       man: m};
    
    if ($(this).hasClass('update-btn')) {
        myData.no = data_receita.id;
    }
    
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'html',
        data: myData
    })
    .done(function(html) {
        if (html.indexOf("Dados inválidos.") != -1) {
            doNotShowSecondForm = false;
        } else {
            doNotShowSecondForm = true;
        }
         //alert(html + " " + doNotShowSecondForm);
        $('#myModal').modal('show'); // mostra modal que insercao no banco de dados foi com sucesso ou não
        $('#myModalLabel').html("Inserção/Edição de Medicamentos");
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




