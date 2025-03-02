<?php
/*****Desenvolvido por Fabio Galeno*****/
    require_once('../conexao/conexao_01.php');
    require_once('viatura_carga.php');
    require_once('material_carga.php');
    class Cargas
    {
        private $conexao;
        
        public function __construct()
        {
            $this->conexao = new Conexao();
        }

        public function SelectViaturas()
        {
            $conn = $this->conexao->getConexao();

            $vtrs = [];
            $sqlVtr = "SELECT * FROM viatura";

            $stmt = $conn->prepare($sqlVtr);
            $stmt->execute();
            $result = $stmt->get_result();
            while($rowVtr = $result->fetch_assoc())
            {
                $selectVtr = new Vtrs
                (
                    $rowVtr['id_prefixo'],
                    $rowVtr['modelo'],
                    $rowVtr['placa'],
                    $rowVtr['situacao'],
                    $rowVtr['cautela'],
                    $rowVtr['detalhes']
                );
                $vtrs[] = $selectVtr;
            }
            return $vtrs;
        }
        //função que seleciona todos os dados de materiais cadastrados
        public function SelectMaterial()
        {
            $conn = $this->conexao->getConexao();
            $mtrl = [];
            $sqlMtrl = "SELECT
                        id_material,
                        serie,
                        material,
                        tipo,
                        modelo,
                        quantidade,
                        tam_cal,
                        marca,
                        unidade
                        FROM material";

            $stmt = $conn->prepare($sqlMtrl);
            $stmt->execute();
            $result = $stmt->get_result();
            while($rowMtrl = $result->fetch_assoc())
            {
                //adicionar mais dados
                $selectMaterial = new Mtrl

                (   
                    $rowMtrl['id_material'],
                    $rowMtrl['serie'],
                    $rowMtrl['material'],
                    $rowMtrl['tipo'],
                    $rowMtrl['modelo'],
                    $rowMtrl['quantidade'],
                    $rowMtrl['tam_cal'],
                    $rowMtrl['marca'],
                    $rowMtrl['unidade']
                );
                $mtrl[] = $selectMaterial;
            }
            return $mtrl;
        }
    }

?>