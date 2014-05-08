<?php
class SlideshowsController extends AppController {
	
	var $paginate = array('order' => 'id desc', 'limit' => 5);
	
	public function index() {
		$opts = array();
		$this->set('slideshows', $this->paginate('Slideshow', $opts));
	}

    public function add() {
        if ($this->Session->read('Auth.User.nivel') == 3 && $this->request->is('post')) {
            $this->Slideshow->create(array('creator' => $this->Session->read('Auth.User.id'), 'modifier' => $this->Session->read('Auth.User.id')));
            if ($this->Slideshow->save($this->request->data)) {
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
			$slideshow = $this->Slideshow->read(null, $id);
			if ($this->data) {
				$this->data['Slideshow']['modifier'] = $this->Session->read('Auth.User.id');
				if ($this->Slideshow->save($this->data)) {
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->set('slideshows', $slideshow);
			}
		} else { $this->redirect(array('action' => 'index')); }
	}

	public function delete($id = null) {
		if ($this->Session->read('Auth.User.nivel') == 3) {
			if ($id) $this->Slideshow->delete($id);
			// else $this->Session->setflash('');
		} else { $this->Session->setflash('Você não está autorizado a fazer isso.'); }
		$this->redirect(array('action' => 'index')); 
	}
}