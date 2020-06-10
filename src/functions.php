<?php
require_once '../config.php';

// init params
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// find calling script (php file)
$script = end(explode('/', $_SERVER['PHP_SELF']));

if (!$conn && $script != 'init.php') {
  echo $script;
  echo "<h3>Σφάλμα: Δεν υπάρχει η βάση.<br>Αρχικοποιήστε με το <a href='init.php'>αρχείο init.php</a> ή επικοινωνήστε με το διαχειριστή.</h3>";
  die();
}

mysqli_set_charset($conn,"utf8");
$query = "SELECT pkey, pvalue from $av_params";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result)==0) 
    return 0;
else {
    while ($row = mysqli_fetch_array($result)) {
      $key = $row['pkey'];
      $$key = $row['pvalue'];
    }
    //$_SESSION['initialized'] = true;
}

  
// Report all errors except E_NOTICE
// This is the default value set in php.ini  
// to avoid notices on some configurations
error_reporting(E_ALL ^ E_NOTICE);


function getSchooledc ($id,$conn)
{
        global $av_sch;
        $query = "SELECT name from $av_sch where kwdikos='".$id."'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result)==0) {
            return "";
        }
        else {
          $row = mysqli_fetch_array($result);
          return $row['name'];
        }
}
function getSchool ($id,$conn)
{
    global $av_sch;
    if (!$id)
        return "";
    $query = "SELECT name from $av_sch where id=".$id;
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)==0) 
        return "";
    else {
        $row = mysqli_fetch_array($result);
        return $row['name'];
    }
}
function getSchoolID ($name,$conn)
{
    global $av_sch;
    $query = "SELECT id from $av_sch where name='".$name."'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)==0) 
        return 0;
    else {
        $row = mysqli_fetch_array($result);
        return $row['id'];
    }
}
function getSchoolcode ($id, $conn)
{
    global $av_sch;
    $query = "SELECT kwdikos from $av_sch where id=".$id;
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)==0) 
        return 0;
    else {
        $row = mysqli_fetch_array($result);
        return $row['kwdikos'];
    }
}

// epil: epilogh 1-20 / dim: 2 dhmotiko,1 nip,0 ola / omada / sch: sxoleio (lektiko) / show_inactive
function getSchools ($epil, $dim, $omada, $conn, $sch, $show_inactive = false)
{
    global $av_sch;
    $inactive = $show_inactive ? '' : 'AND inactive=0';
    if (!$omada && !$dim)
        $query = "select DISTINCT name,id,kwdikos from $av_sch WHERE 1 $inactive order by name";
    if (!$omada && $dim)
        $query = "select DISTINCT name,id,kwdikos from $av_sch where dim=$dim $inactive order by name";
    if ($omada && $dim)
        $query = "select DISTINCT name,id,kwdikos from $av_sch where dim=$dim AND omada <> $omada $inactive order by name";
    $arr = array();
    $result = mysqli_query($conn, $query);
    while ($ar = mysqli_fetch_array($result))
        $arr[] = $ar;
    $ret = "<select name='p".$epil."' id='p".$epil."' style='width:280px;'>";
    $ret .= "<option value=\"\"></option>";
    foreach ($arr as $res)
    {
        //print_r($res);
        if ($sch == $res[0])
            $ret .= "<option value=\"$res[2]\" selected>".$res[0]."</option>";
        else
            $ret .= "<option value=\"$res[2]\">".$res[0]."</option>";
    }
    $ret .= "</select>";
    return $ret;
}

