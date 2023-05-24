/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function selectClient(obj) {
    var id = $(obj).attr('data-id');
    var nome = $(obj).html();
    
    $('.seachresult').hide();
    $('#client_name').val(nome);
    $('#client_name').attr('data-id', id);
    $('input[name=client_id]').val(id);
}

function updateSubTotal(obj) {
    var id = $(obj).attr('data-id');
    var quant = $(obj).val();
    var quantMax = $('#quantMax'+id).val();
    var preco = $(obj).attr('data-preco');
    var subTotal = parseFloat($('#subTotal'+id).val());
    var preco_total = parseFloat($('#preco').val());
    
    if (quant <= 0){
        $(obj).val(1);
        quant = 1;
    }
    if (quantMax < quant){
        quant = quantMax;
        $(obj).val(quantMax);
        alert("O nosso estoque contem somente: "+quantMax);
    }
    preco_total = preco_total - subTotal;
    subTotal = (parseInt(quant) * parseFloat(preco));
    preco_total = preco_total + subTotal;
    
    $('#subTotal'+id).val(subTotal);
    $('#preco').val(preco_total);
    $('#divSubTotal'+id).html(converteFloatMoeda(subTotal) );
}

function excluirProd(obj) {
    var pQuant = $(obj).closest('tr').find('.p_quant');
    var prUnit = pQuant.attr('data-preco');
    var quant = pQuant.val();
    var subTotal = (parseInt(quant) * parseFloat(prUnit));
    var preco_total = parseFloat($('#preco').val());
    preco_total = preco_total - subTotal;
    
    $(obj).closest('tr').remove();
    $('#preco').val(preco_total);
}

function addProduct(obj) {
    var id = $(obj).attr('data-id');
    var nome = $(obj).html();
    var preco = $(obj).attr('data-preco');
    var quantMax = $(obj).attr('data-quant');
    var quant = 1;
    var subTotal = (parseInt(quant) * parseFloat(preco));
    
    if ($('#estoque'+id).length === 0){
        var trInicial = "<tr id='produto"+id+"'>";
        var tdNome = "<td>"+nome.toString().toUpperCase()+"</td>";
        var tdQuantMinus = "<td><a href='javascript:;' onclick='javascript:decrementar("+id+")'><i class='fa fa-minus-circle'></i></a>";
        var tdQuantBody = "<input type='number' id='estoque"+id+"' name='quant["+id+"]' onChange='updateSubTotal(this)' class='p_quant' value='"+parseInt(quant)+"' data-preco='"+preco+"' data-id='"+id+"'>";
        var tdQuantPlus = "<a href='javascript:;' onclick='javascript:incrementar("+id+")'><i class='fa fa-plus-circle'></i></a></td>";
        var tdQuant = String().concat(tdQuantMinus,tdQuantBody,tdQuantPlus);
        //var tdQuant = "<td>"+tdQuantBody+"</td>";
        var tdPreco = "<td><input type=hidden id='preco"+id+"' value='"+preco+"'>"+converteFloatMoeda(preco)+"<input type='hidden' id=subTotal"+id+" value="+subTotal+"></td>";
        var tdSubTotal = "<td><div id='divSubTotal"+id+"'>"+converteFloatMoeda(subTotal)+"</div></td>";
        var tdAcao = "<td><input type='hidden' id='quantMax"+id+"' name='quantMax["+id+"]' value='"+quantMax+"'><a href='javascript:;' onClick='excluirProd(this)'>Excluir</a></td>";
        var trFim = "</tr>";
        var table = String().concat(trInicial,tdNome,tdQuant,tdPreco,tdSubTotal,tdAcao,trFim);
        
        $('#products_table').append(table);
    }
    
    $('.seachresult').hide();
    $('#add_prod').val('');
}

