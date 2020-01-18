
<html>
<!-- TELA DE EDIÇAO DE SERVIDORES. Apenas servidor acessa -->
  <head>
    <title>Edição de servidores</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href = "<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
    <!-- styles -->
    <link href = "<?= base_url(); ?>assets/css/styles.css" rel = "stylesheet">
  </head>
  <body class = "login-bg">
  <?php $this->load->view('menu_lateral'); ?>
	 <div class = "page-content container">
	 <div class = "row">
	 <div class = "col-md-4 col-md-offset-4">
	 <div class = "login-wrapper">
	 <div class = "box">
	 <div class = "content-wrap">
            <!-- Formulario para edição de servidores -->
              <h6>Edição de servidores</h6>
	            <?php echo form_open('Servidores/Updateservidor'); ?>
							<input type  = "hidden" id         = "id" name = "id" value   = "<?php echo isset($servidores) ? $servidores->id : -1; ?>">
							<input class = "form-control" type = "text" id = "nome" name  = "nome" placeholder  = "Nome do servidor(a)"
							       value = "<?php echo isset($servidores) ? $servidores->nome : ''; ?>" required>
							<input class = "form-control" type = "text" id = "siape" name = "siape" placeholder = "Siape do servidor(a)"
							       value = "<?php echo isset($servidores) ? $servidores->siape : ''; ?>" required>
							<input class = "form-control" type = "text" id = "cargo" name = "cargo" placeholder = "Cargo do servidor(a)"
							       value = "<?php echo isset($servidores) ? $servidores->cargo : ''; ?>" required>
              <br><br><br>
              <div    class = "action">
              <button class = "btn btn-primary signup" type = "submit" >Confirmar</button>
              </div>
		         <?php echo form_close(); ?>
              <br>
             <?php
               if($msg = get_msg()): 
                 echo '<div class="msg-box"><b>'.$msg.'</b></div>';
               endif;
             ?>
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
