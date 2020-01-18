<?php

Class Autenticacao extends CI_Controller {
	public function __construct() {
		parent:: __construct();
		$this->load->helper('funcoes','func');
		$this->load->model('Option_model','option');
	}

	public function index() {
		if($this->session->userdata('logged_in')) {
    	redirect('Docportaria/listarHome');
    }else {
		  $this->load->view('login_form');
    }
	}

	public function login() {
		$this->form_validation->set_rules('login','NOME','trim|required');
		$this->form_validation->set_rules('senha','SENHA','trim|required');
		if($this->form_validation->run() == FALSE){
				set_msg('<p> Usuário ou senha incorretos!!</p>');
				$dados['titulo'] = 'Login do Sistema';
				$dados['h2']     = 'Login do Sistema';
				$this->load->view('login_form',$dados);
		} else {
			$dados = array(
				'login' => $this->input->post('login'),
				'senha' => md5($this->input->post('senha'))
			);
			$result = $this->option->get_option($dados);
			if ($result == TRUE) {
				$newdata=array(
					'logged_in'   => TRUE,
					'nmLogin'     => $result[0]->nmLogin,
					'nmUsuario'   => $result[0]->nmUsuario,
					'nivelAcesso' => $result[0]->nivelAcesso,
					'assinatura'  => $result[0]->assinatura
        );
	    	$this->session->set_userdata($newdata);
				redirect('Docportaria/listarHome');
			} else {
				set_msg('<p> Usuário ou senha incorretos!!</p>');
				$dados['titulo'] = ' Login do Sistema';
				$dados['h2']     = ' Login do Sistema';
				$this->load->view('login_form',$dados);
			}
		}
	}

	public function logout() {
    $this->session->sess_destroy();
    set_msg('<p> Logout com sucesso!!</p>');
		$dados['titulo'] = ' Login do Sistema';
		$dados['h2']     = ' Login do Sistema';
		redirect('Autenticacao/index',$dados);
	}

	public function alterar(){
		//verificar o login do usuário
		verifica_login();
		//verifica   validação
		$this->form_validation->set_rules('login','NOME','trim|required|min_length[5]');
		$this->form_validation->set_rules('email','EMAIL','trim|required|valid_email');
		$this->form_validation->set_rules('senha','SENHA','trim|min_length[6]');
		$this->form_validation->set_rules('nome_site','Nome do Site','trim|required');
		if(isset($_POST['senha']) && $_POST['senha'] != ''): 
			$this->form_validation->set_rules('senha2','Repita a senha' ,'trim|required|min_length[6]|matches[senha]');
		endif;
		if($this->form_validation->run() == FALSE): 
		if(validation_errors())                   : 
				set_msg(validation_errors());
			endif;
		else: 
			$dados_form = $this->input->post();
			$this->option->update_option('user_login',$dados_form['login']); //método criado , chamar o nome do campo login / e o valor do formulario -> update_option é uma função criada dentro de Option_model
			$this->option->update_option('user_email',$dados_form['email']);
			$this->option->update_option('nome_site',$dados_form['nome_site']);
			if(isset($_POST['senha']) && $_POST['senha'] != ''): 
				$this->option->update_option('user_pass',password_hash($dados_form['senha'], PASSWORD_DEFAULT));
			endif;
			set_msg("dados alterados com Sucesso !!!");
		endif;
		//carrega view
		$_POST['login']     = $this->option->get_option('user_login');  //dados que foram cadastrados no banco de dados
		$_POST['email']     = $this->option->get_option('user_email');
		$_POST['nome_site'] = $this->option->get_option('nome_site');
		$dados['titulo']    = 'Configuração do sistema';
		$dados['h2']        = ' Alterar configuração básica';
		$this->load->view('painel/config',$dados);
	}
}
