<div class="wrapper">
<div class="formvu">
<form name="formvisituser">       
<p style="font-weight: bold;">Umów swojego zwierzaka na wizytę</p> 
<p>Informacje o weterynarzach i budynkach znajdziesz w zakładce "Dostępni weterynarze" w menu bocznym</p>     
      <table>
		  <tr><td><label for="imie">Imię zwierzęcia:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['imie']; ?>" type="text" id="imie" name="imie" /></td></tr>
		  
		  <tr><td><label for="nazwisko">Nazwisko weterynarza:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['nazwisko']; ?>" type="text" id="nazwisko" name="nazwisko" /></td></tr>
		  
		  <tr><td><label for="id_budynek">Id budynku:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['id_budynek']; ?>" type="text" id="id_budynek" name="id_budynek" /></td></tr>
		  
		  <tr><td><label for="numer_gabinetu">Numer gabinetu:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['numer_gabinetu']; ?>" type="text" id="numer_gabinetu" name="numer_gabinetu" /></td></tr>
	  
          <tr><td><label for="nazwa">Rodzaj wizyty:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['nazwa']; ?>" type="text" id="nazwa" name="nazwa" /></td></tr>
		  
          <tr><td><label for="data">Data: (format: RRRR-MM-DD HH:MM:SS)&nbsp</label></td>
          <td><input value="2021-02-15 14:00:00" type="text" id="data" name="data" /></td></tr>
		  
		  <tr><td><label for="dolegliwosci">Dolegliwości (opcjonalnie):</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['dolegliwosci']; ?>" type="text" id="dolegliwosci" name="dolegliwosci" /></td></tr>

		  
          <tr><td></td>
		  <td><span id="datavu"><input type="button" value="Umów się" onclick="addvisituser()" /></span></td></tr> 
		  
		  <tr><td></td>
		  <td><span id="responsevu"></span></td></tr>
      </table>
  </form>
</div>

<div class="listvu">
<p style="font-weight: bold;">Lista wizyt:</p>
<table style=" padding: 20px; font-size:20px; text-align:center;">
<thead>
		<tr> 
			<th>Nazwa </th>
			<th>Cena </th>
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