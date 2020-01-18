<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Servidores extends CI_Controller {
	public function __construct() {
		parent:: __construct();
		//carrega o model que possui funções que acessam o banco de dados
		$this->load->model('Admin_servidores_model','ap');
		$this->load->helper('funcoes');
		$ci = & get_instance();
		if($ci->session->userdata('logged_in')!= TRUE) {
      $dados['titulo'] = ' Login do Sistema';
      $dados['h2']     = ' Login do Sistema';
			set_msg('<p> Acesso restrito! Faça login para continuar.</p>');
			redirect('Autenticacao');
    }
	}
	//é  a página padrão do menu servidores
	public function listar() {
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	  );
		$dados['servidores'] = $this->ap->getAllservidor();
		$this->load->view('servidores',$dados);
	}

	//Abre a view de cadastro de servidor
	public function Novo_servidor() {
		$ci    = & get_instance();
		$dados = array(
			'nome'        => '',
			'siape'       => '',
			'cargo'       => '',
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
			'assinatura'  => $ci->session->userdata('assinatura'),
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
			'assinatura'  => $ci->session->userdata('assinatura')
		);
		$this->load->view('cadastro_servidor',$dados);
	}
	// Cadastra uma nova servidor no banco de dados
	public function cadastrar() {
		$ci = & get_instance();
		$this->form_validation->set_rules('nome', 'nome', 'trim|required|is_unique[tipo.nome]');
		$this->form_validation->set_rules('siape', 'siape', 'trim|required');
		$this->form_validation->set_rules('cargo', 'cargo', 'trim|required');
		$dados = array(
			'nome'        => $this->input->post('nome'),
			'siape'       => $this->input->post('siape'),
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
			'assinatura'  => $ci->session->userdata('assinatura')
		);
		$nome  = $this->ap->verifica_cadastrado_nome($this->input->post('nome'));
		$siape = $this->ap->verifica_cadastrado_siape( $this->input->post('siape'));
		$cargo = $this->input->post('cargo');
		if ($this->form_validation->run() == FALSE|| $nome==TRUE ||$siape ==TRUE) {
				if($nome ==TRUE){
					$dados['message_display'] = 'Já existe um servidor com este Nome!';
				}
				if($siape==TRUE){
						$dados['message_display'] = 'Já existe um servidor com este SIAPE!';
				}
				$this->load->view('cadastro_servidor',$dados);
		} else {
				$dados = array(
					'nome'  => $this->input->post('nome'),
					'siape' => $this->input->post('siape'),
					'cargo' => $this->input->post('cargo'),
				);
    	$this->ap->Addservidor($dados);
			set_msg('Servidor cadastrado com sucesso!');
  		redirect(base_url('Servidores/listar'));
		}
	}
	//Altera dados da servidor
	public function Editservidor($idservidor){
		       $ci            = & get_instance();
		$dados['nmLogin']     = $ci->session->userdata('nmLogin');
		$dados['nivelAcesso'] = $ci->session->userdata('nivelAcesso');
		$dados['assinatura']  = $ci->session->userdata('assinatura');
		$dados['servidores']  = $this->ap->getAllservidor();
		$dados['servidores']  = $this->ap->GetservidorById($idservidor);
		$this->load->view('edita_servidor_view',$dados);
	}
	//Alterar a servidor no banco de dados
	public function Updateservidor(){
 		$this->form_validation->set_rules('nome', 'nome', 'trim|required');
		 $this->form_validation->set_rules('siape', 'siape', 'trim|required');
		 $this->form_validation->set_rules('cargo', 'cargo', 'trim|required');
 		$idservidor = $this->input->post('id');
 		$dados      = array(
			'id'    => $this->input->post('id'),
			'nome'  => $this->input->post('nome'),
			'siape' => $this->input->post('siape'),
			'cargo' => $this->input->post('cargo')
		);
		$nome  = $this->ap->verifica_cadastrado_nome($this->input->post('nome'));
		$siape = $this->ap->verifica_cadastrado_siape( $this->input->post('siape'));
		if ($this->form_validation->run() == FALSE|| $nome > 1 ||$siape > 1) {
			       $ci            = & get_instance();
			$dados['nmLogin']     = $ci->session->userdata('nmLogin');
			$dados['nivelAcesso'] = $ci->session->userdata('nivelAcesso');
			$dados['assinatura']  = $ci->session->userdata('assinatura');
			if($nome  > 1){
				set_msg('Já existe um servidor com este Nome!');
				//var_dump('1');
			}
			if($siape > 1){
				set_msg('Já existe um servidor com este SIAPE!');
				//	var_dump('2');
			}
			$dados['servidores'] = $this->ap->getAllservidor();
			$dados['servidores'] = $this->ap->GetservidorById($idservidor);
			$this->load->view('edita_servidor_view',$dados);
		} else {
		  $this->ap->Updateservidor($idservidor, $dados);
			set_msg('Dados do servidor atualizados com sucesso!');
		  redirect(base_url('Servidores/listar'));
		}
  }
    //Deleta tipos de servidor
	public function Deleteservidor($idservidor){
    $dados['servidores'] = $this->ap->getAllservidor();
		$this->ap->Deleteservidor($idservidor);
		set_msg('Servidor excluído com sucesso!');
    redirect(base_url('Servidores/listar'));
	}
}

?>
