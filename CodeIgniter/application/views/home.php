<html>
<head>
	<meta charset = "utf-8">
	<meta name    = "viewport" content = "width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
	<title>Home</title>

	<?php $this->load->view('head_principal')?>

		function arquiva(idPortaria){
  		    var atualizar = confirm('Deseja arquivar esta portaria?');
  		    if (atualizar){
  		        location.href = '<?php echo base_url('Docportaria/StatusArquivada') ?>/'+ idPortaria;
  		    }
  		}

		//baixa pdf da portaria para visualizar
		function baixar(idPortaria){
				location.href = '<?php echo base_url('Docportaria/generatePDFHome') ?>/'+ idPortaria;
		}
		//VERIFICA SE USUARIO DESEJA MUDAR STATUS DE PORTARIA PARA PUBLICADA
		function publica(idPortaria){
				var atualizar = confirm('Deseja publicar esta portaria?');
				if (atualizar){
						location.href = '<?php echo base_url('Docportaria/StatusPublicada') ?>/'+ idPortaria;
				}
		}
		//VERIFICA SE USUARIO DESEJA MUDAR STATUS DE PORTARIA PARA APROVADA
		function aprova(idPortaria){
				var atualizar = confirm('Deseja aprovar esta portaria?');
				if (atualizar){
						location.href = '<?php echo base_url('Docportaria/StatusAprovada') ?>/'+ idPortaria;
				}
		}
		function editaAdmin(idPortaria){
			location.href = '<?php echo base_url('Docportaria/EditDocPortaria') ?>/'+ idPortaria;
		}
		//ENVIA USUARIO DIRETOR PARA PAGINA DE EDICAO DE PORTARIA
		function editaDiretor(idPortaria){
			location.href = '<?php echo base_url('Docportaria/EditDocPortariaDiretor') ?>/'+ idPortaria;
		}
		//VERIFICA SE USUARIO DESEJA MUDAR STATUS DE PORTARIA PARA ESPERA, OU SEJA, MANDA PARA APROVACAO DO DIRETOR
		function enviar_aprovacao(idPortaria){
				var atualizar = confirm('Deseja enviar esta portaria para aprovação?');
				if (atualizar){
						location.href = '<?php echo base_url('Docportaria/StatusEspera') ?>/'+ idPortaria;
				}
		}
	</script>
