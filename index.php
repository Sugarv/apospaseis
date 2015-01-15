<?php
  session_start();
  header('Content-type: text/html; charset=iso8859-7'); 
  Require "config.php";
  require_once 'functions.php';
?>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
	<LINK href="style.css" rel="stylesheet" type="text/css">
        
        <title><?php echo "$av_title ($av_dnsh)"; ?></title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.clearableTextField.js"></script>
        <link rel="stylesheet" href="js/jquery.clearableTextField.css" type="text/css" media="screen" />
	<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic&subset=greek,latin' rel='stylesheet' type='text/css'>
  </head>
<?php
  $timeout = 0;

  include_once("class.login.php");
  $log = new logmein();
  if($log->logincheck($_SESSION['loggedin']) == false)
  //if($log->logincheck($_SESSION['loggedin']) == false && $_SESSION['timeout']<time())
  {   
      //header("Location: login.php");
      $page = 'login.php';
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$page.'";';
	echo '</script>';

  }
  else
      $loggedin = 1;
  // if veltiwseis, goto index2.php
  if ($av_type == 2){
      //header("Location: index2.php");
      $page = 'index2.php';
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$page.'";';
	echo '</script>';
  }
  if (time() > $_SESSION['timeout'])  
    $timeout = 1;
  $diff = $_SESSION['timeout'] - time();

  if ($timeout){
//    echo "<body>� �������� ��� ���� �����.<br>�������� ����� ������ ��� �������.";
//    echo "<form action='login.php'><input type='submit' value='�������'></form></body></html>";
//    exit;
//    header("Location: login.php");
	$page = 'login.php';
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$page.'";';
	echo '</script>';
  }

  if ($loggedin)
  {
    // if admin redirect to admin page
    if ($_SESSION['user']=="$av_admin")
        //$isadmin = 1;
        //header("Location: admin.php");
        echo "  <meta http-equiv=\"refresh\" content=\"0; URL=admin.php\">";
?>
  <div id="left1">
      <?php include('help.php'); ?>
  </div>
  <div id="right1">
<?php
    $mysqlconnection = mysql_connect($db_host, $db_user, $db_password);
    mysql_select_db($db_name, $mysqlconnection);
    mysql_query("SET NAMES 'greek'", $mysqlconnection);
    mysql_query("SET CHARACTER SET 'greek'", $mysqlconnection);
  
    echo "<center><h2>$av_title ($av_foreas)</h2></center>";
    
    $query = "SELECT * from $av_emp WHERE am = ".$_SESSION['user'];
    $result = mysql_query($query, $mysqlconnection);
    $name = mysql_result($result, 0, "name");
    $surname = mysql_result($result, 0, "surname");
    $patrwnymo = mysql_result($result, 0, "patrwnymo");
    $klados = mysql_result($result, 0, "klados");
    $id = mysql_result($result, 0, "id");
    $am = $_SESSION['user'];
    $organ = mysql_result($result, 0, "org");
    $organ = getSchooledc($organ, $mysqlconnection);
    $eth = mysql_result($result, 0, "eth");
    $mhnes = mysql_result($result, 0, "mhnes");
    $hmeres = mysql_result($result, 0, "hmeres");
    if ($av_athmia)
    {
        if (strpos($klados,"��6") !== false)
            $dim = 1;
        else
            $dim = 2;
    }
    else
        $dim = 0;
    ?>
    <script type="text/javascript">		               
                function stopRKey(evt) {
                    var evt = (evt) ? evt : ((event) ? event : null);
                    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
                    if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
                }

                document.onkeypress = stopRKey;

                function toggleFormElements() {
                    var inputs = document.getElementsByTagName("input");
                    ret=confirm("����� ��������;");
                    if (ret){
                        for (var i = 0; i < 40; i++) {    
                            inputs[i].value = '';
                            if (inputs[i].disabled == true)
                                inputs[i].disabled = false;
                            else
                                inputs[i].disabled = true;
                        }
                    }
                    mytag = document.getElementById("null_btn").value;
                    if (inputs[0].disabled == 1)
                        document.getElementById("null_btn").value = "�������������� ��������� �������";
                    else
                        document.getElementById("null_btn").value = "�������� ������";  
                }
                
                $(document).ready(function(){
                    $('#apospash').change(function(){
                        var checked = $(this).attr('checked');
                        if (checked) {
                        //$('#other').show();             
                        $('#other').fadeIn();             
                        } else {
                            //$('#other').hide();
                            $('#other').fadeOut();
                        }
                    });        
                });
                
        </script>
        <?php
    //check if employee has aitisi
    $query = "SELECT * from $av_ait WHERE emp_id=$id";
    $result = mysql_query($query, $mysqlconnection);
    if (mysql_num_rows($result)>0)
    {
        $has_aitisi = 1;
        $submitted = mysql_result($result, 0, "submitted");
    }
    
    // if user has already saved an application
    if ($has_aitisi)
    {
        $gamos = mysql_result($result, 0, "gamos");
        $paidia = mysql_result($result, 0, "paidia");
        $dhmos_anhk = mysql_result($result, 0, "dhmos_anhk");
        $dhmos_anhk = str_replace(" ", "&nbsp;", $dhmos_anhk);
        $dhmos_ent = mysql_result($result, 0, "dhmos_ent");
        $dhmos_syn = mysql_result($result, 0, "dhmos_syn");
        $aitisi = mysql_result($result, 0, "aitisi");
        $eidikh = mysql_result($result, 0, "eidikh");
        $apospash = mysql_result($result, 0, "apospash");
        $didakt = mysql_result($result, 0, "didakt");
        $metapt = mysql_result($result, 0, "metapt");
        $didask = mysql_result($result, 0, "didask");
        $paidag = mysql_result($result, 0, "paidag");
        $ethea = mysql_result($result, 0, "eth");
        $mhnesea = mysql_result($result, 0, "mhnes");
        $hmeresea = mysql_result($result, 0, "hmeres");
        $ygeia = mysql_result($result, 0, "ygeia");
        $ygeia_g = mysql_result($result, 0, "ygeia_g");
        $ygeia_a = mysql_result($result, 0, "ygeia_a");
        $eksw = mysql_result($result, 0, "eksw");
        $comments = mysql_result($result, 0, "comments");
        $ypdil = mysql_result($result, 0, "ypdil");
        $org_eid = mysql_result($result, 0, "org_eid");
        $allo = mysql_result($result, 0, "allo");
        $allo = str_replace(" ", "&nbsp;", $allo);
        
        if ($submitted)
            echo "<h3><center>� ������ ���� ��������� ��� ��� �������� �� ��� ��������������.</center></h3>";
        echo "<center>";
        echo "<table id=\"mytbl\" class=\"imagetable\" border=\"2\">\n";
        echo "<thead><th colspan=7>���� 1: ������� ���������</th></thead>";
        echo "<tr><td colspan=2>������������� ���/���:</td><td colspan=5>".$name." ".$surname."</td></tr>";
        echo "<tr><td colspan=2>���������: </td><td colspan=5>".$patrwnymo."</td></tr>";
        echo "<tr><td colspan=2>������: </td><td colspan=5>".$klados."</td></tr>";
        echo "<tr><td colspan=2>A.M.: </td><td colspan=5>".$am."</td></tr>";
        echo "<tr><td colspan=2>�������� ����: </td><td colspan=5>".$organ."</td></tr>";
        echo "<tr><td colspan=2>�������� ��������: <small>(��� $av_endofyear)</small></td><td colspan=5>$eth ���, $mhnes �����, $hmeres ������</td></tr>";
        
        // if user has submitted
        if ($submitted)
        {
            echo "<form id='src' name='src' action='index2.php' method='POST'>\n";
            if ($org_eid)
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='org_eid' value='1' checked disabled>��� �������� ���� ������ ����� (�� ������ ������� � ����� �������)</td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='org_eid' value='1' disabled>��� �������� ���� ������ ����� (�� ������ ������� � ����� �������)</td></tr>";
            if ($aitisi)
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='aitisi' value='1' disabled checked>������� ������ ��������� ����� / ��������� ����������� �� $av_etos</td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='aitisi' value='1' disabled>������� ������ ��������� ����� / ��������� ����������� �� $av_etos</td></tr>";
            echo "<tr height=20></tr><tr><td colspan=7><center>������������ ���������</center></td></tr>";
            echo "<tr><td>�����</td><td>";
            echo getGamos($gamos);
            echo "</td><td>������</td><td>$paidia</td><td>�����</td><td>$dhmos_anhk</td></tr>";
            echo "<tr height=20></tr><tr><td colspan=7><center>�����������</center></td></tr>";
            echo "<tr><td colspan=2>����� ��� ������������� �������� $av_nomos ��� ��� �����������</td><td colspan=5>";
            getDimos($dhmos_ent,$mysqlconnection);
            echo "</td></tr>";
            echo "<tr height=20></tr><tr><td colspan=7><center>������������</center></td></tr>";
            echo "<tr><td colspan=2>����� ��� ������������� �������� $av_nomos ��� ��� ������������</td><td colspan=5>";
            getDimos($dhmos_syn, $mysqlconnection);
            echo "</td></tr>";
            if ($eidikh)
                echo "<tr height=20></tr><tr><td colspan=2><center>������ ��������� (���� �������������)</center></td><td colspan=5><input type='checkbox' name='eidikh' value='1' disabled checked>������� �� ������ �� ������ ��������� ����������</td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=2><center>������ ��������� (���� �������������)</center></td><td colspan=5><input type='checkbox' name='eidikh' value='1' disabled>������� �� ������ �� ������ ��������� ����������</td></tr>";
            if ($apospash)
                echo "<tr height=20></tr><tr><td colspan=2><center>������� ��������</center></td><td colspan=5><input type='checkbox' name='apospash' value='1' disabled checked>��� �� ������ ���� ������ �����</td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=2><center>������� ��������</center></td><td colspan=5><input type='checkbox' name='apospash' value='1' disabled>��� �� ������ ���� ������ �����</td></tr>";
            echo "<div id='ea'><tr><td colspan=2></td><td colspan=5>";
            if ($didakt)
                echo "�) ����������� ���.������<input type='checkbox' name='didakt' value='1' disabled checked><br>";
            else
                echo "�) ����������� ���.������<input type='checkbox' name='didakt' value='1' disabled><br>";
            if ($metapt)
                echo "�) ������������ ���.������<input type='checkbox' name='metapt' value='1' disabled checked><br>";
            else
                echo "�) ������������ ���.������<input type='checkbox' name='metapt' value='1' disabled><br>";
            if ($didask)
                echo "�) ����������� ���.������<input type='checkbox' name='didask' value='1' disabled checked><br>";
            else
                echo "�) ����������� ���.������<input type='checkbox' name='didask' value='1' disabled><br>";
            if ($paidag)
                echo "�) ������ ������������ �������� �� ����������� ���� ������ �����<input type='checkbox' name='paidag' value='1' disabled checked><br>";
            else
                echo "�) ������ ������������ �������� �� ����������� ���� ������ �����<input type='checkbox' name='paidag' value='1' disabled><br>";
            echo "�) ����������� ���� ���.�����: $ethea ���, $mhnesea �����, $hmeresea ������<br>";
            echo "��) ���� ������ (�.�. Braille, ���������): $allo";
            echo "<tr><td colspan=7><small>�� ���������� �������� ��� �� ������� ��� ������� ���/���, ����������� �� <a href='aposp2013.doc'>�����</a> ��� ������� ��� ��� $av_foreas</small></td></tr>";
            echo "</td></tr>";
            
            echo "</div>";
            
            echo "<tr height=20></tr><tr><td colspan=7><center>������� ����� ������</center></td></tr>";
            echo "<tr><td colspan=2><center>��� �����, ������� � �������</center></td><td colspan=5>";
            echo getYgeia($ygeia);
            echo "</td></tr>";
            echo "<tr><td colspan=2><center>������</center></td><td colspan=5>";
            echo getYgeia_g($ygeia_g);
            echo "</td></tr>";
            echo "<tr><td colspan=2><center>�������</center></td><td colspan=5>";
            echo getYgeia_a($ygeia_a);
            echo "</td></tr>";
            if ($eksw)
                echo "<tr><td colspan=2><center>�������� ��� ����������� ������������</center></td><td colspan=5><input type='checkbox' name='eksw' value='1' checked disabled></td></tr>";
            else
                echo "<tr><td colspan=2><center>�������� ��� ����������� ������������</center></td><td colspan=5><input type='checkbox' name='eksw' value='1' disabled></td></tr>";
            echo "<tr height=20></tr><tr><td colspan=2>������ - ������������</td><td colspan=5>$comments</td></tr>";
            $blabla = "������ �������� ��� ��� ��� ������� �������� ����������� (�.�. ������������/���� ����������� �������� �������, ����������/����� ����. �������) ��� ��� ��� ������� �� ���� �� ������ ��� ����� ���� ��� $av_endofyear.";
            echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='ypdil' value='1' checked disabled>$blabla</td></tr>";
            echo "<tr><td colspan=7><small>���������� ����: ".  date("d-m-Y, H:i:s", strtotime(mysql_result($result, 0, "submit_date")))."</small></td></tr>";
            echo "<input type='hidden' name = 'id' value='$id'>";
            echo "</form>";
            echo "<tr><td colspan=7><center><form action='index2.php' method='POST'><input type='submit' value='�������� ��� ���� 2'></form></center></td></tr>";
            echo "<tr><td colspan=7><center><form action='login.php'><input type='hidden' name = 'logout' value=1><input type='submit' value='������'></form></center></td></tr>";
        }
        // if not submitted
        else
        {
            //form
            echo "<form id='src' name='src' action='save.php' method='POST'>\n";
            if ($org_eid)
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='org_eid' value='1' checked>��� �������� ���� ������ ����� (�� ������ ������� � ����� �������)</td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='org_eid' value='1'>��� �������� ���� ������ ����� (�� ������ ������� � ����� �������)</td></tr>";
            if ($aitisi)
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='aitisi' value='1' checked>������� ������ ��������� ����� / ��������� ����������� �� $av_etos</td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='aitisi' value='1'>������� ������ ��������� ����� / ��������� ����������� �� $av_etos</td></tr>";
            echo "<tr height=20></tr><tr><td colspan=7><center>������������ ���������</center></td></tr>";
            echo "<tr><td>�����</td><td>";
            cmbGamos_edit($gamos);
            echo "</td><td>������</td><td>";
            cmbPaidia_edit($paidia);
            echo "</td><td>�����</td><td>";
            //cmbDimos_edit('anhk',$dhmos_anhk);
            echo "<input size=30 name='dhmos_anhk' value=$dhmos_anhk>";
            echo "</td></tr>";
            echo "<tr height=20></tr><tr><td colspan=7><center>�����������</center></td></tr>";
            echo "<tr><td colspan=2>����� ��� ������������� �������� $av_nomos ��� ��� �����������</td><td colspan=5>";
            cmbDimos_edit('ent',$dhmos_ent,$mysqlconnection);
            echo "</td></tr>";
            echo "<tr height=20></tr><tr><td colspan=7><center>������������</center></td></tr>";
            echo "<tr><td colspan=2>����� ��� ������������� �������� $av_nomos ��� ��� ������������</td><td colspan=5>";
            cmbDimos_edit('syn',$dhmos_syn,$mysqlconnection);
            echo "</td></tr>";
            if ($eidikh)
                echo "<tr height=20></tr><tr><td colspan=2><center>������ ��������� (���� �������������)</center></td><td colspan=5><input type='checkbox' name='eidikh' value='1' checked>������� �� ������ �� ������ ��������� ����������</td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=2><center>������ ��������� (���� �������������)</center></td><td colspan=5><input type='checkbox' name='eidikh' value='1'>������� �� ������ �� ������ ��������� ����������</td></tr>";

            if ($apospash)
                echo "<tr height=20></tr><tr><td colspan=2><center>������� ��������</center></td><td colspan=5><div name='main'><input type='checkbox' id='apospash' name='apospash' value='1' checked='1'>��� �� ������ ���� ������ �����</div></td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=2><center>������� ��������</center></td><td colspan=5><div name='main'><input type='checkbox' id='apospash' name='apospash' value='1'>��� �� ������ ���� ������ �����</div></td></tr>";
            if (!$apospash)
                $style = "display:none;";
            else $style = '';
            echo "<tr><td colspan=2></td><td colspan=5><div class='other' name='other' id='other' style='$style'>";
            if ($didakt)
                echo "�) ����������� ���.������<input type='checkbox' name='didakt' value='1' checked><br>";
            else
                echo "�) ����������� ���.������<input type='checkbox' name='didakt' value='1'><br>";
            if ($metapt)
                echo "�) ������������ ���.������<input type='checkbox' name='metapt' value='1' checked><br>";
            else
                echo "�) ������������ ���.������<input type='checkbox' name='metapt' value='1'><br>";
            if ($didask)
                echo "�) ����������� ���.������<input type='checkbox' name='didask' value='1' checked><br>";
            else
                echo "�) ����������� ���.������<input type='checkbox' name='didask' value='1'><br>";
            if ($paidag)
                echo "�) ������ ������������ �������� �� ����������� ���� ������ �����<input type='checkbox' name='paidag' value='1' checked><br>";
            else
                echo "�) ������ ������������ �������� �� ����������� ���� ������ �����<input type='checkbox' name='paidag' value='1'><br>";
            echo "�) ����������� ���� ���.�����: <input size=2 name='eth' value=$ethea> ���,<input size=2 name='mhnes' value=$mhnesea> �����,<input size=2 name='hmeres' value=$hmeresea> ������<br>";
            echo "��) ���� ������ (�.�. Braille, ���������): <input size=25 name='allo' value=$allo>";
            echo "<br><small>�� ���������� �������� ��� �� ������� ��� ������� ���/���, ����������� �� <a href='aposp2013.doc'>�����</a> ��� ������� ��� ��� $av_foreas </small></div></td></div></tr>";
            //echo "</div>";
            
            echo "<tr height=20></tr><tr><td colspan=7><center>������� ����� ������</center></td></tr>";
            echo "<tr><td colspan=2><center>������� ��������� ��� �����, ������� � �������</center></td><td colspan=5>";
            cmbYgeia_edit($ygeia);
            echo "</td></tr>";
            echo "<tr><td colspan=2><center>������� ��������� ������</center></td><td colspan=5>";
            cmbYgeia_g_edit($ygeia_g);
            echo "</td></tr>";
            echo "<tr><td colspan=2><center>������� ��������� �������</center></td><td colspan=5>";
            cmbYgeia_a_edit($ygeia_a);
            echo "</td></tr>";
            if ($eksw)
                echo "<tr><td colspan=2><center>�������� ��� ����������� ������������</center></td><td colspan=5><input type='checkbox' name='eksw' value='1' checked></td></tr>";
            else
                echo "<tr><td colspan=2><center>�������� ��� ����������� ������������</center></td><td colspan=5><input type='checkbox' name='eksw' value='1'></td></tr>";
            echo "<tr height=20></tr><tr><td colspan=2>������ - ������������</td><td colspan=5><textarea cols=60 name='comments' >$comments</textarea></td></tr>";
            
            $blabla = "������ �������� ��� ��� ��� ������� �������� ����������� (�.�. ������������/���� ����������� �������� �������, ����������/����� ����. �������) ��� ��� ��� ������� �� ���� �� ������ ��� ����� ���� ��� 31-08-$av_etos.";
            if ($ypdil)
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='ypdil' value='1' checked>$blabla</td></tr>";
            else
                echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='ypdil' value='1'>$blabla</td></tr>";
            echo "<tr><td colspan=7><small>��������� ���������: ". date("d-m-Y, H:i:s", strtotime(mysql_result($result, 0, "updated")))."</small></td></tr>";
            echo "<input type='hidden' name = 'id' value='$id'>";
            echo "<input type='hidden' name = 'part' value='1'>";
            echo "<tr><td colspan=7><center><INPUT TYPE='submit' name='save' VALUE='����������'></center></td></tr>";
            echo "<tr><td colspan=7><center><INPUT TYPE='submit' name='next' VALUE='�������� ��� ���� 2'></center></td></tr>";
            echo "</form>";
            //echo "<tr><td colspan=7><center><form action='index2.php' method='POST'><input type='submit' value='������� ������'></form></center></td></tr>";            
            //echo "<tr><td colspan=4><center><INPUT TYPE='submit' onclick='return myaction()' name='submit' VALUE='�������� �������'></center></td>\n";
            echo "</tr>\n";
            echo "</form>";
            echo "<tr><td colspan=7><center><form action='login.php'><input type='hidden' name = 'logout' value=1><input type='submit' value='������'></form></center></td></tr>";
        }
        echo "</table>";
        echo "</center>";
    }
    // if user has NOT saved an application
    else
    {
        echo "<center>";        
        echo "<table id=\"mytbl\" class=\"imagetable\" border=\"2\">\n";
        echo "<thead><th colspan=7>����� �������� ���������</th></thead>";
        echo "<tr><td colspan=2>������������� ���/���:</td><td colspan=5>".$name." ".$surname."</td></tr>";
        echo "<tr><td colspan=2>���������: </td><td colspan=5>".$patrwnymo."</td></tr>";
        echo "<tr><td colspan=2>������: </td><td colspan=5>".$klados."</td></tr>";
        echo "<tr><td colspan=2>A.M.: </td><td colspan=5>".$am."</td></tr>";
        echo "<tr><td colspan=2>�������� ����: </td><td colspan=5>".$organ."</td></tr>";
        echo "<tr><td colspan=2>�������� ��������: <small>(��� $av_endofyear)</small></td><td colspan=5>$eth ���, $mhnes �����, $hmeres ������</td></tr>";
        
        echo "<form id='src' name='src' action='save.php' method='POST'>\n";
        echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='org_eid' value='1'>��� �������� ���� ������ ����� (�� ������ ������� � ����� �������)</td></tr>";
        echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='aitisi' value='1'>������� ������ ��������� ����� / ��������� ����������� �� $av_etos</td></tr>";
        echo "<tr height=20></tr><tr><td colspan=7><center>������������ ���������</center></td></tr>";
        echo "<tr><td>�����</td><td>";
        cmbGamos();
        echo "</td><td>������</td><td>";
        cmbPaidia();
        echo "</td><td>�����</td><td>";
        echo "<input size=30 name='dhmos_anhk'>";
        echo "</td><td></td></tr>";
        echo "<tr height=20></tr><tr><td colspan=7><center>�����������</center></td></tr>";
        echo "<tr><td colspan=2>����� ��� ������������� �������� $av_nomos ��� ��� �����������</td><td colspan=5>";
        cmbDimos('ent',$mysqlconnection);
        echo "</td></tr>";
        echo "<tr height=20></tr><tr><td colspan=7><center>������������</center></td></tr>";
        echo "<tr><td colspan=2>����� ��� ������������� �������� $av_nomos ��� ��� ������������</td><td colspan=5>";
        cmbDimos('syn',$mysqlconnection);
        echo "</td></tr>";
        echo "<tr height=20></tr><tr><td colspan=2><center>������ ��������� (���� �������������)</center></td><td colspan=5><input type='checkbox' name='eidikh' value='1'>������� �� ������ �� ������ ��������� ����������</td></tr>";

            echo "<tr height=20></tr><tr><td colspan=2><center>������� ��������</center></td><td colspan=5><div name='main'><input type='checkbox' id='apospash' name='apospash' value='1'>��� �� ������ ���� ������ �����</div></td></tr>";
            $style = "display:none;";
            echo "<tr><td colspan=2></td><td colspan=5><div class='other' name='other' id='other' style='$style'>";
            echo "�) ����������� ���.������<input type='checkbox' name='didakt' value='1'><br>";
            echo "�) ������������ ���.������<input type='checkbox' name='metapt' value='1'><br>";
            echo "�) ����������� ���.������<input type='checkbox' name='didask' value='1'><br>";
            echo "�) ������ ������������ �������� �� ����������� ���� ������ �����<input type='checkbox' name='paidag' value='1'><br>";
            echo "�) ����������� ���� ���.�����: <input size=2 name='eth'> ���,<input size=2 name='mhnes'> �����,<input size=2 name='hmeres'> ������<br>";
            echo "��) ���� ������ (�.�. Braille, ���������): <input size=25 name='allo' value=$allo>";
            echo "<br><small>�� ���������� �������� ��� �� ������� ��� ������� ���/���, ����������� �� <a href='aposp2013.doc'>�����</a> ��� ������� ��� ��� $av_foreas </small></div></td></div></tr>";
        
        echo "<tr height=20></tr><tr><td colspan=7><center>������� ����� ������</center></td></tr>";
        echo "<tr><td colspan=2><center>������� ��������� ��� �����, ������� � �������</center></td><td colspan=5>";
        cmbYgeia_edit(0);
        echo "</td></tr>";
        echo "<tr><td colspan=2><center>������� ��������� ������</center></td><td colspan=5>";
        cmbYgeia_g_edit(0);
        echo "</td></tr>";
        echo "<tr><td colspan=2><center>������� ��������� �������</center></td><td colspan=5>";
        cmbYgeia_a_edit(0);
        echo "</td></tr>";
        echo "<tr><td colspan=2><center>�������� ��� ����������� ������������</center></td><td colspan=5><input type='checkbox' name='eksw' value='1'></td></tr>";
        echo "<tr height=20></tr><tr><td colspan=2>������ - ������������</td><td colspan=5><textarea cols=60 name='comments' value='$comments'></textarea></td></tr>";        
        $blabla = "������ �������� ��� ��� ��� ������� �������� ����������� (�.�. ������������/���� ����������� �������� �������, ����������/����� ����. �������) ��� ��� ��� ������� �� ���� �� ������ ��� ����� ���� ��� 31-08-$av_etos.";
        echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='ypdil' value='1'>$blabla</td></tr>";
        echo "<tr height=20><tr><tr><td colspan=7><small>����������� ��� �� ��������� �� ����������� ���� ������� �����������.</small></td></tr>";
        echo "<input type='hidden' name = 'id' value='$id'>";
        echo "<input type='hidden' name = 'part' value='1'>";
        echo "<tr><td colspan=7><center><INPUT TYPE='submit' name='save' VALUE='����������'></center></td></tr>";
        echo "<tr><td colspan=7><center><INPUT TYPE='submit' name='submit' VALUE='�������� ��� ���� 2' disabled></center></td></tr>";
        echo "</form>";
        echo "<tr><td colspan=7><center><form action='login.php'><input type='hidden' name = 'logout' value=1><input type='submit' value='������'></form></center></td></tr>";
        echo "</table>";
        echo "</center>";
    }
     mysql_close();   
    }
?>
  </div>
</center>
</div>
  </body>
</html>