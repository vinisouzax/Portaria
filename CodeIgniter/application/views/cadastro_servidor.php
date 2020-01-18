<html>
<!-- View para cadastrar servidores -->
  <head>
    <title>Cadastro de servidores</title>
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
              <h6>Cadastro de servidores</h6>
	            <?php echo form_open('Servidores/cadastrar');
	            //abre formulário para recuperar os dados através de um input
	            ?>
              <input class = "form-control" type = "text" id = "nome" name  = "nome" value    = "<?php if($nome != ''){ echo $nome;}?>" placeholder    = "Nome do servidor(a)" required>
              <input class = "form-control" type = "text" id = "siape" name = "siape"   value = "<?php if($nome != ''){ echo $nome;} ?>" placeholder   = "Siape do Servidor(a)" required>
              <input class = "form-control" type = "text" id = "cargo" name = "cargo"   value = "<?php if($cargo != ''){ echo $cargo;} ?>" placeholder = "Cargo do Servidor(a)" required>
              
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
              <button class = "btn btn-primary signup" type = "submit" >Cadastrar</button>
              </div>
		         <?php echo form_close(); ?>
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
