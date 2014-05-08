<?php


class BairrosController extends AppController {

    public $helpers = array ('Html','Form');
    public $name = 'Bairros';

    function index() {
        $this->set('bairros', $this->Bairro->find('all'));
    }

    public function view($id = null) {
        $this->Bairro->id = $id;
        $this->set('bairro', $this->Bairros->read());
    }

        public function add() {
        if ($this->request->is('bairro')) {
            if ($this->Bairro->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    function edit($id = null) {
    $this->Bairro->id = $id;
    if ($this->request->is('get')) {
        $this->request->data = $this->Bairro->read();
    } else {
        if ($this->Bairro->save($this->request->data)) {
            $this->Session->setFlash('Your post has been updated.');
            $this->redirect(array('action' => 'index'));
        }
    }
}

function delete($id) {
    if (!$this->request->is('bairro')) {
        throw new MethodNotAllowedException();
    }
    if ($this->Bairro->delete($id)) {
        $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
        $this->redirect(array('action' => 'index'));
    }
}

}

?>