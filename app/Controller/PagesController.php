<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {
	public $name = 'Pages';
	public $uses = array();
	
	public function display() {
		return $this->redirect(array('controller' => $this->Session->read('Auth.Imobiliaria.nivel') == 2 ? 'imovels' : 'empreendimentos', 'action' => 'index'));
	}
	
	 public function pegarBairros ($cidade = null) {
	    $this->layout = 'json';
	    $result = array();

	    if (in_array($_REQUEST['cidade'], array_keys($this->cidade))) {
	        /*$this->loadModel('Bairro');
	        $bairros = $this->Bairro->find('list','fields' => array('id','bairro'), 'conditions' => array('cidade' => $this->cidade[$_REQUEST['cidade']]));
	        foreach ($bairros as $id => $bairro) {
	            if (!empty($bairro)){
	                $result[$id] = $bairro;
	                $arr = $result;
	                json_encode($arr);
	            }
	     }
	    } else $result[] = 'error';*/

	    include 'banco.php';

	    $cidade = $this->cidade[$_REQUEST['cidade']];

	    $bairros = array();
	    $sql = mysql_query("SELECT * FROM bairros WHERE cidade  = '$cidade' ");
	    while($result = mysql_fetch_array($sql)){
	    	$id = $result['id'];
	    	$bairros[$id] = $result['bairro'];


	    }
	    	    	json_encode($bairros);
	}else $bairros[] = 'sem bairros';
		$this->set('data', $bairros);

	}

	private function getCidadeIdByNome ($nome = '') {
		foreach ($this->cidades as $id => $cidade) 
			if ($cidade == $nome) return $id;
	}
}
