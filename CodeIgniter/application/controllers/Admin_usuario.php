<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Controller de administração de usuários
class Admin_usuario extends CI_Controller {
	public function __construct(){
    parent:: __construct();
    //Model das funcionalidades
    $this->load->model('Admin_usuario_model','aum');
    $this->load->helper('funcoes');
    $ci = & get_instance();
		if($ci->session->userdata('logged_in')!= TRUE) {
      $dados['titulo'] = ' Login do Sistema';
      $dados['h2']     = ' Login do Sistema';
			set_msg('<p> Acesso restrito! Faça login para continuar.</p>');
			redirect('Autenticacao');
    }
	}
	//carrega tela principal de manutenção de usuarios
	public function index(){
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	  );
    $dados['usuarios'] = $this->aum->getAllUsuarios();
		$this->load->view('usuario_view',$dados);
	}
	//carrega tela de cadastro de assinatura. Apenas usuários do TIPO DIRETOR realiza este cadastro
	public function listaCadastroAssinatura(){
		$ci    = & get_instance();
		$dados = array(
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
			'assinatura'  => $ci->session->userdata('assinatura')
	  );
		$this->load->view('cadastro_assinatura', $dados);
	}
	//lista Diretores
	public function listaDiretores(){
		$ci    = & get_instance();
		$dados = array(
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		);
		$dados['usuarios'] = $this->aum->getAllDiretores();
		$this->load->view('diretores_view', $dados);
	}
	//CARREGA FORMULARIO DE CADASTRO DE USUARIOS
	public function mostra_cadastro_usuario() {
		$ci    = & get_instance();
		$dados = array(
			'Login'       => '',
			'Usuario'     => '',
			'senha'       => '',
			'email'       => '',
			'nivelAcesso' => '',
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
			'assinatura'  => $ci->session->userdata('assinatura')
		);
		$this->load->view('cadastro_form',$dados);
	}
	//SETA VALOR PARA USUARIO
	public function SetUsuario(){
    $dados['usuarios'] = $this->aum->getAllUsuarios();
		$this->load->view('novo_usuario_view',$dados);
	}
	//ADICIONA NOVO USUARIO
	public function addusuario(){
		$ci = & get_instance();
 		$this->form_validation->set_rules('Login', 'Login', 'trim|required|is_unique[usuario.nmLogin]|min_length[5]');
		$this->form_validation->set_rules('Usuario', 'Usuario', 'trim|required');
		$this->form_validation->set_rules('Senha', 'Senha', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required');
		$this->form_validation->set_rules('Acesso', 'Acesso', 'trim|required');
		$this->form_validation->set_rules('Confirme_Senha', 'Confirme_Senha', 'trim|required');
		$senha  = $this->input->post('Senha');
		$cSenha = $this->input->post('Confirme_Senha');
		//verifica se existe usuario com o mesmo nome ou login
		$cadastrado = $this->aum->verifica_cadastro( $this->input->post('Login'),$this->input->post('Usuario') );
		$dados      = array(
			'Login'       => $this->input->post('Login'),
			'Usuario'     => $this->input->post('Usuario'),
			'senha'       => '',
			'email'       => $this->input->post('Email'),
			'nivelAcesso' => $this->input->post('Acesso'),
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
			'assinatura'  => $ci->session->userdata('assinatura')
		);
		if ($this->form_validation->run() == FALSE || $cadastrado == TRUE) {
			set_msg('Dados inválidos !!');
			if($cadastrado== TRUE){
				 set_msg('Nome de usuário ou login já cadastrados. Por favor verifique !!');
			}
			$this->load->view('cadastro_form',$dados);
		} else {
			if($senha == $cSenha){
				$dados = array(
					'nmLogin'     => $this->input->post('Login'),
					'nmUsuario'   => $this->input->post('Usuario'),
					'senha'       => md5($this->input->post('Senha')),
					'email'       => $this->input->post('Email'),
					'nivelAcesso' => $this->input->post('Acesso')
				);
	     	$this->aum->AddUsuario($dados);
				set_msg('Novo usuário cadastrado com sucesso!');
		    redirect(base_url('Admin_usuario/index'));
			} else {
		    set_msg('Senhas não conferem !');
				$this->load->view('cadastro_form', $dados);
			}
		}
	}
	//CHAMA VIEW DE EDIÇÃO DE USUÁRIOS
	public function EditUsuario($idUsuario){
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	  );
    $dados['usuarios'] = $this->aum->getAllUsuarios();
    $dados['usuario']  = $this->aum->GetUsuarioById($idUsuario);
		$this->load->view('edita_usuario_view',$dados);
	}
	//ATUALIZA DADOS DE UM USUARIOS
	public function UpdateUsuario(){
		$ci = & get_instance();
 		$this->form_validation->set_rules('Login', 'Login', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('Usuario', 'Usuario', 'trim|required');
		$this->form_validation->set_rules('Senha', 'Senha', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required');
		$this->form_validation->set_rules('Acesso', 'Acesso', 'trim|required');
		$this->form_validation->set_rules('Confirme_Senha', 'Confirme_Senha', 'trim|required');
           $idUsuario         = $this->input->post('IdUsuario');
           $senha             = $this->input->post('Senha');
           $cSenha            = $this->input->post('Confirme_Senha');
    $dados['message_display'] = '';
		//verifica se tem um usuario com nome, login ou email cadastrado no sistema para não deixar ter dois dados repetidos no banco
		$cadastrado = $this->aum->verifica_cadastrado_alterar_nome($this->input->post('IdUsuario'), $this->input->post('Usuario'));
		$log        = $this->aum->verifica_cadastrado_alterar_login($this->input->post('IdUsuario'), $this->input->post('Login'));
		$email      = $this->aum->verifica_cadastrado_alterar_email($this->input->post('IdUsuario'), $this->input->post('Email'));
		if ($this->form_validation->run() == FALSE || $cadastrado==TRUE|| $log ==TRUE|| $email==TRUE) {
			if($cadastrado==TRUE){
				$dados['message_display'] = 'Já existe um usuario com este nome!';
			}
			if($log==TRUE){
				$dados['message_display'] = 'Já existe este login no sistema. Escolha outro por favor!';
			}
			if($email==TRUE){
				$dados['message_display'] = 'Já existe um usuário com este email. !';
			}
		  $dados['nmLogin']     = $ci->session->userdata('nmLogin');
		  $dados['nivelAcesso'] = $ci->session->userdata('nivelAcesso');
		  $dados['assinatura']  = $ci->session->userdata('assinatura');
		  $dados['usuario']     = $this->aum->GetUsuarioById($idUsuario);
			$this->load->view('edita_usuario_view',$dados);
		} else {
			if($senha == $cSenha){
				$dados = array(
					'nmLogin'     => $this->input->post('Login'),
					'nmUsuario'   => $this->input->post('Usuario'),
					'senha'       => md5($this->input->post('Senha')),
					'email'       => $this->input->post('Email'),
					'nivelAcesso' => $this->input->post('Acesso')
				);
        $this->aum->UpdateUsuario($idUsuario, $dados);
        set_msg('<p><B>Usuário atualizado com sucesso !!!</B></p>');
        redirect(base_url('Admin_usuario/index'));
			} else {
	     		$dados['message_display'] = 'Senhas não conferem !';
	     		$dados['usuario']         = $this->aum->GetUsuarioById($idUsuario);
				  $this->load->view('edita_usuario_view',$dados);
			 }
		}
  }
    //DELETA USUARIO
	public function deleteusuario($idUsuario){
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	  );
    $dados['usuarios'] = $this->aum->getAllUsuarios();
		$this->aum->DeleteUsuario($idUsuario);
		set_msg('<b>Usuário deletado com Sucesso! </b>');
    redirect(base_url('Admin_usuario/index'));
	}
	//CADASTRA ASSINATURA PARA USUARIO DIRETOR
	public function CadastroAssinatura(){
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	  );
		$nmLogin = $this->input->post('IdUsuario');
		$this->load->library('upload');
    // definimos o path onde o arquivo será gravado
		$path = "./assets/imagens/assinaturas/";
    // verificamos se o diretório existe
    // se não existe criamos com permissão de leitura e escrita
    if ( ! is_dir($path)) {
    	mkdir($path, 0777, $recursive = true);
		}
    // definimos as configurações para o upload
    // determinamos o path para gravar o arquivo
    $configUpload['upload_path'] = $path;
    // definimos - através da extensão -
    // os tipos de arquivos suportados
    $configUpload['allowed_types'] = 'jpg|png|gif';
    $this->upload->initialize($configUpload);
		//'assinatura' => base_url() . "assets/imagens/assinaturas/" . $conteudo['file_name'],
    $conteudo = "";
      if($this->upload->do_upload('arquivo')){
        $conteudo   = $this->upload->data();
        $assinatura = base_url() . "assets/imagens/assinaturas/" . $conteudo['file_name']	;
				$this->aum->CadastroAssinatura($nmLogin, $assinatura);
				$dados['message_display'] = 'Assinatura Cadastrada com Sucesso :) ';
				$this->load->view('cadastro_assinatura', $dados);
      }else{
				$dados['message_display'] = 'Erro Inesperado :( ';
				$this->load->view('cadastro_assinatura', $dados);
      }
	}

	//chama tela para cadastrar assinatura
	public function EditAssinatura($idUsuario){
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
	  );
    $dados['usuarios'] = $this->aum->getAllDiretores();
    $dados['usuario']  = $this->aum->GetUsuarioById($idUsuario);
		$this->load->view('cadastro_assinatura_administrador', $dados);
	}

	//CADASTRA ASSINATURA PARA USUARIO DIRETOR
	public function CadastroAssinaturaAdministrador(){
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		);
		$dados['usuarios'] = $this->aum->getAllDiretores();
		       $nmLogin    = $this->input->post('IdUsuario');
		$this->load->library('upload');
    // definimos o path onde o arquivo será gravado
		$path = "./assets/imagens/assinaturas/";
    // verificamos se o diretório existe
    // se não existe criamos com permissão de leitura e escrita
    if ( ! is_dir($path)) {
    	mkdir($path, 0777, $recursive = true);
		}
    // definimos as configurações para o upload
    // determinamos o path para gravar o arquivo
    $configUpload['upload_path'] = $path;
    // definimos - através da extensão -
    // os tipos de arquivos suportados
    $configUpload['allowed_types'] = 'jpg|png|gif';
    $this->upload->initialize($configUpload);
		//'assinatura' => base_url() . "assets/imagens/assinaturas/" . $conteudo['file_name'],
    $conteudo = "";
      if($this->upload->do_upload('arquivo')){
        $conteudo   = $this->upload->data();
        $assinatura = base_url() . "assets/imagens/assinaturas/" . $conteudo['file_name']	;
				$this->aum->CadastroAssinatura($nmLogin, $assinatura);
				set_msg('<b>Assinatura de Diretor atualizada com sucesso!!!</b>');
				$this->load->view('diretores_view', $dados);
      }else{
				set_msg('<b>Erro inesperado :(!!!</b>');
				$this->load->view('diretores_view', $dados);
      }
	}

}
