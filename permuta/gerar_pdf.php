<?php
    // Inclua o TCPDF
    require_once('tcpdf/tcpdf.php');

    // Classe personalizada para geração de PDF
    class PermutaPDF extends TCPDF {

        private $detalhes;

        // Construtor para inicializar os detalhes
        public function __construct($detalhes) {
            parent::__construct();
            $this->detalhes = $detalhes;
        }

        // Cabeçalho personalizado
        public function Header() {
            // Caminho do logo
            $image_file = K_PATH_IMAGES . 'logo.png';
            $this->Image($image_file, 10, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            
            // Fonte do título
            $this->SetFont('helvetica', 'B', 14);
            
            // Título do documento
            $this->Cell(0, 15, 'REQUERIMENTO DE PERMUTA DE ESCALA DE SERVIÇO', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        }

        // Rodapé personalizado
        public function Footer() {
            // Posição do rodapé
            $this->SetY(-15);
            // Fonte do rodapé
            $this->SetFont('helvetica', 'I', 8);
            // Número da página
            $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }

        // Função para adicionar conteúdo detalhado da permuta
        public function adicionarConteudo() {
            $html = '
                <h3>Detalhes da Permuta</h3>
                <table border="1" cellpadding="5">
                    <tr>
                        <td><strong>Posto do Permutante:</strong></td>
                        <td>' . $this->detalhes['postoPermutante'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Permutante:</strong></td>
                        <td>' . $this->detalhes['guerraPermutante'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Cia do Permutante:</strong></td>
                        <td>' . $this->detalhes['cia1'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Posto do Permutado:</strong></td>
                        <td>' . $this->detalhes['postoPermutado'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Permutado:</strong></td>
                        <td>' . $this->detalhes['guerraPermutado'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Cia do Permutado:</strong></td>
                        <td>' . $this->detalhes['cia2'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Data da Permuta:</strong></td>
                        <td>' . $this->detalhes['dataPermuta'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Justificativa:</strong></td>
                        <td>' . $this->detalhes['justificativa'] . '</td>
                    </tr>
                </table>
            ';

            // Adicionar conteúdo HTML ao PDF
            $this->writeHTML($html, true, false, true, false, '');
        }
    }

    // Função para obter os detalhes da permuta (exemplo)
    function obterDetalhesPermuta() {
        // Simulação dos dados para exemplo
        return [
            'postoPermutante' => 'Capitão',
            'guerraPermutante' => 'Silva',
            'cia1' => '1ª Cia',
            'postoPermutado' => 'Sargento',
            'guerraPermutado' => 'Santos',
            'cia2' => '2ª Cia',
            'dataPermuta' => '25-09-2024',
            'justificativa' => 'Motivos Pessoais'
        ];
    }

    // Instanciando a classe com detalhes
    $detalhesPermuta = obterDetalhesPermuta();
    $pdf = new PermutaPDF($detalhesPermuta);

    // Configurar o documento PDF
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nome da Empresa');
    $pdf->SetTitle('Detalhes da Permuta');
    $pdf->SetSubject('Permuta de Escala');
    $pdf->SetKeywords('Permuta, Escala, PDF');

    // Adicionar página
    $pdf->AddPage();

    // Adicionar conteúdo ao PDF
    $pdf->adicionarConteudo();

    // Gerar e exibir o PDF
    $pdf->Output('detalhes_permutas.pdf', 'I');
?>