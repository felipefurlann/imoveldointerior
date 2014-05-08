<?php

$conn = @mysql_connect("localhost", "interior", "imv1imv2imv3") or die ("Problemas na conexao.");

$db = @mysql_select_db("interior_site", $conn) or die ("Problemas na conexao");


?>