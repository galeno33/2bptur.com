<?php
class Materiais
{
    private $idCautela;
    private $mtrArmeiro;
    private $material;
    private $tipoMaterial;
    private $tamanhoCalibre;
    private $diaCautela;
    private $cautelante;
    private $postoArmeiro;
    private $armeiro;
    private $diaEntrega;
    private $series;

    public function __construct($idCautela, $mtrArmeiro, $material, $tipoMaterial, $tamanhoCalibre, $diaCautela, $cautelante, $postoArmeiro, $armeiro, $diaEntrega, $series)
    {
        $this->idCautela = $idCautela;
        $this->mtrArmeiro = $mtrArmeiro;
        $this->material = $material;
        $this->tipoMaterial = $tipoMaterial;
        $this->tamanhoCalibre = $tamanhoCalibre;
        $this->diaCautela = $diaCautela;
        $this->cautelante = $cautelante;
        $this->postoArmeiro = $postoArmeiro;
        $this->armeiro = $armeiro;
        $this->diaEntrega = $diaEntrega;
        $this->series = $series;
    }

    public function getIdCautela() { return $this->idCautela; }
    public function getMtrArmeiro() { return $this->mtrArmeiro; }
    public function getMaterial() { return $this->material; }
    public function getTipoMaterial() { return $this->tipoMaterial; }
    public function getTamanhoCalibre() { return $this->tamanhoCalibre; }
    public function getDiaCautela() { return $this->diaCautela; }
    public function getCautelante() { return $this->cautelante; }
    public function getPostoArmeiro() { return $this->postoArmeiro; }
    public function getArmeiro() { return $this->armeiro; }
    public function getDiaEntrega() { return $this->diaEntrega; }
    public function getSeries() { return $this->series; }
}
?>