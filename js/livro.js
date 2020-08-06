$(document).ready(function () {
    status(0);
         $(window).unbind('resize').bind('resize', () => {
             $('#div-cadastro').height(window.innerHeight - parseInt($("body").css("padding-bottom")));
             $("#nav-sm").hide();
            largura_sm = 767;
            if(window.innerWidth <= largura_sm){
                if($("#painel-formulario").is(":visible") && $("#painel-grade").is(":visible")){
                $("#painel-grade").hide();
                }
            }else{
                $("#painel-formulario, #painel-grade").show();
                
            }
        }).trigger('resize')
         
        $("#idlivro").keypress(function (event) {
        if (event.keyCode === 13) {
            carregar($(this).val());
            status(2);
        }
    });
    grade();
    $('#idlivro').focus();
});

$.ajaxSetup({
    dataType: 'json'
});


function mudar_painel_grid(){
    $('#painel-grade').show();
    $('#painel-formulario').hide();

    $("#grade .btn").addClass("active");
    $("#formulario .btn").removeClass("active");
}

function mudar_painel_form(){
    $('#painel-grade').hide();
    $('#painel-formulario').show();

    $("#formulario .btn").addClass("active");
    $("#grade .btn").removeClass("active");
}


function inserir_novo() {
    status(1);
    limpar();
    $('#nomelivro').focus();
}

function cancelar() {
    status(0);
    limpar();
}

function limpar() {
    $("input, select").val("");
    $('#idlivro').focus();
}


function carregar(idlivro) {
    $.ajax({
        url: "ajax/livro/carregar.php",
        data: {
            idlivro: idlivro
        },
        success: function (result) {
            switch (result.status) {
                case 0:
                    status(2);
                    for (let id in result.data) {
                            $("#" + id).val(result.data[id]);
                            if(window.innerWidth <= largura_sm){
                                mudar_painel_form();
                            }
                    }
                    break;
                case 2:
                    alert(result.message);
                    break;
            }
        }
    });

}

function gravar() {
    let arquivo = (status() === 1 ? 'inserir_novo.php' : 'alterar.php');

    $.ajax({
        url: "ajax/livro/" + arquivo,
        data: {
            idlivro: $('#idlivro').val(),
            nomelivro: $('#nomelivro').val(),
            biblioteca: $('#biblioteca').val(),
            preco: $('#preco').val()
        },
        success: function (result) {
            switch (result.status) {
                case 0:
                    carregar(result.data.idlivro);
                    grade();
                    $.notify({
                        // options
                        icon: 'fas fa-check-circle',
                        message: 'Livro gravado' 
                    },{
                        // settings
                        type: 'success',
                        element: 'body',
                        placement:{
                            from: 'bottom',
                        },
                        delay: 2800,
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        onShow: function() {
                            this.css({'width':'250px','height':'auto'});
                        },
                    });

                    break;
                case 2:
                    alert(result.message);
                    break;
            }
        }
    });
}



function grade() {
    $.ajax({
        url: "ajax/livro/grade.php",
        success: function (result) {
            switch (result.status) {
                case 0:
                    $('#grade tbody tr').html("");
                    for (const livro of result.data) {
                        const datacriacao = livro.datacriacao.split("-").reverse().join("/");
                        const horacriacao = livro.horacriacao.substr(0, 8);
                        const tds = [
                            //`<th scope="row">2</th>`
                            `<td style='text-align: right'>${livro.idlivro}</td>`,
                            `<td> ${livro.nome}</td>`,
                            `<td> ${livro.biblioteca}</td>`,
                            `<td style='text-align: right' class=''>R$ ${livro.preco}</td>`,
                            `<td style='text-align: center' class='d-md-block d-none'>${datacriacao} ${horacriacao}</td>`,
                        ].join("");
                        $("#grade tbody").append(`<tr onclick='carregar(${livro.idlivro})'>${tds}</tr>`);
                    }
                    break;
                case 2:
                    alert(result.message);
                    break;
            }
        }
    });
}



function deletar() {
    /*if (!confirm("Tem certeza que deseja deletar o livro???")) {
        return false;
    }*/
    $.ajax({
        url: "ajax/livro/deletar.php",
        data: {
            idlivro: $("#idlivro").val()
        },
        success: function (result) {
            switch (result.status) {
                case 0:
                    cancelar();
                    //alert("Livro deletado com sucesso!!");
                    $.notify({
                        // options
                        icon: 'fas fa-trash-alt',
                        message: 'Livro deletado' 
                    },{
                        // settings
                        type: 'danger',
                        element: 'body',
                        placement:{
                            from: 'bottom',
                        },
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        onShow: function() {
                            this.css({'width':'250px','height':'auto'});
                        },
                    });
                    grade();
                    break;
                case 2:
                    alert(result.message);
                    break;
            }
        }
    });
}

function aparecermodal(){
    $('#caixa-msg').modal('show')
}

var _status = null;
function status(status) {
    /*
    0 - tela em branco (esperando inserir novo ou carregar)
    1 - Criando novo
    2 - Alterando um existente
    */
    if (status === undefined) {
        return _status;
    } else {
        _status = status;
        switch (status) {
            case 0:
                $('#btn-novo').attr('disabled', false);
                $('#btn-gravar').attr('disabled', true);
                $('#btn-cancelar').attr('disabled', true);
                $('#btn-deletar').attr('disabled', true);
                $('#inputCriadoEm').attr('dissable', true);
                $('#idlivro').attr('disabled', false);
                $('#nomelivro').attr('disabled', true);
                $('#biblioteca').attr('disabled', true);
                $('#preco').attr('disabled', true);
                break;
            case 1:
                $('#btn-novo').attr('disabled', true);
                $('#btn-gravar').attr('disabled', false);
                $('#btn-cancelar').attr('disabled', false);
                $('#btn-deletar').attr('disabled', true);
                $('#idlivro').attr('disabled', true);
                $('#nomelivro').attr('disabled', false);
                $('#biblioteca').attr('disabled', false);
                $('#preco').attr('disabled', false);
                break;
            case 2:
                $('#btn-novo').attr('disabled', true);
                $('#btn-gravar').attr('disabled', false);
                $('#btn-cancelar').attr('disabled', false);
                $('#btn-deletar').attr('disabled', false);
                $('#idlivro').attr('disabled', true);
                $('#nomelivro').attr('disabled', false);
                $('#biblioteca').attr('disabled', false);
                $('#preco').attr('disabled', false);
                break;
        }
    }
}