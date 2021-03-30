<div class="listvu">
<h2>Weterynarze w klinice:</h2>
<table style=" padding: 20px; font-size:20px; text-align:center;">
<thead>
		<tr> 
			<th>Imię </th>
			<th>&nbsp Nazwisko &nbsp</th>
			<th>&nbsp Adres kliniki</th>
			<th>&nbsp Numer gabinetu</th>
    </thead>
 <?php
    if ($data) { 
       foreach ( $data as $row ) { 
       echo '<tr><td>'.$row['imię'].'&nbsp</td><td>'.$row['nazwisko'].'</td><td>'.$row['miasto'].', '.$row['ulica'].' '.$row['numer_budynku'].'</td><td>'.$row['numer_gabinetu'].'</td></tr>' ;
    }}
 ?> 
</table> 

<h2>Budynki:</h2>
<table style=" padding: 20px; font-size:17px; text-align:center; width:400px">
<thead>
		<tr> 
			<th>Id </th>
			<th>Miasto </th>
			<th>Ulica </th>
			<th>Nr budynku </th>
    </thead>
 <?php
    if ($data) { 
       foreach ( $data as $row ) { 
       echo '<tr><td>'.$row['id_budynek'].'</td><td>'.$row['miasto'].'</td><td>'.$row['ulica'].'</td><td>'.$row['numer_budynku'].'</td></tr>' ;
    }}
 ?> 
</table> 