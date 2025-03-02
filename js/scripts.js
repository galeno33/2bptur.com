/*!
* Start Bootstrap - Personal v1.0.1 (https://startbootstrap.com/template-overviews/personal)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-personal/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

   
            $(document).ready(function(){
    
                $('#materialSelect').on('change', function() {
                    //seleciona os campos especificos quando o campo armamento é escolhido
                    if ($(this).val() == '1') {
                        $('#tipoArmamentoDiv').show();
                        $('#tipoCalibre').show();
                        $('#serieDiv').show();
                        $('#chaveConfirmDiv').show();
                    }else {
                        $('#tipoArmamentoDiv').hide();
                        $('#tipoCalibre').hide();
                        $('#serieDiv').hide();
                    }
                    if ($(this).val() == '2') {
                        $('#tipoColeteDiv').show();
                        $('#tipoTamanhoColeteDiv').show();
                        $('#serieDiv').show();
                        $('#chaveConfirmDiv').show();
                    }else {
                        $('#tipoColeteDiv').hide();
                        $('#tipoTamanhoColeteDiv').hide();
                        //$('#serieDiv').hide();
                    }
                    if ($(this).val() == '3') {
                        $('#tipoCalibre').show();
                        $('#chaveConfirmDiv').show();
                    }//else {
                        //$('#tipoCalibre').hide(); //de alguma forma se ativar essas linhas o campo calibre ,quando selecionado o armamento, não aparece
                    //}
                    if ($(this).val() == '4'){
                        $('#tipoTonfaDiv').show();
                        $('#chaveConfirmDiv').show();
                    }else {
                        $('#tipoTonfaDiv').hide();
                    }
                    if ($(this).val() == '5'){
                        $('#tipoEspagidorDiv').show();
                        $('#chaveConfirmDiv').show();
                    }else {
                        $('#tipoEspagidorDiv').hide();
                    }
                    //condicional para selecionar o tipo de carregador
                    if($(this).val() == '6'){
                        $('#tipoCarregadorDiv').show();
                        $('#calibreCarregador').show();
                        $('#serieDiv').show();
                        $('#chaveConfirmDiv').show();
                    }else {
                        $('#tipoCarregadorDiv').hide();
                        $('#calibreCarregador').hide();
                        //$('#serieDiv').hide();
                    }
                    if($(this).val() == '7'){
                        $('#chaveConfirmDiv').show();
                    }
                    if($(this).val() == '8'){
                        $('#chaveConfirmDiv').show();
                    }
                    if($(this).val() == '9'){
                        $('#chaveConfirmDiv').show();
                    }
                    if($(this).val() == '10'){
                        $('#chaveConfirmDiv').show();
                    }
                });
            });
    
    