<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost', 'login' => 'interior', 'password' => 'imv1imv2imv3', 'database' => 'interior_site',
		// 'host' => '186.202.152.20', 'login' => 'thiag_imoveldoin', 'password' => 'th1th2th3', 'database' => 'thiagocantillana_imoveldointerior',
		// 'host' => 'localhost', 'login' => 'root', 'password' => 'planow', 'database' => 'imoveldointerior',
		'prefix' => '',
		'encoding' => 'utf8',
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
		'prefix' => '',
		//'encoding' => 'utf8',
	);
}