$(function () {
    $('.tabItem').on('click',function () {
       $('.activetab').removeClass('activetab');
       $(this).addClass('activetab');
       
       var item = $('.activetab').index();
       $('.tabbody').hide();
       $('.tabbody').eq(item).show();
    });
    
    $('#busca').on('focus',function (){
        $(this).animate({
            width: '250px'
        },'fast');
    });
    
    $('#busca').on('blur', function (){
        if($(this).val() === ''){
            $(this).animate({
                width: '100px'
            },'fast');
        }
        setTimeout(function (){
            $('.seachResult').hide();
        }, 500);
    });
    
    $('#busca').on('keyup', function (){
        var datatype = $(this).attr('data-type');
        //var q = $(this).val();
        var left = $(this).offset().left;
        var top = $(this).offset().top + $(this).height() + 3;
        
        if(datatype !== ''){
            $.ajax({
                url: BASE_URL+'ajax/'+datatype,
                type: 'GET',
                data: {
                    q: $(this).val()
                },
                dataType: 'json',
                success: function (json) {
                    if ($('.seachResult').length === 0){
                        $('#busca').after("<div class='seachResult'></div>");
                    }
                    $('.seachResult').css('left', left+'px');
                    $('.seachResult').css('top', top+'px');
                    var html = "";
                    for (var x in json){
                        html += "<div class='si'><a href='"+json[x].link+"'>" +json[x].nome+ "</a></div>";
                    }
                    $('.seachResult').html(html);
                    $('.seachResult').show();
                    response(json);
                }
            });
        }
    });
    
    $('.cep_add').on('blur', function (){
        var cep = $(this).val();
        
        $.ajax({
            url:'https://api.postmon.com.br/v1/cep/'+cep,
            type:'GET',
            dataType:'json',
            success: function(json){
                if (typeof json.logradouro !== 'undefined'){
                    $('.endereco').val(json.logradouro);
                    $('.bairro').val(json.bairro);
                    $('.cidade').val(json.cidade);
                    $('.estado').val(json.estado);
                    $('.pais').val("Brasil");
                    $('.numero').focus();
                }
            }
        });
    });
    
    $('.client_add_button').on('click', function () {
        var name = $('#client_name').val();
        var cpf = $('#client_cpf').val();
        if (name !== '' && name.length >= 4){
            if (confirm('Deseja adcionar um cliente com nome: '+name+' ?')){
                $.ajax({
                    url: BASE_URL+'ajax/add_cliente',
                    type: 'POST',
                    data: { 
                        nome: name,
                        cpfCnpj: cpf
                    },
                    dataType: 'json',
                    success: function (json) {
                        $('.seachResult').hide();
                        $('#client_name').attr('data-id', json.id);
                        $('input[name=client_id]').val(json.id);
                        response(json);
                    }
                });
            }
        }
    });
    
    $('#client_name').on('keyup', function (){
        var datatype = $(this).attr('data-type');
        //var q = $(this).val();
        var left = $(this).offset().left;
        var top = $(this).offset().top + $(this).height() + 3;
        
        if(datatype !== ''){
            $.ajax({
                url: BASE_URL+'ajax/'+datatype,
                type: 'GET',
                data: {
                    q: $(this).val()
                },
                dataType: 'json',
                success: function (json) {
                    if ($('.seachResult').length === 0){
                        $('#client_name').after("<div class='seachResult'></div>");
                    }
                    $('.seachResult').css('left', left+'px');
                    $('.seachResult').css('top', top+'px');
                    var html = "";
                    for (var x in json){
                        html += "<div class='si'><a href='javascript:;' onClick='selectClient(this)' data-id='"+json[x].id+"'>" +json[x].nome+ "</a></div>";
                    }
                    $('.seachResult').html(html);
                    $('.seachResult').show();
                    response(json);
                }
            });
        }
    });
    
    $('#add_prod').on('keyup', function (){
        var datatype = $(this).attr('data-type');
        //var q = $(this).val();
        var left = $(this).offset().left;
        var top = $(this).offset().top + $(this).height() + 3;
        
        if(datatype !== ''){
            $.ajax({
                url: BASE_URL+'ajax/'+datatype,
                type: 'GET',
                data: {
                    q: $(this).val()
                },
                dataType: 'json',
                success: function (json) {
                    if ($('.seachResult').length === 0){
                        $('#add_prod').after("<div class='seachResult'></div>");
                    }
                    $('.seachResult').css('left', left+'px');
                    $('.seachResult').css('top', top+'px');
                    var html = "";
                    for (var x in json){
                        html += "<div class='si'><a href='javascript:;' onClick='addProduct(this)' data-id='"+json[x].id+"' data-preco='"+json[x].preco+"' data-quant='"+json[x].quant+"'>" +json[x].nome+ "</a></div>";
                    }
                    $('.seachResult').html(html);
                    $('.seachResult').show();
                    response(json);
                }
            });
        }
    });
    
    $('input[name=price]').mask('000.000.000.000.000,00', {
        reverse:true, 
        placeholder:"0,00"
    });
});

$(function (){
    var cpfType = $('#cpf_filtro').attr('data-type');
        $('#cpf_filtro').autocomplete({
            source: BASE_URL+'ajax/'+cpfType,
            focus: function(event, ui) {
                $('#cpf_filtro').val(ui.item.cpfCnpj);
                return false;
            },
            select: function (event, ui) {
                $('#cpf_filtro').val(ui.item.cpfCnpj);
                $('#nome_filtro').val(ui.item.nome);
                return false;
            }
        });
        $('#cpf_filtro').autocomplete("instance")._renderItem = function(ul, item){
            return $("<li>").append("<div>"+item.cpfCnpj+"</div>").appendTo(ul);
        };
    var nomeType = $('#nome_filtro').attr('data-type');
    //var q = $('#nome_filtro').val();
        $('#nome_filtro').autocomplete({
            source: BASE_URL+'ajax/'+nomeType,
            //source: function(request, response){
            //    $.ajax({
            //        url: BASE_URL+'ajax/'+nomeType,
            //        dataType: 'json',
            //        data: {
            //            q: $('#nome_filtro').val()
            //        },
            //        success: function (data) {
            //            response(data);
            //        }
            //    });
            //},
            focus: function(event, ui){
                $('#nome_filtro').val(ui.item.nome);
                return false;
            },
            select: function(event, ui){
                var code = ui.item.nome;
                $('#nome_filtro').val(ui.item.nome);
                $('#cpf_filtro').val(ui.item.cpfCnpj);
                $('#cep_filtro').val(ui.item.cep);
                $('#estrela_filtro').val(ui.item.estrela);
                return false;
            }
        });
        $('#nome_filtro').autocomplete("instance")._renderItem = function(ul, item){
            return $("<li>").append("<div>"+item.nome+"</div>").appendTo(ul);
        };
    
});

