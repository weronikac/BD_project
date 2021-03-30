<div class="wrapper">
<div class="form">
<form name="formoffice">            
      <table>
          <tr><td><label for="id_budynku">Id budynku:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['id_budynku']; ?>" type="text" id="id_budynku" name="id_budynku" /></td></tr>
		  
          <tr><td><label for="numer_gabinetu">Numer gabinetu:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['numer_gabinetu']; ?>" type="text" id="numer_gabinetu" name="numer_gabinetu" /></td></tr>
		  
          <tr><td></td>
		  <td><span id="dataof"><input type="button" value="Dodaj" onclick="addoffice()" /></span></td></tr> 
		  
		  <tr><td></td>
		  <td><span id="responseof"></span></td></tr>
      </table>
  </form>

</div>

<div class="list">
<p style="font-weight: bold;">Dostępne kliniki:</p>
<table style=" padding: 20px; font-size:17px; text-align:center; width:400px">
<thead>
		<tr> 
			<th>Id </th>
			<th>Miasto </th>
			<th>Ulica </th>
			<th>Nr budynku </th>
    </thead>
 <?php
    if ($data) { 
       foreach ( $data as $row ) { 
       echo '<tr><td>'.$row['id_budynek'].'</td><td>'.$row['miasto'].'</td><td>'.$row['ulica'].'</td><td>'.$row['numer_budynku'].'</td></tr>' ;
    }}
 ?> 
</table> 

</div>
</div>
