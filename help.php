<?php require_once 'config.php'; ?>
<html>
    <head>
         <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
         <LINK href="style.css" rel="stylesheet" type="text/css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
         <script>
        $(function() {
        $( "#accordion" ).accordion();
        });
        </script>
    </head>
    <body>
<p class="main">Καλώς ήλθατε στην <?php echo $av_title." ($av_foreas)"; ?>
<br>
<br>
    <u><strong>Οδηγίες Υποβολής Στοιχείων (Βήμα 1):</strong></u>
<div id="accordion">
    <strong>Υπέβαλα αίτηση βελτίωσης θέσης:</strong><div>Το επιλέγετε εάν είχατε υποβάλει αίτηση βελτίωσης θέσης ή  οριστικής τοποθέτησης κατά το τρέχον σχολικό έτος (<?php echo $av_sxoletos; ?>)
    προκειμένου να προσμετρηθούν άμεσα μονάδες εντοπιότητας ή συνυπηρέτησης που τυχόν διαθέτετε.
    <br></div>
    <strong>Δήμος:</strong><div>Στο πεδίο αυτό αναγράφετε τον Δήμο στον οποίο ανήκει η οικογενειακή σας μερίδα, προκειμένου να διευκολυνθεί η αυτεπάγγελτη αναζήτηση 
    πιστοποιητικών εντοπιότητας και οικογενειακής κατάστασης, εφόσον απαιτείται. 
    <br></div>
    <strong>Εντοπιότητα:</strong><div>Το πεδίο αυτό συμπληρώνεται εάν έχετε εντοπιότητα σε κάποιον από τους Καλλικρατικούς Δήμους της Περιφερειακής Ενότητας <?= $av_nomos; ?>, 
    τουλάχιστον για μία διετία μέχρι την ημερομηνία υποβολής της αίτησης απόσπασης, και αν προτίθεσθε να δηλώσετε σχολεία του ίδιου δήμου για τα οποία θα λάβετε 
    επιπλέον μοριοδότηση. 
    <br></div>
    <strong>Συνυπηρέτηση:</strong><div>Το πεδίο αυτό συμπληρώνεται εάν υπάρχει συνυπηρέτηση με τον / την σύζυγό σας σε κάποιον από τους Καλλικρατικούς Δήμους της 
    Περιφερειακής Ενότητας <?= $av_nomos; ?> - τουλάχιστον κατά το τελευταίο ένα έτος μέχρι την ημερομηνία υποβολής της αίτησης απόσπασης, στο οποίο δύναται να περιληφθούν και 
    διαστήματα ανεργίας επιδοτούμενης ή μη. Για την προσμέτρηση μονάδων συνυπηρέτησης θα πρέπει να προσκομίσετε στην υπηρεσία τα απαραίτητα έγγραφα. 
    <a href="<?php echo $av_link; ?>" target="_blank"><small>(βλ. σχετική ανακοίνωση).</small></a>
    <br></div>
    <strong>Ειδική κατηγορία (κατά προτεραιότητα):</strong><div>Για την ένταξη σε ειδική κατηγορία θα πρέπει να προσκομίσετε στην υπηρεσία τα απαραίτητα έγγραφα (εν ισχύ γνωμάτευση 
    πρωτοβάθμιας ή δευτεροβάθμιας υγειονομικής επιτροπής ή Κέντρου Πιστοποίησης Αναπηρίας (ΚΕ.Π.Α.) (<a href="<?php echo $av_link; ?>" target="_blank"><small>Εγκύκλιος αποσπάσεων</small></a>). 
    <br></div>
    <strong>Επιθυμώ απόσπαση από Γενική σε Ειδική Αγωγή:</strong><div>Επιλέγετε αυτό το πεδίο αν έχετε οργανική θέση σε σχολική μονάδα γενικής αγωγής και επιθυμείτε να 
    αποσπασθείτε σε σχολική μονάδα ειδικής αγωγής ή σε τμήμα ένταξης. Στην περίπτωση αυτή, δηλώνετε και το αντίστοιχο προσόν (ή προσόντα) που διαθέτετε, σύμφωνα με το 
    άρθρα 20, 21 του Ν. 3699/2008 (ΦΕΚ199/τ.Α). 
    Στο πεδίο "άλλο προσόν" αναφέρετε τυχόν επιπρόσθετα προσόντα που διαθέτετε (λ.χ. εξειδίκευση στην ελληνική νοηματική γλώσσα κωφών και γραφή Braille των τυφλών, 
    ή οτιδήποτε άλλο σχετικό προσόν). Για τον υπολογισμό κάποιου προσόντος ως λόγο απόσπασης στην ειδική αγωγή απαιτείται να προσκομίσετε στην υπηρεσία τον αντίστοιχο 
    νομίμως επικυρωμένο τίτλο σπουδών. 
    <br></div>
    <strong>Σοβαροί λόγοι υγείας:</strong><div>Για την απόδειξη του ποσοστού αναπηρίας των αντίστοιχων περιπτώσεων απαιτείται εν ισχύ γνωμάτευση πρωτοβάθμιας ή 
    δευτεροβάθμιας υγειονομικής επιτροπής ή Κέντρου Πιστοποίησης Αναπηρίας (ΚΕ.Π.Α.). (<a href="<?php echo $av_link; ?>" target="_blank"><small>Εγκύκλιος αποσπάσεων</small></a>)
    <br></div>
    <strong>Δηλώνω υπεύθυνα ότι...:</strong><div>το πεδίο αυτό συμπληρώνεται θετικά από κάθε εκπαιδευτικό προκειμένου να έχει δικαίωμα υποβολής αίτησης απόσπασης.</div>  
</div>
    Αν εντοπίσετε κάποια ασυμφωνία στα στοιχεία σας (χρόνος συν.υπηρεσίας/οργανική θέση κλπ.), παρακαλούμε δηλώστε το στο πεδίο "Σχόλια - Παρατηρήσεις" με την ένδειξη 'Λάθος', π.χ. 'Λάθος Συνολική Υπηρεσία' κλπ.
    <br><br>

Για να προχωρήσετε στο <strong>Βήμα 2</strong> (καταχώρηση επιλογών), πατήστε το αντίστοιχο κουμπί.
</p>
<p>
<br>
<small>
Σχεδίαση - Ανάπτυξη: <a href="mailto:it@dipe.ira.sch.gr?subject=Αποσπάσεις/Βελτιώσεις">Ε.Ζαχαριουδάκης, ΠΕ20</a>
<br>
Επιμέλεια: Γραμματεία <?php echo $av_foreas; ?>
</small>
</p>
</body>
</html>