$(function () {
    var cpfTypeAdd = $('#cpfCnpj_add').attr('data-type');
    //var q = $('#nome_filtro').val();
        $('#cpfCnpj_add').autocomplete({
            source: BASE_URL+'ajax/'+cpfTypeAdd,
            focus: function(event, ui){
                $('#cpfCnpj_add').val(ui.item.nome);
                return false;
            },
            select: function(event, ui){
                var code = ui.item.nome;
                $('#cliente_add').val(ui.item.nome);
                $('#cliente_id').val(ui.item.id);
                $('#cpfCnpj_add').val(ui.item.cpfCnpj);
                $('#cliente_estrela').val(ui.item.estrela);
                return false;
            }
        });
        $('#cpfCnpj_add').autocomplete("instance")._renderItem = function(ul, item){
            return $("<li>").append("<div>"+item.cpfCnpj+"</div>").appendTo(ul);
        };
    var clienteType = $('#cliente_add').attr('data-type');
    //var q = $('#nome_filtro').val();
        $('#cliente_add').autocomplete({
            source: BASE_URL+'ajax/'+clienteType,
            focus: function(event, ui){
                $('#cliente_add').val(ui.item.nome);
                return false;
            },
            select: function(event, ui){
                var code = ui.item.nome;
                $('#cliente_add').val(ui.item.nome);
                $('#cliente_id').val(ui.item.id);
                $('#cpfCnpj_add').val(ui.item.cpfCnpj);
                $('#cliente_estrela').val(ui.item.estrela);
                return false;
            }
        });
        $('#cliente_add').autocomplete("instance")._renderItem = function(ul, item){
            return $("<li>").append("<div>"+item.nome+"</div>").appendTo(ul);
        };
    var produtoType = $('#produto_add').attr('data-type');
    //var q = $('#nome_filtro').val();
        $('#produto_add').autocomplete({
            source: BASE_URL+'ajax/'+produtoType,
            focus: function(event, ui){
                $('#produto_add').val(ui.item.nome);
                return false;
            },
            select: function(event, ui){
                var code = ui.item.nome;
                $('#produto_add_nome').val(ui.item.nome);
                $('#produto_add_id').val(ui.item.id);
                $('#produto_add_preco').val(ui.item.preco);
                $('#produto_add_quant').val(ui.item.quant);
                return false;
            }
        });
        $('#produto_add').autocomplete("instance")._renderItem = function(ul, item){
            return $("<li>").append("<div>"+item.nome+"</div>").appendTo(ul);
        };
});

var produtos = [];
/**
 * Comment
 * params:
 *      document.getElementById('produto_add')
 *      document.getElementById('produto_add_id')
 *      document.getElementById('produto_add_preco')
 *      document.getElementById('produto_add_quant')
 * @return {null} description
 */
function addProduto() {
    var prd_nome = document.getElementById('produto_add').value;
    var prd_id = document.getElementById('produto_add_id').value;
    var prd_preco = document.getElementById('produto_add_preco').value;
    var prd_quant_max = document.getElementById('produto_add_quant').value;
    var preco_total = parseFloat(document.getElementById('preco').value);
    var prd_quant = 1;
    var table_prd = document.getElementById('produto_table');
    //console.log( document.getElementById('estoque'+prd_id) === null);
    if (document.getElementById('estoque'+prd_id) === null){
        var fim = table_prd.rows.length;
        var row = table_prd.insertRow(fim);
        var cell_nome = row.insertCell(0);
        var cell_qtd = row.insertCell(1);
        var cell_preco = row.insertCell(2);
        var cell_subTotal = row.insertCell(3);
        var cell_dell = row.insertCell(4);
        
        var subTotal = (parseInt(prd_quant) * parseFloat(prd_preco));
        preco_total = subTotal + preco_total;
        cell_nome.innerHTML = prd_nome.toString().toUpperCase();
        var qtdMinus = "<a href='javascript:;' onclick='javascript:decrementar("+prd_id+")'><i class='fa fa-minus-circle'></i></a>";
        var qtdBody = "<input type='number' id='estoque"+prd_id+"' name='quant["+prd_id+"]' onChange='updateSubTotal(this)' class='p_quant' value='"+parseInt(prd_quant)+"' data-preco='"+prd_preco+"' data-id='"+prd_id+"'>";
        var qtdPlus = "<a href='javascript:;' onclick='javascript:incrementar("+prd_id+")'><i class='fa fa-plus-circle'></i></a>";
        cell_qtd.innerHTML = String().concat(qtdMinus,qtdBody,qtdPlus);
        cell_preco.innerHTML = "<div><input type='hidden' id='preco"+prd_id+"' value='"+parseFloat(prd_preco)+"'>"+converteFloatMoeda(prd_preco)+"<input type='hidden' id=subTotal"+prd_id+" value="+subTotal+"></div>";
        cell_subTotal.innerHTML = "<div id='divSubTotal"+prd_id+"'>"+converteFloatMoeda(subTotal)+"</div>";
        cell_dell.innerHTML = "<input type='hidden' id='quantMax"+prd_id+"' name='quantMax["+prd_id+"]' value='"+prd_quant_max+"'><a href='javascript:;' onClick='javascript:delTableItem(this,"+prd_id+")'><i class='fa fa-eraser'></i></a>";
        document.getElementById('preco').value = preco_total;
        
        var produto = [];
        produto.push(fim);
        produto.push(parseInt(prd_id));
        produto.push(prd_nome);
        produto.push(prd_quant);
        produto.push(parseFloat(prd_preco));
        produto.push(parseInt(prd_quant_max));
        produtos.push(produto);
    }
    
    document.getElementById('produto_add').value = '';
    console.log(produtos);
}

function delTableItem(obj, item) {
    console.log(obj);
    console.log($(obj).closest('tr'));
    //var table_prd = document.getElementById('produto_table');
    var subTotal = parseFloat(document.getElementById('subTotal'+item).value);
    var preco_total = parseFloat(document.getElementById('preco').value);
    preco_total = preco_total - subTotal;
    document.getElementById('preco').value = preco_total;
    //produtos;
    //Array.find();
    //table_prd.deleteRow(item);
    $(obj).closest('tr').remove();
}
/**
 * Comment
 * Adiciona um CLiente
 * params: 
 *      document.getElementById(cpfCnpj_add)
 *      document.getElementById(cliente_add)
 * @returns {null} 
 */
