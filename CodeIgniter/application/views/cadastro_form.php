
<html>
<!-- TELA DE CADASTRO DE USUARIO-->
  <head>
  <!-- pagina de cadastro de usuarios -->
    <title>Cadastro de Usuário</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href = "<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
    <!-- styles -->
    <link   href = "<?= base_url(); ?>assets/css/styles.css" rel = "stylesheet">
    <script src  = "<?= base_url(); ?>assets/vendors/select/bootstrap-select.min.js"></script>
    <script src  = "<?= base_url(); ?>assets/js/forms.js"></script>
  </head>
  <body class = "login-bg">
	<?php $this->load->view('menu_lateral'); ?>
	<div class = "page-content container">
	<div class = "row">
	<div class = "col-md-4 col-md-offset-4">
	<div class = "login-wrapper">
	<div class = "box">
	<div class = "content-wrap">
	                <h6>Cadastro de Usuário</h6>
	                <!-- Apenas administrador tem acesso a cadastro de usuarios-->
	                <!-- abre form -->
		              <?php if($nivelAcesso == 'Administrador'){
  			            echo form_open_multipart('Admin_usuario/addusuario'); ?>
  	                <input class = "form-control" type = "text" id     = "Login" name          = "Login" value                = "<?php if($Login != ''){ echo $Login;}  ?>" placeholder     = "Nome de Login" required>
  	                <input class = "form-control" type = "text" id     = "Usuario" name        = "Usuario" value              = "<?php if($Usuario != ''){ echo $Usuario;}  ?>" placeholder = "Nome Completo" required>
  	                <input class = "form-control" type = "password" id = "Senha" name          = "Senha" placeholder          = "Senha" required>
  	                <input class = "form-control" type = "password" id = "Confirme_Senha" name = "Confirme_Senha" placeholder = "Confirme a Senha" required>
  	                <input class = "form-control" type = "email" id    = "Email" name          = "Email"  value               = "<?php if($email != ''){ echo $email;}  ?>" placeholder     = "Email" required>
  	                <br>
  							    <div    class = "col-md-12">
  							    <select class = "form-control" id = "Acesso" name = "Acesso" required>
  							    <option value = ''>Selecione o Acesso</option>
  							    <option value = "Administrador">Administrador</option>
  							    <option value = "Diretor">Diretor</option>
  								    </select>
  							    </div>
  							    <br><br><br>
  	                <div    class = "action">
  	                <button class = "btn btn-primary signup" type = "submit" >Confirmar</button>
  	                </div>
    			        <?php echo form_close();
    			        }
    			        ?>
                  <br><br>
                  <?php
                    if($msg = get_msg()): 
                      echo '<div class="msg-box"><b>'.$msg.'</b></div>';
                    endif;
                  ?>
    			        <!--fecha form -->
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
    <link href = "<?= base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.css" rel = "stylesheet" media = "screen">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "<?= base_url(); ?>assets/js/jquery-1.11.1.js"></script>
    <!-- jQuery UI -->
    <script src = "<?= base_url(); ?>assets/js/jqueri-ui-1.10.3.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src = "<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src = "<?= base_url(); ?>assets/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src = "<?= base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.js"></script>
    <script src = "<?= base_url(); ?>assets/js/custom.js"></script>
    <script src = "<?= base_url(); ?>assets/js/tables.js"></script>
		<?php $this->load->view('rodape')?>
  </body>
</html>
