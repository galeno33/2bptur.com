<?php
    /***
     * a dinamica dos campos de seleção está implementada com js no diretorio js/script.js
     * a dinamica com javascript foi desenvolvido dia 15 de maio de 2024 e atualizada dia 25 de maio de 2024
     * */
    //session_start();
    //$mtr = $_SESSION['mtr'];      inserir_db_material.php
    echo "<form class='row g-3' id='cadastroOcorrencia' action='#' method='POST' enctype='multipart/form-data'>";
                                                
    /*echo "<div id='adMatricula' class='col-sm-3'>";
        echo "<div class='form-group'>";
            echo "<span id='msgAlerta1'></span>";
                echo "<label for='inputMatricula' class='form-label'> Matricula</label>";
                echo "<input type='number' class='form-control' name='matricula' id='inputMatricula' placeholder='Digite a Matricula' value='$mtr' disabled>"; 
                
        echo "</div>";
    echo "</div>";*/
    //------------------------------data da cautela-----------------------------------------
    echo "<div id='adDataCaula' class='col-sm-2'>";
        echo "<div class='form-group'>";
            echo "<span id='msgAlerta1'></span>";
                echo "<label for='inputDataCautela' class='form-label'>Data da cautela</label>";
                echo "<input type='date' class='form-control' name='diaCautela' id='inputDataCautela' placeholder='Data da cautela'>"; 
        echo "</div>";
    echo "</div>";
    //---------------------------------------------------------------------------------------------------------
    echo "<div class='col-sm-2' id='quantidadeDiv'>";
        echo "<div class='form-group'>";
            echo "<span id='msgAlerta1'></span>";
                echo "<label for='inputQuantidade' class='form-label'>Quantidade</label>";
                echo "<input type='number' class='form-control' name='quantidade' id='inputSerie' placeholder='Quantidade'>"; 
        echo "</div>";
    echo "</div>";
    //---------------------------------------------------------------------------------------------------------
    echo "<div class='col-sm-3'>";
        echo "<label for='inputMiker' class='form-label'>Material</label>";
        echo "<select class='form-control' id='materialSelect' name='material' aria-label='Default select example'>";
            echo "<option selected disabled>Material</option>";
            echo "<option value='1'>Armamento</option>";
            echo "<option value='2'>Colete balistico</option>";
            echo "<option value='3'>Munição</option>";
            echo "<option value='4'>Tonfa</option>";
            echo "<option value='5'>Espagidor</option>";
            echo "<option value='6'>Carregador</option>";
            echo "<option value='7'>Colete reflexivo</option>";
            echo "<option value='8'>Escudo balistico</option>";
            echo "<option value='9'>Escudo nivel III</option>";
            echo "<option value='10'>Capacete anti-tumulto</option>";
        echo "</select>";
    echo "</div>";
    //--------------------------------select de tipo de armamento--------------------------------------
    echo "<div class='col-sm-3' id='tipoArmamentoDiv' style= 'display:none;'>";
        echo "<label for='inputTipificacao' class='form-label'>Tipo</label>";
        echo "<select class='form-control' name='tipoArmamento' aria-label='Default select example'>
            <option selected disabled>Tipo de armamento</option>
            <option value='1'>Pistola</option>
            <option value='2'>Revolver</option>
            <option value='3'>Fuzil</option>
            <option value='4'>Carabina</option>
        </select>";
    echo "</div>";
    //--------------------------------select de tipo de carregador--------------------------------------
    echo "<div class='col-sm-3' id='tipoCarregadorDiv' style= 'display:none;'>";
        echo "<label for='inputTipificacao' class='form-label'>Tipo</label>";
        echo "<select class='form-control' name='tipoCarregador' aria-label='Default select example'>
            <option selected disabled>Tipo de carregador</option>
            <option value='1'>Pistola</option>
            <option value='2'>Fuzil</option>
            <option value='3'>Carabina</option>
        </select>";
    echo "</div>";
    //--------------------------------select do calibre----------------------------------------------
    echo "<div class='col-sm-2' id='tipoCalibre' style= 'display:none;'>";
        echo "<label for='inputCalibre' class='form-label'>Calibre</label>";
        echo "<select class='form-control' name='tipoCalibre' aria-label='Default select example'>
            <option selected disabled>Calibre</option>
            <option value='1'>.40</option>
            <option value='2'>.556</option>
            <option value='3'>.762</option>
            <option value='4'>.38</option>
            <option value='5'>.22</option>
            <option value='6'>.32</option>
        </select>";
    echo "</div>";
    //--------------------------------select do calibre do carregador-----------------------------------
    echo "<div class='col-sm-2' id='calibreCarregador' style= 'display:none;'>";
        echo "<label for='inputCalibre' class='form-label'>Calibre</label>";
        echo "<select class='form-control' name='calibreCarregador' aria-label='Default select example'>
            <option selected disabled>Calibre</option>
            <option value='1'>.40</option>
            <option value='2'>.556</option>
            <option value='3'>.762</option>
            <option value='4'>.22</option>
        </select>";
    echo "</div>";
    //--------------------------------select de tipo de colete---------------------------------------
    echo "<div class='col-sm-3' id='tipoColeteDiv' style= 'display:none'>";
        echo "<label for='inputTipificacao' class='form-label'>Tipo</label>";
        echo "<select class='form-control' name='tipoColete' aria-label='Default select example'>
            <option selected disabled>Tipo de colete</option>
            <option value='1'>Feminino</option>
            <option value='2'>masculino</option>
        </select>";
    echo "</div>";
    //--------------------------------select de tipo de tonfa---------------------------------------
    echo "<div class='col-sm-3' id='tipoTonfaDiv' style= 'display:none'>";
        echo "<label for='inputTonfa' class='form-label'>Tipo</label>";
        echo "<select class='form-control' name='tipoTonfa' aria-label='Default select example'>
            <option selected disabled>Tipo de tonfa</option>
            <option value='1'>Madeira</option>
            <option value='2'>Polietileno</option>
        </select>";
    echo "</div>";
    //--------------------------------select de tipo de espagidor-----------------------------------
    echo "<div class='col-sm-3' id='tipoEspagidorDiv' style= 'display:none'>";
        echo "<label for='inputTonfa' class='form-label'>Tipo</label>";
        echo "<select class='form-control' name='tipoEspagidor' aria-label='Default select example'>
            <option selected disabled>Tipo de espagidor</option>
            <option value='1'>PSI JATO DE NÉVOA</option>
            <option value='2'>GL 108 MAX CS</option>
            <option value='3'>GL 108 MINI</option>
            <option value='4'>GL 108 OC MAX</option>
            <option value='5'>STANDARD 108 MEDIO</option>
        </select>";
    echo "</div>";
    //------------------------------select do tamanho do colete----------------------------------------
    echo "<div class='col-sm-2' id='tipoTamanhoColeteDiv' style= 'display:none'>";
        echo "<label for='inputTamanhoColete' class='form-label'>Tamanho do colete</label>";
        echo "<select class='form-control' name='tamanhoColete' aria-label='Default select example'>
            <option selected disabled>Tamanho</option>
            <option value='1'>P</option>
            <option value='2'>M</option>
            <option value='3'>G</option>
            <option value='4'>GG</option>
        </select>";
    echo "</div>";
    //------------------------------select do numero do material
    echo "<div class='col-sm-2' id='serieDiv' style= 'display:none'>";
        echo "<div class='form-group'>";
                echo "<label for='inputSerie' class='form-label'>Serie</label>";
                echo "<input type='text' class='form-control' name='serie' id='inputSerie' placeholder='Nº de serie'>"; 
        echo "</div>";
    echo "</div>";
    //---------------------------------------inserir token----------------------------------------------------------
    echo "<div class='col-sm-2' id='chaveConfirmDiv' style='display:none'>";
        echo "<label for='inputToken' class='form-label'>Confirmar</label>";
        echo "<input type='text' class='form-control' name='token' id='inputToken' placeholder='Confirme a cautela'>";
        
    echo "</div>";
    //----------------botão que envia um token para o celular do usuario que vai cautelar o material----------------
    //<!-- Botão de Gerar Token -->
       /* echo "<div class='col-sm-12'>";
            echo "<button type='button' id='gerarTokenButton' class='btn btn-warning'>Gerar token</button>";
        echo "</div>";*/

    echo "<div class='col-sm-12'>";
    echo "<hr class='sidebar-divider'>";
        echo "<button type='submit' id='butaoVisivel' name='salvar' class='btn btn-primary' style='display:none;>Cautelar material</button>";//'
        //echo "<button type='button' id='gerarTokenButton' class='btn btn-warning'>Gerar token</button>";
    echo "</div>";
    echo "</form>";
    //--------------------------------------------------------------------------------------------------------------
    echo "<div class='col-sm-12'>";
    //echo "<hr class='sidebar-divider'>";
        //echo "<button type='submit' id='butaoVisivel' name='salvar' class='btn btn-primary' style='display:none;'>Cautelar material</button>";
        //echo "<button type='submit' id='butaoToken' name='salvar' class='btn btn-warning' style='display:block;'>Gerar token</button>";
       // echo "<a href='../token/token.php' name='gerarToken' id='butaoToken' class='btn btn-warning' style='display:block;'> Gerar token</a>";
        //echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#myModal'>Autorização</button>";
    echo "</div>";
    //--------------------------------------------fim do botão que chama o modal do token---------------------------
   
   
?>