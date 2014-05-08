<?php

class EmpreendimentosController extends AppController {

	public $uses = array('Empreendimento', 'Cidade', 'Cep', 'Imobiliaria');

	public $paginate = array();



	public function index() {

		$cond = array();

		if (isset($_REQUEST['cidade']) && in_array($_REQUEST['cidade'], array_keys($this->cidades))) {

			$cond['cidade'] = $_REQUEST['cidade'];

		}

		$this->paginate = $this->getPaginate($cond);

		$empreendimentos = $this->paginate('Empreendimento');

		foreach ($empreendimentos as $id => $empreendimento) {

			$empreendimentos[$id]['Empreendimento']['capa'] = $this->_capaDoEmpreendimento($empreendimento);

			$bairro = $this->Bairro->find('first', array('conditions' => array('id' => $empreendimento['Empreendimento']['bairro'])));

			$empreendimentos[$id]['Empreendimento']['bairro'] = $bairro['Bairro']['bairro'];

		}

		$this->set('empreendimentos', $empreendimentos);

		$this->setBairros();

	}

	

	public function empreendimentosPorCidade ($cidade = null) {

		$this->layout = 'json';

		if ($cidade = (isset($_REQUEST['cidade']) ? $_REQUEST['cidade'] : $cidade)) {

			$this->set('data', $this->Imobiliaria->find('list', array('fields' => array('id', 'nome'), 'conditions' => array('cidade' => $cidade))));

		} else {

			$this->set('data', array('error' => 1));

		}

	}

	

	public function add () {

					// Carrega todas as cidades
			        $this->loadModel('Cidade');
			        $cidades = $this->Cidade->find('list', array('fields' => array('id', 'nome')));
			        $this->set('cidades', $cidades);

			       	$rioclaro = $this->Cidade->find('list', array('fields' => array('id', 'nome'),'conditions' => array('nome' => 'Rio Claro')));


					if (empty($this->request->data)) {

						$this->setBairroDaCidade(null, 'Rio Claro');

					} else {

						$data = $this->request->data['Imovel'];

						$data['modifier'] = $data['creator'] = $this->Session->read('Auth.User.Imobiliaria.id');

						$cidadeNome = $this->Cidade->find('list',array('fields' => array('Cidade.nome'),'conditions' => array('id' => $data['cidade'])));

						$cidadeNome = implode(',', $cidadeNome);

						$data['cidadeNome'] = $cidadeNome;

						if(empty($data['thumb'])){
							$data['thumb'] = 'http://painel.imoveldointerior.com.br/sem-foto.jpg';
						}

						$this->Empreendimento->save($data);

						$this->redirect(array('action' => 'index'));

					}

	}

	

	public function editar ($id = null) {

		if (!$id) return $this->_toHome();

		$empreendimento = $this->Empreendimento->read(null, $id);

		if ($empreendimento['Empreendimento']['creator'] != $this->Session->read('Auth.User.Imobiliaria.id')) return $this->_toHome();

		if (empty($this->request->data)) {

			        $id_cidade = $empreendimento['Empreendimento']['cidade'];
			        $id_bairro = $empreendimento['Empreendimento']['bairroNome'];

			        $this->set('bairroSelected', $id_bairro);
			        $this->set('cidadeSelected', $id_cidade);


							// Carrega todas as cidades
			        $this->loadModel('Cidade');
			        $cidades = $this->Cidade->find('list', array('fields' => array('id', 'nome')));
			        $this->set('cidades', $cidades);

			       	$rioclaro = $this->Cidade->find('list', array('fields' => array('id', 'nome'),'conditions' => array('nome' => 'Rio Claro')));


			        // Carrega todos os bairros
			        $this->loadModel('Bairro');
			        $bairros = $this->Bairro->find('list', array('fields' => array('id', 'bairro'), 'conditions' => array('cidade' => $empreendimento['Empreendimento']['cidadeNome']), 'order' => array('bairro ASC')));
			        $this->set('bairros', $bairros);


			$this->set('empreendimento', $empreendimento = $this->Empreendimento->read(null, $id));

			$this->setBairroDaCidade($empreendimento['Empreendimento']['cidade']);



		} else {

			$empreendimento['Empreendimento'] = array_merge($this->request->data['Imovel'], $this->request->data['Empreendimento']);


			if ($this->Empreendimento->save($empreendimento)) return $this->redirect(array('action' => 'index'));

			$this->set('data', $this->request->data);

		}

	}

	

	public function excluir ($id = null) {

		if (!$id) return $this->_toHome();

		$imovel = $this->Empreendimento->read(null, $id);

		if ($imovel['Empreendimento']['creator'] != $this->Session->read('Auth.User.Imobiliaria.id')) return $this->_toHome();

		$this->Empreendimento->delete($id);

		$this->redirect(array('action' => 'index'));

	}



	public function ativar($id = null) {

		if (!$id) return $this->_toHome();

		$imovel = $this->Empreendimento->read(null, $id);

		if ($imovel['Empreendimento']['creator'] != $this->Session->read('Auth.User.Imobiliaria.id')) return $this->_toHome();

		$data['Empreendimento']['modifier'] = $imovel['Empreendimento']['creator'];

		if ($imovel['Empreendimento']['ativoPeloAdm']) $imovel['Empreendimento']['ativo'] = !$imovel['Empreendimento']['ativo'];

		$this->Empreendimento->save($imovel);

		

		$this->redirect(array('action' => 'index'));

	}

		function buscabairros() {
		
		if($this->request->is('ajax')) {
		$this->layout = 'ajax';
		$this->set('bairros', $this->Bairro->find('all', array('fields' => array('id','bairro'),'order' => array('bairro ASC'), 'conditions' => array('cidade' => $this->request->data['select']))));		    
			// $this->request->data['select'] é a cidade que vem do Ajax
		    }
	}

}