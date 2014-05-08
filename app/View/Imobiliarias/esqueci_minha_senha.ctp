<div class="wrapper">
	<div class="image">	
    	<?php echo $this->Html->link($this->Html->image('logo.png'), array('controller' => '', 'action' => 'index'), array('escape' => false)) ?>
    </div>
    <?php echo $this->Session->flash() . $this->Session->flash('auth'); ?>
    <div class="form">
    	<?php
			echo $this->Form->create(false, array('')) . 
				$this->Form->input('email', array('required', 'label' => 'E-mail', 'type' => 'email')) . 
				$this->Form->end('enviar');
        ?>
    </div>
</div>