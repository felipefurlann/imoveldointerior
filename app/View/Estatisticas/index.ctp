<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load('visualization', '1', {packages: ['corechart']});
</script>
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
            <div class="span12">
            	<!-- Estatisticas -->
                <div class="row-fluid">
					<div class="span3">
                    	<?php echo $this->Form->input('periodo', array('label' => 'Mostrar periodo por', 'default' => $periodo, 'options' => $periodos)) ?>
                    </div>
					<div class="span3 last">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">
        <h4 class="verde-pequeno" style="text-align:left">Estatísticas</h4>
	    <div id="imoveis-data" style="width:1060px;height:315px"> </div>
    </div>
</div>
<div class="row-fluid"><div class="span12"> &nbsp; </div></div>
<div class="row-fluid">
	<div class="span12">
        <h4 class="verde-pequeno" style="text-align:left">Mais vistos</h4>
        <div id="imoveis-mais-vistos">
        	<?php krsort($maisVistos, SORT_NUMERIC); foreach ($maisVistos as $id => $maisVisto) { ?>
            	<div class="row-fluid">
                	<div class="span11">
                    	<?php echo $maisVisto; ?>
                    </div>
                    <div class="span1 last">
                    	<?php echo $id; ?>
                    </div>
                </div>
			<?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
function drawVisualization() {
	// Create and populate the data table.
	var data = google.visualization.arrayToDataTable([
		['Data', 'Imóveis', 'Empreendimentos'],
		<?php foreach ($pageviews as $pageview) echo "['" . $pageview['data'] . "', " . $pageview['i'] . ", " . $pageview['e'] . "]," ?>
	]);

	var options = {
		vAxis: {title: "Visualizações"},
		hAxis: {title: "Datas"},
		seriesType: "bars",
		chartArea: { width: 720 }
	};
	
	var chart = new google.visualization.ComboChart(document.getElementById('imoveis-data'));
	chart.draw(data, options);
}
google.setOnLoadCallback(drawVisualization);

document.getElementById('periodo').onchange = function (e) {
	console.log(e);
	window.location.replace('?periodo=' + e.target.value)
};
</script>