<form name="formlogin">            
      <table>
          <tr><td><label for="email">Email:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['email']; ?>" type="text" id="email" name="email" /></td></tr>
		  
          <tr><td><label for="haslo">Hasło:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['haslo']; ?>" type="password" id="haslo" name="haslo" /></td></tr>
		  
          <tr><td></td>
		  <td><span id="datal"><input type="button" value="Zaloguj" onclick="login()" /></span></td></tr> 
		  
		  <tr><td></td>
		  <td><span id="responsel"></span></td></tr>
          
      </table>
  </form>