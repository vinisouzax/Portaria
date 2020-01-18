<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//controller para controlar funçoes relacionadas aos documentos das portarias
class Docportaria extends CI_Controller {
	public function __construct(){
    parent:: __construct();
		$this->load->model('Admin_servidores_model','op');
		$this->load->model('Admin_usuario_model','au');
    $this->load->model('Admin_docportaria_model','ap');
    $this->load->helper('funcoes');
    $ci = & get_instance();
		if($ci->session->userdata('logged_in')!= TRUE) {
        $dados['titulo'] = ' Login do Sistema';
        $dados['h2']     = ' Login do Sistema';
				set_msg('<p> Acesso restrito! Faça login para continuar.</p>');
				redirect('Autenticacao');
    }
	}

	//lista todas as portarias com status Cadastrada e Retornada e Espera
	public function listar() {
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	  );
		$dados['portarias'] = $this->ap->getAllportariasCadastradas();
		$dados['usuarios']  = $this->au->getAllDiretores();
	  $this->load->view('docportaria',$dados);
	}
	//lista todas as portarias
	public function listarTudo() {
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	    );
	   $dados['portarias'] = $this->ap->getAllportarias();
	   $this->load->view('consulta_docportaria',$dados);
	}
	//lista todas as portarias com status Publicada, Aprovada, Espera e Retornada
	public function listarHome() {
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	   );
	   $dados['portarias'] = $this->ap->getAllportariasPublicadasAprovadasEspera();
		 $this->load->view('home',$dados);
	}
	//função que busca todas as portarias através do filtro
	public function buscarHome() {
		$ci    = & get_instance();
		$dados = array(
		  'nmLogin'     => $ci->session->userdata('nmLogin'),
		  'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
		  'assinatura'  => $ci->session->userdata('assinatura')
	   );
	   $dados['portarias'] = $this->ap->busca_docportaria_like();
	   $this->load->view('home',$dados);
	}

	//função que pega servidores e tipos de portarias para que possa carregar os combo box da pagina de cadastro
	public function Nova_portaria() {
		$ci    = & get_instance();
		$dados = array(
			'numero'      => NULL,
			'texto'       => '',
			'dataInicio'  => '',
			'dataTermino' => '',
			'nmLogin'     => $ci->session->userdata('nmLogin'),
			'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
			'assinatura'  => $ci->session->userdata('assinatura')
		);
		$dados['servidores'] = $this->op->getAllservidor();
		$dados['tipos']      = $this->ap->getTipos();
		$this->load->view('cadastro_docportaria',$dados);
	}

	// Cadastra uma nova portaria
	public function cadastrar() {
		$ci = & get_instance();
		//$this->form_validation->set_rules('numero', 'numero', 'trim|required');
		$this->form_validation->set_rules('editor1', 'editor1', 'trim|required');
		$this->form_validation->set_rules('dtInicio', 'dtInicio', 'trim|required');
		$this->form_validation->set_rules('idTipo', 'idTipo', 'trim|required');
		$dataInicio  = implode('-',array_reverse( explode('/', $this->input->post('dtInicio'))));
		$dataTermino = implode('-',array_reverse( explode('/', $this->input->post('dtTermino'))));
		//verifica se o numero da portaria já está no sistema
		//$cadastrado=$this->ap->verifica_cadastrado('portaria',$this->input->post('numero'));
		//verifica se o fumulário falhou ou se a data de inicio de portaria é menor que a de termino
		if ($this->form_validation->run() == FALSE) {
			$dados= array(
				'texto'       => $this->input->post('editor1'),
				'dataInicio'  => $dataInicio,
				'dataTermino' => $dataTermino,
				'idTipo'      => $this->input->post('idTipo'),
				'nmLogin'     => $ci->session->userdata('nmLogin'),
				'nivelAcesso' => $ci->session->userdata('nivelAcesso'),
				'assinatura'  => $ci->session->userdata('assinatura')
		 );
			$dados['servidores'] = $this->op->getAllservidor();
			$dados['tipos']      = $this->ap->getTipos();
			
			$this->load->view('cadastro_docportaria', $dados);
		} else if ($dataInicio > $dataTermino){
			$data  = "17-01-2038";
			$data  = date('d/m/Y', strtotime("+2 days",strtotime($data)));
			$data  = implode('-',array_reverse( explode('/', $data)));
			$dados = array(
				'texto'       => $this->input->post('editor1'),
				'dataInicio'  => $dataInicio,
				'dataTermino' => $data,
				'idTipo'      => $this->input->post('idTipo'),
				'status'      => 'Cadastrada'
			);
    	$this->ap->Addportaria($dados);
			set_msg('<center><b>Portaria cadastrada com sucesso!!!</b></center>');
  		redirect(base_url('Docportaria/listar'));
		} else {
			$dados = array(
				'texto'       => $this->input->post('editor1'),
				'dataInicio'  => $dataInicio,
				'dataTermino' => $dataTermino,
				'idTipo'      => $this->input->post('idTipo'),
				'status'      => 'Cadastrada'
			);
    	$this->ap->Addportaria($dados);
			set_msg('<center><b>Portaria cadastrada com sucesso!!!</b></center>');
  		redirect(base_url('Docportaria/listar'));
		}
	}
	//As funções abaixo são para usuarios distintos
	//Altera dados da portaria de uma visão do adminstrador, view carregada é a edita_docportaria_view
	public function EditDocPortaria($idportaria){
		       $ci            = & get_instance();
		$dados['nmLogin']     = $ci->session->userdata('nmLogin');
		$dados['nivelAcesso'] = $ci->session->userdata('nivelAcesso');
		$dados['assinatura']  = $ci->session->userdata('assinatura');
		$dados['portarias']   = $this->ap->getAllportarias();
		$dados['tipos']       = $this->ap->getTipos();
		$dados['servidores']  = $this->op->getAllservidor();
		$dados['portarias']   = $this->ap->GetPortariaById($idportaria);
		$this->load->view('edita_docportaria_view',$dados);
	}
	//altera dados da portaria de uma visão do diretor, view carregada é a edita_docportaria_diretor_view
	public function EditDocPortariaDiretor($idportaria){
		       $ci            = & get_instance();
		$dados['nmLogin']     = $ci->session->userdata('nmLogin');
		$dados['nivelAcesso'] = $ci->session->userdata('nivelAcesso');
		$dados['assinatura']  = $ci->session->userdata('assinatura');
		$dados['portarias']   = $this->ap->getAllportarias();
		$dados['tipos']       = $this->ap->getTipos();
		$dados['servidores']  = $this->op->getAllservidor();
		$dados['portarias']   = $this->ap->GetPortariaById($idportaria);
		$this->load->view('edita_docportaria_diretor_view',$dados);
	}
	//Altera a portaria de uma visao do administrador
	public function UpdateDocPortaria(){
		       $ci            = & get_instance();
		$dados['nmLogin']     = $ci->session->userdata('nmLogin');
		$dados['nivelAcesso'] = $ci->session->userdata('nivelAcesso');
		$dados['assinatura']  = $ci->session->userdata('assinatura');
 		//$this->form_validation->set_rules('numero', 'numero', 'trim|required');
		$this->form_validation->set_rules('editor1', 'editor1', 'trim|required');
		$this->form_validation->set_rules('dtInicio', 'dtInicio', 'trim|required');
		$this->form_validation->set_rules('idTipo', 'idTipo', 'trim|required');
		//$cadastrado=$this->ap->verifica_cadastrado('portaria',$this->input->post('numero'));
		$dataInicio    = implode('-',array_reverse(explode('/',$this->input->post('dtInicio'))));
		$dataTermino   = implode('-',array_reverse( explode('/', $this->input->post('dtTermino'))));
		$idDocPortaria = $this->input->post('idPortaria');
 		//	var_dump($idDocPortaria);
		if ($this->form_validation->run() == FALSE ||  $this->input->post('idTipo') == 0) {
			//Caso de alguma falha, então aparece está mensagem, set_msg está da funcoes_helper
			set_msg('<p><B>Existe informações com inconsistentes, por favor verifique !!!!</B></p>');
			//data termino menor que data de inicio de portaria, então aparece está mensagem, set_msg está da funcoes_helper
				$dados= array(
					'texto'       => $this->input->post('editor1'),
					'dataInicio'  => $dataInicio,
					'dataTermino' => $dataTermino,
					'idTipo'      => $this->input->post('idTipo')
				);
	    $dados['portarias'] = $this->ap->getAllportarias();
	    $dados['tipos']     = $this->ap->getTipos();
	    $dados['portarias'] = $this->ap->GetPortariaById($idDocPortaria);
			set_msg('<b>A portaria não foi atualizada, por favor verifique as informações!!</b>');
			$this->load->view('edita_docportaria_view',$dados);
		} else if ($dataInicio > $dataTermino){
			$data  = "17-01-2038";
			$data  = date('d/m/Y', strtotime("+2 days",strtotime($data)));
			$data  = implode('-',array_reverse( explode('/', $data)));
			$dados = array(
				'texto'       => $this->input->post('editor1'),
				'dataInicio'  => $dataInicio,
				'dataTermino' => $data,
				'idTipo'      => $this->input->post('idTipo'),
			);
    	$portaria = $this->ap->GetPortariaById($idDocPortaria);
			$this->ap->UpdateDocPortaria($idDocPortaria, $dados);
			set_msg('<b>Portaria atualizada com sucesso!!!</b>');
    	redirect(base_url('Docportaria/listar'));
		} else {
			$dados = array(
				'texto'       => $this->input->post('editor1'),
				'dataInicio'  => $dataInicio,
				'dataTermino' => $dataTermino,
				'idTipo'      => $this->input->post('idTipo'),
			);
    	$portaria = $this->ap->GetPortariaById($idDocPortaria);
			$this->ap->UpdateDocPortaria($idDocPortaria, $dados);
			set_msg('<b>Portaria atualizada com sucesso!!!</b>');
    	redirect(base_url('Docportaria/listar'));
	  }
	}

	//altera a portaria de um visao do diretor, campo a mais 'status'
	public function UpdateDocPortariaDiretor(){
		       $ci            = & get_instance();
		$dados['nmLogin']     = $ci->session->userdata('nmLogin');
		$dados['nivelAcesso'] = $ci->session->userdata('nivelAcesso');
		$dados['assinatura']  = $ci->session->userdata('assinatura');
 		//$this->form_validation->set_rules('numero', 'numero', 'trim|required|xss_clean');
		$this->form_validation->set_rules('editor1', 'editor1', 'trim|required');
		$this->form_validation->set_rules('dtInicio', 'dtInicio', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		$this->form_validation->set_rules('idTipo', 'idTipo', 'trim|required');
		$dataInicio    = implode('-',array_reverse(explode('/',$this->input->post('dtInicio'))));
		$dataTermino   = implode('-',array_reverse(explode('/',$this->input->post('dtTermino'))));
		$idDocPortaria = $this->input->post('idPortaria');
		if ($this->form_validation->run() == FALSE ||  $this->input->post('idTipo') == 0) {
			set_msg('<p><B> Está faltando preencher alguns campos , ou os dados não conferem, por favor verifique!</B></p>');
			$dados['portarias'] = $this->ap->getAllportarias();
			$dados['tipos']     = $this->ap->getTipos();
			$dados['portarias'] = $this->ap->GetPortariaById($idDocPortaria);
			set_msg('<b>A portaria não foi atualizada, por favor verifique as informações!!</b>');
			$this->load->view('edita_docportaria_diretor_view',$dados);
		} else {
			//pega texto do editor
			$texto = $this->input->post('editor1');
			//caminho do pdf que será guardado em uma variavel da tabela portaria
			$pathBD = "";
			//status da portaria sera usada para verificacao, numero e data de inicio serão usadas para o nome da portaria
			$status = $this->input->post('status');
			$numero = $this->input->post('numero');
			//Apenas se portaria for aprovada é que será gerado um pdf que sera salvo em uma pasta de uploads dentro do sistema e seu caminho sera guardado dentro do banco de dados para download. Se a portaria for retornada não gera pdf e nem caminho, o caminho fica nulo
			if($status == 'Aprovada'){
	    		/*$path = "./uploads/";
				if ( ! is_dir($path)) {
	        		mkdir($path, 0777, $recursive = true);
	    		}*/
				//obtem ultima portaria do ano
				$p = $this->ap->obtemNumero();
				//trata numero para documento
				     $n                      = $this->ap->tratamentoNumero($p->numero+1);
				     $data                   = explode("/", $this->input->post('dtInicio'));
				list($dia, $mesNumero, $ano) = $data;
				//retorna o nome do mês
				$mes        = $this->ap->obtemMes($mesNumero);
				$assinatura = $ci->session->userdata('assinatura');
				//nome do arquivo
				//$pdfFilePath = "./uploads/".$n."_".date("dmY",strtotime($dataAtual)).".pdf";
				//carrega biblioteca
				$this->load->library('mytcpdf');
				//importa as funcionalidade da bilioteca TCPDF
				$this->mytcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$this->mytcpdf->SetPrintHeader(false);
				$this->mytcpdf->SetPrintFooter(false);
				$this->mytcpdf->SetMargins(18, 18, 18, true);
				// set some language-dependent strings (optional)
				if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
					require_once(dirname(__FILE__).'/lang/eng.php');
					$this->mytcpdf->setLanguageArray($l);
				}
				//adiciona esse setFont, se não da erro na página
				$this->mytcpdf->SetFont('dejavusans', '', 10);
				//adiciona página
				$this->mytcpdf->AddPage();
				$textoComAssinatura = '<p align="center" style="font-style: Times New Roman; font-style: 12;"><strong>PORTARIA Nº '.$n.', DE '.$dia.' DE '.$mes.' DE '.$ano.' </strong></p><p></p><p></p><br/><br/>'.$texto.'<p></p><p></p><br/><br/><p align= "center"><img   src="'. $assinatura .'" width="255" height="117"  alt=""></p> ';
				//$html = '<img src="'. base_url('assets/imagens/logoGoverno.png') .'"width="710" height="220"><p align="center" style="font-family: Times New Roman; font-size: 12;"><strong>PORTARIA Nº '.$n.', DE '.$dia.' DE '.$mes.' DE '.$ano.' </strong></p><p></p><p></p><br/><br/>'.$texto.'<p></p><p></p><br/><br/><p align= "center"><img   src="'. $assinatura .'" width="255" height="117"  alt=""></p>';
				//escreve pdf
				//$this->mytcpdf->writeHTML($html, true, false, true, false, '');
				//ob_clean();
				//Saída do pdf
				//$this->mytcpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/CodeIgniter/uploads/output.pdf', 'F');
				$pathBD = base_url()."uploads/".$n."_".date("dmY", strtotime($dataInicio)).".pdf";
				$dados  = array(
					'numero'      => $n,
					'texto'       => $textoComAssinatura,
					'dataInicio'  => $dataInicio,
					'dataTermino' => $dataTermino,
					'arquivo'     => $pathBD,
					'idTipo'      => $this->input->post('idTipo'),
					'status'      => $status                        //campo a mais do que a função de cima
				);
			}else{
				$dados = array(
					'texto'       => $texto,
					'dataInicio'  => $dataInicio,
					'dataTermino' => $dataTermino,
					'arquivo'     => $pathBD,
					'idTipo'      => $this->input->post('idTipo'),
					'status'      => $status                        //campo a mais do que a função de cima
				);
     		}
			$portaria = $this->ap->GetPortariaById($idDocPortaria);
			$this->ap->UpdateDocPortaria($idDocPortaria, $dados);
			set_msg('Portaria atualizada com sucesso!');
			redirect(base_url('Docportaria/listarHome'));
		}
	}
		//apaga portaria
  public function deleteportaria($idPortaria){
		$portaria = $this->ap->GetPortariaById($idPortaria);
		if($this->ap->DeletePortaria($idPortaria)){
			set_msg('Portaria deletada com sucesso!');
			redirect('Docportaria/listar' , ' refresh');
		}
		set_msg('Houve um erro ao deletar a portaria!');
		redirect(base_url('Docportaria/listar'));
	}
	//muda status da portaria para arquivada
  public function StatusArquivada($idPortaria){
		if($this->ap->StatusArquivada($idPortaria)){
			redirect('Docportaria/listarHome' , ' refresh');
		}
		redirect(base_url('Docportaria/listarHome'));
	}
	//muda status da portaria para publicada
  public function StatusPublicada($idPortaria){
		if($this->ap->StatusPublicada($idPortaria)){
			redirect('Docportaria/listarHome' , ' refresh');
		}
		redirect(base_url('Docportaria/listarHome'));
	}
	//muda status da portaria para aprovada
  public function StatusAprovada($idPortaria){
	  $ci         = & get_instance();
	  $assinatura = $ci->session->userdata('assinatura');
	  $portaria   = $this->ap->GetPortariaById($idPortaria);
	  $path       = "./uploads/";
		if ( ! is_dir($path)) {
      mkdir($path, 0777, $recursive = true);
    }
		//obtem ultima portaria do ano
		$p = $this->ap->obtemNumero();
		//trata numero para documento
		     $n                           = $this->ap->tratamentoNumero($p->numero+1);
		     $data                        = explode("-", $portaria->dataInicio);
		list($ano, $mesNumero, $diaEhora) = $data;
		     $dia                         = $diaEhora[0].$diaEhora[1];
		//retorna o nome do mês
		$mes = $this->ap->obtemMes($mesNumero);
		//nome do arquivo
		//$pdfFilePath = base_url()."uploads/".$n."_".date("dmY",strtotime($dataAtual)).".pdf";
		//carrega biblioteca
		$this->load->library('mytcpdf');
		//importa as funcionalidade da bilioteca TCPDF
		$this->mytcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->mytcpdf->SetPrintHeader(false);
		$this->mytcpdf->SetPrintFooter(false);
		$this->mytcpdf->SetMargins(18, 18, 18, true);
		//adiciona esse setFont, se não da erro na página
		$this->mytcpdf->SetFont('dejavusans', '', 10);
		//adiciona página
		$this->mytcpdf->AddPage();
		//html que cont´tem o texto que será gerado
		$texto = '<p align="center" style="font-family: Times New Roman; font-size: 12;"><strong>PORTARIA Nº '.$n.', DE '.$dia.' DE '.$mes.' DE '.$ano.' </strong></p><p></p><p></p><br/><br/>'.$portaria->texto.'<p></p><p></p><br/><br/><p align= "center"><img   src="'. $assinatura .'" width="255" height="117"  alt=""></p> ';
		//$html = '<img src="'. base_url('assets/imagens/logoGoverno.png') .'"width="710" height="220"><p align="center" style="font-family: Times New Roman; font-size: 12;"><strong>PORTARIA Nº '.$n.', DE '.$dia.' DE '.$mes.' DE '.$ano.' </strong></p><p></p><p></p><br/><br/>'.$portaria->texto.'<p></p><p></p><br/><br/><p align= "center"><img   src="'. $assinatura .'" width="255" height="117"  alt=""></p>';
		//$this->mytcpdf->writeHTML($html, true, false, true, false, '');
		//ob_clean();
		//Saída do pdf
		//para funcionar no windows
		//$this->mytcpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/CodeIgniter/uploads/output.pdf', 'F');
		//$dataAtual = implode('-',array_reverse( explode('/', $dataAtual)));
		$pathBD = base_url()."uploads/".$n."_".date("dmY", strtotime($portaria->dataInicio)).".pdf";
		if($this->ap->StatusAprovada($idPortaria, $path, $texto, $p->numero+1)){
			redirect('Docportaria/listarHome' , 'refresh');
		}
		redirect(base_url('Docportaria/listarHome'));
	}

	//muda status da portaria para aprovada
  public function StatusAprovada2(){
		$this->form_validation->set_rules('idPortaria', 'idPortaria', 'trim|required');
		$assinatura = $this->input->post('diretor');
		$portaria   = $this->ap->GetPortariaById($this->input->post('idPortaria'));
		$path       = "./uploads/";
		if ( ! is_dir($path)) {
      mkdir($path, 0777, $recursive = true);
    }
		//obtem ultima portaria do ano
		$p = $this->ap->obtemNumero();
		//trata numero para documento
		     $n                           = $this->ap->tratamentoNumero($p->numero+1);
		     $data                        = explode("-", $portaria->dataInicio);
		list($ano, $mesNumero, $diaEhora) = $data;
		     $dia                         = $diaEhora[0].$diaEhora[1];
		//retorna o nome do mês
		$mes = $this->ap->obtemMes($mesNumero);
		//nome do arquivo
		//$pdfFilePath = base_url()."uploads/".$n."_".date("dmY",strtotime($dataAtual)).".pdf";
		//carrega biblioteca
		$this->load->library('mytcpdf');
		//importa as funcionalidade da bilioteca TCPDF
		$this->mytcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->mytcpdf->SetPrintHeader(false);
		$this->mytcpdf->SetPrintFooter(false);
		$this->mytcpdf->SetMargins(18, 18, 18, true);
		//adiciona esse setFont, se não da erro na página
		$this->mytcpdf->SetFont('dejavusans', '', 10);
		//adiciona página
		$this->mytcpdf->AddPage();
		//html que cont´tem o texto que será gerado
		$texto = '<p align="center" style="font-family: Times New Roman; font-size: 12;"><strong>PORTARIA Nº '.$n.', DE '.$dia.' DE '.$mes.' DE '.$ano.' </strong></p><p></p><p></p><br/><br/>'.$portaria->texto.'<p></p><p></p><br/><br/><p align= "center"><img   src="'. $assinatura .'" width="255" height="117"  alt=""></p> ';
		//$html = '<img src="'. base_url('assets/imagens/logoGoverno.png') .'"width="710" height="220"><p align="center" style="font-family: Times New Roman; font-size: 12;"><strong>PORTARIA Nº '.$n.', DE '.$dia.' DE '.$mes.' DE '.$ano.' </strong></p><p></p><p></p><br/><br/>'.$portaria->texto.'<p></p><p></p><br/><br/><p align= "center"><img   src="'. $assinatura .'" width="255" height="117"  alt=""></p>';
		//$this->mytcpdf->writeHTML($html, true, false, true, false, '');
		//ob_clean();
		//Saída do pdf
		//para funcionar no windows
		//$this->mytcpdf->Output($_SERVER['DOCUMENT_ROOT'] . '/CodeIgniter/uploads/output.pdf', 'F');
		//$dataAtual = implode('-',array_reverse( explode('/', $dataAtual)));
		$pathBD = base_url()."uploads/".$n."_".date("dmY", strtotime($portaria->dataInicio)).".pdf";
		if($this->ap->StatusAprovada($portaria->idPortaria, $path, $texto, $p->numero+1)){
			redirect('Docportaria/listarHome' , 'refresh');
		}
		redirect(base_url('Docportaria/listar'));
	}


	//muda status da portaria para espera
  public function StatusEspera($idPortaria){
		if($this->ap->StatusEspera($idPortaria)){
			redirect('Docportaria/listarHome' , ' refresh');
		}
		redirect(base_url('Docportaria/listar'));
	}

	//muda status da portaria para retornada
  public function StatusRetorna($idPortaria){
		if($this->ap->StatusRetorna($idPortaria)){
			set_msg('<p> Portaria retornada com sucesso!! </p>');
			redirect('Docportaria/listarHome' , ' refresh');
		}
		redirect(base_url('Docportaria/listarHome'));
	}

	public function generatePDFHome($idPortaria){
		$portaria = $this->ap->GetPortariaById($idPortaria);
		//nome do arquivo
		$pdfFilePath = $portaria->numero."_".date("dmY",strtotime($portaria->dataInicio)).".pdf";
		//carrega biblioteca
		$this->load->library('mytcpdf');
		//importa as funcionalidade da bilioteca TCPDF
		$this->mytcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->mytcpdf->SetPrintHeader(false);
		$this->mytcpdf->SetPrintFooter(false);
		$this->mytcpdf->SetMargins(18, 18, 18, true);
		if($portaria->status == 'Espera' || $portaria->status == 'Retornada' || $portaria->status == 'Cadastrada'){
	// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$this->mytcpdf->setLanguageArray($l);
			}
			//adiciona esse setFont, se não da erro na página
			$this->mytcpdf->SetFont('dejavusans', '', 10);
			//adiciona página
			$this->mytcpdf->AddPage();
			//html que cont´tem o texto que será gerado
			$html = '<html><head></head><body><img src="'. base_url('assets/imagens/logoGoverno.png') . '" width="710" height="220"><p align="center" style="font-family: Times New Roman; font-size: 12;"><strong>PORTARIA Nº XXX, DE XX DE X DE XXXX</strong></p><p></p><p></p>'.$portaria->texto.'<p></p><p></p></body></html>';
			//gera o pdf apartir do html
			$this->mytcpdf->writeHTML($html, true, false, true, false, '');
			//Saída do pdf
			$this->mytcpdf->Output($pdfFilePath,'D');
		}else{
				// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$this->mytcpdf->setLanguageArray($l);
			}
			//adiciona esse setFont, se não da erro na página
			$this->mytcpdf->SetFont('dejavusans', '', 10);
			//adiciona página
			$this->mytcpdf->AddPage();
			//html que cont´tem o texto que será gerado
			$html = '<html><head></head><body><img src="'. base_url('assets/imagens/logoGoverno.png') .'"width="710" height="220">'.$portaria->texto.'</body></html>';
			//gera o pdf apartir do html
			//var_dump($portaria->texto);
			$this->mytcpdf->writeHTML($html, true, false, true, false, '');
			//Saída do pdf
			$this->mytcpdf->Output($pdfFilePath,'D');
		}
		redirect(base_url('Docportaria/listarHome'));
	}

	public function generatePDFConsulta($idPortaria){
		$portaria = $this->ap->GetPortariaById($idPortaria);
		//nome do arquivo
		$pdfFilePath = $portaria->numero."_".date("dmY",strtotime($portaria->dataInicio)).".pdf";
		//carrega biblioteca
		$this->load->library('mytcpdf');
		//importa as funcionalidade da bilioteca TCPDF
		$this->mytcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->mytcpdf->SetPrintHeader(false);
		$this->mytcpdf->SetPrintFooter(false);
		$this->mytcpdf->SetMargins(18, 18, 18, true);
		if($portaria->status == 'Espera' || $portaria->status == 'Retornada' || $portaria->status == 'Cadastrada'){
	// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$this->mytcpdf->setLanguageArray($l);
			}
			//adiciona esse setFont, se não da erro na página
			$this->mytcpdf->SetFont('dejavusans', '', 10);
			//adiciona página
			$this->mytcpdf->AddPage();
			//html que cont´tem o texto que será gerado
			$html = '<html><head></head><body><img src="'. base_url('assets/imagens/logoGoverno.png') . '" width="710" height="220"><p align="center" style="font-family: Times New Roman; font-size: 12;"><strong>PORTARIA Nº XXX, DE XX DE X DE XXXX</strong></p><p></p><p></p>'.$portaria->texto.'<p></p><p></p></body></html>';
			//gera o pdf apartir do html
			$this->mytcpdf->writeHTML($html, true, false, true, false, '');
			//Saída do pdf
			$this->mytcpdf->Output($pdfFilePath,'D');
		}else{
				// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$this->mytcpdf->setLanguageArray($l);
			}
			//adiciona esse setFont, se não da erro na página
			$this->mytcpdf->SetFont('dejavusans', '', 10);
			//adiciona página
			$this->mytcpdf->AddPage();
			//html que cont´tem o texto que será gerado
			$html = '<html><head></head><body><img src="'. base_url('assets/imagens/logoGoverno.png') .'"width="710" height="220">'.$portaria->texto.'</body></html>';
			//gera o pdf apartir do html
			//var_dump($portaria->texto);
			$this->mytcpdf->writeHTML($html, true, false, true, false, '');
			//Saída do pdf
			$this->mytcpdf->Output($pdfFilePath,'D');
		}
		redirect(base_url('Docportaria/listarTudo'));
	}
}
