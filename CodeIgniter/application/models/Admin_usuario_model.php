<?php if(!defined('BASEPATH')){ exit('Sem permissão de acesso direto ao Script.'); }
  //realiza alterações e consultas na tabela usuario
  class Admin_usuario_model extends CI_Model{
    public function __construct() {
      parent:: __construct();
      $this->load->model('Admin_usuario_model','aum');
    }

    //pega todos os usuarios cadastrados no sistema
		public function getAllUsuarios() {
      $this->db->select('*');
      $this->db->from('usuario');
      return $this->db->get()->result();
    }

    //pega todos os usuarios diretores cadastrados no sistema
		public function getAllDiretores() {
      $this->db->select('*');
      $this->db->from('usuario');
      $this->db->where('nivelAcesso', 'Diretor');
      return $this->db->get()->result();
    }

    //adiciona usuario no sistema
    public function AddUsuario($dados_usuario = NULL) {
        return $this->db->insert('usuario', $dados_usuario);
    }

    //pega usuario no sistema pelo seu ID
    public function GetUsuarioById($idUsuario = NULL) {
      $this->db->select('*');
      $this->db->from('usuario');
      $this->db->where('idUsuario', $idUsuario);
      return $this->db->get()->result()[0];
    }
    public function verifica_cadastro($login, $usuario){
      $this->load->database();
      $query  = $this->db->get_where('usuario', array('nmLogin !=' => $login, 'nmUsuario' => $usuario ));
      $result = $query->result_array();
      if(count($result) > 0) {
          return TRUE;
      }
      return FALSE;
    }

    //verifica se existe usuario que já foi cadastrado através do nome
    public function verifica_cadastrado_alterar_nome($id,$nome){
      $this->load->database();
      $query  = $this->db->get_where('usuario', array('idUsuario !=' => $id, 'nmUsuario' => $nome ));
      $result = $query->result_array();
      if(count($result) > 0) {
          return TRUE;
      }
      return FALSE;
    }

    //verifica se existe usuario que já foi cadastrado através do email
    public function verifica_cadastrado_alterar_email($id,$email){
      $this->load->database();
      $query  = $this->db->get_where('usuario', array('idUsuario !=' => $id, 'email' => $email ));
      $result = $query->result_array();
      if(count($result) > 0) {
          return TRUE;
      }
      return FALSE;
    }

    //verifica se existe usuario que já foi cadastrado através do login
    public function verifica_cadastrado_alterar_login($id,$login){
      $this->load->database();
      $query  = $this->db->get_where('usuario', array('idUsuario !=' => $id, 'nmLogin' => $login ));
      $result = $query->result_array();
      if(count($result) > 0) {
          return TRUE;
      }
      return FALSE;
    }

    //atualiza dados de um usuario
    public function UpdateUsuario($idUsuario = NULL, $dados_usuario = NULL) {
      $this->db->where('idUsuario', $idUsuario);
      $this->db->update('usuario', $dados_usuario);
      return TRUE;
    }

    //cadastra assinatura do DIRETOR no sistema
    public function CadastroAssinatura($nmLogin = NULL, $assinatura = NULL) {
      $this->db->set('assinatura', $assinatura);
      $this->db->where('nmLogin', $nmLogin);
      $this->db->update('usuario');
      return TRUE;
    }

    //deleta usuario do sistema
    public function deleteUsuario($idUsuario = NULL) {
      $this->db->where('idUsuario', $idUsuario);
      $this->db->delete('usuario');
      return TRUE;
    }

}
