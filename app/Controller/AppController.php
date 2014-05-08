<?php

App::uses('Controller', 'Controller');



class AppController extends Controller {

	public $components = array('Auth', 'Session'), 

		$cidades = array(), 

		$paginate = array(), 

		$finalidade = array(1 => 'Venda', 2 => 'Locação', 3 => 'Temporada', 4 => 'Permuta'), 

		$dormitorios = array(0 => 'Sem dormitório', 1 => '1 dormitório', 2 => '2 dormitórios', 3 => '3 dormitórios', 4 => '4 dormitórios ou mais'), 

		// Suites

		$suites = array(0 => 'Sem suites', 1 => '1 suite', 2 => '2 suites', 3 => '3 suites', 4 => '4 suites ou mais'), 

		$salas = array(0 => 'Sem sala', 1 => '1 sala', 2 => '2 salas', 3 => '3 salas', 4 => '4 salas ou mais'), 

		$tipos = array('residencial' => 'Residencial', 'comercial' => 'Comercial.', 'empreendimento' => 'Empreendimento', 'terreno' => 'Terreno', 'rural' => 'Rural'), 

		$especificacao = array('',  'Casa', 'Apartamento', 'Condomínio', 'Chácara', 'Kitnet', 'Barracão', 'Salas comerciais', 'Ponto comercial', 'Come.', 'Res.', 'Comercial', 'Residencial', 'Com./Res.', 'Fazenda', 'Sítio', 'Chácara');

	

	public $uses = array('Pageview', 'Empreendimento', 'Imovel');

		

	public function beforeFilter() {

		$this->loadModel('Cidade');

		$this->cidade = $this->Cidade->find('list', array ('fields' => array('id','nome')));

		$this->set('Cidades',$this->cidade);

		$this->loadModel('Bairro');

		$this->bairro = $this->Bairro->find('list', array ('fields' => array('id','bairro'),'conditions' => array('cidade' => 'Rio Claro'),'order' => array('bairro ASC')));

		$this->set('Bairros',$this->bairro);


		$this->Auth->authenticate = array('all' => array('userModel' => 'Imobiliaria'));

		$this->Auth->loginAction = array('controller' => 'imobiliarias', 'action' => 'login');

		$this->set('cidades', $this->cidades);

		

		$this->uses = array('Imovel', 'Cep', 'Cidade');

		$this->set('finalidade', $this->finalidade);

		$this->set('dormitorios', $this->dormitorios);

		$this->set('suites', $this->suites);

		$this->set('salas', $this->salas);

		$this->set('banheiros', array(0 => 'Sem banheiro', 1 => '1 banheiro', 2 => '2 banheiros', 3 => '3 banheiros', 4 => '4 banheiros ou mais'));

		$this->set('garagens', array(0 => 'Sem garagem', 1 => 'Para 1 carro', 2 => 'Para 2 carros', 3 => 'Para 3 carros', 4 => 'Para 4 carros ou mais'));

		$this->set('tipo', $this->tipos);

		$this->set('mais_opcoes', array('alarme' => 'Alarme', 'cercaeletrica' => 'Cerca elétrica', 'porteiro' => 'Porteiro', 'sauna' => 'Sauna', 'aquecimento' => 'Aquecimento', 'churrasqueira' => 'Churrasqueira', 'piscina' => 'Piscina', 'qpoliesportiva' => 'Quadra poliesportiva', 'campofutebol' => 'Campo de futebol', 'cfechado' => 'Condomínio fechado', 'playground' => 'Playground', 'qtenis' => 'Quadra de tênis', 'canil' => 'Canil', 'edicula' => 'Edícula', 'peletronico' => 'Portão eletrônico', 'sfestas' => 'Salão de festas'));

		$this->set('especificacao', $this->especificacao);

		$this->set('cidadesSP', $this->cidades);

		$this->Session->setFlash($this->Session->read('Auth.User.Imobiliaria.observacoes'), 'default', array(), 'observacao');

	}

	

	protected function _toHome() { return $this->redirect(array('controller' => '', 'action' => 'index')); }

	

	protected function getBairrosDaCidade($cidade = '', $uf = 'sp') {

		

	}

	

	protected function setBairros () {

		$this->set('bairrosSP', $this->Cep->find('list', array('fields' => array('id', 'bairro'), 'conditions' => array('uf_sigla' => 'sp'), 'order' => array('bairro'), 'group' => array('bairro'))));

	}

	

	protected function getPaginate ($cond = array()) {

		$paginate = array('limit' => 10, 'conditions' => array_merge($cond, array('creator' => $this->Session->read('Auth.User.Imobiliaria.id'))));

		return $this->paginate = $paginate;

	}

	

	protected function _capaDoEmpreendimento ($imovel = null, $else = null) { 

		if (isset($imovel['Imovel'])) $imovel = $imovel['Imovel'];

		if (isset($imovel['Empreendimento'])) $imovel = $imovel['Empreendimento'];

		if (!$imovel) return $imovel;

		if (!empty($imovel['foto1'])) return $imovel['foto1']; 

		elseif (!empty($imovel['foto2'])) return $imovel['foto2']; 

		elseif (!empty($imovel['foto3'])) return $imovel['foto3']; 

		elseif (!empty($imovel['foto4'])) return $imovel['foto4']; 

		elseif (!empty($imovel['foto5'])) return $imovel['foto5']; 

		elseif (!empty($imovel['foto6'])) return $imovel['foto6']; 

		elseif (!empty($imovel['foto7'])) return $imovel['foto7']; 

		elseif (!empty($imovel['foto8'])) return $imovel['foto8']; 

		elseif (!empty($imovel['foto9'])) return $imovel['foto9']; 

		elseif (!empty($imovel['foto10'])) return $imovel['foto10']; 

		elseif (!empty($imovel['foto11'])) return $imovel['foto11']; 

		elseif (!empty($imovel['foto12'])) return $imovel['foto12']; 

		elseif (!empty($imovel['bannerTopo'])) return $imovel['bannerTopo']; 

		elseif (!empty($imovel['thumb'])) return $imovel['thumb']; 

		else return !!$else ? $else : '1.png'; 

	}

	

	protected function setBairroDaCidade ($id = null, $nome = null) {

		if (in_array($id, array_keys($this->cidades))) {

			$nome = $this->cidades[$id];

		}

		if (in_array($nome, $this->cidade)); else return $nome;

		$bairros = $this->Cep->find('list', array('fields' => array('id', 'bairro'), 'conditions' => array('uf_sigla' => 'sp', 'cidade' => $nome), 'order' => array('bairro'), 'group' => array('bairro')));

		foreach ($bairros as $i => $bairro) if (empty($bairro)) unset($bairros[$id]);

		$this->set('bairrosDaCidade', $bairros);

		return $bairros;

	}

	

	protected function _mail($mensagem, $destinatario = 'contato@imovelrioclaror.com.br', $assunto = 'Imóvel do Interior', $rementente = 'contato@imovelrioclaror.com.br', $toHome = false) {

		$headers = "MIME-Version: 1.1\r\n";

		$headers .= "Content-type: text/plain; charset=utf-8\r\n";

		$headers .= "From: $rementente\r\n"; // remetente

		$quebra_linha = "\r\n";

		

		$enviado = mail($destinatario, $assunto, $mensagem, $headers, "-r".$rementente);

		if (!$enviado) { 

			$headers .= "Return-Path: " . $emailsender . $quebra_linha; 

			$enviado = mail($destinatario, $assunto, $mensagem, $headers);

		}

		return $toHome ? $this->_toHome() : $enviado;

	}

}