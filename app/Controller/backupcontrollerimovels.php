<?php	include 'banco.php';
class ImovelsController extends AppController {
	public $uses = array('Imovel', 'Cidade', 'Cep', 'Imobiliaria');
	
	public function beforeFilter () {
		parent::beforeFilter();
		if ($this->Session->read('Auth.User.Imobiliaria.nivel') != 2) return $this->_toHome();
	}
	
	public function index() {
	

		/*$sql = mysql_query("SELECT * FROM imovels");
		while($result = mysql_fetch_array($sql)){
		 $codigo = $result['codigo'];$placa = $result['placa'];$tipo = $result['tipo'];		$cidade = $result['cidade'];		$cidadeNome = $result['cidadeNome'];		$bairro = $result['bairro'];		$bairroNome = $result['bairroNome'];		$intencao = $result['intencao'];		$especificacao = $result['especificacao'];		$endereco = $result['endereco'];		$valor = $result['valor'];		$condominio = $result['condominio'];		$salas = $result['salas'];		$dormitorios = $result['dormitorios'];		$suites = $result['suites'];		$banheiros = $result['banheiros'];		$garagem = $result['garagem'];		$complemento = $result['complemento'];		$areaConstruida = $result['areaConstruida'];		$areaTotal = $result['areaTotal'];		$descricao = $result['descricao'];		$geolocalizacao = $result['geolocalizacao'];		$video = $result['video'];		$foto1 = $result['foto1'];		$foto2 = $result['foto2'];		$foto3 = $result['foto3'];		$foto4 = $result['foto4'];		$foto5 = $result['foto5'];		$foto6 = $result['foto6'];		$legendaFoto1 = $result['legendaFoto1'];		$legendaFoto2 = $result['legendaFoto2'];		$legendaFoto3 = $result['legendaFoto3'];		$legendaFoto4 = $result['legendaFoto4'];		$legendaFoto5 = $result['legendaFoto5'];		$legendaFoto6 = $result['legendaFoto6'];		$destaque = $result['destaque'];			if($codigo == NULL or $placa == NULL or			$tipo == NULL or $cidade == NULL or 			$cidadeNome == NULL or 			$bairro == NULL or 			$bairroNome == NULL or			$intencao == NULL or 			$especificacao == NULL or			$valor == NULL or 			$condominio == NULL or			$salas == NULL or 			$dormitorios == NULL or 			$suites == NULL or 			$banheiros == NULL or 		$garagem == NULL or 			$complemento == NULL or 			$areaConstruida == NULL or 			$areaTotal == NULL or 			$descricao == NULL or 
			$geolocalizacao == NULL){
				$texto = 'Sob Consulta';
				$insere = mysql_query("UPDATE imovels SET codigo  = '$texto' WHERE codigo is null");
				$insere = mysql_query("UPDATE imovels SET placa = '$texto' WHERE placa is null");
				$insere = mysql_query("UPDATE imovels SET tipo = '$texto'WHERE tipo is null");
				$insere = mysql_query("UPDATE imovels SET cidadeNome = '$texto' WHERE cidadeNome is null");
				$insere = mysql_query("UPDATE imovels SET cidade = '$texto' WHERE cidade is null");
				$insere = mysql_query("UPDATE imovels SET bairro = '$texto' WHERE bairro is null");
				$insere = mysql_query("UPDATE imovels SET bairroNome = '$texto' WHERE bairroNome is null");
				$insere = mysql_query("UPDATE imovels SET intencao = '$texto' WHERE intencao is null");
				$insere = mysql_query("UPDATE imovels SET especificacao = '$texto' WHERE especificacao is empty");
				$insere = mysql_query("UPDATE imovels SET valor = '$texto' WHERE valor is null");
				$insere = mysql_query("UPDATE imovels SET condominio = '$texto' WHERE condominio is null");
				$insere = mysql_query("UPDATE imovels SET salas = '$texto' WHERE salas is null");
				$insere = mysql_query("UPDATE imovels SET dormitorios = '$texto' WHERE dormitorios = ''");
				$insere = mysql_query("UPDATE imovels SET suites = '$texto' WHERE suites = ''");
				$insere = mysql_query("UPDATE imovels SET banheiros = '$texto' WHERE banheiros = ''");
				$insere = mysql_query("UPDATE imovels SET complemento = '$texto' WHERE complemento = ''");
				$insere = mysql_query("UPDATE imovels SET garagem = '$texto' WHERE garagem = '' ");
				$insere = mysql_query("UPDATE imovels SET areaConstruida = '$texto' WHERE areaConstruida is null");
				$insere = mysql_query("UPDATE imovels SET areaTotal = '$texto' WHERE areaTotal is null");
				$insere = mysql_query("UPDATE imovels SET descricao = '$texto' WHERE descricao is null");
				$insere = mysql_query("UPDATE imovels SET geolocalizacao = '$texto' WHERE geolocalizacao is null");
			}
		}*/

		$this->setBairros();
		$data = (array)((array)$_POST + (array)$_GET);
		$cond = array();

		if (isset($data['codigo']) && is_numeric(trim($data['codigo'])))
			$cond['codigo like'] = trim($data['codigo']) . "%";
			
		if (isset($data['tipo']) && in_array($data['tipo'], array_keys($this->tipos)))
			$cond['tipo'] = $data['tipo'];
			
		if (isset($data['finalidade']) && in_array($data['finalidade'], array_keys($this->finalidade)))
			$cond['intencao'] = $data['finalidade'];
			
		$this->paginate = $this->getPaginate($cond);
		$this->set('imoveis', $this->paginate('Imovel'));	        
	}
	
