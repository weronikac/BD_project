<form name="formregister">            
      <table>
		  <tr><td><label for="imie">Imię:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['imie']; ?>" type="text" id="imie" name="imie" /></td></tr>
		  
		  <tr><td><label for="nazwisko">Nazwisko:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['nazwisko']; ?>" type="text" id="nazwisko" name="nazwisko" /></td></tr>
		  
          <tr><td><label for="email">Email:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['email']; ?>" type="text" id="email" name="email" /></td></tr>
		  
          <tr><td><label for="haslo">Hasło:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['haslo']; ?>" type="password" id="haslo" name="haslo" /></td></tr>
		  
		  <tr><td><label for="nr_tel">Numer telefonu:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['nr_tel']; ?>" type="text" id="nr_tel" name="nr_tel" /></td></tr>
		  
          <tr><td></td>
		  <td><span id="datar"><input type="button" value="Zapisz" onclick="register()" /></span></td></tr>
		  
		  <tr><td></td>
		  <td><span id="responser"></span></td></tr>
		  
      </table>
  </form>