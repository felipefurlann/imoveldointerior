
<html>
<head>
    <title></title>
    <meta charset="utf-8">
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

		//debug($Bairros);
		
        echo $this->Form->input('codigo', array('label' => 'Código'));

        echo $this->Form->input('cidade', array('label' => 'Cidade', 'options' => $Cidades, 'default' => '9566'));

		echo $this->Form->input('bairro', array('type' => 'select', 'label' => 'Bairro', 'empty' => 'Selecione o Bairro')); // retirei o array
        echo $this->Form->input('placa', array('label' => 'Placa'));
        echo $this->Form->input('endereco', array('label' => 'Endereço'));
        echo $this->Form->input('complemento', array('label' => 'Complemento'));
        echo $this->Form->input('dormitorios', array('label' => 'Dormitórios', 'empty' => 'Selecione', 'options' => $dormitorios));
        echo $this->Form->input('suites', array('label' => 'Suítes', 'empty' => 'Selecione', 'options' => $suites));
        echo $this->Form->input('salas', array('label' => 'Salas', 'empty' => 'Selecione', 'options' => $salas));
        echo $this->Form->input('banheiros', array('label' => 'Banheiros', 'empty' => 'Selecione', 'options' => $banheiros));
		?>
    </div>
	<div class="span4">
    	<?php unset($tipo['empreendimento']);
        echo $this->Form->input('garagem', array('label' => 'Garagem', 'empty' => 'Selecione', 'options' => $garagens));
        echo $this->Form->input('areaTotal', array('label' => 'Área total'));
        echo $this->Form->input('areaConstruida', array('label' => 'Área construída'));
        echo $this->Form->input('intencao', array('label' => 'Finalidade', 'required','empty' => 'Selecione', 'options' => $finalidade));
        echo $this->Form->input('tipo', array('label' => 'Tipo', 'required','empty' => 'Selecione', 'options' => $tipo));
        echo $this->Form->input('imovel', array('label' => 'Imóvel', 'required', 'options' => array('empty' => 'Selecione')));
        echo $this->Form->input('condominio', array('label' => 'Condomínio'));
        echo $this->Form->input('descricao', array('label' => 'Descrição', 'cols' => false, 'rows' => false));
        echo $this->Form->input('valor', array('label' => 'Valor do imóvel', 'type' => 'text'));
        ?>
    </div>
	<div class="span4 last">
    	<div id="mais-opcoes">
			<?php echo $this->Form->select("opcoes", $mais_opcoes, array('multiple' => 'checkbox')) ?>
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
  <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
  <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>          <?php 
echo $this->Form->input('foto'.$i.'', array('label' => false,
    'type' => 'file'  
));  

            ?></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
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
    	<?php
         echo $this->Form->input('geolocalizacao', array('label' => false)) 
         ?>
    </div>
    <div class="span6 last">
    	<div id="mapa" style="height: 220px; width:100%">
			<!--<iframe frameborder="0" width="440" height="220" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/?ie=UTF8&amp;ll=-22.398015,-47.561343&amp;spn=0.001768,0.00327&amp;t=m&amp;z=19&amp;layer=c&amp;cbll=-22.397786,-47.561513&amp;panoid=9pXBkC8alYZwvMbakHZ1lw&amp;cbp=12,41.19,,0,0&amp;source=embed&amp;output=svembed"></iframe>-->
        </div>
        <div id="mapaInputs">
        </div>
    </div>
</div>
<?php echo $this->Form->end('Enviar') ?>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&v=3.9" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(e) {
$('#ImovelBairro').hide()

        $("#ImovelCidade").change(function(){

            $.ajax({
                type: 'POST',
                data: { select: $('#ImovelCidade :selected').html()},
                url: 'buscabairros',

                success: function(data) {
                          //preenche o select de bairros com os dados que retornam do ajax.
                    $("#ImovelBairro").html(data);
					$("#ImovelBairro").show();

                }
            });
        });

        $(document).ready(function(){

            $.ajax({
                type: 'POST',
                data: { select: $('#ImovelCidade :selected').html()},
                url: 'buscabairros',

                success: function(data) {
                          //preenche o select de bairros com os dados que retornam do ajax.
                    $("#ImovelBairro").html(data);
                    $("#ImovelBairro").show();

                }
            });
        });

        
	$('#ImovelTipo').change(function(e) {
        $('#ImovelImovel').html($('<option />').val('').text('Selecione'));
		switch ($(this).val()) {
			case "residencial":
				$('#ImovelImovel').append($('<option />').val('1').text("Casa"));
				$('#ImovelImovel').append($('<option />').val('2').text("Apartamento"));
				$('#ImovelImovel').append($('<option />').val('3').text("Condomínio"));
				$('#ImovelImovel').append($('<option />').val('4').text("Chácara"));
				$('#ImovelImovel').append($('<option />').val('5').text("Kitnet"));
				break;
			case "comercial":
				$('#ImovelImovel').append($('<option />').val('7').text("Barracão"));
				$('#ImovelImovel').append($('<option />').val('8').text("Salas comerciais"));
				$('#ImovelImovel').append($('<option />').val('9').text("Ponto comercial"));
				break;
			case "terreno":
				$('#ImovelImovel').append($('<option />').val('12').text("Comercial"));
				$('#ImovelImovel').append($('<option />').val('13').text("Residencial"));
				$('#ImovelImovel').append($('<option />').val('14').text("Com./Res."));
				break;
			case "rural":
				$('#ImovelImovel').append($('<option />').val('15').text("Fazenda"));
				$('#ImovelImovel').append($('<option />').val('16').text("Sítio"));
				$('#ImovelImovel').append($('<option />').val('17').text("Chácara"));
				break;
		}
    });
});
</script>

<div class="btncancelar" style="background-image: url('../img/botao-filtrar-index.png');
width: 95px;
height: 30px;
margin: 5px;
/* background: #005580; */
color: white;
margin: -147px 0 0 79%;
text-align: center;
text-decoration: none;">
<a href="http://painel.imoveldointerior.com.br/imovels" style="color:white;text-decoration:none;">Cancelar</a>
</div>


</body>
</html>