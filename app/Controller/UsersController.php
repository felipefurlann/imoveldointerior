<?php

class UsersController extends AppController {

	var $name = 'User';

	var $uses = array('Imobiliaria');

	

	public function beforeFilter () {

		parent::beforeFilter();

	}

	

	public function login() {

		$this->layout = 'login';

		if ($this->request->is('post')) {

			if ($this->Auth->login()) {

				return $this->redirect($this->Auth->redirect());

				// Prior to 2.3 use `return $this->redirect($this->Auth->redirect());`

			} else {

				$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');

			}

		}

	}



	public function logout() {

    	$this->redirect($this->Auth->logout());

	}



	public function esqueciMinhaSenha() {



	}



	public function esqueciMeuLogin() {



	}

}



/*

$this->Administrador->create();

$this->Administrador->save(array(

	'nome' => 'Tarsis de Lima',

	'login' => 'tamivendu', 

	'email' => 'tarsis@planow.com.br',

	'senha' => $this->Auth->password('tarsis'), 

	'creator' => 1, 

	'modifier' => 1, 

));

*/