<?php
class Imobiliaria extends AppModel {
    public $validate = array(
        'login' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'senha' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
}