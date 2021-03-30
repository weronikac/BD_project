function register(){
  if(!document.getElementById("imie")) alert("Brak wpisanego imienia");
  else if(!document.getElementById("nazwisko")) alert("Brak wpisanego nazwiska");
  else if(!document.getElementById("email")) alert("Brak wpisanego adresu email");
  else if(!document.getElementById("haslo")) alert("Brak wpisanego hasła");
  else if(!document.getElementById("nr_tel")) alert("Brak wpisanego numeru telefonu");
  else{
    var imie = document.getElementById("imie").value ;
    var nazwisko = document.getElementById("nazwisko").value ;
    var email = document.getElementById("email").value ;
     var haslo = document.getElementById("haslo").value ;
     var nr_tel = document.getElementById("nr_tel").value ;
     document.getElementById("datar").style.display = "none" ;
     json_data = "{\"imie\":\"" + imie + "\",\"nazwisko\":\"" + nazwisko + "\",\"email\":\"" + email + "\",\"haslo\":\"" + haslo +  "\",\"nr_tel\":\"" + nr_tel +  "\"}" ;
     var msg = "datar=" + encodeURIComponent(json_data) ;                                    
     url = "index.php?sub=User&action=saveReg" ;
     resp = function(response) {
        document.getElementById("responser").innerHTML = response ; 
      }
      xmlhttpPost (url, msg, resp) ;
  }
}

function addwet(){
  if(!document.getElementById("imie")) alert("Brak wpisanego imienia");
  else if(!document.getElementById("nazwisko")) alert("Brak wpisanego nazwiska");
  else if(!document.getElementById("email")) alert("Brak wpisanego adresu email");
  else if(!document.getElementById("haslo")) alert("Brak wpisanego hasła");
  else{
    var imie = document.getElementById("imie").value ;
    var nazwisko = document.getElementById("nazwisko").value ;
    var email = document.getElementById("email").value ;
    var haslo = document.getElementById("haslo").value ;
    document.getElementById("datawet").style.display = "none" ;
    json_data = "{\"imie\":\"" + imie + "\",\"nazwisko\":\"" + nazwisko + "\",\"email\":\"" + email + "\",\"haslo\":\"" + haslo +"\"}" ;
    var msg = "datawet=" + encodeURIComponent(json_data) ;                                    
    url = "index.php?sub=Wet&action=saveWet" ;
    resp = function(response) {
        document.getElementById("responsewet").innerHTML = response ; 
      }
      xmlhttpPost (url, msg, resp) ;
    }
}

function login(){
  if(!document.getElementById("email")) alert("Brak wpisanego adresu email");
  else if(!document.getElementById("haslo")) alert("Brak wpisanego hasła");
  else{
     var email = document.getElementById("email").value ;
     var haslo = document.getElementById("haslo").value ;
     document.getElementById("datal").style.display = "none" ;
     json_data = "{\"email\":\"" + email + "\",\"haslo\":\"" + haslo + "\"}" ;
     var msg = "datal=" + encodeURIComponent(json_data) ;                                    
     url = "index.php?sub=User&action=isRegister" ;
     resp = function(response) {
        document.getElementById("responsel").innerHTML = response ; 
      }
      xmlhttpPost (url, msg, resp) ;
    }
}

function wet_login(){
  if(!document.getElementById("email")) alert("Brak wpisanego adresu email");
  else if(!document.getElementById("haslo")) alert("Brak wpisanego hasła");
  else{
    var email = document.getElementById("email").value ;
    var haslo = document.getElementById("haslo").value ;
    document.getElementById("dataw").style.display = "none" ;
    json_data = "{\"email\":\"" + email + "\",\"haslo\":\"" + haslo + "\"}" ;
    var msg = "dataw=" + encodeURIComponent(json_data) ;                                     
    url = "index.php?sub=Wet&action=isRegister" ;
    resp = function(response) {
      document.getElementById("responsew").innerHTML = response ; 
    }
    xmlhttpPost (url, msg, resp) ;
  }
}

