<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Controller dos tipos de portarias
Class Portarias extends CI_Controller {
	public function __construct() {
		parent:: __construct();
		//carrega o model que possui funções que acessam o banco de dados
		$this->load->model('Admin_portaria_model','ap');
		$this->load->helper('funcoes');
		$ci = & get_instance();
		if($ci->session->userdata('logged_in')!= TRUE) {
      $dados['titulo'] = ' Login do Sistema';
      $dados['h2']     = ' Login do Sistema';
			set_msg('<p> Acesso restrito! Faça login para continuar.</p>');
			redirect('Autenticacao');
    }
	}
	//é  a página padrão do menu tipos de portarias
	public function portarias() {
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	  );
		$dados['portarias'] = $this->ap->getAllPortaria();
		$this->load->view('portarias',$dados);
	}
	//Abre a view de cadastro de tipo de portaria
	public function Nova_Portaria() {
		$ci    = & get_instance();
		$dados = array(
			'nome'        => '',
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
			'assinatura'  => $ci->session->userdata('assinatura')
	  );
		$this->load->view('cadastro_portaria', $dados);
	}

	// Cadastra um novo tipo de portaria no banco de dados
	public function cadastrar() {
		$this->form_validation->set_rules('Nome', 'Nome', 'trim|required');
		//verifica se existe uma portaria cadastrada.
		$dados['nome']     = $this->input->post('Nome');
		       $cadastrado = $this->ap->verifica_cadastrado($this->input->post('Nome') );
		if ($this->form_validation->run() == FALSE || $cadastrado==TRUE) {
			if($cadastrado==TRUE){
				$ci    = & get_instance();
				$dados = array(
					'nmLogin'     => $ci->session->userdata('nmLogin'),
					'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
					'assinatura'  => $ci->session->userdata('assinatura')
				);
				$dados['nome']            = $this->input->post('Nome');
				$dados['message_display'] = 'Já existe portaria com este nome cadastrada! Por favor digite outro nome!!';
			}
			$this->load->view('cadastro_portaria', $dados);
		} else {
			$dados['nome'] = $this->input->post('Nome');
    	$this->ap->AddPortaria($dados);
			set_msg('Portaria cadastrada com sucesso!');
			redirect(base_url('Portarias/portarias'));
		}
	}
	//Altera dados do tipo portaria
	public function EditPortaria($idPortaria){
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	  );
    $dados['portarias'] = $this->ap->getAllPortaria();
    $dados['portarias'] = $this->ap->GetPortariaById($idPortaria);
		set_msg('Portaria editada com sucesso!');
		$this->load->view('edita_portaria_view',$dados);
	}
	//Alterar o tipo de portaria no banco de dados
	public function UpdatePortaria(){
 		$this->form_validation->set_rules('Nome', 'Nome', 'trim|required');
    $idPortaria = $this->input->post('idTipo');
    $cadastrado = $this->ap->verifica_cadastrado($this->input->post('Nome') );
		if ($this->form_validation->run() == FALSE || $cadastrado==TRUE) {
			if($cadastrado==TRUE){
				$ci    = & get_instance();
				$dados = array(
				  'nmLogin'     => $ci->session->userdata('nmLogin'),
				  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
				  'assinatura'  => $ci->session->userdata('assinatura')
			  );
				$dados['message_display'] = 'A portaria já esta cadastrada no sistema!';
			}
      $dados['portarias'] = $this->ap->GetPortariaById($idPortaria);
			set_msg('Portaria não foi atualizada. Por favor verifique as informações!');
			$this->load->view('edita_portaria_view',$dados);
		} else {
			$dados['nome'] = $this->input->post('Nome');
      $this->ap->UpdatePortaria($idPortaria, $dados);
			set_msg("Tipo de Portaria atualizado com sucesso!!!");
      redirect(base_url('Portarias/portarias'));
		}
  }
    //Deleta tipos de portaria
	public function DeletePortaria($idPortaria){
    $dados['portarias'] = $this->ap->getAllPortaria();
		$this->ap->DeletePortaria($idPortaria);
		set_msg("Tipo de portaria excluido com sucesso!!!");
    redirect(base_url('Portarias/portarias'));
	}
}
?>
