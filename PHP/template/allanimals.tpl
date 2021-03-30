<table style=" padding: 20px; font-size:17px; text-align:center;">
<thead>
		<tr> 
			<th>Imię </th>
			<th>&nbsp Gatunek </th>
			<th>&nbsp Rasa</th>
			<th>&nbsp Wielkość </th>
			<th>Właściciel &nbsp</th>
    </thead>
 <?php
    if ($data) { 
       foreach ( $data as $row ) { 
       echo '<tr><td>'.$row['imię'].'</td><td>&nbsp'.$row['gatunek'].'</td><td>&nbsp'.$row['rasa'].'</td><td>&nbsp'.$row['wielkość'].'</td><td>&nbsp'.$row['wlimie']." ".$row['wlnazwisko'].'</td></tr>' ;
    }}
 ?> 
</table> 