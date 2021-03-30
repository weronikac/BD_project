<table style=" padding: 20px; font-size:17px; text-align:center;">

 <?php
 
    if ($data) { 
	echo '<thead>
		<tr> 
			<th>Zwierzę </th>
			<th>&nbsp Właściciel </th>
			<th>&nbsp Data szczepienia </th>
			<th>&nbsp Nazwa szczepienia </th>
    </thead> ';
       foreach ( $data as $row ) { 
		echo '<tr><td>'.$row['imię'].'</td><td>&nbsp'.$row['właściciel'].'</td><td>&nbsp'.$row['data'].'</td><td>&nbsp'.$row['nazwa'].'</td></tr>' ;}

		
    }
	else	echo "Brak zaszczepionych zwierząt!";
 ?> 
</table> 