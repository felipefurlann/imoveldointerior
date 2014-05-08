<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Imóvel Rio Claro - Painel de controle</title>
<?php echo $this->Html->css(array('bootstrap', 'css')) . $this->Html->script(array('jquery', 'js', 'widget', 'fileupload2', 'fileupload-fp', 'fileupload-ui')); ?>
</head>
<body>
<div id="top" class="wrapper">
    <div class="container">
        <div class="row-fluid">
            <div class="span11">
                <h2>Painel Administrativo</h2>
            </div>
            <div class="span1 last">
                <?php echo $this->Html->link('sair', array('controller' => 'users', 'action' => 'logout'), array('id' => 'sair')) ?>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .wrapper -->

<div id="near" class="wrapper">
    <div class="container">
        <div class="row-fluid">
            <div class="span6">
                <?php echo $this->Html->link($this->Html->image('logo-administradores-middle.png'), array('action' => 'index'), array('escape' => false)) ?>
            </div>
            <div class="span6 last" style="text-align:right">
            	<?php echo $this->Html->link($this->Html->image($this->Session->read('Auth.User.Imobiliaria.logotipo'), array('style' => 'height: 75px;width: auto;')), array('action' => 'index'), array('escape' => false)) ?>
            </div>
        </div><!-- .row -->
        <div class="row-fluid">
        	<div class="span12">
            	<hr style="border-bottom: 1px solid #f1f1f0; border-top: 1px solid #a9c2c6; margin-bottom: 20px;" />
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span12">
				<?php if ($this->Session->read('Auth.User.Imobiliaria.observacoes')) echo $this->Session->flash('observacao'); ?>
            </div>
        </div>
    </div><!-- .container -->
</div><!-- .wrapper -->

<div id="main" class="wrapper">
	<div class="container">
        <!-- Não era pra você estar vendo isso! -->
        <?php echo $content_for_layout; ?>
    </div>
</div>

</body>
</html>