</head>
<body>

	<?php $this->load->view('menu_lateral'); ?>


	<div class = "container">
	<div class = "panel-heading">
	<div class = "panel-title">Avisos</div>
			<?php if($nivelAcesso == 'Administrador'){ ?>
			<div style = "float: right;" ><a href = "<?php echo base_url('Docportaria/nova_portaria') ?>" class = "btn btn-info">Cadastrar Nova Portaria</a> </div>
			<?php } ?>
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
					<th hidden>Texto</th>
					<th>Data Ínicio</th>
					<th>Data Fim</th>
					<th>Status</th>
					<th>Download</th>
					<th> Visualizar</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				if($nivelAcesso == 'Administrador'){//TABELA CONSTRUIDA PARA USO EXCLUSIVO DO ADMINISTRADOR
					$dataAtual      = date('m/d/Y');                                                    //DATAS ATUAL E DO PROXIMO MES PARA VERIFICAR SE PORTARIA ESTA VENCIDA OU DENTRO DO PRAZO DE UM MES PARA VENCER
					$dataProximoMes = date('m/d/Y', strtotime('+1 months', strtotime(date('Y-m-d'))));
					foreach ($portarias as $portaria) {	//TODAS AS PORTARIAS ENVIADAS PELO CONTROLLER
						 if(strtotime($portaria->dataTermino) >= strtotime($dataAtual) && strtotime($portaria->dataTermino)<= strtotime($dataProximoMes) && ($portaria->status == 'Publicada' || $portaria->status == 'Aprovada')){//PORTARIAS DENTRO DO PRAZO DE UM MES PARA VENCER COM STATUS PUBLICADA
							echo '<tr class="odd gradeX">';
								echo '<td class="center">' . $portaria->nome . '</td>';
								echo '<td class="center">' . $portaria->numero . '</td>';
								?>
								<td hidden><?php echo $portaria->texto ?></td>
								<td class = "center"> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
								<td class = "center"> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
								<?php
								echo '<td style="background-color: yellow !important; "> Vencendo </td>';
								echo '<td> <a class=" btn alert-warning btn-xs " onclick="baixar(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-download-alt"></i> Download </a></td>';
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
								echo '<td> <a class="btn btn-success btn-xs" onclick="arquiva(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-ok-circle"></i> Arquivar </a> </td>';
								echo '<td></td>';
						  echo '</tr>';
						}
						//PORTARIAS VENCIDAS COM STATUS PUBLICADA
						if(strtotime($portaria->dataTermino) < strtotime($dataAtual) && ($portaria->status == 'Publicada' || $portaria->status == 'Aprovada')){
							echo '<tr class="odd gradeX">';
								echo '<td class="center">' . $portaria->nome . '</td>';
								echo '<td class="center">' . $portaria->numero . '</td>';
								?>
								<td hidden> <?php echo $portaria->texto ?></td>
								<td class = "center"> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
								<td class = "center"> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
								<?php
								echo '<td style="background-color: #FF6347 !important; "> Vencida </td>';
								echo '<td> <a class=" btn alert-warning btn-xs " onclick="baixar(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-download-alt"></i> Download </a></td>';
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
								echo '<td> <a class="btn btn-success btn-xs" onclick="arquiva(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-ok-circle"></i> Arquivar </a> </td>';
								echo '<td></td>';
							echo '</tr>';
						}//PORTARIAS COM STATUS APROVADA
						if($portaria->status == 'Aprovada'){
							echo '<tr class="odd gradeX">';
							echo '<td class="center">' . $portaria->nome . '</td>';
							echo '<td class="center">' . $portaria->numero . '</td>';
						?>
						<td hidden> <?php echo $portaria->texto ?></td>
						<td class = "center"> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
						<td class = "center"> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
						<?php
						echo '<td style="background-color: #90EE90 !important; "> Aprovada </td>';
						echo '<td> <a class=" btn alert-warning btn-xs " onclick="baixar(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-download-alt"></i> Download </a></td>';
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
						echo '<td> <a class="btn btn-success btn-xs" onclick="publica(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-saved"></i> Publicar </a></td>';
						echo '<td></td>';
						echo '</tr>';
					}//PORTARIAS COM STATUS RETORNADA
					if($portaria->status == 'Retornada'){
						echo '<tr class="odd gradeX">';
							echo '<td class="center">' . $portaria->nome . '</td>';
							echo '<td class="center">' . $portaria->numero . '</td>';
							?>
							<td hidden> <?php echo $portaria->texto ?></td>
							<td class = "center"> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
							<td class = "center"> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
							<?php
							echo '<td style="background-color: #FFFAFA !important; "> Retornada </td>';
							echo '<td> <a class=" btn alert-warning btn-xs " onclick="baixar(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-download-alt"></i> Download </a></td>';
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
							echo '<td><a class="btn btn-primary btn-xs" onclick="editaAdmin(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
							echo '<td> <a class="btn btn-success btn-xs" onclick="enviar_aprovacao(' . $portaria->idPortaria . ');" ><i class="glyphicon glyphicon-export"></i> Enviar </a></td>';
						echo '</tr>';
					}
					if($portaria->status == 'Espera'){//PORTARIAS COM STATUS DE ESPERA, OU SEJA, ESPERANDO APROVACAO, APENAS DIRETOR PODE APROVAR
						echo '<tr class="odd gradeX">';
							echo '<td class="center">' . $portaria->nome . '</td>';
							echo '<td class="center">' . $portaria->numero . '</td>';
							?>
							<td hidden> <?php echo $portaria->texto ?></td>
							<td class = "center"> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
							<td class = "center"> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
							<?php
							echo '<td style="background-color: yellow !important; "> Aguardando Aprovação </td>';
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
							echo '<td></td>';
							echo '<td></td>';
						echo '</tr> ';
					}
				}
			}//TABELA EXCLUSIVA DO DIRETOR
			if($nivelAcesso == 'Diretor'){
				foreach ($portarias as $portaria) {
					if($portaria->status == 'Espera'){//PORTARIAS COM STATUS DE ESPERA, OU SEJA, ESPERANDO APROVACAO, APENAS DIRETOR PODE APROVAR
						echo '<tr class="odd gradeX">';
							echo '<td class="center">' . $portaria->nome . '</td>';
							echo '<td class="center">' . $portaria->numero . '</td>';
							?>
							<td hidden ><?php echo $portaria->texto ?></td>
							<td class = "center"> <?php echo date("d/m/Y",strtotime($portaria->dataInicio)); ?> </td>
							<td class = "center"> <?php echo  date("d/m/Y",strtotime($portaria->dataTermino)); ?> </td>
							<?php
							echo '<td style="background-color: yellow !important; "> Aguarda Aprovação </td>';
							echo '<td> <a class=" btn alert-warning btn-xs " onclick="baixar(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-download-alt"></i> Download </a></td>';
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
							echo '<td> <a class="btn btn-success btn-xs" onclick="aprova(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-saved"></i> Aprovar </a></td>';
							echo '<td><a class="btn btn-primary btn-xs" onclick="editaDiretor(' . $portaria->idPortaria . ');"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
						echo '</tr>';
						}
					}
				}
			?>

			</tbody>
				<tfoot>
					<tr>
						<th>Tipo</th>
						<th>Número</th>
						<th hidden>Texto</th>
						<th>Data Ínicio</th>
						<th>Data Fim</th>
						<th>Status</th>
						<th>Download</th>
						<th> Visualizar</th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</section>
	</div>
	<?php $this->load->view('rodape')?>
</body>

</html>