<?php if(!defined('BASEPATH')){ exit('Sem permissão de acesso direto ao Script.'); }
  //realiza manutenções e consultas na tabela servidores
  class Admin_servidores_model extends CI_Model{
    public function __construct() {
      parent:: __construct();
      $this->load->model('Admin_usuario_model','aum');
    }
    //Adiciona uma servidor nova no sistema
    public function Addservidor($dados_servidor = NULL) {
      return $this->db->insert('servidores', $dados_servidor);
    }
    //recupera dados de todas as servidores
    public function getAllservidor() {
      $this->db->select('*');
      $this->db->from('servidores');
      return $this->db->get()->result();
    }

    public function verifica_cadastrado_nome($nome){
      $this->load->database();
      $query  = $this->db->get_where('servidores',array('nome'=>$nome));
      $result = $query->result_array();
      return count($result);
    }

    public function verifica_cadastrado_siape($siape){
      $this->load->database();
      $query  = $this->db->get_where('servidores',array('siape'=>$siape));
      $result = $query->result_array();
      return count($result);
    }

    //recupera dados de uma servidor por um único ID
    public function GetServidorById($idservidor = '') {
      $this->db->select('*');
      $this->db->from('servidores');
      $this->db->where('id', $idservidor);
      return $this->db->get()->result()[0];
    }

    // altera dados de uma servidor
    public function Updateservidor($idservidor = NULL, $dados_servidor = NULL) {
      $this->db->where('id', $idservidor);
      $this->db->update('servidores', $dados_servidor);
      return TRUE;
    }

    //deleta uma servidor pelo ID
    public function Deleteservidor($idservidor = NULL) {
      $this->db->where('id', $idservidor);
      $this->db->delete('servidores');
      return TRUE;
    }
}
