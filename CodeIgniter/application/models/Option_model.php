<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option_model extends CI_Model{
	function __construct(){
		parent:: __construct();
	}
	public function get_option($data){
		$condition = "nmLogin =" . "'" . $data['login'] . "' AND " . "senha =" . "'" . $data['senha'] . "'";
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function update_option($option_name , $option_value){
		$this->db->where('option_name',$option_name);
		$query = $this->db->get('options',1);
		if($query->num_rows() == 1): 
			// a opção ja existe e devo atualizar;
			$this->db->set('option_value', $option_value); //vou setar as informações que vieram do formulario através do controller
			$this->db->where('option_name',$option_name);//Caso o dado ja esteja inserido na tabela com o mesmo nome, vai retornar nenhuma linha afetada, sem fazer o update;
			$this->db->update('options');// na tabela options no banco de dados.
			return $this->db->affected_rows(); //irá retornar em quantas linhas foram alterado o valor dos dados.
			//se nenhum dados for alterado ele vai entrar ai e retornar 0;
		else: 
			//opção não existe; Devo inserir.
			//Faço um array com o nome de cada coluna da minha tabela 'options' e adiciono o valor
			$dados = array(
				'option_name'  => $option_name,
				'option_value' => $option_value
				);
			//inserir informações no banco de dados
			$this->db->insert('options',$dados);
			return $this->db->insert_id(); //retorna o id da informações que foi adicionada .
		endif;
	}

	public function ler_usuario_informacao($nmLogin) {
		$condition = "login =" . "'" . $nmLogin . "'";
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
}
