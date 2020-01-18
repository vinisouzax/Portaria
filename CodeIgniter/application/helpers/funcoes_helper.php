<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('set_msg')):
	function set_msg($msg=NULL){
		$ci= & get_instance();
		$ci->session->set_userdata('aviso', $msg);
	}
endif;
if(!function_exists('get_msg')):
	function get_msg($destroy =TRUE){
		$ci = & get_instance();
		$retorno = $ci->session->userdata('aviso');
		if($destroy) $ci->session->unset_userdata('aviso');//unset é utilizado para guardar algumas informações na sessão
		return $retorno;
	}
endif;

if(!function_exists('to_bd')):
	//codifica html para salvar no banco de dados
	function to_bd($string=NULL){
		return htmlentities($string);
	}
endif;

if(!function_exists('to_html')):
	//codifica html para salvar no banco de dados
	function to_html($string=NULL){
		return html_entity_decode($string);
	}
endif;

if(!function_exists('resumo_post')):
	//gera um texto parcial a partir de conteúdo de um post
	function resumo_post($string =NULL ,$tamanho =100){
		$string = to_html($string);//rever a informação pro html
		$string = strip_tags($string);// remove as tags html depois
		$string = substr($string,0,$tamanho); //gera resumo
		return $string;
	}
endif;
