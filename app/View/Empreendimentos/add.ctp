<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/css/jasny-bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.2/js/jasny-bootstrap.min.js"></script>

<style type="text/css">
div.fotos {
width: 16%;
margin:0 6px 0 0;
}
</style>
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
            height: 287px;"></div>
              <div>
                <span class="btn btn-default btn-file"><span class="fileinput-new"></span>
                <?php 
            echo $this->Form->input('bannerTopo', array('label' => false,
                'type' => 'file'  
            ));  

                        ?>
                </span>
              </div>
            </div>
        </div>
        <?php echo $this->Form->input('tituloBannerTopo', array('label' => false, 'placeholder' => 'Título')) ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php

            echo $this->Form->input('cidade', array('label' => 'Cidade', 'options' => $Cidades, 'default' => '9566'));
            echo $this->Form->input('bairro', array('type' => 'select', 'label' => 'Bairro', 'empty' => 'Selecione o Bairro'));
                $this->Form->input('endereco', array('label' => 'Endereço', 'required'));   
                $this->Form->input('tipo', array('label' => 'Tipo do imóvel', 'required', 'options' => array(1 => 'Residencial', 2 => 'Comercial', 3 => 'Residencial/Comercial'), 'empty' => 'Selecione'));
        ?>
                <label for="thumb">Imagem perfil empreendimento (220px x 150px)</label>
                <div class="btnEnviarFoto" style="width:220px;height:150px;">
                    <a href="#" class="remove icon-trash icon-white"></a>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>          <?php 
                    echo $this->Form->input('thumb', array('label' => false,
                        'type' => 'file'  
                    ));  

                                ?></span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                      </div>
                    </div>
                </div>
                <small>Essa imagem aparecerá na página principal em caso do empreendimento estar em  destaque no portal</small>
    </div>
    <div class="span8 last">
        <?php echo $this->Form->input('descricao', array('label' => 'Descrição', 'type' => 'textarea', 'style' => 'height: 370px', 'cols' => false, 'rows' => false)) ?>
    </div>
</div>
<div class="row-fluid" >
    <div class="span12">
        <h2 class="titulo">Imagens</h2>
        <div class="row-fluid" style="display: flex !important;flex-wrap: wrap !important;">
            <?php for ($i = 1; $i <= 12; $i++) { ?>
            <div class="fotos">
                <div class="btnEnviarFoto">
                    <a href="#" class="remove icon-trash icon-white"></a>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                    <div>
                        <span class="btn btn-default btn-file">
<?php 
                    echo $this->Form->input('foto'.$i.'', array('label' => false,
                        'type' => 'file'  
                    ));  

                                ?>
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
            </div>
                <?php echo $this->Form->input("legendaFoto$i", array('label' => false, 'placeholder' => 'Legenda')) ?>
        </div>
            <?php } ?>
    </div><!-- .span12 -->
</div><!-- .row-fluid -->
<div class="row-fluid">
    <div class="span12">
        <h2 class="titulo">Vídeo</h2>
        <div class="row-fluid">
            <div class="span6">
                <div class="row-fluid">
                    <?php echo $this->Form->input('video', array('label' => '', 'type' => 'text')); ?>

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
        <div class="row-fluid">
            <?php for ($i = 1; $i <= 6; $i++) { ?>
            <div class="span2">
                <div class="btnEnviarFoto">
                    <a href="#" class="remove icon-trash icon-white"></a>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                      <div>
                        <span class="btn btn-default btn-file"><?php 
                    echo $this->Form->input('logo'.$i.'', array('label' => false,
                        'type' => 'file'  
                    ));  

                                ?></span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                      </div>
                    </div>
                </div>
                <?php echo $this->Form->input("legendaLogo$i", array('label' => false, 'placeholder' => 'Legenda')) ?>
            </div>
            <?php } ?>
        </div>
    </div><!-- .span12 -->
</div><!-- .row-fluid -->
<div class="row-fluid">
    <div class="span6">
                <h2 class="titulo">Localização</h2>
        <?php
         echo $this->Form->input('geolocalizacao', array('label' => false)) 
         ?>
    </div>
</div>

<?php echo $this->Form->end('Salvar') ?>
<script type="text/javascript">
$(function () {
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
});
</script>
<div class="btncancelar" style="background-image: url('../img/botao-filtrar-index.png');
width: 95px;
height: 30px;
margin: 5px;
/* background: #005580; */
color: white;
margin: -47px 0 0 79%;
text-align: center;
text-decoration: none;">
<a href="http://painel.imoveldointerior.com.br/empreendimentos" style="color:white;text-decoration:none;">Cancelar</a>
</div>