	public function imoveisPorCidade ($cidade = null) {
		$this->layout = 'json';
		if ($cidade = (isset($_REQUEST['cidade']) ? $_REQUEST['cidade'] : $cidade)) {
			$this->set('data', $this->Imobiliaria->find('list', array('fields' => array('id', 'nome'), 'conditions' => array('cidade' => $cidade))));
		} else {
			$this->set('data', array('error' => 1));
		}
	}
	
	public function add () {
		        if ( !empty($this->request->data) ){ 
		                $data = $this->request->data;

		                if ($data['Imovel']['opcoes']) $data['Imovel']['opcoes'] = implode(';', $data['Imovel']['opcoes']);
		                $data['Imovel']['ativo'] = $data['Imovel']['ativoPeloAdm'] = 1;
		                $data['Imovel']['creator'] = $data['Imovel']['modifier'] = $this->Session->read('Auth.User.Imobiliaria.id');
		                if ($data['Imovel']['bairro']) {
		                	$this->loadModel('Bairro');
		                    $bairro = $this->Bairro->find('first', array('conditions' => array('id' => $data['Imovel']['bairro']), 'order' => array('bairro ASC')));
		                    $bairroRioClaro = $this->Bairro->find('first', array('conditions' => array('cidade' => 'rioclaro')));
		                    $this->set('bairrosRioClaro',$bairroRioClaro);

		                    $data['Imovel']['bairroNome'] = $bairro['Bairro']['bairro'];
		                }

		                if ($data['Imovel']['cidade']) {
		                    $cidade = $this->Cidade->find('first', array('conditions' => array('id' => $data['Imovel']['cidade'])));
		                    $data['Imovel']['cidadeNome'] = $cidade['Cidade']['nome'];
		                }

		                /*if(empty($data['foto1'])){}else {$foto1 = $data['foto1'];}
		                if(empty($data['foto2'])){}else {$foto2 = $data['foto2'];}
		                if(empty($data['foto3'])){}else {$foto3 = $data['foto3'];}
		                if(empty($data['foto4'])){}else {$foto4 = $data['foto4'];}
		                if(empty($data['foto5'])){}else {$foto5 = $data['foto5'];}
		                if(empty($data['foto6'])){}else {$foto6 = $data['foto6'];}*/


		            $data['Imovel']['especificacao'] = $data['Imovel']['imovel'];
		            if ($this->Imovel->save($data)){
		            	/*$lastCreated = $this->Imovel->find('first', array('order' => array('created' => 'desc')));
		            	$id = $lastCreated['Imovel']['id'];
 						if(empty($foto1)){
		                }else{
		                	@$foto1 = str_replace("", "",microtime()).".".strtolower(end(explode(".", $foto1)));
		                	$sql = @mysql_query("UPDATE imovels SET foto1 = '$foto1' WHERE id = '$id' ");
		                	$dir = "img";
		                	$caminho = WWW_ROOT.$dir.DS; 
		                	echo $caminho;
		                	$move_imagem = move_uploaded_file ($foto1, $caminho);
		                	//$move_imagem = move_uploaded_file($foto1,$caminho);	
		                	if($move_imagem){echo 'moveu imagem';}else{echo 'nao moveu';}
		                  }
		                if(empty($foto2)){
		                }else{
		                	@$foto2 = str_replace(" ", "",microtime()).".".strtolower(end(explode(".", $foto2)));
		                	$sql = mysql_query("UPDATE imovels SET foto2 = '$foto2' WHERE id = '$id' ");
		                  }
		                if(empty($foto3)){
		                }else{
		                	@$foto3 = str_replace(" ", "",microtime()).".".strtolower(end(explode(".", $foto3)));
		                	$sql = mysql_query("UPDATE imovels SET foto3 = '$foto3' WHERE id = '$id' ");
		                  }
		                if(empty($foto4)){
		                }else{
		                	@$foto4 = str_replace(" ", "",microtime()).".".strtolower(end(explode(".", $foto4)));
		                	$sql = mysql_query("UPDATE imovels SET foto4 = '$foto4' WHERE id = '$id' ");
		                  }
		                if(empty($foto5)){
		                }else{
		                	@$foto5 = str_replace(" ", "",microtime()).".".strtolower(end(explode(".", $foto5)));
		                	$sql = mysql_query("UPDATE imovels SET foto5 = '$foto5' WHERE id = '$id' ");
		                  }
		                if(empty($foto6)){
		                }else{
		                	@$foto6 = str_replace(" ", "",microtime()).".".strtolower(end(explode(".", $foto6)));
		                	$sql = mysql_query("UPDATE imovels SET foto6 = '$foto6' WHERE id = '$id' ");
		                  }*/

		            	//$this->redirect(array('action' => 'index'));
		            }           
		        }
		}
	