function getGamos ($gamos)
{
    switch ($gamos)
    {
        case 0:$ret = "Άγαμος";break;
        case 1:$ret = "Έγγαμος";break;
        case 2:$ret = "Διαζευγμένος/σε διάσταση με επιμέλεια παιδιού ανήλικου ή σπουδάζοντος";break;
        case 3:$ret = "Σε χηρεία χωρίς παιδιά ανήλικα ή σπουδάζοντα";break;
        case 4:$ret = "Σε χηρεία με παιδιά ανήλικα ή σπουδάζοντα";break;
        case 5:$ret = "Μονογονεϊκή οικογένεια (χωρίς γάμο) με παιδιά ανήλικα ή σπουδάζοντα";break;
    }
    return $ret;
}
function getDimos ($dimos_code, $conn)
{
    global $av_dimos;
    $query = "SELECT name from $av_dimos where id=$dimos_code";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result)==0) 
            return "";
        else {
          $row = mysqli_fetch_array($result);
          return $row['name'];
        }
}
function cmbGamos ()
{
    echo "<select name=\"gamos\" style=\"width:200px\">";
    echo "<option value=\"\" selected>(Παρακαλώ επιλέξτε:)</option>";
    echo "<option value=\"0\">Άγαμος</option>";
    echo "<option value=\"1\">Έγγαμος</option>";
    echo "<option value=\"2\">Διαζευγμένος/σε διάσταση με επιμέλεια παιδιού ανήλικου ή σπουδάζοντος</option>";
    echo "<option value=\"3\">Σε χηρεία χωρίς παιδιά ανήλικα ή σπουδάζοντα</option>";
    echo "<option value=\"4\">Σε χηρεία με παιδιά ανήλικα ή σπουδάζοντα</option>";
    echo "<option value=\"5\">Μονογονεϊκή οικογένεια (χωρίς γάμο) με παιδιά ανήλικα ή σπουδάζοντα</option>";
    echo "</select>";
}
function cmbPaidia ()
{
    echo "<select name=\"paidia\">";
    echo "<option value=\"\" selected>(Παρακαλώ επιλέξτε:)</option>";
    echo "<option value=\"0\">0</option>";
    echo "<option value=\"1\">1</option>";
    echo "<option value=\"2\">2</option>";
    echo "<option value=\"3\">3</option>";
    echo "<option value=\"4\">4</option>";
    echo "<option value=\"5\">5</option>";
    echo "</select>";
}
function cmbDimos ($str,$conn)
{
    echo "<select name=\"dhmos_$str\">";
    echo "<option value=\"0\" selected>(Παρακαλώ επιλέξτε:)</option>";
    global $av_dimos;
    $query = "SELECT * from $av_dimos";
    $result = mysqli_query($conn, $query);
    while ($arr = mysqli_fetch_array($result)){
        echo "<option value=".$arr['id'].">".$arr['name']."</option>";
    }
    echo "</select>";
}
function cmbDimos_edit ($str, $epil, $conn)
{
    echo "<select name=\"dhmos_$str\">";
    global $av_dimos;
    $query = "SELECT * from $av_dimos";
    $result = mysqli_query($conn, $query);
    while ($arr = mysqli_fetch_array($result)){
        if ($epil == $arr['id'])
            echo "<option value=".$arr['id']." selected>".$arr['name']."</option>";
        else
            echo "<option value=".$arr['id'].">".$arr['name']."</option>";
    }
    echo "</select>";
}
function cmbPaidia_edit ($epil)
{
    echo "<select name=\"paidia\">";
    if ($epil=='') echo "<option value=\"\" selected>(Παρακαλώ επιλέξτε:)</option>";
    else echo "<option value=\"\">(Παρακαλώ επιλέξτε:)</option>";
    if ($epil==0) echo "<option value=\"0\" selected>0</option>";
    else echo "<option value=\"0\">0</option>";
    if ($epil==1) echo "<option value=\"1\" selected>1</option>";
    else echo "<option value=\"1\">1</option>";
    if ($epil==2) echo "<option value=\"2\" selected>2</option>";
    else echo "<option value=\"2\">2</option>";
    if ($epil==3) echo "<option value=\"3\" selected>3</option>";
    else echo "<option value=\"3\">3</option>";
    if ($epil==4) echo "<option value=\"4\" selected>4</option>";
    else echo "<option value=\"4\">4</option>";
    if ($epil==5) echo "<option value=\"5\" selected>5</option>";
    else echo "<option value=\"5\">5</option>";
    echo "</select>";
}
function cmbGamos_edit ($epil)
{
    echo "<select name=\"gamos\" style=\"width:200px\">";
    if ($epil=='') echo "<option value=\"\" selected>(Παρακαλώ επιλέξτε:)</option>";
    else echo "<option value=\"\">(Παρακαλώ επιλέξτε:)</option>";
    if ($epil==0) echo "<option value=\"0\" selected>Άγαμος</option>";
    else echo "<option value=\"0\">Άγαμος</option>";
    if ($epil==1) echo "<option value=\"1\" selected>Έγγαμος</option>";
    else echo "<option value=\"1\">Έγγαμος</option>";
    if ($epil==2) echo "<option value=\"2\" selected>Διαζευγμένος/σε διάσταση με επιμέλεια παιδιού ανήλικου ή σπουδάζοντος</option>";
    else echo "<option value=\"2\">Διαζευγμένος/σε διάσταση με επιμέλεια παιδιού ανήλικου ή σπουδάζοντος</option>";
    if ($epil==3) echo "<option value=\"3\" selected>Σε χηρεία χωρίς παιδιά ανήλικα ή σπουδάζοντα</option>";
    else echo "<option value=\"3\">Σε χηρεία χωρίς παιδιά ανήλικα ή σπουδάζοντα</option>";
    if ($epil==4) echo "<option value=\"4\" selected>Σε χηρεία με παιδιά ανήλικα ή σπουδάζοντα</option>";
    else echo "<option value=\"4\">Σε χηρεία με παιδιά ανήλικα ή σπουδάζοντα</option>";
    if ($epil==5) echo "<option value=\"1\" selected>Μονογονεϊκή οικογένεια (χωρίς γάμο) με παιδιά ανήλικα ή σπουδάζοντα</option>";
    else echo "<option value=\"5\">Μονογονεϊκή οικογένεια (χωρίς γάμο) με παιδιά ανήλικα ή σπουδάζοντα</option>";
    echo "</select>";    
}