function addCliente() {
    var cpf = document.getElementById('cpfCnpj_add').value;
    var cliente = document.getElementById('cliente_add').value;
    var url = BASE_URL+'ajax/addCliente';
    var data = new FormData();
    data.append("cpfCnpj", cpf);
    data.append("nome", cliente);
    
    if ((cliente !== '') && (cliente.length >= 4)){
        if (confirm('Deseja adicionar o cliente: '+cliente)){
            if (validaCPF(cpf)){
                $.ajax({
                    url: BASE_URL+'ajax/seachCliente',
                    type: 'GET',
                    data: {
                        q: cliente
                    },
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        var existe = false;
                        for (var x in json) {
                            alert(json[x].nome);
                            existe = true;
                        }
                        if (!existe){
                            var params = ("cpfCnpj="+cpf+"&nome="+cliente);
                            sendPost(url,params);
                        }
                        //response(json);
                    }
                });
                //var params = ("cpf="+cpf+"&cliente="+cliente);
                //sendPost(url,params);
            } else {
                alert('O CPF invalido: '+cpf);
            }
        }
    }
}

function sendPost(url, params) {
    // Exemplo de requisição GET
    var ajax = new XMLHttpRequest();
    
    // Seta tipo de requisição e URL com os parâmetros
    ajax.open("POST", url, true);
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //ajax.setRequestHeader("Content-Type","multipart/form-data");
    ajax.setRequestHeader("Content-length", params.length);
    ajax.setRequestHeader("Connection", "close");
    
    // Envia a requisição
    ajax.send(params);
    
    // Cria um evento para receber o retorno.
    ajax.onreadystatechange = function() {
      // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
            if (ajax.readyState === 4 && ajax.status === 200) {
                    //var data = ajax.responseText;
                    //console.log(data);
        // Retorno do Ajax
                    
                    var xml = ajax.responseText;
                    console.log(xml);
                    var resp = JSON.parse(xml);
                    console.log(resp);
                    var cliente_id = document.getElementById('cliente_id');
                    alert(resp.id);
                    cliente_id.value = resp.id;
                    //var dados = new Array();
                    
                    //dados = organizarXML(xml);
                    //var key = dados.length;
                    //for (var j=0; j<dados.length; j++){
                    //    if (Array.isArray(dados[j])){
                    //        var xml2 = dados[j][0];
                    //        var nivel = dados[j]['nivel'];
                    //        dados[j][2] = organizarXML(xml2, nivel);
                    //    }
                    //}
                    //console.log(dados);
                    
                    //var array = gerarArray(dados);
                    //console.log(array);
                    
                    //atualizarPagina(array);
            }
    };
}

/**
 * Comment
 * @param {Object} obj Podera ser um Element ou um Integer
 * @return {null} Atualiza o campo <select id='cnae'></select>
 */
function buscarCnae(obj) {
    //console.log("Objeto: "+obj);
    var secao = obj.getAttribute('secao');
    var divisao = obj.getAttribute('divisao');
    var grupo = obj.getAttribute('grupo');
    
    if (secao === null){
        secao = obj.value;
        console.log('secao>'+secao);
        console.log('divisao>'+divisao);
        console.log('grupo>'+grupo);
    } else{
        if (divisao === null){
            divisao = obj.value;
            console.log('secao>'+secao);
            console.log('divisao>'+divisao);
            console.log('grupo>'+grupo);
        } else{
            if (grupo === null){
                grupo = obj.value;
                console.log('secao>'+secao);
                console.log('divisao>'+divisao);
                console.log('grupo>'+grupo);
            }
        }
    }
    
    $.ajax({
        url: BASE_URL+'ajax/seachCnaes',
        type: 'GET',
        data: {
            secao: secao,
            divisao: divisao,
            grupo: grupo
        },
        dataType: 'JSON',
        success: function(json){
            var html = "";
            if (divisao !== null){
                if (grupo !== null){
                    for (var x in json) {
                        html += '<option value="'+json[x].classe+'" '+((json[x].classe==='')?"disabled":"")+'>'+json[x].descricao+'</option>';
                    }
                    //html += '<option value="" >""</option>';
                    var htmlCNAE = document.getElementById('cnae');
                    htmlCNAE.innerHTML = html;
                    htmlCNAE.setAttribute('secao', json[0].secao);
                    htmlCNAE.setAttribute('divisao', json[0].divisao);
                    htmlCNAE.setAttribute('grupo', json[0].grupo);
                    console.log(htmlCNAE);
                }else{
                    for (var x in json) {
                        html += '<option value="'+json[x].grupo+'" '+((json[x].grupo==='')?"disabled":"")+'>'+json[x].descricao+'</option>';
                    }
                    //html += '<option value="">""</option>';
                    var htmlGRP = document.getElementById('cnae_grupo');
                    htmlGRP.innerHTML = html;
                    htmlGRP.setAttribute('secao', json[0].secao);
                    htmlGRP.setAttribute('divisao', json[0].divisao);
                    console.log(htmlGRP);
                    buscarCnae(htmlGRP);
                }
            } else {
                for (var x in json) {
                    html += '<option value="'+json[x].divisao+'" '+
                            ((json[x].divisao==='')?"disabled":"")+'>'+json[x].descricao+'</option>';
                }
                //html += '<option value="" >""</option>';
                var htmlDIV = document.getElementById('cnae_divisao');
                htmlDIV.innerHTML = html;
                htmlDIV.setAttribute('secao', json[0].secao);
                console.log(htmlDIV);
                buscarCnae(htmlDIV);
            }
            //console.log(html);
            //var result = document.getElementById('cidade');
            //result.innerHTML = html;
            //document.getElementById('cnae').innerHTML = html;
        }
    });
}

