<form name="formaddwet">            
      <table>
		  <tr><td><label for="imie">Imię:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['imie']; ?>" type="text" id="imie" name="imie" /></td></tr>
		  
		  <tr><td><label for="nazwisko">Nazwisko:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['nazwisko']; ?>" type="text" id="nazwisko" name="nazwisko" /></td></tr>
		  
          <tr><td><label for="email">Email:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['email']; ?>" type="text" id="email" name="email" /></td></tr>
		  
          <tr><td><label for="haslo">Hasło:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['haslo']; ?>" type="password" id="haslo" name="haslo" /></td></tr>
		  
          <tr><td></td>
		  <td><span id="datawet"><input type="button" value="Zapisz" onclick="addwet()" /></span></td></tr>
		  
		  <tr><td></td>
		  <td><span id="responsewet"></span></td></tr>
		  
      </table>
  </form>