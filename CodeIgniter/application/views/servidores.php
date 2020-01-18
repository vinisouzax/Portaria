<html>
<!--Tela de manutenção de servidores-->
  <head>
    <title>Manutenção de Servidores</title>
		<?php $this->load->view('head_principal')?>
    	function confirma_excluir(idServidor){
    	    var apagar = confirm('Você deseja excluir este servidor');
    	    if (apagar){
    	        location.href = '<?php echo base_url('Servidores/deleteservidor') ?>/'+ idServidor;
    	    }
    	}
    </script>
  </head>
  <body>
	<?php $this->load->view('menu_lateral')?>
	<div class = "container">
	<div class = "panel-heading">
	<div class = "panel-title">Servidores</div>

			 <div style = "float: right;" ><a href = "<?php echo base_url('Servidores/Novo_servidor') ?>" class = "btn btn-info">Cadastrar Novo servidor</a> </div>
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
					<th>Cargo</th>
					<th>Atualizar</th>
					<th>Excluir</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($servidores as $servidor) {
						echo '<tr class="odd gradeX">';
						echo '<td>' . $servidor->nome . '</td>';
						echo '<td>' . $servidor->cargo . '</td>';
						echo '<td class="center"  width="20px"><a class="btn btn-primary btn-xs" href="Editservidor/' . $servidor->id . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a></td>';
						echo '<td class="center" width="20px"> <a class="btn btn-danger btn-xs" onclick="confirma_excluir(' . $servidor->id . ');"
						><i class="glyphicon glyphicon-remove"></i> Excluir </a></td>';
						echo '</tr>';
					}
				?>
			</tbody>
				<tfoot>
					<tr>
						<th>Descrição</th>
						<th>Cargo</th>
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
