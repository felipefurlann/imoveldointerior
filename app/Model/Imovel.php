<?php

App::uses('AppModel', 'Model');
class Imovel extends AppModel {
    public $name = 'Imovel';
    public $useTable = 'imovels';

    public function beforeSave($options = array()){  
    	for ($i=1; $i < 13 ; $i++) { 
		    if(!empty($this->data['Imovel']['foto'.$i.'']['name'])) {  
		        $this->data['Imovel']['foto'.$i.''] = $this->upload($this->data['Imovel']['foto'.$i.'']);             
		    } else {  
		        unset($this->data['Imovel']['foto'.$i.'']);  
		    }  
    	}
	}  

public function upload($imagem = array(), $dir = 'img')  
{  
	$dir = WWW_ROOT.$dir.DS;   
    if(($imagem['error']!=0) and ($imagem['size']==0)) {  
        throw new NotImplementedException('Alguma coisa deu errado, o upload retornou erro '.$imagem['error'].' e tamanho '.$imagem['size']);  
    }  
  
    $imagem = $this->checa_nome($imagem, $dir);  
  
    $this->move_arquivos($imagem, $dir);  
  
    return $imagem['name'];  
}  

	/**
	 * Verifica se o diretório existe, se não ele cria.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/ 

	/**
	 * Verifica se o nome do arquivo já existe, se existir adiciona um numero ao nome e verifica novamente
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	 * @return nome da imagem
	*/ 
	public function checa_nome($imagem, $dir)
	{
		$imagem_info = pathinfo($dir.$imagem['name']);
		$imagem_nome = $this->trata_nome($imagem_info['filename']).'.'.$imagem_info['extension'];

		$conta = 2;
		while (file_exists($dir.$imagem_nome)) {
			$imagem_nome  = $this->trata_nome($imagem_info['filename']).'-'.$conta;
			$imagem_nome .= '.'.$imagem_info['extension'];
			$conta++;
		}
		$imagem['name'] = $imagem_nome;
		return $imagem;
	}

	/**
	 * Trata o nome removendo espaços, acentos e caracteres em maiúsculo.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/ 
	public function trata_nome($imagem_nome)
	{
		$imagem_nome = strtolower(Inflector::slug($imagem_nome,'-'));
		return $imagem_nome;
	}

	/**
	 * Move o arquivo para a pasta de destino.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/ 
	public function move_arquivos($imagem, $dir)
	{
		App::uses('File', 'Utility');
		$arquivo = new File($imagem['tmp_name']);
		$arquivo->copy($dir.$imagem['name']);
		$arquivo->close();
	}






}

?>