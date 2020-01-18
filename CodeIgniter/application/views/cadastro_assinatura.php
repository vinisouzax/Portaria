<html>
<!-- TELA DE CADASTRO DE assinatura-->
  <head>
  <!-- pagina de cadastro de assinatura -->
    <title>Cadastro de Assinatura</title>
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
              <h6>Cadastro de Assinatura</h6>
      	      <!-- Apenas diretor tem acesso a cadastro de sua assinatura-->
              <!-- abre form -->
		          <?php if($nivelAcesso == 'Diretor'){
		            echo form_open_multipart('Admin_usuario/cadastroassinatura'); ?>
    						<input type = "hidden" id = "IdUsuario" name = "IdUsuario" value = "<?php echo $nmLogin; ?>">
    						<label>Imagem de Assinatura: (JPG;PNG;GIF)</label>
    						<br>
    						<input type = "file" name = "arquivo" id = "arquivo"/>
							  <br><br><br>
							  <?php
								  echo "<div align=center>";
								  if (isset($message_display)) {
									  echo $message_display;
								  }
  								echo validation_errors();
  								echo "</div>";
							  ?>
                <div    class = "action">
                <button class = "btn btn-primary signup" type = "submit" >Confirmar</button>
                </div>
    			      <?php echo form_close();
    			       }
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
