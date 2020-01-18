<html>
<!--View para Consultar todas portarias do sistema-->
  <head>
    <title>Consulta Portarias</title>
		<?php $this->load->view('head_principal')?>
  		//baixa pdf da portaria para visualizar
  		function visualiza(idPortaria){
  		    location.href = '<?php echo base_url('Docportaria/generatePDFConsulta') ?>/'+ idPortaria;
  		}
      function baixar(idPortaria){
  		    location.href = '<?php echo base_url('Docportaria/generatePDFHome') ?>/'+ idPortaria;
  		}
	  </script>
  </head>
  <body>
	<?php $this->load->view('menu_lateral')?>
	<div class = "container">
	<div class = "panel-heading">
	<div class = "panel-title">Portarias</div>
		</div>
		<br><br>
		<?php
			//se existe uma mensagem vinda do controller
			if($msg = get_msg()){
				echo '<div class="msg-box"><center> <b>'.$msg.'</b></center></div>';
			}
		?>
		<br><br>
		<section>
			<div   class = "demo-html"></div>
			<table id    = "example" class = "display" style = "width:100%; font-size: 12px;">
			<thead>
				<tr>
					<th>Tipo</th>
					<th>Número</th>
					<th>Status</th>
					<th hidden>Texto</th>
					<th>Data Ínicio</th>
					<th>Data Fim</th>
					<th>Editar</th>
					<th> Download</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
						<!--preenche tabela com todas as portarias do sistema -->
						<?php
								foreach ($portarias as $portaria) {
									if($portaria->status == 'Espera' || $portaria->status == 'Retornada' || $portaria->status == 'Cadastrada'){
										echo '<tr class="odd gradeX">';
										echo '<td class="center">' . $portaria->nome . '</td>';
										echo '<td>' . $portaria->numero . '</td>';
										echo '<td>' . $portaria->status . '</td>';
										?>
                    <td hidden><?php echo $portaria->texto ?></td>
                    <td> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
										 <td> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
                    <?php
										echo '<td class="center"><a class="btn btn-primary btn-xs" href="EditDocPortaria/' . $portaria->idPortaria . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
                    echo '<td> <a class=" btn alert-warning btn-xs " onclick="baixar(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-download-alt"></i> Download </a></td>';
                  	//um modal para cada portaria
										echo '<td><a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal'. $portaria->idPortaria .'" ><i class="glyphicon glyphicon-eye-open"></i> Visualizar </a>
										<div id    = "myModal'. $portaria->idPortaria .'" class = "modal fade" width = "100px"  >
										<div class = "modal-dialog"  >
										    <!-- Modal content-->
										    <div class = "modal-content" >
										    <div class = "modal-header">
										      </div>
											    <div class = "modal-body">
											    <img src   = "'. base_url('assets/imagens/logoGoverno.png') . '"  width = "100%"	" height="220"><br><p align="center"><strong>PORTARIA Nº XXX, DE XX DE X DE XXXX</strong></p><br><br>
											       '. to_html($portaria->texto) .'
													</div>
										      <div    class = "modal-footer">
										      <button type  = "button" class = "btn btn-default" data-dismiss = "modal">Close</button>
										      </div>
										    </div>
										  </div>
										</div>
								</td>';
					  echo '</tr>';
					}else{
						echo '<tr class="odd gradeX">';
						echo '<td class="center">' . $portaria->nome . '</td>';
						echo '<td>' . $portaria->numero . '</td>';
						echo '<td>' . $portaria->status . '</td>';
    				?>
            <td hidden><?php echo $portaria->texto ?></td>
            <td> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
    				<td> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
    				<?php
						echo '<td class="center"><a class="btn btn-primary btn-xs" href="EditDocPortaria/' . $portaria->idPortaria . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
            echo '<td> <a class=" btn alert-warning btn-xs " onclick="baixar(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-download-alt"></i> Download </a></td>';
						//um modal para cada portaria
    				echo '<td><a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal'. $portaria->idPortaria .'" ><i class="glyphicon glyphicon-eye-open"></i> Visualizar </a>
    				<div id    = "myModal'. $portaria->idPortaria .'" class = "modal fade" width = "100px"  >
    				<div class = "modal-dialog"  >
    				    <!-- Modal content-->
    				    <div class = "modal-content" >
    				    <div class = "modal-header">
    				      </div>
    				      <div class = "modal-body">
    				      <img src   = "'. base_url('assets/imagens/logoGoverno.png') . '"  width = "100%"	" height="220">
    					       '. to_html($portaria->texto) .'
    				      </div>
    				      <div    class = "modal-footer">
    				      <button type  = "button" class = "btn btn-default" data-dismiss = "modal">Close</button>
    				      </div>
    				    </div>
    				  </div>
    				</div>
    			</td>';
    	     echo '</tr>';
    		 }
			}
			?>

			</tbody>
				<tfoot>
					<tr>
						<th>Tipo</th>
						<th>Número</th>
						<th>Status</th>
						<th hidden>Texto</th>
						<th>Data Ínicio</th>
						<th>Data Fim</th>
						<th>Editar</th>
						<th> Download</th>
						<th>Ação</th>
					</tr>
				</tfoot>
			</table>
		</section>
	</div>
	<?php $this->load->view('rodape')?>
  </body>
</html>
