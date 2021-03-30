<form name="formclinic">            
      <table>
          <tr><td><label for="miasto">Miasto:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['miasto']; ?>" type="text" id="miasto" name="miasto" /></td></tr>
		  
          <tr><td><label for="ulica">Ulica:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['ulica']; ?>" type="text" id="ulica" name="ulica" /></td></tr>
	  
          <tr><td><label for="numer_budynku">Numer budynku:</label></td>
          <td><input value="<?php if(isset($formData)) echo $formData['numer_budynku']; ?>" type="text" id="numer_budynku" name="numer_budynku" /></td></tr>	 
		  
          <tr><td></td>
		  <td><span id="datac"><input type="button" value="Dodaj" onclick="addclinic()" /></span></td></tr> 
		  
		  <tr><td></td>
		  <td><span id="responsec"></span></td></tr>
      </table>
  </form>