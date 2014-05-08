<?php
class ConstrutorasController extends AppController {
	
	var $uses = array('Construtora', 'Cidade');
	
	var $paginate = array('order' => 'id desc', 'limit' => 30);
	
	var $helpers = array('Html', 'Form', 'Csv'); 
	
	public function index () {
        $this->set('construtoras', $this->paginate());
		$this->set('cidades', $this->cidades);
	}

    public function add() {
        if ($this->Session->read('Auth.User.nivel') == 3 && $this->request->is('post')) {
            $this->Construtora->create(array('creator' => $this->Session->read('Auth.User.id'), 'modifier' => $this->Session->read('Auth.User.id')));
            if ($this->Construtora->save($this->request->data)) {
                $this->Session->setFlash(__('A construtora foi salva com sucesso.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('A construtora não pôde ser salva. Tente novamente.'));
            }
        } else {
			$this->set('cidades', $this->Cidade->find('list', array('fields' => array('id', 'nome'), 'conditions' => array('uf' => 'sp'))));
		}
    }

    public function edit($id = null) {
		if ($this->Session->read('Auth.User.nivel') == 3) {
			$this->Construtora->id = $id;
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Construtora->save($this->request->data)) {
					$this->Session->setFlash(__('A construtora foi salva com sucesso.'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('A construtora não pôde ser salva. Tente novamente.'));
				}
			} else {
				$this->request->data = $this->Construtora->read(null, $id);
				unset($this->request->data['Construtora']['password']);
			}
		}
    }

    public function delete($id = null) {
		if ($this->Session->read('Auth.User.nivel') == 3) {
			$this->Construtora->id = $id;
			if ($this->Construtora->exists()) {
				if ($this->Construtora->delete()) {
					$this->Session->setFlash(__('Imobilária excluído.'));
					$this->redirect(array('action' => 'index'));
				}
			}
		}
    }
	
	public function export() {
		if ($this->Session->read('Auth.User.nivel') == 3) {
			$this->layout = null;
			$this->autoLayout = false;
			$this->set('construtoras', $this->Construtora->find('all'));
		}
	}
}
?>