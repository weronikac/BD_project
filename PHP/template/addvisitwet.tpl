<div class="wrapper">
<div class="form">
<form name="formvisit">       
<p style="font-weight: bold;">Dodaj rodzaj wizyty oraz jej cenę</p>    
      <table>
          <tr><td><label for="nazwa">Nazwa wizyty:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['nazwa']; ?>" type="text" id="nazwa" name="nazwa" /></td></tr>
		  
          <tr><td><label for="cena">Cena:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['cena']; ?>" type="text" id="cena" name="cena" /></td></tr>
		  
          <tr><td></td>
		  <td><span id="datavis"><input type="button" value="Dodaj" onclick="addvisit()" /></span></td></tr> 
		  
		  <tr><td></td>
		  <td><span id="responsevis"></span></td></tr>
      </table>
  </form>
  
  
  </div>

<div class="list">
<p style="font-weight: bold;">Lista wizyt:</p>
<table style=" padding: 20px; font-size:20px; text-align:center;">
<thead>
		<tr> 
			<th>Nazwa &nbsp&nbsp</th>
			<th>Cena &nbsp&nbsp</th>
    </thead>
 <?php
    if ($data) { 
       foreach ( $data as $row ) { 
       echo '<tr><td>'.$row['nazwa'].'&nbsp</td><td>'.$row['cena'].'</td></tr>' ;
    }}
 ?> 
</table> 

</div>
</div>