function cmbYgeia_edit ($epil)
{
    echo "<select name=\"ygeia\">";
    if ($epil==0) echo "<option value=\"0\" selected>(Παρακαλώ επιλέξτε:)</option>";
        else echo "<option value=\"0\">(Παρακαλώ επιλέξτε:)</option>";
    if ($epil==1) echo "<option value=\"1\" selected>50-60%</option>";
        else echo "<option value=\"1\">50-60%</option>";
    if ($epil==2) echo "<option value=\"2\" selected>67-79%</option>";
        else echo "<option value=\"2\">67-79%</option>";
    if ($epil==3) echo "<option value=\"3\" selected>80% και άνω</option>";
        else echo "<option value=\"3\">80% και άνω</option>";
    echo "</select>";
}
function cmbYgeia_g_edit ($epil)
{
    echo "<select name=\"ygeia_g\">";
    if ($epil==0) echo "<option value=\"0\" selected>(Παρακαλώ επιλέξτε:)</option>";
        else echo "<option value=\"0\">(Παρακαλώ επιλέξτε:)</option>";
    if ($epil==1) echo "<option value=\"1\" selected>50-66%</option>";
        else echo "<option value=\"1\">50-66%</option>";
    if ($epil==2) echo "<option value=\"2\" selected>67% και άνω</option>";
        else echo "<option value=\"2\">67% και άνω</option>";
    echo "</select>";
}
function cmbYgeia_a_edit ($epil)
{
    echo "<select name=\"ygeia_a\">";
    if ($epil==0) echo "<option value=\"0\" selected>(Παρακαλώ επιλέξτε:)</option>";
        else echo "<option value=\"0\">(Παρακαλώ επιλέξτε:)</option>";
    if ($epil==1) echo "<option value=\"1\" selected>67% και άνω</option>";
        else echo "<option value=\"1\">67% και άνω</option>";
    echo "</select>";
}
function getYgeia ($y)
{
    switch ($y)
    {
        case 0:
            $ret = "Όχι";
            break;
        case 1:
            $ret = "50-60%";
            break;
        case 2:
            $ret = "67-79%";
            break;
        case 3:
            $ret = "80% και άνω";
            break;
    }
    return $ret;
}
function getYgeia_g ($y)
{
    switch ($y)
    {
        case 0:
            $ret = "Όχι";
            break;
        case 1:
            $ret = "50-66%";
            break;
        case 2:
            $ret = "67% και άνω";
            break;
    }
    return $ret;
}
function getYgeia_a ($y)
{
    switch ($y)
    {
        case 0:
            $ret = "Όχι";
            break;
        case 1:
            $ret = "67% και άνω";
            break;
    }
    return $ret;
}

function mb_helper($v) {
  return mb_convert_encoding($v,'utf-8','iso-8859-7');
}

