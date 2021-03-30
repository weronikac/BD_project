
<form name="formvacc">       
<p style="font-weight: bold;">Dodaj szczepienie dla zwierzęcia</p>    
      <table>
		  <tr><td><label for="imie">Imię zwierzęcia:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['imie']; ?>" type="text" id="imie" name="imie" /></td></tr>
		  
		  <tr><td><label for="nazwisko">Nazwisko właściciela:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['nazwisko']; ?>" type="text" id="nazwisko" name="nazwisko" /></td></tr>
	  
          <tr><td><label for="nazwa">Rodzaj szczepienia:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['nazwa']; ?>" type="text" id="nazwa" name="nazwa" /></td></tr>
		  
          <tr><td><label for="data">Data: (format: RRRR-MM-DD HH:MM:SS)&nbsp</label></td>
          <td><input value="2021-02-15 14:00:00" type="text" id="data" name="data" /></td></tr>
		  
          <tr><td></td>
		  <td><span id="datavacc"><input type="button" value="Dodaj" onclick="addvaccine()" /></span></td></tr> 
		  
		  <tr><td></td>
		  <td><span id="responsevacc"></span></td></tr>
      </table>
  </form>
