<h2>Informacje: </h2>
<table class="dane">
	<?php
    if ($data) { 
       foreach ( $data as $row ) { 
       echo '<tr><td>Liczba zapisanych zwierząt: </td>      
    <td>'.$row['l_zwierząt'].'</td></tr>
	<tr><td>Liczba zarejestrowanych weterynarzy:</td>      
    <td>'.$row['l_weterynarzy'].'</td></tr>
	<tr><td>Liczba zarejestrowanych użytkowników: </td>
	<td>'.$row['l_właścicieli'].'</td></tr>
	<tr><td>Liczba zarejestrowanych użytkowników posiadających co najmniej 2 zwierzęta: &nbsp </td>
	<td>'.$row['l_właścicieli2'].'</td></tr>
	<tr><td>Średnia cena za wizytę: </td>
	<td>'.$row['śr_cena'].'</td></tr>' ;
    }}
 ?>

		  
</table> 