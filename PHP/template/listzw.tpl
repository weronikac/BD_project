

<table style=" padding: 20px; font-size:17px; text-align:center;">
<thead>
		<tr> 
			<th>Imię &nbsp</th>
			<th>Gatunek &nbsp</th>
			<th>Rasa &nbsp</th>
			<th>Wielkość </th>
    </thead>
 <?php
    if ($data) { 
       foreach ( $data as $row ) { 
       echo '<tr><td>'.$row['imię'].'&nbsp</td><td>'.$row['gatunek'].'&nbsp</td><td>'.$row['rasa'].'&nbsp</td><td>'.$row['wielkość'].'</td></tr>' ;
    }}
 ?> 
</table> 
<br>


<a href="index.php?sub=Zwierze&action=add" >Dodaj zwierzę</a>
