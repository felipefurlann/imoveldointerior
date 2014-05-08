<?php echo $this->Html->script(array('widget', 'fileupload2', 'fileupload-fp', 'fileupload-ui')); ?>

<div id="">
    <h2 class="titulo">Dados Imobiliária</h2>
    <?php echo $this->Session->flash() ?>
    <?php echo $this->Form->create('Imobiliaria'); ?>
    <div style="display: inline-block; float: left;">
    <?php echo $this->Form->input('nome', array('label' => 'Nome')) . $this->Form->input('username', array('label' => 'Login')) . 
        $this->Form->input('password', array('label' => 'Senha')) . $this->Form->input('cidade', array('label' => 'Cidade', 'options' => $cidades, 'default' => '9566')) . 
        $this->Form->input('endereco', array('label' => 'Endereço')) . $this->Form->input('telefone', array('label' => 'Telefone')); ?>
    </div>
    <div style="display: inline-block; float: left">
    <?php echo $this->Form->input('email', array('label' => 'E-mail')) . $this->Form->input('cnpj', array('label' => 'CNPJ')) . 
        $this->Form->input('creci', array('label' => 'CRECI')) . $this->Form->input('contato', array('label' => 'Contato')) . 
        $this->Form->input('observacoes', array('label' => 'Observações', 'style' => 'margin-bottom: 50px')); ?>
    </div>
    <div class="clear"> </div>
    
    <h2 class="titulo">Informações adicionais</h2>
    
    <div style="display: inline-block; float: left; width: 360px">
        <?php echo $this->Form->input('site'); ?>
        <div class="input file">
            <label>Logotipo (200x150)</label>
            <div id="image" class="image" style="width: 200px; height: 150px; box-shadow: inset #000 0px 0px 1px; display: inline-block; float: left;"></div>
            <div class="upload">
				<input type="file" name="arq" id="arq" />
            </div>
            <div class="delete">
                <a href="#"></a>
            </div>
        </div>
    </div>
    
    <div style="display: inline-block; float: left">
    <?php echo $this->Form->input('institucional', array('label' => 'Texto Institucional', 'rows' => 12)); ?>
    </div>
    
    <div>
    </div>
    
    <?php echo $this->Form->end('salvar imobiliaria') ?>
</div>
<form id="file_upload" action="/upload/u_ImobiliariaAddForm.php" method="post" enctype="multipart/form-data"> </form>
<script type="text/javascript">
$(function () {
	$image = $('#image');
	$('#file_upload').fileupload({
		send: function (a, b, c) {
			if(/(gif|jpg|jpeg|png)$/.test(b.files[0].name)) {
				$image.html('');
				$image.addClass('loading');
			}
		}, 
		done: function (e, data) {
			$result = $.parseJSON(data.result);
			$image.html('');
			$image.removeClass('loading');
			$image.append($('<img src="' + $result.thumb + '" />'));
			$image.append($('<input type="hidden" name="data[Imobiliaria][logotipo]" value="' + $result.thumb + '" />'));
		}, 
		fail: function (e, data) {
			$image.removeClass('loading');
			console.log(data.errorThrown);
		}
	});
	
	$('#arq').bind('change', function (e) {
		$('#file_upload').fileupload('add',  {
			url: '/upload/u_ImobiliariaAddForm.php', 
			fileInput: $(this)
		});
		$('#file_upload').fileupload('send', { });
	});
	
	$('.delete a').click(function(e) {
		e.preventDefault();
        $image.html('');
		$image.removeClass('loading');
	});
});
</script>