function addanimal(){
  if(!document.getElementById("imie")) alert("Brak wpisanego imienia");
  else if(!document.getElementById("gatunek")) alert("Brak wpisanego gatunku");
  else if(!document.getElementById("rasa")) alert("Brak wpisanej rasy");
  else if(!document.getElementById("wielkosc")) alert("Brak wpisanej wielkosci zwierzęcia");
  else{
    var imie = document.getElementById("imie").value ;
    var gatunek = document.getElementById("gatunek").value ;
    var rasa = document.getElementById("rasa").value ;
    var wielkosc = document.getElementById("wielkosc").value ;
    document.getElementById("datazw").style.display = "none" ;
    json_data = "{\"imie\":\"" + imie + "\",\"gatunek\":\"" + gatunek + "\",\"rasa\":\"" + rasa + "\",\"wielkosc\":\"" + wielkosc +"\"}" ;
    var msg = "datazw=" + encodeURIComponent(json_data) ;                                     
    url = "index.php?sub=Zwierze&action=saveAnimal" ;
    resp = function(response) {
      document.getElementById("responsezw").innerHTML = response ; 
    }
    xmlhttpPost (url, msg, resp) ;
  }
}


function addclinic(){
  if(!document.getElementById("miasto")) alert("Brak wpisanego miasta");
  else if(!document.getElementById("ulica")) alert("Brak wpisanej ulicy");
  else if(!document.getElementById("numer_budynku")) alert("Brak wpisanego numeru budynku");
  else{
    var miasto = document.getElementById("miasto").value ;
    var ulica = document.getElementById("ulica").value ;
    var numer_budynku = document.getElementById("numer_budynku").value ;
    document.getElementById("datac").style.display = "none" ;
    json_data = "{\"miasto\":\"" + miasto + "\",\"ulica\":\"" + ulica + "\",\"numer_budynku\":\"" + numer_budynku + "\"}" ;
    var msg = "datac=" + encodeURIComponent(json_data) ;                                    
    url = "index.php?sub=Wet&action=saveClinic" ;
    resp = function(response) {
        document.getElementById("responsec").innerHTML = response ; 
      }
      xmlhttpPost (url, msg, resp) ;
    }
}


function addoffice(){
  if(!document.getElementById("id_budynku")) alert("Brak wpisanego id budynku");
  else if(!document.getElementById("numer_gabinetu")) alert("Brak wpisanego numeru gabinetu");
  else{
    var id_budynku = document.getElementById("id_budynku").value ;
    var numer_gabinetu = document.getElementById("numer_gabinetu").value ;
    document.getElementById("dataof").style.display = "none" ;
    json_data = "{\"id_budynku\":\"" + id_budynku + "\",\"numer_gabinetu\":\"" + numer_gabinetu + "\"}" ;
    var msg = "dataof=" + encodeURIComponent(json_data) ;                                    
    url = "index.php?sub=Wet&action=saveOffice" ;
    resp = function(response) {
        document.getElementById("responseof").innerHTML = response ; 
      }
      xmlhttpPost (url, msg, resp) ;
    }
}


function addvisit(){
  if(!document.getElementById("nazwa")) alert("Brak wpisanej nazwy wizyty");
  else if(!document.getElementById("cena")) alert("Brak wpisanej ceny");
  else{
    var nazwa = document.getElementById("nazwa").value ;
    var cena = document.getElementById("cena").value ;
    document.getElementById("datavis").style.display = "none" ;
    json_data = "{\"nazwa\":\"" + nazwa + "\",\"cena\":\"" + cena +"\"}" ;
    var msg = "datavis=" + encodeURIComponent(json_data) ;                                    
    url = "index.php?sub=Wet&action=saveVisit" ;
    resp = function(response) {
        document.getElementById("responsevis").innerHTML = response ; 
      }
      xmlhttpPost (url, msg, resp) ;
    }
}

