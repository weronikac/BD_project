<form name="formanimal">            
      <table>
          <tr><td><label for="imie">Imie:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['imie']; ?>" type="text" id="imie" name="imie" /></td></tr>
		  
          <tr><td><label for="gatunek">Gatunek:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['gatunek']; ?>" type="text" id="gatunek" name="gatunek" /></td></tr>
	  
          <tr><td><label for="rasa">Rasa:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['rasa']; ?>" type="text" id="rasa" name="rasa" /></td></tr>
		  
		  <tr><td><label for="wielkosc">Wielkość:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['wielkosc']; ?>" type="text" id="wielkosc" name="wielkosc" /></td></tr>
		 
		  
          <tr><td></td>
		  <td><span id="datazw"><input type="button" value="Dodaj" onclick="addanimal()" /></span></td></tr> 
		  
		  <tr><td></td>
		  <td><span id="responsezw"></span></td></tr>
      </table>
  </form>