/**
 * Comment
 * @param {Object} obj Sera um Element
 * @param {Integer} rodada Sera um Inteiro indicando em qual situacao se encontra.
 *                          Situacao 0 -> mudanca do <select id='cnae_secao'></select>
 *                          Situacao 1 -> mudanca do <select id='cnae_divisao'></select>
 *                          Situacao 2 -> mudanca do <select id='cnae_grupo'></select>
 *                          Situacao 3 -> mudanca do <select id='cnae'></select>
 * @return {null} Atualiza o campo <select id='cnae'></select>
 */
function atualizarCnae(obj, rodada) {
    console.log("Objeto: "+obj);
    let secao = null;
    let divisao = null;
    let grupo = null;
    let atrSecao = null;
    let atrDivisao = null;
    let atrGrupo = null;
    let atrClasse = null;
    
    if (Array.isArray(obj)){
        atrSecao = obj['secao'];
        atrDivisao = obj['divisao'];
        atrGrupo = obj['grupo'];
        atrClasse = obj['classe'];
    } else{
        atrSecao = obj.getAttribute('secao');
        atrDivisao = obj.getAttribute('divisao');
        atrGrupo = obj.getAttribute('grupo');
        atrClasse = obj.getAttribute('classe');
    }
    
    if (!isNumber(rodada)){
        rodada = Number.parseInt(rodada);
    }
    
    switch (rodada) {
        case '0':
            let htmlSecao = document.getElementById('cnae_secao');
            for (let i=0;i<htmlSecao.length;i++){
                if (htmlSecao.options[i].value === atrSecao){
                    htmlSecao.options[i].setAttribute('selected','true');
                }
            }
            atualizarCnae(obj,'1');
            break;
        case '1':
            secao = atrSecao;
            break;
        case '2':
            secao = atrSecao;
            divisao = atrDivisao;
            break;
        case '3':
            secao = atrSecao;
            divisao = atrDivisao;
            grupo = atrGrupo;
            break;
        default:
            console.log('ERRO: rodada->'+rodada);
            break;
    }
    console.log('AtrSecao>'+atrSecao);
    console.log('AtrDivisao>'+atrDivisao);
    console.log('AtrGrupo>'+atrGrupo);
    console.log('-------------');
    console.log('secao>'+secao);
    console.log('divisao>'+divisao);
    console.log('grupo>'+grupo);
    console.log('-------------');
    
    //if (rodada === 1){
    //    //secao = obj.value;
    //    secao = obj.getAttribute('secao');
    //    console.log('secao>'+secao);
    //    console.log('divisao>'+divisao);
    //    console.log('grupo>'+grupo);
    //} else{
    //    if (rodada === 2){
    //        //divisao = obj.value;
    //        secao = obj.getAttribute('secao');
    //        divisao = obj.getAttribute('divisao');
    //        console.log('secao>'+secao);
    //        console.log('divisao>'+divisao);
    //        console.log('grupo>'+grupo);
    //    } else{
    //        if (rodada === 3){
    //            //grupo = obj.value;
    //            secao = obj.getAttribute('secao');
    //            divisao = obj.getAttribute('divisao');
    //            grupo = obj.getAttribute('grupo');
    //            console.log('secao>'+secao);
    //            console.log('divisao>'+divisao);
    //            console.log('grupo>'+grupo);
    //        }
    //    }
    //}
    if (rodada > 0){
        $.ajax({
            url: BASE_URL+'ajax/seachCnaes',
            type: 'GET',
            data: {
                secao: secao,
                divisao: divisao,
                grupo: grupo
            },
            dataType: 'JSON',
            success: function(json){
                var html = "";
                switch (rodada) {
                    case '1':
                        for (var x in json) {
                            html += '<option value="'+json[x].divisao+'" '+
                                    ((json[x].divisao==='')?"disabled":"")+' '+
                                    ((json[x].divisao===atrDivisao)?"selected":"")+'>'+json[x].descricao+'</option>';
                        }
                        //html += '<option value="" >""</option>';
                        var htmlDIV = document.getElementById('cnae_divisao');
                        htmlDIV.innerHTML = html;
                        htmlDIV.setAttribute('secao', json[0].secao);
                        console.log(htmlDIV);
                        atualizarCnae(obj, '2');
                        break;
                    case '2':
                        for (var x in json) {
                            html += '<option value="'+json[x].grupo+'" '+
                                    ((json[x].grupo==='')?"disabled":"")+' '+
                                ((json[x].grupo===atrGrupo)?"selected":"")+'>'+json[x].descricao+'</option>';
                        }
                        //html += '<option value="">""</option>';
                        var htmlGRP = document.getElementById('cnae_grupo');
                        htmlGRP.innerHTML = html;
                        htmlGRP.setAttribute('secao', json[0].secao);
                        htmlGRP.setAttribute('divisao', json[0].divisao);
                        console.log(htmlGRP);
                        atualizarCnae(obj, '3');
                        break;
                    case '3':
                        for (var x in json) {
                            html += '<option value="'+json[x].classe+'" '+
                                    ((json[x].classe==='')?"disabled":"")+' '+
                                ((json[x].classe===atrClasse)?"selected":"")+'>'+json[x].descricao+'</option>';
                        }
                        //html += '<option value="" >""</option>';
                        var htmlCNAE = document.getElementById('cnae');
                        htmlCNAE.innerHTML = html;
                        htmlCNAE.setAttribute('secao', json[0].secao);
                        htmlCNAE.setAttribute('divisao', json[0].divisao);
                        htmlCNAE.setAttribute('grupo', json[0].grupo);
                        console.log(htmlCNAE);
                        break;
                    default:
                        console.log('ERRO: rodada->'+rodada);
                        break;
                }
                //console.log(html);
                //var result = document.getElementById('cidade');
                //result.innerHTML = html;
                //document.getElementById('cnae').innerHTML = html;
            }
        });
    }
    
}

/**
 * Comment
 * @param {Object} obj Podera ser um Element ou um Integer
 * @return {null} Atualiza o campo <select id='cidade'></select>
 */
