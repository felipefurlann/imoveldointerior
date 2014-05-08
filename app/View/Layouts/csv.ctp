<?php 
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=exportar.csv');
echo $content_for_layout; 
?>