	public function editar($id = null) {

			    if (!$id) return $this->redirect(array('action' => 'index'));
			    $imovel = $this->Imovel->read(null, $id);
			    
			    if ($imovel['Imovel']['creator'] != $this->Session->read('Auth.User.Imobiliaria.id')) return $this->redirect(array('action' => 'index'));

			    if (empty($this->request->data)) {

			        $this->set('imovel', $imovel);
			        $id_cidade = $imovel['Imovel']['cidade'];
			        $id_bairro = $imovel['Imovel']['bairroNome'];

			        $this->set('bairroSelected', $id_bairro);
			        $this->set('cidadeSelected', $id_cidade);

			        // Carrega todas as cidades
			        $this->loadModel('Cidade');
			        $cidades = $this->Cidade->find('list', array('fields' => array('id', 'nome')));
			        $this->set('cidades', $cidades);

			        // Carrega todos os bairros
			        $this->loadModel('Bairro');
			        $bairros = $this->Bairro->find('list', array('fields' => array('id', 'bairro'), 'conditions' => array('cidade' => $imovel['Imovel']['cidadeNome']), 'order' => array('bairro ASC')));
			        $this->set('bairros', $bairros);

			        $especificacoes = array();
			        $tipo = $imovel['Imovel']['tipo'];
			        if ($tipo == 'residencial') {
			            $especificacoes = array(
			                1 => 'Casa',
			                2 => 'Apartamento',
			                3 => 'Condomínio',
			                4 => 'Chácara',
			                5 => 'Kitnet',
			                6 => 'Temporada'
			            );
			        } elseif ($tipo == 'comercial') {
			            $especificacoes = array(
			                7 => 'Barracão', 
			                8 => 'Salas comerciais', 
			                9 => 'Ponto comercial', 
			            );
			        } elseif ($tipo == 'empreendimento') {
			            $especificacoes = array(
			                10 => 'Comercial', 
			                11 => 'Residencial', 
			            );
			        } elseif ($tipo == 'terreno') {
			            $especificacoes = array(
			                12 => 'Comercal', 
			                13 => 'Residencial', 
			                14 => 'Com./Res.', 
			            );
			        } elseif ($tipo == 'rural') {
			            $especificacoes = array(
			                15 => 'Fazenda', 
			                16 => 'Sítio', 
			                17 => 'Chácara', 
			            );
			        } else {
			            $especificacoes = null;
			        }
			        $this->set('especificacoes', $especificacoes);
			        $this->set('data', $imovel);

			    } else {
			        $data = $this->request->data;

			        if ($data['Imovel']['opcoes']) $data['Imovel']['opcoes'] = implode(';', $data['Imovel']['opcoes']);
			        $data['Imovel']['modifier'] = $this->Session->read('Auth.User.Imobiliaria.id');
			        $data['Imovel']['especificacao'] = $data['Imovel']['imovel'];
			        if ($data['Imovel']['bairro']) {
			        	        $this->loadModel('Bairro');
			            $bairro = $this->Bairro->find('first', array('conditions' => array('id' => $data['Imovel']['bairro'])));
			            $data['Imovel']['bairroNome'] = $bairro['Bairro']['bairro'];
			        }
			        if ($data['Imovel']['cidade']) {
			            $cidade = $this->Cidade->find('first', array('conditions' => array('id' => $data['Imovel']['cidade'])));
			            $data['Imovel']['cidadeNome'] = $cidade['Cidade']['nome'];
			        }
			        if ($this->Imovel->save($data)) return $this->redirect(array('action' => 'index'));
			        $this->set('data', $data);

			    }
	}
				
	public function excluir ($id = null) {
		if (!$id) return $this->redirect(array('action' => 'index'));
		$imovel = $this->Imovel->read(null, $id);
		if ($imovel['Imovel']['creator'] != $this->Session->read('Auth.User.Imobiliaria.id')) return $this->redirect(array('action' => 'index'));
		$this->Imovel->delete($id);
		$this->redirect(array('action' => 'index'));
	}

	public function ativar($id = null) {
		if (!$id) return $this->redirect(array('action' => 'index'));
		$imovel = $this->Imovel->read(null, $id);
		if ($imovel['Imovel']['creator'] != $this->Session->read('Auth.User.Imobiliaria.id')) return $this->redirect(array('action' => 'index'));
		$data['Imovel']['modifier'] = $imovel['Imovel']['creator'];
		if ($imovel['Imovel']['ativoPeloAdm']) $imovel['Imovel']['ativo'] = !$imovel['Imovel']['ativo'];
		$this->Imovel->save($imovel);
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


