<?php
	header('Content-type: text/html; charset=iso8859-7'); 
        require_once "config.php";
        require_once "functions.php";
        session_start();
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=iso8859-7">
    <title>�������� �������</title>
    <LINK href="style_2.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        @media print
        {
        .noprint {display:none;}
        }

        @media screen
        {
        }
    </style>
  </head>
  <body> 
<?php
  echo "<div class=\"print\">";
  echo "<center><h3>$av_title ($av_foreas)</h3></center>";
  $serial = $_POST['sch_arr'];
  $ser_cred = $_POST['cred_arr'];
  $scharr = unserialize(stripslashes($serial));
  
//  echo "<center>";
//  echo "<table id=\"mytbl\" border=\"2\">\n";
//  echo "<thead><th colspan=4>���������������� ������ ��� �������� ���������� � �������� �����</th></thead>";
//  echo "<tr><td>������������� ���/���:</td><td colspan=3>".$credarr[0]." ".$credarr[1]."</td></tr>";
//  echo "<tr><td>���������: </td><td colspan=3>".$credarr[2]."</td></tr>";
//  echo "<tr><td>������: </td><td colspan=3>".$credarr[3]."</td></tr>";
//  echo "<tr><td>A.M.: </td><td colspan=3>".$_SESSION['user']."</td></tr>";
//  echo "<tr><td>�������� ����: </td><td colspan=3>".$credarr[4]."</td></tr>";
    
    $query = "SELECT * from $av_emp WHERE am = ".$_SESSION['user'];
    $mysqlconnection = mysql_connect($db_host, $db_user, $db_password);
    mysql_select_db($db_name, $mysqlconnection);
    mysql_query("SET NAMES 'greek'", $mysqlconnection);
    mysql_query("SET CHARACTER SET 'greek'", $mysqlconnection);
    $result = mysql_query($query, $mysqlconnection);
    $name = mysql_result($result, 0, "name");
    $surname = mysql_result($result, 0, "surname");
    $patrwnymo = mysql_result($result, 0, "patrwnymo");
    $klados = mysql_result($result, 0, "klados");
    $id = mysql_result($result, 0, "id");
    $am = $_SESSION['user'];
    $organ = mysql_result($result, 0, "org");
    $ethy = mysql_result($result, 0, "eth");
    $mhnesy = mysql_result($result, 0, "mhnes");
    $hmeresy = mysql_result($result, 0, "hmeres");

    $query = "SELECT * from $av_ait WHERE emp_id=$id";
    $result = mysql_query($query, $mysqlconnection);
    $gamos = mysql_result($result, 0, "gamos");
    $paidia = mysql_result($result, 0, "paidia");
    $dhmos_anhk = mysql_result($result, 0, "dhmos_anhk");
    $dhmos_ent = mysql_result($result, 0, "dhmos_ent");
    $dhmos_syn = mysql_result($result, 0, "dhmos_syn");
    $aitisi = mysql_result($result, 0, "aitisi");
    $eidikh = mysql_result($result, 0, "eidikh");
    $apospash = mysql_result($result, 0, "apospash");
    $didakt = mysql_result($result, 0, "didakt");
    $metapt = mysql_result($result, 0, "metapt");
    $didask = mysql_result($result, 0, "didask");
    $paidag = mysql_result($result, 0, "paidag");
    $eth = mysql_result($result, 0, "eth");
    $mhnes = mysql_result($result, 0, "mhnes");
    $hmeres = mysql_result($result, 0, "hmeres");
    $ygeia = mysql_result($result, 0, "ygeia");
    $ygeia_g = mysql_result($result, 0, "ygeia_g");
    $ygeia_a = mysql_result($result, 0, "ygeia_a");
    $eksw = mysql_result($result, 0, "eksw");
    $comments = mysql_result($result, 0, "comments");
    $ypdil = mysql_result($result, 0, "ypdil");
    $org_eid = mysql_result($result, 0, "org_eid");
    $allo = mysql_result($result, 0, "allo");
    
    echo "<center>";
    echo "<table id=\"mytbl\" class=\"imagetable\" border=\"2\">\n";
    echo "<thead><th colspan=7>����� �������� ���������</th></thead>";
    echo "<tr><td colspan=2>������������� ���/���:</td><td colspan=5>".$name." ".$surname."</td></tr>";
    echo "<tr><td colspan=2>���������: </td><td colspan=5>".$patrwnymo."</td></tr>";
    echo "<tr><td colspan=2>������: </td><td colspan=5>".$klados."</td></tr>";
    echo "<tr><td colspan=2>A.M.: </td><td colspan=5>".$am."</td></tr>";
    echo "<tr><td colspan=2>�������� ����: </td><td colspan=5>".getSchooledc($organ, $mysqlconnection)."</td></tr>";    
    if ($av_type == 1)
    {
		echo "<tr><td colspan=2>�������� ��������: </td><td colspan=5>$ethy ���, $mhnesy �����, $hmeresy ������</td></tr>";
        if ($org_eid)
            echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='org_eid' value='1' checked disabled>��� �������� ���� ������ ����� (�� ������ ������� � ����� �������)</td></tr>";
        else
            echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='org_eid' value='1' disabled>��� �������� ���� ������ ����� (�� ������ ������� � ����� �������)</td></tr>";
        if ($aitisi)
            echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='aitisi' value='1' disabled checked>������� ������ ��������� ����� / ��������� ����������� �� 2013</td></tr>";
        else
            echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='aitisi' value='1' disabled>������� ������ ��������� ����� / ��������� ����������� �� 2013</td></tr>";
        echo "<tr height=20></tr><tr><td colspan=7><center>������������ ���������</center></td></tr>";
        echo "<tr><td>�����</td><td>";
        echo getGamos($gamos);
        echo "</td><td>������</td><td>$paidia</td><td>�����</td><td>$dhmos_anhk</td></tr>";
        echo "<tr height=20></tr><tr><td colspan=7><center>�����������</center></td></tr>";
        echo "<tr><td colspan=2>����� ��� ������������� �������� ��������� ��� ��� �����������</td><td colspan=5>";
        getDimos($dhmos_ent,$mysqlconnection);
        echo "</td></tr>";
        echo "<tr height=20></tr><tr><td colspan=7><center>������������</center></td></tr>";
        echo "<tr><td colspan=2>����� ��� ������������� �������� ��������� ��� ��� ������������</td><td colspan=5>";
        getDimos($dhmos_syn,$mysqlconnection);
        echo "</td></tr>";
        if ($eidikh)
            echo "<tr height=20></tr><tr><td colspan=2><center>������ ���������</center></td><td colspan=5><input type='checkbox' name='eidikh' value='1' disabled checked>������� �� ������ �� ������ ��������� ����������</td></tr>";
        else
            echo "<tr height=20></tr><tr><td colspan=2><center>������ ���������</center></td><td colspan=5><input type='checkbox' name='eidikh' value='1' disabled>������� �� ������ �� ������ ��������� ����������</td></tr>";
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
        echo "�) ����������� ���� ���.�����: $eth ���, $mhnes �����, $hmeres ������<br>";
        echo "��) ���� ������ (�.�. Braille, ���������): $allo";
        echo "</td></tr></div>";

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
        $blabla = "������ �������� ��� ��� ��� ������� �������� ����������� (�.�. ������������/���� ����������� �������� �������, ����������/����� ����. �������)<br> ��� ��� ��� ������� �� ���� �� ������ ��� ����� ���� ��� 31-08-2013.";
        echo "<tr height=20></tr><tr><td colspan=7><input type='checkbox' name='ypdil' value='1' checked disabled>$blabla</td></tr>";

        //echo "<tr><td colspan=7><small>���������� ����: ".  date("d-m-Y, H:i:s", strtotime(mysql_result($result, 0, "submit_date")))."</small></td></tr>";
        echo "<input type='hidden' name = 'id' value='$id'>";
    }
    //echo "</form>";
    
  echo "<tr><td colspan=7><center><strong>�����������</strong></center></td></tr>";
  $i=1;
  $sum=0;
  foreach ($scharr as $arr)
  {
      if ($arr)
        echo "<tr><td>".$i."� ���������</td><td colspan=6>$arr</td></tr>\n";
        //echo $i." epilogh: ".$arr."<br>";
      $i++;
	  //$sum+=$arr;
//	  $sum.=$arr;
  }
  //if (!$sum)
  //    echo "<tr><td colspan=2><center>�������� ������</center></td></tr>\n";
  echo "<tr><td colspan=7><small>���������� ����: ".  date("d-m-Y, H:i:s", strtotime(mysql_result($result, 0, "submit_date")))."</small></td></tr>";
  echo "<tr style='height:30px'><td colspan=7>&nbsp;</td></tr>";
  echo "<tr><td colspan=4></td><td align='center'>�/� �������������</td></tr>";
  echo "<tr style='height:60px'><td colspan=7>&nbsp;</td></tr>";
  echo "<tr><td colspan=4></td><td align='center'>$name $surname</td></tr>";
  echo "</table>";
  echo "</center>";
  echo "</div>";
  
  echo "<div class=\"noprint\">";
  echo "<center>";
  echo "<br>";
  
  echo "<table><center>";
  echo "<tr><td><input type='button' value='��������' onclick='javascript:window.print()' /></td></tr>";
  echo "<tr><td><form action='index2.php'><input type='submit' value='���������'></form></center></td></tr></table>";
  echo "</div>";


echo "</body>";
echo "</html>";

?>