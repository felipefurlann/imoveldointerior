<?php

$conn = @mysql_connect("localhost", "root", "") or die ("Problemas na conexao.");

$db = @mysql_select_db("imovelrioclaro", $conn) or die ("Problemas na conexao");


?>