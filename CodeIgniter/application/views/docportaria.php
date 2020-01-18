<html>
  <head>
    <title>Manutenção de Portarias</title>
		<?php $this->load->view('head_principal')?>
  		function confirma_excluir(idPortaria){
  		    var apagar = confirm('Você deseja excluir esta portaria');
  		    if (apagar){
  	        location.href = '<?php echo base_url('Docportaria/DeletePortaria') ?>/'+ idPortaria;
  		    }
  		}

  		function enviar_aprovacao(idPortaria){
  		    var atualizar = confirm('Deseja enviar esta portaria para aprovação?');
  		    if (atualizar){
  		        location.href = '<?php echo base_url('Docportaria/StatusEspera') ?>/'+ idPortaria;
  		    }
  		}

			function enviar_publicacao(idPortaria){
  		    var atualizar = confirm('Deseja publicar esta portaria?');
  		    if (atualizar){
  		        location.href = '<?php echo base_url('Docportaria/StatusPublicada') ?>/'+ idPortaria;
  		    }
  		}

  	</script>
  </head>
  <body>
	<?php $this->load->view('menu_lateral')?>
	<div class = "container">
	<div class = "panel-heading">
	<div class = "panel-title">Portarias em fase de formulação</div>

			<div style = "float: right;" ><a href = "<?php echo base_url('Docportaria/nova_portaria') ?>" class = "btn btn-info">Cadastrar Nova Portaria</a> </div>
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
					<th width = "">Tipo</th>
					<th width = "">Status</th>
					<th hidden>Texto</th>
					<th width = "">Data Ínicio</th>
					<th width = "">Data Fim</th>
					<th width = "">Enviar p/ diretor aprovar</th>
					<th width = "">Visualizar</th>
					<th width = "" >Aprovação</th>
					<th width = "">Atualizar</th>
					<th width = "">Excluir</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($portarias as $portaria) {
					if($portaria->status == 'Cadastrada' || $portaria->status == 'Retornada' || $portaria->status == 'Espera'){
						echo '<tr class="odd gradeX">';
						echo '<td class="center">' . $portaria->nome . '</td>';
						echo '<td>' . $portaria->status . '</td>';
					?>
						<td hidden><?php echo $portaria->texto ?></td>
						<td> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
						<td> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
					<?php
						echo '<td> <a class="btn btn-success btn-xs" onclick="enviar_aprovacao(' . $portaria->idPortaria . ');" ><i class="glyphicon glyphicon-export"></i> Enviar </a></td>';
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
						echo '<td> <button style="border: none;" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-saved"></i>Aprovar</button> </td>';
						echo '<td class="center"><a class="btn btn-primary btn-xs" href="EditDocPortaria/' . $portaria->idPortaria . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
						echo '<td> <a class="btn btn-danger btn-xs" onclick="confirma_excluir(' . $portaria->idPortaria . ');"
							><i class="glyphicon glyphicon-remove"></i> Excluir </a></td>';
						echo '</tr>';
					}
				}
			?>

			</tbody>
				<tfoot>
					<tr>
						<th width = "">Tipo</th>
						<th width = "">Status</th>
						<th hidden>Texto</th>
						<th width = "">Data Ínicio</th>
						<th width = "">Data Fim</th>
						<th width = "">Enviar p/ diretor aprovar</th>
						<th width = "">Visualizar</th>
						<th width = "" >Aprovação</th>
						<th width = "">Atualizar</th>
						<th width = "">Excluir</th>
					</tr>
				</tfoot>
			</table>
			<div    class = "modal fade" id = "myModal" role       = "dialog">
			<div    class = "modal-dialog modal-sm">
			<div    class = "modal-content">
			<div    class = "modal-header">
			<button type  = "button" class  = "close" data-dismiss = "modal">&times;</button>
			<h4     class = "modal-title">Diretores Ativos</h4>
					</div>
					<div class = "modal-body">
					<!-- Select de Diretores -->
					<?php
					echo form_open_multipart('Docportaria/StatusAprovada2'); ?>
					<input  class = "form-control" type = "hidden" id = "idPortaria" name = "idPortaria" placeholder = "id" value = "<?= $portaria->idPortaria; ?>" required>
					<select class = "form-control" type = "select" id = "diretor" name    = "diretor" required>
						<?php foreach ($usuarios as $usuario) { ?>
								<option value = "<?= $usuario->assinatura; ?>"> <?= $usuario->nmUsuario; ?></option>
						<?php  } ?>
					</select>
					<br>
					<div    class = "action">
					<button class = "btn btn-primary signup" type = "submit"  id = "cadastrar" class = "cadastrar" name = "cadastrar"  >Aprovar</button>
					</div>
					<?php echo form_close(); ?>
					</div>
					<div    class = "modal-footer">
					<button type  = "button" class = "btn btn-default" data-dismiss = "modal">Fechar</button>
					</div>
				</div>
				</div>
				</div>
		</section>
	</div>
	<?php $this->load->view('rodape')?>
  </body>
</html>