function buscarEstados(obj) {
    console.log("Array: "+Array.isArray(obj));
    if (Array.isArray(obj)){
        var estado = Number.parseInt(obj['codEstado']);
        var cidade = Number.parseInt(obj['codCidade']);
    } else {
        var estado = obj.value;
        var cidade = "";
    }
    console.log("Cidade: "+Number.isInteger(cidade));
    $.ajax({
        url: BASE_URL+'ajax/seachCidades',
        type: 'GET',
        data: {q:estado},
        dataType: 'JSON',
        success: function(json){
            var html = "";
            var select = document.getElementById('cidade');
            //console.log(select);
            var fimLista = select.length;
                for (var i=0; i<fimLista; i++){
                    select.options.remove(0);
                }
            if (Number.isInteger(cidade)){
                for (var x in json) {
                    var elem = document.createElement('option');
                    elem.value = json[x].Codigo;
                    elem.text = json[x].Nome;
                    ((Number.parseInt(json[x].Codigo)===cidade)?elem.setAttribute("selected","true"):"");
                    select.add(elem, select.options[x]);
                    html += '<option value="'+json[x].Codigo+'" '+
                            ((Number.parseInt(json[x].Codigo)===cidade)?"selected":" ")+'>'+json[x].Nome+'</option>';
                }
            } else {
                for (var x in json) {
                    var elem = document.createElement('option');
                    elem.value = json[x].Codigo;
                    elem.text = json[x].Nome;
                    select.add(elem, select.options[x]);
                    html += '<option value="'+json[x].Codigo+'">'+json[x].Nome+'</option>';
                }
            }
            
            console.log(html);
            //var result = document.getElementById('cidade');
            //result.innerHTML = html;
            //document.getElementById('cidade').innerHTML = html;
        }
    });
}

/**
 * Comment
 * Botao Click para consultar o CEP
 * @return {null} description
 */
function consultaCEP() {
    var cep = document.getElementById('cep');
    //alert(cep.value);
    var url = "https://api.postmon.com.br/v1/cep/"+cep.value+"?format=xml";
    //alert(url);
    sendGET(url);
}

/**
 * Comment
 * @param {Array} result 
 *  result['cidade'];
 *  result['bairro'];
 *  result['estado'];
 *  result['logradouro'];
 *  @return {null} description
 */
function atualizarPagina(result){
    var codCidade = result['cidade_info']['codigo_ibge'];
    var codEstado = result['estado_info']['codigo_ibge'];
    var obj = Array();
    obj['codEstado'] = codEstado;
    obj['codCidade'] = codCidade;
    buscarEstados(obj);
    //var cidade = document.getElementById('cidade');
    //var bairro = document.getElementById('bairro');
    //var estado = document.getElementById('estado');
    //var endereco = document.getElementById('endereco');
    //var pais = document.getElementById('pais');
    //endereco.setAttribute('value',result['logradouro']);
    //bairro.setAttribute('value',result['bairro']);
    //pais.setAttribute('value','Brasil');
    //estado.value = codEstado;
    //cidade.value = codCidade;
    document.getElementById('estado').value = codEstado;
    $('.cidade').val(codCidade);
    //document.getElementById('cidade').value = codCidade;
    console.log(codCidade);
    console.log(document.getElementById('cidade'));
    document.getElementById('bairro').setAttribute('value',result['bairro']);
    
    document.getElementById('endereco').setAttribute('value',result['logradouro']);
    document.getElementById('pais').setAttribute('value','Brasil');
    document.getElementById('numero').focus();
}

/**
 * Comment: Efetua a Pesquisa do CEP.
 * Atualiza a página.
 * @param {String} url description: URL de pesquisa.
 * @return {null} description
 */
function sendGET(url){
    // Exemplo de requisição GET
    var ajax = new XMLHttpRequest();

    // Seta tipo de requisição e URL com os parâmetros
    ajax.open("GET", url, true);

    // Envia a requisição
    ajax.send();

    // Cria um evento para receber o retorno.
    ajax.onreadystatechange = function() {
      // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
            if (ajax.readyState === 4 && ajax.status === 200) {
                    //var data = ajax.responseText;
                    //console.log(data);
        // Retorno do Ajax
                    
                    var xml = ajax.responseXML.documentElement;
                    console.log(xml);
                    var dados = new Array();
                    //var key = xml.childNodes.length;
                    //for (i=0; i<key; i++){
                    //    var remove = xml.childNodes[i];
                    //    dados[i] = new Array();
                    //    dados[i][0] = remove;
                    //    dados[i][1] = remove.childNodes.length;
                    //    //dados[i] = xml.removeChild(xml.firstChild);
                    //}
                    dados = organizarXML(xml);
                    //var key = dados.length;
                    for (var j=0; j<dados.length; j++){
                        if (Array.isArray(dados[j])){
                            var xml2 = dados[j][0];
                            var nivel = dados[j]['nivel'];
                            dados[j][2] = organizarXML(xml2, nivel);
                        }
                    }
                    console.log(dados);
                    //var array = new Array();
                    //for (i=0; i<dados.length; i++){
                    //    array[dados[i][0].tagName] = dados[i][0].textContent;
                    //}
                    var array = gerarArray(dados);
                    console.log(array);
                    
                    atualizarPagina(array);
            }
    };
    
    function organizarXML(xml, nivel=0){
        var dados = new Array();
        var key = xml.childNodes.length;
        for (var i=0; i<key; i++){
            var remove = xml.childNodes[i];
            if (remove.childNodes.length === 1){
                dados[i] = remove;
            } else {
                dados[i] = new Array();
                dados[i][0] = remove;
                dados[i][1] = remove.tagName;
                dados[i][2] = remove.textContent;
                dados[i]['nivel'] = nivel + 1;
            }
            //dados[i] = xml.removeChild(xml.firstChild);
            //if (remove.childNodes.length > 1){
            //    dados[i][2] = organizarXML(remove);
            //}
        }
        
        return dados;
    }
    
    function gerarArray(dados){
        var array = new Array();
        for (var i=0; i<dados.length; i++){
            if (Array.isArray(dados[i])){
                array[dados[i][0].tagName] = new Array();
                //var key = dados[i][2].length;
                for (var k=0; k<dados[i][2].length; k++){
                    array[dados[i][0].tagName][dados[i][2][k].tagName] = (dados[i][2][k].textContent);
                }
                
            } else {
                array[dados[i].tagName] = dados[i].textContent;
            }
        }
        return array;
    }
}

