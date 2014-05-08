<div class="wrapper">
	<div class="image">	
    	<?php echo $this->Html->link($this->Html->image('logo.png'), '', array('escape' => false)) ?>
    </div>
    <?php echo $this->Session->flash() . $this->Session->flash('auth'); ?>
    <div class="form">
    	<?php
			echo $this->Form->create();
			echo $this->Form->input('login', array('label' => 'Login'));
			echo $this->Form->input('senha', array('label' => 'Senha', 'type' => 'password'));
			echo $this->Form->end('entrar');
        ?>
    </div>
    <div class="links">
    	<?php
			echo $this->Html->link('esqueci minha senha', array('controller' => 'users', 'action' => 'esqueciMinhaSenha')) . 
				$this->Html->link('esqueci meu login', array('controller' => 'users', 'action' => 'esqueciMeuLogin'));
        ?>
    </div>
</div>