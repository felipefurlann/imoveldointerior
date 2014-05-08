<?php
$line = $imobiliarias[0]['Imobiliaria'];
$this->Csv->addRow(array_keys($line));
foreach ($imobiliarias as $imobiliaria) {
	$line = $imobiliaria['Imobiliaria'];
	$this->Csv->addRow($line);
}
echo  $this->Csv->render('imobiliarias');
?>