/**
 * Comment
 * @param {Integer} cpf description
 * @return {Boolean} description
 */
function validaCPF(cpf) {
    var numeros;
    var digitos;
    var soma;
    //var i;
    var resultado;
    var digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11){
        console.log("ValidaCPF: FALSE");
        return false;
    }
    for (var i = 0; i < cpf.length - 1; i++) {
        if (cpf.charAt(i) !== cpf.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
    }
    if (!digitos_iguais){
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (var i = 10; i > 1; i--){
            soma += numeros.charAt(10 - i) * i;
        }
        resultado = ((soma % 11) < 2 )? 0 : 11 - soma % 11;
        if (resultado !== parseInt(digitos.charAt(0)) ){
            console.log("ValidaCPF: FALSE");
            return false;
        }
        numeros = cpf.substring(0,10);
        soma = 0;
        for (var i = 11; i > 1; i--){
            soma += numeros.charAt(11 - i) * i;
        }
        resultado = ((soma % 11) < 2 )? 0 : 11 - soma % 11;
        if (resultado !== parseInt(digitos.charAt(1))){
            console.log("ValidaCPF: FALSE");
            return false;
        }
        console.log("ValidaCPF: TRUE");
        return true;
    } else {
        console.log("ValidaCPF: FALSE");
        return false;
    }
}

function validarCNPJ(cnpj) {
    var tamanho;
    var numeros;
    var digitos;
    var soma;
    var pos;
    cnpj = cnpj.replace(/[^\d]+/g,'');
    if(cnpj == ''){
        console.log("ValidarCNPJ: FALSE");
        return false;
    }
    
    if (cnpj.length != 14){
        console.log("ValidarCNPJ: FALSE");
        return false;
    }
    
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
            cnpj == "11111111111111" || 
            cnpj == "22222222222222" || 
            cnpj == "33333333333333" || 
            cnpj == "44444444444444" || 
            cnpj == "55555555555555" || 
            cnpj == "66666666666666" || 
            cnpj == "77777777777777" || 
            cnpj == "88888888888888" || 
            cnpj == "99999999999999"){
        console.log("ValidarCNPJ: FALSE");
        return false;
    }
    
    
    // Valida DVs
    tamanho = cnpj.length - 2;
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)){
        console.log("ValidarCNPJ: FALSE");
        return false;
    }
    
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)){
        console.log("ValidarCNPJ: FALSE");
        return false;
    }
    
    console.log("ValidarCNPJ: TRUE");
    return true;
}

function  incrementar(obj){
    //var estoque = 'estoque'+obj;
    var qtd = parseInt(document.getElementById('estoque'+obj).value);
    var qtdMax = parseInt(document.getElementById('quantMax'+obj).value);
    var preco = parseFloat(document.getElementById('preco'+obj).value);
    var subTotal = parseFloat(document.getElementById('subTotal'+obj).value);
    var preco_total = parseFloat(document.getElementById('preco').value);
    preco_total = preco_total - subTotal;
    qtd++;
    if (qtdMax < qtd){
        qtd--;
        alert("O nosso estoque contem somente: "+qtdMax);
    }
    subTotal = (qtd * preco);
    preco_total = preco_total + subTotal;
    document.getElementById('estoque'+obj).value = qtd;
    document.getElementById('subTotal'+obj).value = (subTotal);
    document.getElementById('preco').value = preco_total;
    document.getElementById('divSubTotal'+obj).innerHTML = converteFloatMoeda(subTotal);
    document.getElementById('qtd_prd').value = qtd;
}

function  decrementar(obj){
    //var estoque = 'estoque'+obj;
    var qtd = parseInt(document.getElementById('estoque'+obj).value);
    var preco = parseFloat(document.getElementById('preco'+obj).value);
    var subTotal = parseFloat(document.getElementById('subTotal'+obj).value);
    var preco_total = parseFloat(document.getElementById('preco').value);
    preco_total = preco_total - subTotal;
    qtd--;
    if (qtd <1){
        qtd++;
    }
    subTotal = (qtd * preco);
    preco_total = preco_total + subTotal;
    document.getElementById('estoque'+obj).value = qtd;
    document.getElementById('subTotal'+obj).value = (subTotal);
    document.getElementById('preco').value = preco_total;
    document.getElementById('divSubTotal'+obj).innerHTML = converteFloatMoeda(subTotal);
    document.getElementById('qtd_prd').value = qtd;
}

/**
 * params: 
 *      document.getElementById(estoque)
 *      document.getElementById(multiplo) 
 * @returns {undefined}
 *  returns:
 *      document.getElementById(estoque)
 *      document.getElementById(qtd) 
 */
function  estocar(){
    var qtd = parseInt(document.getElementById('estoque').value);
    var multiplo = parseInt(document.getElementById('multiplo').value);
    qtd = qtd + multiplo;
    document.getElementById('estoque').value = qtd;
    document.getElementById('qtd').value = qtd;
}

