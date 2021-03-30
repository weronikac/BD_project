<table style=" padding: 20px; font-size:17px; text-align:center;">

 <?php
 
    if ($data) { 
	echo '<thead>
		<tr> 
			<th>Zwierzę </th>
			<th>Właściciel </th>
			<th>Data wizyty </th>
			<th>Cel wizyty </th>
			<th>Adres kliniki </th>
			<th>Numer gabinetu </th>
			<th>Dolegliwości </th>
    </thead> ';
       foreach ( $data as $row ) { 
	   if($row['dol'] != 'undefined'){
		echo '<tr><td>'.$row['imię'].'</td><td>'.$row['wlasc'].'</td><td>&nbsp'.$row['data'].'</td><td>&nbsp'.$row['cel'].'</td><td>&nbsp'.$row['adres'].'</td><td>&nbsp'.$row['numer_gabinetu'].'</td><td>&nbsp'.$row['dol'].'</td></tr>' ;}
	   else {
		echo '<tr><td>'.$row['imię'].'</td><td>'.$row['wlasc'].'</td><td>'.$row['data'].'</td><td>'.$row['cel'].'</td><td>'.$row['adres'].'</td><td>'.$row['numer_gabinetu'].'</td><td></td></tr>' ;
	   }
		
    }}
	else	echo "Brak umówionych wizyt!";
 ?> 
</table> 