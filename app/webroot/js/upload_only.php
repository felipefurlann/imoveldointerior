<?php header('Access-Control-Allow-Origin: *'); error_reporting(0);

if (!($arq = (isset($_FILES['arq']) ? $_FILES['arq'] : false))) exit;


// preparando...

$pasta = 'f'; $request = isset($_REQUEST) ? $_REQUEST : false; $img;

$nome = date('dmYHis') . rand(1, 10000);

$ext = substr(preg_replace('/[^a-zA-Z0-9.]/', '', $arq['name']), strrpos(preg_replace('/[^a-zA-Z0-9.]/', '', $arq['name']), '.'));

$caminho = $pasta . '/' . $nome . $ext;

$redimensiona = isset($request['redimensiona']);

$tamanho = isset($request['tamanho']) ? $request['tamanho'] : 1200;



list($w, $h, $t, $a) = getimagesize($arq['tmp_name']);



// carregando...

if ($redimensiona) {

	include 'canvas.php'; $img = new canvas($arq['tmp_name']);

	if ($w > $tamanho || $h > $tamanho) $w > $h ? $img->redimensiona($tamanho, '', 'proporcional') : $img->redimensiona('', $tamanho, 'proporcional'); 	

} else move_uploaded_file($arq['tmp_name'], $caminho);



echo json_encode(array_merge(array(

	'nome' => preg_replace('/[^a-zA-Z0-9.]/', '', $arq['name']), 

	'caminho' => 'http://' . $_SERVER['HTTP_HOST'] . '/' . $caminho, 

	'size' => $arq['size'], 

	'type' => $arq['type'], 

	'redimensiona' => $redimensiona, 

	'tamanho' => $tamanho, 

	'_width' => $w, 

	'_height' => $h, 

), $_REQUEST));

if ($redimensiona) $img->grava($caminho);



chmod($caminho, 0755);

?>