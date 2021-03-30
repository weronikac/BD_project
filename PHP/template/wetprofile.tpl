<h2> Moje dane </h2>
<table class="dane">
	<?php
    if ($data) { 
       foreach ( $data as $row ) { 
       echo '<tr><td>Imię: </td>      
    <td>'.$row['imię'].'</td></tr>
	<tr><td>Nazwisko:  &nbsp</td>      
    <td>'.$row['nazwisko'].'</td></tr>
	<tr><td>E-mail: </td>
	<td>'.$row['email'].'</td></tr>' ;
    }}
 ?>
		  
</table> 