// Here's a startsWith function
function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}
function getParam($param, $conn) {
    global $av_params;
    $query = "SELECT pvalue from $av_params where pkey=$param";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)==0) 
        return 0;
    else {
        $row = mysqli_fetch_array($result);
        return $row['pvalue'];
    }
}
function setParam($param, $value=null, $conn) {
    global $av_params;
    $query = "UPDATE $av_params SET pvalue=$value where pkey=$param";
    $result = mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function has_choices($ch){
    $values = array_count_values(unserialize($ch));
    return $values[''] == 20 ? false : true;
}
// function which computes moria apospasis
// returns an array with keys 'synolo' & other criteria if they exist
function compute_moria($emp_id, $conn, $eidiki = 0) {
    $moria = [];
    global $av_ait, $av_emp;
    $query = "SELECT a.*,e.eth,e.mhnes,e.hmeres from $av_ait a JOIN $av_emp e ON e.id=a.emp_id WHERE emp_id=$emp_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    ///////////////////
    // moria yphresias
    $moria_yphr = 0;
    $mhnes = $row['mhnes'] + ($row['eth'] * 12);
    $mhnes += $row['hmeres'] >= 15 ? 1 : 0;
    $eth = $mhnes / 12;
    // 1-10 eth: 1 morio/etos, >10 eth: 1.5 morio/etos, >20 eth: 2 moria/etos
    if ($eth <= 10){
        $moria_yphr = $eth;
    } else if ($eth > 10 && $eth <= 20) {
        $moria_yphr = ($eth - 10) * 1.5 + 10;
    } else if ($eth > 20) {
        $moria_yphr = (($eth - 20) * 2) + 15 + 10;
    }
    // round to 3 decimals
    $moria['yphresias'] = round($moria_yphr, 3);

    // moria gamoy
    // case 0: "Άγαμος";
    // case 1: "Έγγαμος";
    // case 2: "Διαζευγμένος/σε διάσταση με επιμέλεια παιδιού ανήλικου ή σπουδάζοντος";
    // case 3: "Σε χηρεία χωρίς παιδιά ανήλικα ή σπουδάζοντα";
    // case 4: "Σε χηρεία με παιδιά ανήλικα ή σπουδάζοντα";
    // case 5: "Μονογονεϊκή οικογένεια (χωρίς γάμο) με παιδιά ανήλικα ή σπουδάζοντα";
    switch ($row['gamos']) {
        case 1:
        case 2:
        case 3:
            $moria['gamoy'] = 4;
            break;
        case 4:
            $moria['gamoy'] = 12;
            break;
        case 5:
            $moria['gamoy'] = 6;
            break;
    }
    // moria paidiwn
    // 1o 5, 2o 6, 3o 8, 4o+ 10
    switch ($row['paidia']) {
        case 1:
            $moria['paidiwn'] = 5;
            break;
        case 2:
            $moria['paidiwn'] = 11;
            break;
        case 3:
            $moria['paidiwn'] = 19;
            break;
        case 4:
            $moria['paidiwn'] = 29;
            break;
        case 5:
            $moria['paidiwn'] = 39;
            break;
        case 6:
            $moria['paidiwn'] = 49;
            break;
        case 7:
            $moria['paidiwn'] = 59;
            break;
    }
    // ygeias
    // 1: 50-60, 2: 67-79, 3: >=80
    switch ($row['ygeia']) {
        case 1:
            $moria['ygeias'] = 5;
            break;
        case 2:
            $moria['ygeias'] = 20;
            break;
        case 3:
            $moria['ygeias'] = 30;
            break;
    }
    // ygeias gonewn
    // 1: 50-66, 2: >=67-79
    switch ($row['ygeia_g']) {
        case 1:
            $moria['ygeia_g'] = 1;
            break;
        case 2:
            $moria['ygeia_g'] = 3;
            break;
    }
    // ygeias adelfwn
    if ($row['ygeia_a'] == 1){
        $moria['ygeia_a'] = 5;
    }
    // ekswswmatikh
    if ($row['eksw'] == 1){
        $moria['eksw'] = 3;
    }
    // calculate sum
    $synolika_moria = array_sum($moria);
    $moria['yphresias'] = str_replace('.',',',$moria['yphresias']);
    // if eidiki, add 1000 moria to climb on top...
    if ($eidiki > 0){
        $synolika_moria += 1000;
    }
    $moria['synolo'] = str_replace('.',',',$synolika_moria);

    // entopiothta
    if ($row['dhmos_ent'] > 0){
        $moria['entopiothta'] = 4;
    }
    // synyphrethsh
    if ($row['dhmos_syn'] > 0){
        $moria['synyphrethsh'] = 10;
    }

    return $moria;
}
// returns a better description for each moria category
function moria_key2per($key){
    switch ($key) {
        case 'yphresias':
            return 'Υπηρεσίας';
        case 'gamoy':
            return 'Γάμου';
        case 'paidiwn':
            return 'Παιδιών';
        case 'ygeias':
            return 'Υγείας';
        case 'ygeia_g':
            return 'Υγείας γονέων';
        case 'ygeia_a':
            return 'Υγείας αδελφών';
        case 'eksw':
            return 'Εξωσωματικής';
        case 'entopiothta':
            return 'Εντοπιότητας';
        case 'synyphrethsh':
            return 'Συνυπηρέτησης';
        case 'synolo':
            return 'Σύνολο';
    }
}

function count_rows($conn){
  global $av_sch, $av_dimos, $av_emp;
  
  $query = "SELECT id from $av_sch";
  $result = mysqli_query($conn, $query);
  $sch = mysqli_num_rows($result);

  $query = "SELECT id from $av_dimos";
  $result = mysqli_query($conn, $query);
  $dimos = mysqli_num_rows($result);

  $query = "SELECT id from $av_emp";
  $result = mysqli_query($conn, $query);
  $emp = mysqli_num_rows($result) - 1;

  return array('emp' => $emp, 'sch' => $sch, 'dimos' => $dimos);
}
?>
