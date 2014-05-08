<?php
class RodapebannersController extends AppController {
	
	var $paginate = array('order' => 'id desc', 'limit' => 5);
	
	public function index() {
		$opts = array();
		$this->set('rodapebanners', $this->paginate('Rodapebanner', $opts));
	}

    public function add() {
        if ($this->Session->read('Auth.User.nivel') == 3 && $this->request->is('post')) {
            $this->Rodapebanner->create(array('creator' => $this->Session->read('Auth.User.id'), 'modifier' => $this->Session->read('Auth.User.id')));
            if ($this->Rodapebanner->save($this->request->data)) {
                $this->Session->setFlash(__('O banner foi salvo com sucesso.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O banner não pôde ser salvo. Tente novamente.'));
            }
        }
    }
	
	public function edit ($id = null) {
		if ($this->Session->read('Auth.User.nivel') == 3) {
			if (!$id) $this->redirect(array('action' => 'index'));
			$rodapebanner = $this->Rodapebanner->read(null, $id);
			if ($this->data) {
				$this->data['Rodapebanner']['modifier'] = $this->Session->read('Auth.User.id');
				if ($this->Rodapebanner->save($this->data)) {
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->set('rodapebanners', $rodapebanner);
			}
		} else { $this->redirect(array('action' => 'index')); }
	}

	public function delete($id = null) {
		if ($this->Session->read('Auth.User.nivel') == 3) {
			if ($id) $this->Rodapebanner->delete($id);
			// else $this->Session->setflash('');
		} else { $this->Session->setflash('Você não está autorizado a fazer isso.'); }
		$this->redirect(array('action' => 'index')); 
	}
}