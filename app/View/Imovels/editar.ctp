
<html>
<head>
    <title></title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/css/jasny-bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/js/jasny-bootstrap.min.js"></script>
</head>
<body>



<form id="file_upload" action="/upload/upload_only.php" method="post" enctype="multipart/form-data"> </form>
<?php echo $this->Form->create('Imovel', array('type' => 'file')); ?>
<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Painel de gerenciamento</h2>
    </div>
</div>
<div class="row-fluid">
	<div class="span4">
		<?php
        echo $this->Form->input('codigo', array('label' => 'Código', '', 'default' => $imovel['Imovel']['codigo']));
		echo $this->Form->input('cidade', array('label' => 'Cidade', '', 'empty' => 'Selecione', 'type' => 'select', 'options' => $cidades, 'default' => $cidadeSelected));
		echo $this->Form->input('bairro', array('label' => 'Bairro', 'empty' => 'Selecione o Bairro', 'type' => 'select', 'options' => $bairros, 'default' => $bairroSelected));
        echo $this->Form->input('placa', array('label' => 'Placa', '', 'default' => $imovel['Imovel']['placa']));
        echo $this->Form->input('endereco', array('label' => 'Endereço', '', 'default' => $imovel['Imovel']['endereco']));
        echo $this->Form->input('complemento', array('label' => 'Complemento', 'default' => $imovel['Imovel']['complemento']));
        echo $this->Form->input('dormitorios', array('label' => 'Dormitórios', 'empty' => 'Selecione', '', 'options' => $dormitorios, 'default' => $imovel['Imovel']['dormitorios']));
        echo $this->Form->input('suites', array('label' => 'Suítes', 'empty' => 'Selecione', '', 'options' => $suites, 'default' => $imovel['Imovel']['suites']));
        echo $this->Form->input('salas', array('label' => 'Salas', '', 'empty' => 'Selecione', 'options' => $salas, 'default' => $imovel['Imovel']['salas']));
        echo $this->Form->input('banheiros', array('label' => 'Banheiros', '', 'empty' => 'Selecione', 'options' => $banheiros, 'default' => $imovel['Imovel']['banheiros']));
		?>
    </div>
	<div class="span4">
    	<?php
        echo $this->Form->input('garagem', array('label' => 'Garagem', '', 'empty' => 'Selecione', 'options' => $garagens, 'default' => $imovel['Imovel']['garagem']));
        echo $this->Form->input('areaTotal', array('label' => 'Área total', 'default' => $imovel['Imovel']['areaTotal']));
        echo $this->Form->input('areaConstruida', array('label' => 'Área construída', 'default' => $imovel['Imovel']['areaConstruida']));
        echo $this->Form->input('intencao', array('label' => 'Finalidade', '', 'empty' => 'Selecione', 'options' => $finalidade, 'default' => $imovel['Imovel']['intencao']));
        echo $this->Form->input('tipo', array('label' => 'Tipo', '', 'empty' => 'Selecione', 'options' => $tipo, 'default' => $imovel['Imovel']['tipo']));
        echo $this->Form->input('imovel', array('label' => 'Imóvel', '', 'options' => $especificacoes, 'empty' => 'Selecione', 'default' => $imovel['Imovel']['especificacao']));
        echo $this->Form->input('condominio', array('label' => 'Condomínio', 'default' => $imovel['Imovel']['condominio']));
        echo $this->Form->input('descricao', array('label' => 'Descrição', 'cols' => false, 'rows' => false, 'default' => $imovel['Imovel']['descricao']));
        echo $this->Form->input('valor', array('label' => 'Valor do imóvel', '', 'default' => $imovel['Imovel']['valor']));
        ?>
    </div>
	<div class="span4 last">
    	<div id="mais-opcoes">
            <?php echo $this->Form->select("opcoes", $mais_opcoes, array('multiple' => 'checkbox', 'default' => explode(';', $imovel['Imovel']['opcoes']))) ?>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Imagens</h2>
    </div>
</div>
<div class="row-fluid">
	<?php for ($i = 1; $i <= 6; $i++) { ?>
	<div class="span2 <?php echo $i == 6 ? 'last' : '' ?>">
		<div class="btnEnviarFoto">
                    <a href="#" class="remove icon-trash icon-white"></a>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 155px;height: 150px;z-index: 999;line-height: 150px;position:relative;"></div>
                      <div>
                        <img src="http://painel.imoveldointerior.com.br/img/<?php echo $imovel['Imovel']['foto'.$i.'']; ?>">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->Form->input('foto'.$i.'', array('label' => false,'type' => 'file'));?>
                        </span>
                      </div>
                    </div>
        </div>
        <?php echo $this->Form->input("legendaFoto$i", array('label' => false, 'placeholder' => 'Legenda')) ?>
    </div>
    <?php } ?>
