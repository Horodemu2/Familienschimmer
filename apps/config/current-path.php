<?php

$cpath = current_url();
   //echo "page URL is : ".current_url();
   $titelAssoc = array(
       $index => "Home",
       $legal => "Impressum",
       $contact => "Kontakt",
       $pagelogin => "logged In",
       $network => "Das Netzwerk, welches einen stärkt",
       $inspiration => "Inspirationen & Mehr",
       $error404 => "error-404",
       $tmailsent => "E-Mail wurde versandt",
       $privacy => "Datenschutz"
   );

   // Festlegung des Seitentitels basierend auf dem aktuellen Pfad
   if (strpos($cpath, 'backend/') === 0) {
    $title = 'Du bist eingeloggt';
}else {
   $title = isset($titelAssoc[$cpath]) ? $titelAssoc[$cpath] : "Home";
 }
 ?>
