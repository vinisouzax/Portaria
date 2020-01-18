<link  rel  = "stylesheet" type = "text/css" href = "<?=base_url()?>assets/media/css/jquery.dataTables.css">
<link  rel  = "stylesheet" type = "text/css" href = "<?=base_url()?>assets/resources/syntax/shCore.css">
<link  rel  = "stylesheet" type = "text/css" href = "<?=base_url()?>assets/resources/demo.css">
<style type = "text/css" class  = "init">
	
	</style>
	<link href = "<?= base_url(); ?>assets/css/jquery-ui-1.10.3-2013-05-03.css" rel = "stylesheet" media = "screen">
	<link href = "<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel     = "stylesheet">
	<link href = "<?= base_url(); ?>assets/css/styles.css" rel                      = "stylesheet">

	<script src  = "<?= base_url(); ?>assets/js/jquery-1.11.1.js"></script>
	<script src  = "<?= base_url(); ?>assets/js/jqueri-ui-1.10.3.js"></script>
	<script src  = "<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src  = "<?= base_url(); ?>assets/js/custom.js"></script>
	<script type = "text/javascript" src      = "<?= base_url(); ?>assets/js/jquery172.js"></script>
	<script src  = "<?= base_url(); ?>assets/js/jquery-1.11.1.js"></script>
	<script src  = "<?= base_url(); ?>assets/js/jqueri-ui-1.10.3.js"></script>
	<script type = "text/javascript" src      = "<?= base_url(); ?>assets/js/jquery-table.js"></script>
	<script type = "text/javascript" src      = "<?= base_url(); ?>assets/js/jquery.quick.search.js"></script>
	<script type = "text/javascript" language = "javascript" src   = "https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type = "text/javascript" language = "javascript" src   = "<?=base_url()?>assets/media/js/jquery.dataTables.js"></script>
	<script type = "text/javascript" language = "javascript" src   = "<?=base_url()?>assets/resources/syntax/shCore.js"></script>
	<script type = "text/javascript" language = "javascript" src   = "<?=base_url()?>assets/resources/demo.js"></script>
	<script type = "text/javascript" language = "javascript" class = "init">
		$("document").ready(function(){
			$("#example").dataTable({
				"bJQueryUI": true,
				"oLanguage": {
					"sProcessing"  : "Processando...",
					"sLengthMenu"  : "Mostrar _MENU_ registros",
					"sZeroRecords" : "Não foram encontrados resultados",
					"sInfo"        : "Mostrando de _START_ até _END_ de _TOTAL_ registros",
					"sInfoEmpty"   : "Mostrando de 0 até 0 de 0 registros",
					"sInfoFiltered": "",
					"sInfoPostFix" : "",
					"sSearch"      : "Buscar:",
					"sUrl"         : "",
					"oPaginate"    : {
						"sFirst"   : "Primeiro",
						"sPrevious": "Anterior",
						"sNext"    : "Seguinte",
						"sLast"    : "Último"
					}
				}
			});
		});
