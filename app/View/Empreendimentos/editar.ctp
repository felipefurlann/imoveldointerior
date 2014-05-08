<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/css/jasny-bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/js/jasny-bootstrap.min.js"></script>

<?php echo $this->Form->create() ?>
<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Painel de gerenciamento</h2>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
    	<h2 class="label">Banner topo</h2>
		<div class="btnEnviarFoto" style="height: 287px">
                    <a href="#" class="remove icon-trash icon-white"></a>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 1060px;
height: 290px;z-index: 999;line-height: 150px;position:relative;"></div>
                      <div>
                <?php
$empreendimento['Empreendimento']['bannerTopo'] = strtolower($empreendimento['Empreendimento']['bannerTopo']);

                ?>
                        <img src="http://painel.imoveldointerior.com.br/img/<?php echo $empreendimento['Empreendimento']['bannerTopo']; ?>">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->Form->input('bannerTopo', array('label' => false,'type' => 'file'));?>
                        </span>
                      </div>
                    </div>
        </div>
        <?php echo $this->Form->input('tituloBannerTopo', array('label' => false, 'placeholder' => 'Título', 'default' => $empreendimento['Empreendimento']['tituloBannerTopo'])) ?>
    </div>
</div>
<div class="row-fluid">
	<div class="span4">
    	<?php
			echo $this->Form->input('cidade', array('label' => 'Cidade', 'required', 'empty' => 'Selecione', 'options' => $cidades, 'default' => $empreendimento['Empreendimento']['cidade'])) . 
				$this->Form->input('bairro', array('label' => 'Bairro', 'empty' => 'Selecione', 'options' => $bairros, 'default' => $empreendimento['Empreendimento']['bairro'])) . 
				$this->Form->input('endereco', array('label' => 'Endereço', 'required', 'default' => $empreendimento['Empreendimento']['endereco'])) . 
				$this->Form->input('tipo', array('label' => 'Tipo do imóvel', 'required', 'options' => array(1 => 'Residencial', 2 => 'Comercial', 3 => 'Residencial/Comercial'), 'default' => $empreendimento['Empreendimento']['tipo'], 'empty' => 'Selecione'));
        ?>
        		<label for="thumb">Imagem perfil empreendimento (220px x 150px)</label>
                <div class="btnEnviarFoto" style="width:220px;height:150px;">
                    <a href="#" class="remove icon-trash icon-white"></a>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px;height: 150px;z-index: 999;line-height: 150px;position:relative;"></div>
                      <div>
                               <?php
$empreendimento['Empreendimento']['thumb'] = strtolower($empreendimento['Empreendimento']['thumb']);

                ?>
                        <img src="http://painel.imoveldointerior.com.br/img/<?php echo $empreendimento['Empreendimento']['thumb']; ?>">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->Form->input('thumb', array('label' => false,'type' => 'file'));?>
                        </span>
                      </div>
                    </div>
                </div>
                <small>Essa imagem aparecerá na página principal em caso do empreendimento estar em  destaque no portal</small>
    </div>
	<div class="span8 last">
    	<?php echo $this->Form->input('descricao', array('label' => 'Descrição', 'default' => $empreendimento['Empreendimento']['descricao'], 'type' => 'textarea', 'style' => 'height: 370px', 'cols' => false, 'rows' => false)) ?>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Imagens</h2>
        <div class="row-fluid">
        	<?php for ($i = 1; $i <= 12; $i++) { ?>
                <div class="span2">
                    <div class="btnEnviarFoto">
                    <a href="#" class="remove icon-trash icon-white"></a>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px;height: 150px;z-index: 999;line-height: 150px;position:relative;"></div>
                      <div>
                        <img src="http://painel.imoveldointerior.com.br/img/<?php echo $empreendimento['Empreendimento']['foto'.$i.'']; ?>">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->Form->input('foto'.$i.'', array('label' => false,'type' => 'file'));?>
                        </span>
                      </div>
                    </div>
                    </div>
                    <?php echo $this->Form->input("legendaFoto$i", array('label' => false, 'placeholder' => 'Legenda', 'default' => $empreendimento['Empreendimento']["legendaFoto$i"])) ?>
                </div><?php echo $i % 6 == 0 ? '</div><div class="row-fluid">' : '' ?>
			<?php } ?>
        </div><!-- .row-fluid -->
    </div><!-- .span12 -->
</div><!-- .row-fluid -->
<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Vídeo</h2>
        <div class="row-fluid">
        	<div class="span6">
            	<div class="row-fluid">
                    <input id="urlYoutube" class="span10" value="<?php echo $empreendimento['Empreendimento']['video'] ?>" style="padding: 5px 0" />
                    <button data-id="urlYoutube" id="btnYoutube" class="span2 last">OK</button>
                </div>
            </div><!-- .span6 -->
        	<div class="span6 last">
            	<div id="videoYoutube">
				</div>
            </div><!-- .span6 -->
        </div><!-- .row-fluid -->
	</div><!-- .span12 -->
</div><!-- .row-fluid -->
<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Logotipo</h2>
		<?php for ($i = 1; $i <= 4; $i++) { ?>
            <div class="span2 <?php echo $i % 6 == 0 ? 'last' : '' ?>">
                <div class="btnEnviarFoto">
                    <a href="#" class="remove icon-trash icon-white"></a>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px;height: 150px;z-index: 999;line-height: 150px;position:relative;"></div>
                      <div>
                               <?php
$empreendimento['Empreendimento']['logo'.$i.''] = strtolower($empreendimento['Empreendimento']['logo'.$i.'']);

                ?>
                        <img src="http://painel.imoveldointerior.com.br/img/<?php echo $empreendimento['Empreendimento']['logo'.$i.'']; ?>">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->Form->input("logo$i", array('label' => false,'type' => 'file'));?>
                        </span>
                      </div>
                    </div>
                    <input type="file" name="arq" id="<?php echo "logo$i" ?>" />
                </div>
                <?php echo $this->Form->input("legendaLogo$i", array('label' => false, 'placeholder' => 'Legenda', 'default' => $empreendimento['Empreendimento']["legendaLogo$i"])) ?>
            </div>
        <?php } ?>
    </div><!-- .span12 -->
</div><!-- .row-fluid -->
<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Localização</h2>
        <div class="row-fluid">
        	<div class="span6">
            	<div class="row-fluid">
                    <input id="urlMaps" class="span10" value="<?php echo $empreendimento['Empreendimento']['geolocalizacao']; ?>" style="padding: 5px 0" />
                    <button data-id="urlMaps" id="btnMaps" class="span2 last">OK</button>
                </div>
            </div>
        	<div class="span6 last">
            	<div id="iframeMaps"> </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end('Salvar') ?>

<script type="text/javascript">
$(function () {
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
});
</script>