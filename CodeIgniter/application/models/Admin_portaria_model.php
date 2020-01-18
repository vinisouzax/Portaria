<?php if(!defined('BASEPATH')){ exit('Sem permissão de acesso direto ao Script.'); }
//realiza consultas e manutenções na tabela tipos
class Admin_portaria_model extends CI_Model{
   public function __construct() {
    parent:: __construct();
    $this->load->model('Admin_usuario_model','aum');
  }
  //Adiciona um tipo de portaria nova no sistema
  public function AddPortaria($dados_portaria = NULL) {
    return $this->db->insert('tipo', $dados_portaria);
  }
  //recupera dados de todos tipo de portaria
  public function getAllPortaria() {
    $this->db->select('*');
    $this->db->from('tipo');
    return $this->db->get()->result();
  }
  public function verifica_cadastrado($nome){
    $this->load->database();
    $query  = $this->db->get_where('tipo',array('nome'=>$nome));
    $result = $query->result_array();
    if(count($result) > 0) {
        return TRUE;
    }
    return FALSE;
  }
  //recupera dados de um tipo de portaria por um único ID
  public function GetPortariaById($idPortaria = NULL) {
    $this->db->select('*');
    $this->db->from('tipo');
    $this->db->where('idTipo', $idPortaria);
    return $this->db->get()->result()[0];
  }
  // altera dados de um tipo de portaria
  public function UpdatePortaria($idPortaria = NULL, $dados_portaria = NULL) {
    $this->db->where('idTipo', $idPortaria);
    $this->db->update('tipo', $dados_portaria);
    return TRUE;
  }
  //deleta um tipo de portaria pelo ID
  public function DeletePortaria($idPortaria = NULL) {
    $this->db->where('idTipo', $idPortaria);
    $this->db->delete('tipo');
    return TRUE;
  }

}
