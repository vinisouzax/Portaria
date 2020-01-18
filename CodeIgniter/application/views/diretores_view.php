<html>
<!--pega informações importantes para usar em outras partes da pagina e verifica se sessão esta aberta -->
  <head>
  	<!-- Página de Administração de Usuários -->
    <title>Administração de Usuários</title>
		<?php $this->load->view('head_principal')?>
		function confirma_excluir(idUsuario){
		    var apagar = confirm('Você deseja excluir este usuário');
		    if (apagar){
		        location.href = '<?php echo base_url('Admin_usuario/deleteusuario') ?>/'+ idUsuario;
		    }
		}
	</script>
  </head>
  <body>
	<?php $this->load->view('menu_lateral')?>
	<div class = "container">
	<div class = "panel-heading">
	<div class = "panel-title">Assinatura de Diretores</div>
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
					<th>Nome de Login</th>
					<th>Nome do Usuário</th>
					<th>E-mail</th>
					<th>Nível de Acesso</th>
					<th>Editar Assinatura</th>
				</tr>
			</thead>
			<tbody>
			<?php
					foreach ($usuarios as $usuario) {
						echo '<tr class="odd gradeX">';
						echo '<td>' . $usuario->nmLogin . '</td>';
						echo '<td>' . $usuario->nmUsuario . '</td>';
						echo '<td>' . $usuario->email . '</td>';
						echo '<td class="center">' . $usuario->nivelAcesso . '</td>';
						echo '<td class="center">';
						//Administrador edita outros usuarios de nivel mais baixo que ele
						//Outros usuarios so editam as proprias informações menos o nível de acesso
						echo '<a class="btn btn-primary btn-xs" href="EditAssinatura/' . $usuario->idUsuario . '"><i class="glyphicon glyphicon-pencil"></i> Editar </a>';
						echo '</td>';
						echo '</tr>';
					}
				?>

			</tbody>
				<tfoot>
					<tr>
						<th>Nome de Login</th>
						<th>Nome do Usuário</th>
						<th>E-mail</th>
						<th>Nível de Acesso</th>
						<th>Editar Assinatura</th>
					</tr>
				</tfoot>
			</table>
		</section>
	</div>
	<?php $this->load->view('rodape')?>
  </body>
</html>