/**
 * params: 
 *      document.getElementById(estoque)
 *      document.getElementById(multiplo) 
 * @returns {undefined}
 *  returns:
 *      document.getElementById(estoque)
 *      document.getElementById(qtd) 
 */
function  retirar(){
    var qtd = parseInt(document.getElementById('estoque').value);
    var multiplo = parseInt(document.getElementById('multiplo').value);
    qtd = qtd - multiplo;
    if (qtd <1){
        qtd = 1;
    }
    document.getElementById('estoque').value = qtd;
    document.getElementById('qtd').value = qtd;
}

function newImage(){
    var node = document.createElement('input');
    var image = document.getElementById('fileImage');
    var id = parseInt(image.getAttribute('idFileImage'));
    var txtFotos = ("fotos") + (++id);
    node.setAttribute("type", "file");
    node.setAttribute("name", "fotos[]");
    node.setAttribute("class","btn btn-box-tool");
    node.setAttribute("id", txtFotos);
    image.appendChild(node);
    image.setAttribute('idFileImage', id);
}

function delImage(){
    var image = document.getElementById('fileImage');
    var id = parseInt(image.getAttribute('idFileImage'));
    var txtFotos = ("fotos") + (id--);
    var input = document.getElementById(txtFotos);
    if (id >= 0){
        image.removeChild(input);
        image.setAttribute('idFileImage', id);
    }
}

function formatarMoeda() {
    var elemento = document.getElementById('preco');
    var valor = elemento.value;
    var inteiro = null;
    var decimal = null;
    var real = null;
    var len = null;
    
    //valor = valor + '';
    //valor = parseInt(valor.replace(/[\D]+/g,''));
    real = getMoney(valor);
    real = real + '';
    len = real.length;
    
    decimal = real.substring(len - 2, len);
        if (decimal.length === 1){
            decimal = '0' + decimal;
        }
    //alert("Decimal: "+decimal);
    if (len > 2){
        inteiro = real.substring(0, len - 2);
        //alert("Inteiro: "+inteiro);
    } else {
        inteiro = '0';
    }
    real = inteiro + decimal;
    
    valor = formatReal(real);
    
    //valor = valor.replace(/([0-9]{2})$/g, ",$1");
    //switch (valor.length) {
    //    case 1: break;
    //    case 2: break;
    //    case 3: break;
    //    case 4: break;
    //    case 5: break;
    //    case 6: break;
    //    case 7:
    //        valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    //        break;
    //    case 8:
    //        valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    //        break;
    //    case 9:
    //        valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    //        break;
    //    default:
    //        valor = valor.replace(/([0-9]{3}),([0-9]{3}),([0-9]{2}$)/g, ".$1.$2,$3");
    //        break;
    //}
    
    //if (valor.length > 6) {
    //    valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    //}
    
    elemento.value = valor;
    
    function getMoney( str ){
        return parseInt( str.replace(/[\D]+/g,'') );
    }
    
    function formatReal( int ){
        var tmp = int + '';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
            tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        return tmp;
    }
}

//function getMoney( str ){
//    return parseInt( str.replace(/[\D]+/g,'') );
//}

//function formatReal( int ){
//    var tmp = int + '';
//    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
//    if( tmp.length > 6 )
//        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
//    return tmp;
//}

// WRITE THE VALIDATION SCRIPT.
function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode;
    if (iKeyCode !== 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)){
        return false;
    }
    return true;
}

/*   
 * 
 * @brief Converte uma string em formato moeda para float
 * @param {string} valor - o valor em moeda
 * @returns {type} valor - o valor em float
*/
/**
 * Comment
 * Converte uma string em formato moeda para float
 * @param {string} valor O valor em Moeda
 * @return {float} O valor em Float
 */
function converteMoedaFloat(valor){
    
    if (valor === "") {
        valor =  0;
    } else {
        valor = valor.replace(".","");
        valor = valor.replace(",",".");
        valor = parseFloat(valor);
    }
    
    return valor;
}

/*   @brief Converte um valor em formato float para uma string em formato moeda
      @param valor(float) - o valor float
      @return valor(string) - o valor em moeda
*/
function converteFloatMoeda(valor){
    var inteiro = null;
    var decimal = null;
    var c = null;
    var j = null;
    var aux = new Array();
    valor = ""+valor;
    c = valor.indexOf(".",0);
    //encontrou o ponto na string
    if(c > 0){
         //separa as partes em inteiro e decimal
         inteiro = valor.substring(0,c);
         decimal = valor.substring(c+1,valor.length);
    }else{
         inteiro = valor;
    }
    
    //pega a parte inteiro de 3 em 3 partes
    for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
         aux[c]=inteiro.substring(j-3,j);
    }
    
    //percorre a string acrescentando os pontos
    inteiro = "";
    for(c = aux.length-1; c >= 0; c--){
         inteiro += aux[c]+'.';
    }
    //retirando o ultimo ponto e finalizando a parte inteiro
    inteiro = inteiro.substring(0,inteiro.length-1);
    
    decimal = parseInt(decimal);
    if(isNaN(decimal)){
        decimal = "00";
    }else{
        decimal = ""+decimal;
        if(decimal.length === 1){
            decimal = decimal+"0";
        }
    }
    
    valor = "R$ "+inteiro+","+decimal;
    
    return valor;
}

function calcularTroco(obj){
    var preco = converteMoedaFloat(obj.value);
    var precoTotal = document.getElementById('totalVenda').value;
    var troco = preco - precoTotal;
    //if (valor === "") {
    //    valor =  0;
    //} else {
    //    valor = valor.replace(".","");
    //    valor = valor.replace(",",".");
    //    valor = parseFloat(valor);
    //}
    
    document.getElementById('troco').value = converteFloatMoeda(troco);
    return troco;
}