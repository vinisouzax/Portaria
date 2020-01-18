	<nav class = "navbar navbar-inverse" style = "border-radius: 0px;">
	<div class = "container-fluid">
	<div class = "navbar-header">
	<a   class = "navbar-brand" href           = "<?php echo base_url('Docportaria/listarHome') ?>">SIGEP: Portarias</a>
		</div>
		<ul class = "nav navbar-nav">
		<li ><a href = "<?php echo base_url('Docportaria/listarHome') ?>"><i class = "glyphicon glyphicon-home"></i> Home</a></li>
		  <?php
		  if($nivelAcesso == 'Administrador'){
		  ?>
		  <li    class = "dropdown"><a class = "dropdown-toggle" data-toggle = "dropdown" href = "#">Portarias <span class = "caret"></span></a>
		  <ul    class = "dropdown-menu">
		  <li><a href  = "<?php echo base_url('Docportaria/listar') ?>">Cadastro de Portarias</a></li>
			</ul>
		  </li>
		  <?php
		  }
		  if($nivelAcesso == 'Administrador'){
		  ?>
		  <li    class = "dropdown"><a class = "dropdown-toggle" data-toggle = "dropdown" href = "#">Configurações <span class = "caret"></span></a>
		  <ul    class = "dropdown-menu">
		  <li><a href  = "<?php echo base_url('Portarias/portarias') ?>">Manter Tipos</a></li>
		  <li><a href  = "<?php echo base_url('Servidores/listar') ?>">Cadastro de Servidores</a></li>
		  <li><a href  = "<?php echo base_url('Admin_usuario/index') ?>">Cadastro de Usuários</a></li>
		  <li><a href  = "<?php echo base_url('Admin_usuario/listaDiretores') ?>">Cadastro de Assinaturas</a></li>
			</ul>
		  </li>
		  <?php
		  }
		  ?>
		  <?php
		  if($nivelAcesso == 'Diretor'){
	      ?>
		  <li><a href = "<?php echo base_url('Admin_usuario/listaCadastroAssinatura') ?>">Cadastro de Assinatura</a></li>
		  <?php
		  }
		  ?>
			<li><a href  = "<?php echo base_url('Docportaria/listarTudo') ?>"><i class = "glyphicon glyphicon-search"></i> Consultar Portaria</a></li>
			<li    class = "dropdown"><a class                                         = "dropdown-toggle" data-toggle = "dropdown" href = "#"><i class = "glyphicon glyphicon-user"></i> <?php echo $nmLogin?> <span class = "caret"></span></a>
			<ul    class = "dropdown-menu">
			<li><a href  = "<?php echo base_url('Admin_usuario/index') ?>"><i class    = "glyphicon glyphicon-user"></i> Meu Perfil </a></li>
			<li><a href  = "<?php echo base_url('Autenticacao/logout') ?>"><i class    = "glyphicon glyphicon-off"></i> Sair</a></li><!-- LOGOUT-->
			</ul>
		  </li>		
		</ul>
	  </div>
	</nav>

