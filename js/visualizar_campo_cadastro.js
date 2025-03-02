
$(document).ready(function(){
    
    $('#inputMaterial').on('change', function() {
        //seleciona os campos especificos quando o campo armamento é escolhido
        if ($(this).val() == '1') {
            $('#tipoArmamentoDiv').show();
            //$('#tipoCalibre').show();
            //$('#serieDiv').show();
            //$('#chaveConfirmDiv').show();
            $('#buttonMaterial').show();
        }else {
            $('#tipoArmamentoDiv').hide();
            $('#tipoCalibre').hide();
            //$('#serieDiv').hide();
        }
        if ($(this).val() == '2') {
            //$('#buttonMaterial').show();
            $('#tipoColeteDiv').show();
            $('#tipoTamanhoColeteDiv').show();
            //$('#serieDiv').show();
            //$('#chaveConfirmDiv').show();
            $('#inputMarca').show();
            
        }else {
            $('#tipoColeteDiv').hide();
            $('#tipoTamanhoColeteDiv').hide();
            $('#inputMarca').hide();
            //$('#serieDiv').hide();
        }
        if ($(this).val() == '3') {
            $('#tipoCalibre').show();
            $('#chaveConfirmDiv').show();
            $('#buttonMaterial').show();
        }
        if ($(this).val() == '4'){
            $('#tipoTonfaDiv').show();
            $('#chaveConfirmDiv').show();
            $('#buttonMaterial').show();
        }else {
            $('#tipoTonfaDiv').hide();
        }
        if ($(this).val() == '5'){
            $('#tipoEspagidorDiv').show();
            //$('#chaveConfirmDiv').show();
            $('#buttonMaterial').show();
        }else {
            $('#tipoEspagidorDiv').hide();
        }
        //condicional para selecionar o tipo de carregador
        if($(this).val() == '6'){
            $('#modeloCarregadorDiv').show();
            $('#calibreCarregador').show();
        }else {
            $('#modeloCarregadorDiv').hide();
            $('#calibreCarregador').hide();
            //$('#serieDiv').hide();
        }
        if($(this).val() == '7'){
            $('#buttonMaterial').show();
            $('#chaveConfirmDiv').show();
        }
        if($(this).val() == '8'){
            $('#buttonMaterial').show();
            $('#chaveConfirmDiv').show();
        }
        if($(this).val() == '9'){
            $('#buttonMaterial').show();
            $('#chaveConfirmDiv').show();
        }
        if($(this).val() == '10'){
            $('#buttonMaterial').show();
            $('#chaveConfirmDiv').show();
        }
    });

    $('#tipoArmamento').on('change', function() {
        if($(this).val() == '1'){
            $('#modeloPistola').show();
            $('#tipoCalibre').show();
        }else{
            $('#modeloPistola').hide();
        }
        if($(this).val() == '2'){
            $('#tipoCalibre').show();
        }
        if($(this).val() == '3'){
            $('#modeloFuzil').show();
            $('#tipoCalibre').show();
        }else{
            $('#modeloFuzil').hide();
        }
        if($(this).val() == '4'){
            $('#modeloCarabina').show();
            $('#tipoCalibre').show();
        }else{
            $('#modeloCarabina').hide();
        }
    });

    $('#tipoCarregador').on('change', function() {
        //if($(this).val() == '1')
    });
});