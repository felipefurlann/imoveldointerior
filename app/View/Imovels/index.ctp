<div class="row-fluid">
	<div class="span12">
    	<h2 class="titulo">Painel de gerenciamento</h2>
    </div>
</div>
<div class="row-fluid">
    <div id="sideMenu" class="span3">
        <h2>Menu</h2>
        <ul>
            <li><?php echo $this->Session->read('Auth.User.Imobiliaria.nivel') == 2 ? $this->Html->link('Imóveis', array('controller' => 'imovels', 'action' => 'index')) : '' ?></li>
            <li><?php echo $this->Html->link('Empreendimentos', array('controller' => 'empreendimentos', 'action' => 'index')) ?></li>
            <li><?php echo $this->Html->link('Estatísticas', array('controller' => 'estatisticas', 'action' => 'index')) ?></li>
        </ul>
    </div>
    <div id="content" class="span9 last">
        <div class="row-fluid">
            <div class="span4">
                <h4 class="verde-pequeno">Cadastrar imóvel</h4>
                <?php echo $this->Html->link('', array('controller' => 'imovels', 'action' => 'add'), array('class' => 'icone-gerenciamento imovel')) ?>
            </div>
            <div class="span4">
                <?php
                echo $this->Form->create(array('type' => 'get')) .
                    $this->Form->input('finalidade', array('label' => 'Finalidade', 'empty' => 'Selecione', 'options' => array(1 => 'Venda', 2 => 'Locação'))) .
                    $this->Form->input('tipo', array('label' => 'Tipo', 'empty' => 'Selecione', 'options' => array('residencial' => 'Residencial', 'comercial' => 'Comercial', 'empreendimento' => 'Empreendimento', 'terreno' => 'Terreno', 'rural' => 'Rural'))) .
                    $this->Form->end(array('label' => 'Filtrar', 'div' => array('class' => 'btn')));
                ?>
            </div>
            <div class="span4 last">
                <?php
                    echo $this->Form->create(array('type' => 'get')) .
                        $this->Form->input('codigo', array('label' => 'Código')) .
                        $this->Form->end(array('label' => 'Pesquisar', 'div' => array('class' => 'btn')));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
    	<div style="margin-top: 20px;"></div>
    	<h2 class="titulo">Imóveis cadastrados</h2>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
        <div class="row-fluid cabecalho">
            <div class="span2 imovel-foto">foto</div>
            <div class="span1 imovel-codigo">código</div>
            <div class="span1 imovel-placa">placa</div>
            <div class="span1 imovel-finalidade">finalidade</div>
            <div class="span1 imovel-tipo">tipo</div>
            <div class="span1 imovel-imovel">imóvel</div>
            <div class="span2 imovel-bairro">bairro</div>
            <div class="span1 imovel-cidade">cidade</div>
            <div class="span2 imovel-opcoes last">
                <div class="row-fluid">
                    <div class="span4">editar</div>
                    <div class="span4">ativo</div>
                    <div class="span4 last">excluir</div>
                </div>
            </div>
        </div>
    	<?php foreach ($imoveis as $imovel) : 
			$foto = '';
			if ($foto = $imovel['Imovel']['foto1']) {
			} elseif ($foto = $imovel['Imovel']['foto2']) {
			} elseif ($foto = $imovel['Imovel']['foto3']) {
			} elseif ($foto = $imovel['Imovel']['foto4']) {
			} elseif ($foto = $imovel['Imovel']['foto5']) {
			} else { $foto = 'http://imoveldointerior.com.br/upload/foto.png'; }
		?>
			<div class="row-fluid imovel">
            	<div class="span2 imovel-foto"><?php echo $this->Html->image($foto) ?></div>
            	<div class="span1 imovel-codigo"><?php echo $imovel['Imovel']['codigo'] ? $imovel['Imovel']['codigo'] : '&nbsp;' ?></div>
            	<div class="span1 imovel-placa"><?php echo $imovel['Imovel']['placa'] ? $imovel['Imovel']['placa'] : '&nbsp;' ?></div>
            	<div class="span1 imovel-finalidade"><?php echo $finalidade[$imovel['Imovel']['intencao']] ?></div>
            	<div class="span1 imovel-tipo"><div class="icone icone-tipo <?php echo $tipo[$imovel['Imovel']['tipo']] ?>"></div></div>
            	<div class="span1 imovel-imovel"><?php echo $especificacao[$imovel['Imovel']['especificacao']] ?></div>
            	<div class="span2 imovel-bairro"><?php echo $imovel['Imovel']['bairroNome'] ? $imovel['Imovel']['bairroNome'] : '&nbsp;' ?></div>
            	<div class="span1 imovel-cidade"><?php echo $imovel['Imovel']['cidadeNome'] ?></div>
            	<div class="span2 imovel-opcoes last">
                	<div class="row-fluid opcoes">
                    	<div class="span4"><?php echo $this->Html->link('', array('controller' => 'imovels', 'action' => 'editar', $imovel['Imovel']['id']), array('class' => 'editar')) ?></div>
                    	<div class="span4"><?php echo $this->Html->link('', array('controller' => 'imovels', 'action' => 'ativar', $imovel['Imovel']['id']), array('class' => 'ativo ' . ($imovel['Imovel']['ativo'] ? 'ativado ' : '') . ($imovel['Imovel']['ativoPeloAdm'] ? '' : 'desativadoPeloAdm'))) ?></div>
                    	<div class="span4 last"><?php echo $this->Html->link('', array('controller' => 'imovels', 'action' => 'excluir', $imovel['Imovel']['id']), array('class' => 'excluir')) ?></div>
                    </div>
                </div>
            </div>
		<?php
        endforeach; 

		echo '<div class="row-fluid paginacao"> <div class="span12">' . 
			$this->Paginator->prev('Anterior', array(), null, array('class' => 'prev disabled')) . 
			$this->Paginator->numbers() . 
			$this->Paginator->next('Próximo', array(), null, array('class' => 'next disabled')) . 
			'</div> </div>';
		?>
        
    </div>
</div>