function addvaccine(){
  if(!document.getElementById("imie")) alert("Brak wpisanego imienia");
  else if(!document.getElementById("nazwisko")) alert("Brak wpisanego nazwiska");
  else if(!document.getElementById("nazwa")) alert("Brak wpisanej nazwy");
  else if(!document.getElementById("data")) alert("Brak wpisanej daty");
  else{
    var imie = document.getElementById("imie").value ;
    var nazwisko = document.getElementById("nazwisko").value ;
    var nazwa = document.getElementById("nazwa").value ;
    var data = document.getElementById("data").value ;
    document.getElementById("datavacc").style.display = "none" ;
    json_data = "{\"imie\":\"" + imie + "\",\"nazwisko\":\"" + nazwisko + "\",\"nazwa\":\"" + nazwa + "\",\"data\":\"" + data +"\"}" ;
    var msg = "datavacc=" + encodeURIComponent(json_data) ;                                    
    url = "index.php?sub=Wet&action=saveVaccine" ;
    resp = function(response) {
        document.getElementById("responsevacc").innerHTML = response ; 
      }
      xmlhttpPost (url, msg, resp) ;
    }
}


function addvisituser(){
  if(!document.getElementById("imie")) alert("Brak wpisanego imienia");
  else if(!document.getElementById("nazwisko")) alert("Brak wpisanego nazwiska");
  else if(!document.getElementById("id_budynek")) alert("Brak wpisanego id budynku");
  else if(!document.getElementById("numer_gabinetu")) alert("Brak wpisanego numeru gabinetu");
  else if(!document.getElementById("nazwa")) alert("Brak wpisanej nazwy wizyty");
  else if(!document.getElementById("data")) alert("Brak wpisanej daty");
  else{
    var imie = document.getElementById("imie").value ;
    var nazwisko = document.getElementById("nazwisko").value ;
    var id_budynek = document.getElementById("id_budynek").value ;
    var numer_gabinetu = document.getElementById("numer_gabinetu").value ;
    var nazwa = document.getElementById("nazwa").value ;
    var data = document.getElementById("data").value ;
    var dolegliwosci;
    if(document.getElementById("dolegliwosci").value != null)
      dolegliwosci = document.getElementById("dolegliwosci").value ;
    else 
      dolegliwosci = "brak";

    document.getElementById("datavu").style.display = "none" ;
    json_data = "{\"imie\":\"" + imie + "\",\"nazwisko\":\"" + nazwisko + "\",\"id_budynek\":\"" + id_budynek + "\",\"numer_gabinetu\":\"" + numer_gabinetu + "\",\"nazwa\":\"" + nazwa + "\",\"data\":\"" + data + "\",\"dolegliwosci\":\"" + dolegliwosci +"\"}" ;
    var msg = "datavu=" + encodeURIComponent(json_data) ;                                    
    url = "index.php?sub=User&action=saveVisitUser" ;
    resp = function(response) {
        document.getElementById("responsevu").innerHTML = response ; 
      }
      xmlhttpPost (url, msg, resp) ;
    }
}


function xmlhttpPost(strURL, mess, respFunc) {
  var xmlHttpReq = false;
  var self = this;
  if (window.XMLHttpRequest) {
      self.xmlHttpReq = new XMLHttpRequest();
  }
  else if (window.ActiveXObject) {
      self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
  }
  self.xmlHttpReq.onreadystatechange = function() {
  if(self.xmlHttpReq.readyState == 4){
      if ( self.xmlHttpReq.status == 200 ) {    
        respFunc( self.xmlHttpReq.responseText ) ;
      }
      else if ( self.xmlHttpReq.status == 401 ) {
         window.location.reload() ;
      } 
    }
  }
  self.xmlHttpReq.open('POST', strURL);
  self.xmlHttpReq.setRequestHeader("X-Requested-With","XMLHttpRequest");
  self.xmlHttpReq.setRequestHeader("Content-Type","application/x-www-form-urlencoded; ");
  self.xmlHttpReq.send(mess);        
}