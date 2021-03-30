<?php
 
namespace appl  ;
 
abstract class Controller {
  
   protected $css ; 
   protected $menu ; 
   
  
   function __construct() {
      session_start() ;
      $this->css  = "<link rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\" media=\"screen\" >" ;
       if($_SESSION['auth'] == 'USER'){
          $this->menu = file_get_contents('template/menulogin.tpl') ;
       }elseif($_SESSION['auth'] == 'WET'){
         $this->menu = file_get_contents('template/menuwet.tpl') ;
       }else { 
         $this->menu = file_get_contents('template/menu.tpl') ;}
   }

   
 
   static function http404() {
      header('HTTP/1.1 404 Not Found') ;
      print '<!doctype html><html><head><title>404 Not Found</title></head><body><p>Invalid URL</p></body></html>' ;
      exit ;
   }
 
   function __call($name, $arguments)
   {
        self::http404();
   }
 
}
 
?>