<option value="">Selecione</option>
<?php foreach($bairros as $bairro): ?>
<option value="<?php echo $bairro['Bairro']['id']; ?>"> <?php echo $filial['Bairro']['bairro']; ?></option>
<?php endforeach ?>