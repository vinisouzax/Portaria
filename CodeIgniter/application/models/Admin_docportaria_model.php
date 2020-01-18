<?php if(!defined('BASEPATH')){ exit('Sem permissão de acesso direto ao Script.'); }
//realiza consultas e manutenção na tabela de portarias
class Admin_docportaria_model extends CI_Model{
  public function __construct() {
    parent::__construct();
    $this->load->model('Admin_docportaria_model','aum');
  }
  //Adiciona uma portaria nova no sistema
  public function Addportaria($dados_portaria = NULL) {
      return $this->db->insert('portaria', $dados_portaria);
  }

  public function verifica_cadastrado($nome,$dado){
    $this->load->database();
    $query = $this->db->get_where($nome,array('numero'=>$dado));
    $result = $query->result_array();
    if(count($result) > 0) {
        return TRUE;
    }
    return FALSE;
  }

  public function verifica_numero($id,$numero){
    $this->load->database();
    $query = $this->db->get_where('portaria',array('idPortaria'=>$id));
    $query = $this->db->get_where('portaria', array('idPortaria' => $id, 'numero' => $numero));
    $result = $query->result_array();
    if(count($result) > 0) {
        return FALSE;
    }
    return TRUE;
  }
  //recupera dados de todas as portarias
  public function getAllportarias() {
    $this->db->select('*');
    $this->db->from('portaria');
    $this->db->join('tipo', 'portaria.idTipo = tipo.idTipo');
    $query = $this->db->get();
    return $query->result();
  }
  //busca portarias com STATUS CADASTRADA E RETORNADA usada na view docportaria
  public function getAllportariasCadastradas() {
    $this->db->select('*');
    $this->db->from('portaria');
    $this->db->where('status', 'Cadastrada')->or_where('status', 'Retornada')->or_where('status', 'Espera');
    $this->db->join('tipo', 'portaria.idTipo = tipo.idTipo');
    $query = $this->db->get();
    return $query->result();
  }
  //busca portarias com STATUS PUBLICADA, APROVADA, ESPERA, RETORNADA usada na view home
  public function getAllportariasPublicadasAprovadasEspera() {
    $this->db->select('*');
    $this->db->from('portaria');
    $this->db->where('status', 'Publicada')->or_where('status', 'Aprovada')->or_where('status', 'Espera')->or_where('status', 'Retornada');
    $this->db->join('tipo', 'portaria.idTipo = tipo.idTipo');
    $query = $this->db->get();
    return $query->result();
  }
  //busca todos os tipos de portaria
  public function getTipos() {
    $this->db->select('*');
    $this->db->from('tipo');
    return $this->db->get()->result();
  }
  //recupera dados de uma portaria por um único ID
  public function GetPortariaById($idportaria = '') {
    $this->db->select('*');
    $this->db->from('portaria');
    $this->db->where('idPortaria', $idportaria);
    return $this->db->get()->result()[0];
  }
  // altera dados de uma portaria
  public function UpdateDocPortaria($idportaria = NULL, $dados_portaria = NULL) {
    $this->db->where('idPortaria', $idportaria);
    $this->db->update('portaria', $dados_portaria);
    return TRUE;
  }
 //deleta uma portaria pelo ID
  public function DeletePortaria($idportaria = NULL) {
    $this->db->where('idPortaria', $idportaria);
    $this->db->delete('portaria');
    return TRUE;
  }
  //altera status de portaria para ARQUIVADA
  public function StatusArquivada($idportaria = NULL) {
    $this->db->set('status', 'Arquivada');
    $this->db->where('idPortaria', $idportaria);
    $this->db->update('portaria');
    return TRUE;
  }
  //altera status de portaria para PUBLICADA
  public function StatusPublicada($idportaria = NULL) {
    $this->db->set('status', 'Publicada');
    $this->db->where('idPortaria', $idportaria);
    $this->db->update('portaria');
    return TRUE;
  }
  //altera status de portaria para APROVADA
  public function StatusAprovada($idportaria = NULL, $path = NULL, $texto = NULL, $numero = NULL) {
    $this->db->set('status', 'Aprovada');
    $this->db->set('arquivo', $path);
    $this->db->set('texto', $texto);
    $this->db->set('numero', $numero);
    $this->db->where('idPortaria', $idportaria);
    $this->db->update('portaria');
    return TRUE;
  }
  //altera status de portaria para ESPERA
  public function StatusEspera($idportaria = NULL) {
    $this->db->set('status', 'Espera');
    $this->db->where('idPortaria', $idportaria);
    $this->db->update('portaria');
    return TRUE;
  }
  //altera status de portaria para RETORNADA
  public function StatusRetorna($idportaria = NULL) {
    $this->db->set('status', 'Retornada');
    $this->db->where('idPortaria', $idportaria);
    $this->db->update('portaria');
    return TRUE;
  }

  public function obtemNumero(){
    $anoAtual = date('Y');
    $this->db->select_max('numero');
    $this->db->from('portaria');
    $this->db->where('year(dataInicio)', $anoAtual);
    $this->db->join('tipo', 'portaria.idTipo = tipo.idTipo');
    return $this->db->get()->result()[0];
  }

  public function tratamentoNumero($numero){
    if($numero < 10)
        return "00".$numero;
    if($numero > 9 && $numero < 100)
        return "0".$numero;
    if($numero > 99)
        return $numero;
  }

  public function tratamentoDia($dia){
    if($numero < 10)
        return "0".$dia;
    else
        return $dia;
  }
  public function obtemMes($mes){
    if($mes == 1)
        return "JANEIRO";
    if($mes == 2)
        return "FEVEREIRO";
    if($mes == 3)
        return "MARÇO";
    if($mes == 4)
        return "ABRIL";
    if($mes == 5)
        return "MAIO";
    if($mes == 6)
        return "JUNHO";
    if($mes == 7)
        return "JULHO";
    if($mes == 8)
        return "AGOSTO";
    if($mes == 9)
        return "SETEMBRO";
    if($mes == 10)
        return "OUTUBRO";
    if($mes == 11)
        return "NOVEMBRO";
    if($mes == 12)
        return "DEZEMBRO";
  }
}