</div>
<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Localização</h2>
    </div>
</div>
<div class="row-fluid">
	<div class="span6">
    	<?php echo $this->Form->input('geolocalizacao', array('label' => false)) ?>
    </div>
    <div class="span6 last">
    	<div id="mapa" style="height: 220px; width:100%">
			<iframe frameborder="0" width="440" height="220" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/?ie=UTF8&amp;ll=-22.398015,-47.561343&amp;spn=0.001768,0.00327&amp;t=m&amp;z=19&amp;layer=c&amp;cbll=-22.397786,-47.561513&amp;panoid=9pXBkC8alYZwvMbakHZ1lw&amp;cbp=12,41.19,,0,0&amp;source=embed&amp;output=svembed"></iframe>
        </div>
        <div id="mapaInputs">
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
    	<?php echo $this->Form->end(array('label' => 'Enviar', 'div' => array('class' => 'btn'))) ?>
    </div>
</div>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&v=3.9" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	$('#ImovelCidade').change(function(e) {
		$('#ImovelBairro').html($('<option />').val('').text('Carregando...'));
        $.getJSON(
			"<?php echo Router::url(array('controller' => 'pages', 'action' => 'pegarBairros')) ?>", 
			{ "cidade" : $(this).val() }, 
			function (data) { 
				$('#ImovelBairro').html($('<option />').val('').text('Selecione'));
				$.each(data, function (chave, valor) {
					$('#ImovelBairro').append($('<option />').val(chave).text(valor));
				} );
			}
		);
    });
	$('#ImovelTipo').change(function(e) {
        $('#ImovelImovel').html($('<option />').val('').text('Selecione'));
		switch ($(this).val()) {
			case "residencial":
				$('#ImovelImovel').append($('<option />').val('casas').text("Casa"));
				$('#ImovelImovel').append($('<option />').val('apartamento').text("Apartamento"));
				$('#ImovelImovel').append($('<option />').val('condominio').text("Condomínio"));
				$('#ImovelImovel').append($('<option />').val('chacara').text("Chácara"));
				$('#ImovelImovel').append($('<option />').val('kitnet').text("Kitnet"));
				$('#ImovelImovel').append($('<option />').val('temporada').text("Temporada"));
				break;
			case "comercial":
				$('#ImovelImovel').append($('<option />').val('barracao').text("Barracão"));
				$('#ImovelImovel').append($('<option />').val('salascomerciais').text("Salas comerciais"));
				$('#ImovelImovel').append($('<option />').val('pontocomercial').text("Ponto comercial"));
				break;
			case "empreendimento":
				$('#ImovelImovel').append($('<option />').val('ecomercial').text("Comercial"));
				$('#ImovelImovel').append($('<option />').val('eresidencial').text("Residencial"));
				break;
			case "terreno":
				$('#ImovelImovel').append($('<option />').val('tcomercial').text("Comercial"));
				$('#ImovelImovel').append($('<option />').val('tresidencial').text("Residencial"));
				$('#ImovelImovel').append($('<option />').val('tcomres').text("Comerical/Residencial"));
				break;
			case "rural":
				$('#ImovelImovel').append($('<option />').val('fazenda').text("Fazenda"));
				$('#ImovelImovel').append($('<option />').val('sitio').text("Sítio"));
				$('#ImovelImovel').append($('<option />').val('rchacara').text("Chácara"));
				break;
		}
    });
	
	var geo = "<?php echo $imovel['Imovel']['geolocalizacao'] ?>";
	var ll = geo.split(',');
	var geoLoc = new google.maps.LatLng(ll[0], ll[1]);
	mapOpts = { 
		center: geoLoc, 
		zoom: 14, 
		mapTypeId: google.maps.MapTypeId.ROADMAP, 
		panControl: false,
		zoomControl: false,
		scaleControl: false,
		mapTypeControl: false,
		streetViewControl: false,
		overviewMapControl: false
	};
	
	$('#mapaInputs').html($('<input type="hidden" name="data[Imovel][geolocalizacao]" />').val(geo));
	
	var map = new google.maps.Map(document.getElementById("mapa"), mapOpts);
	var marker = new google.maps.Marker({ map: map, position: geoLoc });
});
</script>

</body>
</html>