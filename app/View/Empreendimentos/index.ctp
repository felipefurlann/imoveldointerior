<?php //INSERT INTO `thiagocantillana_imoveldointerior`.`bairros` SELECT id, `uf_sigla`, `cep`, `cidade`, `bairro` FROM `thiagocantillana_imoveldointerior`.`ceps` group by bairro order by id ?>
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
                <h4 class="verde-pequeno">Cadastrar empreendimento</h4>
                <?php echo $this->Html->link('', array('controller' => 'empreendimentos', 'action' => 'add'), array('class' => 'icone-gerenciamento empreendimento')) ?>
            </div>
            <div class="span4">
				<?php
                    echo $this->Form->create(array('type' => 'get'));
                    echo $this->Form->input('cidade', array('empty' => 'Selecione', 'label' => 'Pesquisar por cidade', 'optons' => $cidades, 'required'));
                    echo $this->Form->end(array('label' => 'Filtrar', 'div' => array('class' => 'btn')));
                ?>
            </div>
            <div class="span4 last"> &nbsp; </div>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
    	<div style="margin-top: 20px;"></div>
    	<h2 class="titulo">Empreendimentos cadastrados</h2>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
        <div class="row-fluid cabecalho">
            <div class="span2">foto</div>
            <div class="span2">cidade</div>
            <div class="span2">bairro</div>
            <div class="span4">endereço</div>
            <div class="span2 last">
                <div class="row-fluid">
                    <div class="span4">editar</div>
                    <div class="span4">ativo</div>
                    <div class="span4 last">excluir</div>
                </div>
            </div>
        </div>
        <?php include 'banco.php'; ?>


    	<?php


         foreach ($empreendimentos as $empreendimento) : $empreendimento = $empreendimento['Empreendimento'] ?>
			<div class="row-fluid imovel">
                <?php
$empreendimento['thumb'] = strtolower($empreendimento['thumb']);

                ?>
                    <div class="span2"><img src="http://painel.imoveldointerior.com.br/img/<?php echo $empreendimento['thumb']; ?>"></div>
                    <div class="span2"><?php echo $empreendimento['cidadeNome'] ?></div>
                    <div class="span2"><?php echo $empreendimento['bairro'] ?></div>
		            <div class="span4"><?php echo $empreendimento['endereco'] ?></div>
                    <div class="span2 last">
                	<div class="row-fluid opcoes">
                    	<div class="span4"><?php echo $this->Html->link('', array('controller' => 'empreendimentos', 'action' => 'editar', $empreendimento['id']), array('class' => 'editar')) ?></div>
                    	<div class="span4"><?php echo $this->Html->link('', array('controller' => 'empreendimentos', 'action' => 'ativar', $empreendimento['id']), array('class' => 'ativo '. ($empreendimento['ativo'] ? 'ativado ' : '') . ($empreendimento['ativoPeloAdm'] ? '' : 'desativadoPeloAdm'))) ?></div>
                    	<div class="span4 last"><?php echo $this->Html->link('', array('controller' => 'empreendimentos', 'action' => 'excluir', $empreendimento['id']), array('class' => 'excluir')) ?></div>
                    </div>
                </div>
            </div>
		<?php endforeach; echo '<div class="row-fluid paginacao"> <div class="span12">' . 
			$this->Paginator->prev('Anterior', array(), null, array('class' => 'prev disabled')) . 
			$this->Paginator->numbers() . 
			$this->Paginator->next('Próximo', array(), null, array('class' => 'next disabled')) . 
			'</div> </div>'; ?>
    </div>
</div>