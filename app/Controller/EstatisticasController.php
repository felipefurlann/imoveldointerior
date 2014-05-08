<?php

class EstatisticasController extends AppController {

	public $name = 'Estatisticas';

	public $uses = array('Pageview', 'Imovel');

	public $paginate = array();

	

	public function index() {

		$creator = $this->Session->read('Auth.User.Imobiliaria.id');

		$meses = array('', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');

		# Gráfico

		$periodos = array('d' => 'Dia', 's' => 'Semana', 'm' => 'Mês');

		$result = array(); $periodo = 'd';

		if (isset($_REQUEST['periodo']) && in_array($_REQUEST['periodo'], array_keys($periodos)))

			$periodo = $_REQUEST['periodo'];

		

		if ($periodo == 'd') {

			for ($i = 16; $i--;) { 

				$date = getdate(strtotime("-$i days"));

				$dia = $date['mday'];

				$mes = $date['mon'];

				$ano = $date['year'];

				

				$pageview['data'] = "$dia/" . $meses[$mes];

				$pageview['i'] = $this->Pageview->find('count', array('conditions' => array('model' => 'imovel', 'day(`created`)' => $dia, 'month(`created`)' => $mes, 'year(`created`)' => $ano, 'creator' => $creator)));

				$pageview['e'] = $this->Pageview->find('count', array('conditions' => array('model' => 'empreendimento', 'day(`created`)' => $dia, 'month(`created`)' => $mes, 'year(`created`)' => $ano, 'creator' => $creator)));

				

				$result[] = $pageview;

			}

		} elseif ($periodo == 's') {

			for ($i = 8; $i; $i--) { 

				$segundaFeira = strtotime("-$i Monday");

				$date = getdate($segundaFeira);

				$dia = $date['mday'];

				$mes = $date['mon'];

				$ano = $date['year'];

error_reporting(0);
				$pageview = array('data' => "$dia/" . $meses[$mes], 'i' => 0, 'e' => 0);

				

				for ($j = 0; $j < 7; $j++) {

					$dataDentroDaSemana = getdate(strtotime("+$j day", $segundaFeira));

					$diaDentroDaSemana = $dataDentroDaSemana['mday'];

					$mesDentroDaSemana = $dataDentroDaSemana['mon'];

					$anoDentroDaSemana = $dataDentroDaSemana['year'];

					$pageview['i'] += $this->Pageview->find('count', array('conditions' => array('model' => 'imovel', 'day(`created`)' => $diaDentroDaSemana, 'month(`created`)' => $mesDentroDaSemana, 'year(`created`)' => $anoDentroDaSemana, 'creator' => $creator)));

					$pageview['e'] += $this->Pageview->find('count', array('conditions' => array('model' => 'empreendimento', 'day(`created`)' => $diaDentroDaSemana,  'month(`created`)' => $mesDentroDaSemana, 'year(`created`)' => $anoDentroDaSemana,'creator' => $creator)));

				} $result[] = $pageview;

			}

		} elseif ($periodo == 'm') {

			for ($i = 8; $i--;) { 

				$date = getdate(strtotime("-$i month"));

				$mes = $date['mon'];

				$ano = $date['year'];

				

				$pageview['data'] = $meses[$mes] . "/$ano";

				$pageview['i'] = $this->Pageview->find('count', array('conditions' => array('model' => 'imovel', 'month(`created`)' => $mes, 'year(`created`)' => $ano, 'creator' => $creator)));

				$pageview['e'] = $this->Pageview->find('count', array('conditions' => array('model' => 'empreendimento', 'month(`created`)' => $mes, 'year(`created`)' => $ano, 'creator' => $creator)));

				

				$result[] = $pageview;

			}

		}

		

		$this->set('pageviews', $result);

		$this->set('periodo', $periodo);

		$this->set('periodos', $periodos);

		

		# Mais vistos

		$maisVistos = array();

		

		$imoveis = $this->Imovel->find('all', array('conditions' => array('creator' => $creator)));

		foreach ($imoveis as $imovel) { $imovel = $imovel['Imovel'];

			$maisVistos[$this->Pageview->find('count', array('conditions' => array('model_id' => $imovel['id'], 'model' => 'imovel')))] = 

				$this->especificacao[$imovel['especificacao']].' em Rio Claro - '.$imovel['codigo'];;

		}

		

		$this->set('imoveis', $imoveis);

		$this->set('maisVistos', $maisVistos);

	}

}

