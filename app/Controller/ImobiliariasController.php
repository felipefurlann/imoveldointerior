<?php

class ImobiliariasController extends AppController {

	var $layout = 'login';

	

	public function beforeFilter () {

		$this->layout = 'login';

		parent::beforeFilter();

		$this->Auth->allow(array('login', 'esqueciMinhaSenha'));

	}

	

	public function login() {

		$this->layout = 'login';

		if ($this->request->is('post')) {

			if ($this->Auth->login($this->Imobiliaria->find('first', array('conditions' => array('username' => $this->request->data['Imovel']['username'], 'password' => AuthComponent::password($this->request->data['Imovel']['password'])))))) 

				return $this->redirect(
        array('controller' => 'imovels', 'action' => 'index'));

			else 

				$this->Session->setFlash('Verifique login e senha', 'default', array(), 'auth');

		}

	}

	

	public function esqueciMinhaSenha() {

		if ($this->request->is('post') && $data = $this->request->data) {

			if ($user = $this->Imobiliaria->find('first', array('conditions' => array('email' => $data['email'])))) {

				$mensagem = 'Seu e-mail: ' . $user['Imobiliaria']['email'] . "\r\n";

				$mensagem .= 'Seu login: ' . $user['Imobiliaria']['username'] . "\r\n";

				$mensagem .= 'Sua senha: ' . $user['Imobiliaria']['senha'] . "\r\n";

				

				$mensagem .= 'Use esse link para acessar sua conta: ' . Router::url(array('controller' => '', 'action' => 'index'), true) . "\r\n";

				if ($this->_mail($mensagem, $data['email'])) $this->Session->setflash('E-mail enviado.');

				else $this->Session->setflash('Erro ao enviar e-mail.');

			} else $this->Session->setflash('E-mail não encontrado.');

			return $this->_toHome();

		}

	}



	public function logout() { $this->redirect($this->Auth->logout()); }

}

?>