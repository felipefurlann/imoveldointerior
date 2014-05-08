<div id="ImobiliariasIndex">
    <h2 class="titulo">Imobiliarias</h2>
    
    <?php echo $this->Session->flash() ?>
    <div class="iconeCadastrar">
    	<span>Cadastrar</span>
        <?php echo $this->Html->link($this->Html->image('list-add-user.png'), array('controller' => 'imobiliarias', 'action' => 'add'), array('escape' => false)) ?>
    </div>
    <div class="iconeExportar">
    	<span>Exportar</span>
        <?php echo $this->Html->link($this->Html->image('document-save.png'), array('controller' => 'imobiliarias', 'action' => 'export'), array('escape' => false)) ?>
    </div>
    <div class="formPesquisar">
    	<?php
        	echo $this->Form->create('Imobiliaria', array('type' => 'get'));
			echo $this->Form->input('q', array('label' => 'Pesquisar'));
			echo $this->Form->input('f', array(
				'label' => 'Filtrar', 
				'options' => array(
					'nome' => 'Nome', 
					'telefone' => 'Telefone', 
					'cidade' => 'Cidade', 
					'contato' => 'Contato'
				)
			));
			echo $this->Form->end('pesquisar');
		?>
    </div>
    
    <div class="clear"></div>
    
    <h2 class="titulo">Imobiliarias cadastradas</h2>
    
    <?php
		
		echo '<div class="line head">';
			echo '<div class="campo"><span>Nome</span></div>';
			echo '<div class="campo"><span>Telefone</span></div>';
			echo '<div class="campo"><span>Cidade</span></div>';
			echo '<div class="campo"><span>Contato</span></div>';
			echo '<div class="campo"><span>Editar</span></div>';
		echo '</div>';
			
		foreach ($imobiliarias as $imobiliaria) {
			echo '<div class="line content">';
			echo '<div class="campo nome"><span>' . $imobiliaria['Imobiliaria']['nome'] . '</span></div>';
			echo '<div class="campo telefone"><span>' . $imobiliaria['Imobiliaria']['telefone'] . '</span></div>';
			echo '<div class="campo cidade"><span>' . $cidades[$imobiliaria['Imobiliaria']['cidade']] . '</span></div>';
			echo '<div class="campo contato"><span>' . $imobiliaria['Imobiliaria']['contato'] . '</span></div>';
			echo '<div class="campo iconsEdit">';
				echo $this->Html->link('', array('controller' => 'imobiliarias', 'action' => 'edit', $imobiliaria['Imobiliaria']['id']), array('class' => 'icon edit'));
				echo $this->Html->link('', array('controller' => 'imobiliarias', 'action' => 'view', $imobiliaria['Imobiliaria']['id']), array('class' => 'icon view'));
				echo $this->Html->link('', array('controller' => 'imobiliarias', 'action' => 'delete', $imobiliaria['Imobiliaria']['id']), array('class' => 'icon delete'), $imobiliaria['Imobiliaria']['nome'] . ' será excluída. Confirma?');
			echo '</div>';
			echo '</div>';
		}
		
		echo '<div class="clear"> </div>';
	
		echo '<div class="paginacao">';
		echo $this->Paginator->prev('Anterior', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array());
		echo $this->Paginator->next('Próximo', array(), null, array('class' => 'next disabled'));
		echo '</div>';
    ?>
</div>
