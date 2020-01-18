<html>
<!-- TELA PARA MANUTENCAO DE TIPOS PORTARIAS-->
  <head>
    <title>Manutenção de Tipos de Portarias</title>
		<?php $this->load->view('head_principal')?>
		   function confirma_excluir(idTPortaria){
  		    var apagar = confirm('Você deseja excluir este tipo de portaria');
  		    if (apagar){
  		        location.href = '<?php echo base_url('Portarias/deleteportaria') ?>/'+ idTPortaria;
  		    }
		   }
	   </script>
  </head>
  <body>
	<?php $this->load->view('menu_lateral')?>
	<div class = "container">
	<div class = "panel-heading">
	<div class = "panel-title">Tipos de Portarias</div>

			 <div style = "float: right;" ><a href = "<?php echo base_url('Portarias/Nova_Portaria') ?>" class = "btn btn-info">Novo Tipo de Portaria</a> </div>
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
					<th>Descrição</th>
					<th>Atualizar</th>
					<th>Excluir</th>
				</tr>
			</thead>
			<tbody>
			<?php
				foreach ($portarias as $portaria) {
					echo '<tr class="odd gradeX">';
					echo '<td>' . $portaria->nome . '</td>';
					echo '<td class="center" width="20px"><a class="btn btn-primary btn-xs" href="EditPortaria/' . $portaria->idTipo . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
					echo '<td class="center" width="20px"> <a class="btn btn-danger btn-xs" onclick="confirma_excluir(' . $portaria->idTipo . ');"
					><i class="glyphicon glyphicon-remove"></i> Excluir </a></td>';
					echo '</tr>';
				}
				?>

			</tbody>
				<tfoot>
					<tr>
						<th>Descrição</th>
						<th>Atualizar</th>
						<th>Excluir</th>
					</tr>
				</tfoot>
			</table>
		</section>
	</div>
	<?php $this->load->view('rodape')?>
  </body>
</html>
