<!DOCTYPE html>
 
<html>
    <head>
        <meta charset="utf-8" />
        <title>Klinika</title>
        <?php echo $css ; ?>      
		<script type="text/JavaScript" src="js/login.js"></script> 
    </head>
    <body>  
        <header>   
          <h1><?php echo $title; ?></h1>
        </header>
        <nav class="sidenav"><?php echo $menu ; ?></nav>
        <section>
              <header><?php echo $header; ?></header>
              <article><?php echo $content; ?></article> 
        </section>
        <footer>
          <p>Weronika Ciurej 2021</p>
        </footer>   
    </body>
</html>