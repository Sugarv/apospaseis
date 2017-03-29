<?php
  // Σύστημα αποσπάσεων βελτιώσεων 
  // Βαγγέλης Ζαχαριουδάκης, ΠΕ20
  // Πληροφορίες: sugarv@sch.gr
  // (c) 2013-14
  //
  // ΣΗΜ.: Κατά την εγκατάσταση, μετά τη μεταβολή του config.php, προτείνεται να τρέξετε το init.php
    
  // ΠΑΡΑΜΕΤΡΟΙ ΕΦΑΡΜΟΓΗΣ
  // ΣΗΜ.: Όπου η παράμετρος είναι 1 σημαίνει ενεργοποιημένη. Για απενεργοποίηση βάλτε 0.
  //
  // Παράμετροι βάσης δεδομένων
  // Στοιχεία σύνδεσης
  // local
  $db_host = "localhost";
  $db_user = "root";
  $db_password = "d1pe_db";
  $db_name = "aposp";
  // sch.gr
  //$db_host = "userdb";
  //$db_user = "xxxxxxxx";
  //$db_password = "xxxxxxxxx";
  //$db_name = "xxxxxx";
  // Ονόματα πινάκων
  // ΣΗΜ: το init.php φτιάχνει βάση με τα ονόματα apo_employee, apo_aitisi, apo_school, apo_dimos εκτός αν αλλάξετε το aposp.sql
  $av_emp = "apo_employee";
  $av_ait = "apo_aitisi";
  $av_sch = "apo_school";
  $av_dimos = "apo_dimos";
  
  
  // **** Τύπος εφαρμογής: 1 = Αποσπάσεις, 2 = Βελτιώσεις ****
  $av_type = 1;
  // Τίτλος εφαρμογής (π.χ. Online υποβολή αιτήσεων για απόσπαση - προσωρινή τοποθέτηση)
  //$av_title = "Online υποβολή αιτήσεων για βελτίωση - οριστική τοποθέτηση";
  $av_title = "Online υποβολή αιτήσεων για απόσπαση - προσωρινή τοποθέτηση";
  // Φορέας αιτήσεων (ΠΥΣΠΕ / ΠΥΣΔΕ) (π.χ. ΠΥΣΠΕ Ηρακλείου)
  $av_foreas = "ΠΥΣΠΕ Ηρακλείου";
  // Νομός (βλ. Περιφερειακή ενότητα)
  $av_nomos = "Ηρακλείου";
  // Δ/νση αιτήσεων (π.χ. Διεύθυνση Πρωτοβάθμιας Εκπ/σης Ηρακλείου)
  $av_dnsh = "Διεύθυνση Πρωτοβάθμιας Εκπ/σης Ηρακλείου";
  // Χρήση σε Δ/νση Πρωτοβάθμιας
  $av_athmia = 1;
  // Custom μήνυμα (εμφανίζεται στην οθόνη Login, κάτω απ'το login)
  $av_custom = "";
  
  // Προβολή ή όχι του login
  $av_display_login = 1;
  // Σύστημα ενεργό ή όχι
  $av_is_active = 1;
  // ενεργό από
  $av_active_from = "Παρασκευή 01/08/2014";
  // ενεργό έως
  $av_active_to = "Δευτέρα 18/08/2014";
  // ενεργό έως ώρα
  $av_active_to_time = "09:00";
  // τέλος σχολικού έτους (για υπολογισμό υπηρεσίας)
  $av_endofyear = "31/08/2014";
  // έτος αιτήσεων
  $av_etos = "2014";
  // σχολικό έτος
  $av_sxoletos = "2014-15";
    
  // Σύνδεσμος εγκυκλίου (εμφανίζεται στη βοήθεια της εφαρμογής)(_vel : έγγραφο βελτιώσεων)
  $av_link = "http://dipe.ira.sch.gr/files/apospaseis_pyspe_2014-15.pdf";
  $av_link_vel = "http://dipe.ira.sch.gr/portal/images/stories/Documents/anakoinwseis/dioikhtika/2014/140716_dhlwseis_velt-top.pdf"; 
  
  // Επιλογές Διαχειριστή
  // Όνομα χρήστη διαχειριστή (ΠΡΟΣΟΧΗ: πρέπει να είναι ΑΡΙΘΜΗΤΙΚΟ)
  // Ο κωδικός χρήστη είναι το πεδίο ΑΦΜ του και εισάγεται στο init.php ή απευθείας στη βάση.
  $av_admin = "121212";
  // Κωδικός ασφαλείας για το αρχικοποίηση βάσης (init.php)
  $av_init_pass = "321123";
  // Ο διαχειριστής μπορεί να αναιρέσει την υποβολή
  $av_canundo = 1;
  // Ο διαχειριστής μπορεί να αλλάξει την οργανική και τη συνολική υπηρεσία του εκπ/κού
  $av_canalter = 1;
  
  
// Report all errors except E_NOTICE
// This is the default value set in php.ini  
// to avoid notices on some configurations
  error_reporting(E_ALL ^ E_NOTICE);
  
?>