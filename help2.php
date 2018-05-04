<?php require_once 'config.php'; ?>
<html>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic&subset=greek,latin' rel='stylesheet' type='text/css'>
    </head>
    <body>
<br><br><br>
<p class="main"><?php echo $av_title." ($av_foreas)"; ?>
<br>
<br>
    <u><strong>Οδηγίες Υποβολής Προτιμήσεων <?php if ($av_type==1) echo "(Βήμα 2):"; ?></strong></u>
<br>
- Για να επιλέξετε ένα σχολείο σε οποιαδήποτε προτίμηση, επιλέξτε το από τη λίστα.
<br>
- Για να διαγράψετε ένα σχολείο, πατήστε δεξιά του, στο εικονίδιο <img src="js/clear_cross.png">.
<br>
Έπειτα, συνεχίστε παρομοίως και για τις υπόλοιπες προτιμήσεις.
<br><br>
- Για να αποθηκεύσετε προσωρινά την αίτησή σας, πατήστε στο κουμπί <strong>"Αποθήκευση"</strong>.
<br>
Έτσι, οι προτιμήσεις σας παραμένουν αποθηκευμένες και αφού αποσυνδεθείτε και επανασυνδεθείτε.
<br><br>
<?php if ($av_type == 1) echo "- Για να επιστρέψετε στο προηγούμενο βήμα, πατήστε το αντίστοιχο κουμπί.<br><br>"; ?>
- Για να υποβάλετε οριστικά την αίτηση, πατήστε <strong>"Οριστική υποβολή"</strong> και έπειτα "Ναι" στην ειδοποίηση που εμφανίζεται.
<br>
<br>
<?php if ($av_type == 2) echo "- Για να κάνετε <strong>Αρνητική Δήλωση</strong>, πατήστε \"Αποθήκευση\" και έπειτα \"Οριστική Υποβολή\" χωρίς να έχετε επιλέξει κάποιο σχολείο.<br><br>"; ?>
<strong><u>ΠΡΟΣΟΧΗ:</u></strong> Η οριστική υποβολή είναι <strong>ΥΠΟΧΡΕΩΤΙΚΗ</strong> και δε μπορούν να γίνουν αλλαγές αφού πραγματοποιηθεί.
<br>
</p>
<?php if ($av_type == 2) echo "<p><a href=\"$av_link_vel\" target=\"_blank\"><small>Σχετικό έγγραφο</small></a></p>"; ?>
<p>
<br>
<small>
    Σχεδίαση - Ανάπτυξη: <a href="mailto:sugarv@sch.gr?subject=Αποσπάσεις/Βελτιώσεις">Ε.Ζαχαριουδάκης, ΠΕ20</a>
<br>
Επιμέλεια: Γραμματεία <?php echo $av_foreas; ?>
</small>
</p>
</body>
</html>