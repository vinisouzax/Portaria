
<html>
<!--View de editar portaria. Apenas Administrador acessa essa view-->
  <head><!--Inicio head -->
    <title>Edição de Portaria</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href = "<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
    <!-- styles -->
    <link   href = "<?= base_url(); ?>assets/css/styles.css" rel = "stylesheet">
    <link   href = "<?= base_url(); ?>assets/css/add.css" rel    = "stylesheet">
    <script src  = "<?= base_url('assets/js/jquery-2.1.3.js'); ?>"></script>
    <script src  = "<?= base_url('assets/js/jspdf.js'); ?>"></script>
    <script src  = "<?= base_url('assets/js/pdfFromHTML.js'); ?>"></script>
    <script src  = "<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
    <script src  = "<?= base_url('assets/js/editor.js'); ?>"></script>
    <link   rel  = "stylesheet" href                             = "http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src  = "http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src  = "http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script type = "text/javascript">
		$("document").ready(function() {
			$(".calendario").datepicker({
					dateFormat     : 'dd/mm/yy',
					dayNames       : ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
					dayNamesMin    : ['D','S','T','Q','Q','S','S','D'],
					dayNamesShort  : ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
					monthNames     : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
					monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
					nextText       : 'Próximo',
					prevText       : 'Anterior'
			});
		});
    </script>
  	<script type          = "text/javascript">
  	        window.onload = function()  {
     		CKEDITOR.replace( 'editor1' );
      };
        function addText() {
            var e     = document.getElementById("id");
            var value = e.options[e.selectedIndex].value;
            var nome  = e.options[e.selectedIndex].text;
            if(value == 0){
                alert("Por favor selecione um servidor !!!");
            }else{
                var result = CKEDITOR.instances['editor1'].getData();
                $('textarea#editor1').val(result+" "+nome);
                CKEDITOR.instances['editor1'].setData(result+" "+nome);
            }
        }
    </script>
  </head>
  <body class = "login-bg">
	<?php $this->load->view('menu_lateral'); ?>
	 <div class = "page-content container">
	 <div class = "row">
	 <div class = "col-md-12 ">
	 <div class = "login-wrapper">
	 <div class = "box">
	 <div class = "content-wrap">
            <!-- Inicio de formulario para cadastro de portaria -->
              <h6>Editar Portaria</h6>
            <?php
							if($msg = get_msg()){
		            echo '<div class="msg-box">'.$msg.'</div>';
			        }
              echo form_open_multipart('Docportaria/UpdateDocPortaria'); ?>
              <input  class = "form-control" style            = "width:270px;font-size: 13px"  type                                                               = "hidden" id = "idPortaria" name = "idPortaria"    value   = "<?php echo isset($portarias) ? $portarias->idPortaria : ''; ?>" required />
              <div    align = "left"><label >Data de Início</label></div> <br>
              <input  class = "form-control calendario" style = "width:270px;font-size: 13px"  type                                                               = "text" id   = "dtInicio" name   = "dtInicio" placeholder  = "DD/MM/AAAA" value = "<?php  if($portarias->dataInicio != '')echo  date("d/m/Y",strtotime($portarias->dataInicio)); ?>" required>
              <div    align = "left"><label >Data de Término</label></div> <br>
              <input  class = "form-control calendario" style = "width:270px;font-size: 13px"   type                                                              = "text" id   = "dtTermino" name  = "dtTermino" placeholder = "DD/MM/AAAA" value = "<?php echo isset($portarias) ? date("d/m/Y",strtotime($portarias->dataTermino)) : ''; ?>"/>
              <select class = "form-control" style            = "width:200px;height:40px;font-size: 13px;margin-right: 320px; float:right; margin-top: -50" 	type = "select" id = "idTipo" name     = "idTipo" required>
				                <!--TIPOS DE PORTARIA -->
								<option value = "" > --Portarias--</option><!-- TIPOS DE PORTARIA-->
                <?php foreach ($tipos as $tipo ) { ?>
                	<option value = "<?= $tipo->idTipo; ?>" <?= ($tipo->idTipo == $portarias->idTipo)? 'selected':''?>> <?= $tipo->nome; ?> </option>
                <?php  }  ?>
              </select>
              <select class = "form-control" style = "width:200px;height:40px;font-size: 13px;margin-right: 100px; float:right; margin-top: -50" 	type = "select" id = "id" name = "id">
              <option value = "0" > --Servidores--</option><!-- SERVIDORES CADASTRADOS-->
                <?php foreach ($servidores as $servidor ) { ?>
                	<option value = "<?= $servidor->id; ?>" > <?= $servidor->nome; ?>, SIAPE: <?= $servidor->siape; ?>  </option>
                <?php  } ?>
              </select>
              <!-- adiciona servidor do combo box no texto do editor -->
            	<div id      = "adicionaTexto">
            	<ul  onclick = "addText()"  id = "addUl" >
  					     <li>ADD</li>
  					   </ul>
    					</div>
               <br><br>
              <!-- Editor de texto -->
              <textarea id = "editor1" name = "editor1"><?php echo isset($portarias) ? to_html($portarias->texto) : ''; ?></textarea>
                <center><br><br><br><br>

               <?php
								echo "<div align=center>";
								if (isset($message_display)) {
									echo $message_display;
								}
								echo validation_errors();
								echo "</div>";
					   	 ?>
			         <?php echo form_close(); ?>
                <div    class = "action">
                <button class = "btn btn-primary signup" type = "submit"  id = "cadastrar" class = "cadastrar" name = "Alterar"  >Alterar</button>                </div>
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
