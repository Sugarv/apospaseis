<?php
require_once 'config.php';

function getSchooledc ($id,$conn)
{
        global $av_sch;
        $query = "SELECT name from $av_sch where kwdikos=".$id;
        $result = mysql_query($query, $conn);
        if (mysql_num_rows($result)==0) 
            return "";
        else
            return mysql_result($result, 0);	
}
function getSchool ($id,$conn)
{
    global $av_sch;
    if (!$id)
        return "";
        $query = "SELECT name from $av_sch where id=".$id;
        $result = mysql_query($query, $conn);
        if (mysql_num_rows($result)==0) 
            return "";
        else
            return mysql_result($result, 0);	
}
function getSchoolID ($name,$conn)
{
    global $av_sch;
    $query = "SELECT id from $av_sch where name='".$name."'";
    $result = mysql_query($query, $conn);
    if (mysql_num_rows($result)==0) 
        return 0;
    else
        return mysql_result($result, 0);	
}
function getSchoolcode ($id, $conn)
{
    global $av_sch;
    $query = "SELECT kwdikos from $av_sch where id=".$id;
    $result = mysql_query($query, $conn);
    if (mysql_num_rows($result)==0) 
        return 0;
    else
        return mysql_result($result, 0);	
}

// epil: epilogh 1-20 / dim: 2 dhmotiko,1 nip,0 ola / omada / sch: sxoleio (lektiko)
function getSchools ($epil, $dim, $omada, $conn, $sch)
{
    global $av_sch;
    if (!$omada && !$dim)
        $query = "select DISTINCT name,id from $av_sch WHERE inactive<>1 order by name";
    if (!$omada && $dim)
        $query = "select DISTINCT name,id from $av_sch where dim=$dim AND inactive<>1 order by name";
    if ($omada && $dim)
        $query = "select DISTINCT name,id from $av_sch where dim=$dim AND omada <> $omada AND inactive<>1 order by name";
    $arr = array();
    $result = mysql_query($query, $conn);
    while ($ar = mysql_fetch_array($result))
        $arr[] = $ar;
    $ret = "<select name='p".$epil."' id='p".$epil."'>";
    $ret .= "<option value=\"\"></option>";
    foreach ($arr as $res)
    {
        //print_r($res);
        if ($sch == $res[0])
            $ret .= "<option value=\"$res[1]\" selected>".$res[0]."</option>";
        else
            $ret .= "<option value=\"$res[1]\">".$res[0]."</option>";
    }
    $ret .= "</select>";
    return $ret;
}

function getGamos ($gamos)
{
    switch ($gamos)
    {
        case 0:$ret = "������";break;
        case 1:$ret = "�������";break;
        case 2:$ret = "������������/�� �������� �� ��������� ������� �������� � ������������";break;
        case 3:$ret = "�� ������ ����� ������ ������� � �����������";break;
        case 4:$ret = "�� ������ �� ������ ������� � �����������";break;
        case 5:$ret = "����������� ���������� (����� ����) �� ������ ������� � �����������";break;
    }
    return $ret;
}
function getDimos ($dimos_code, $conn)
{
    global $av_dimos;
    $query = "SELECT name from $av_dimos where id=$dimos_code";
        $result = mysql_query($query, $conn);
        if (mysql_num_rows($result)==0) 
            echo "";
        else
            echo mysql_result($result, 0);
}
function cmbGamos ()
{
    echo "<select name=\"gamos\" style=\"width:200px\">";
    echo "<option value=\"\" selected>(�������� ��������:)</option>";
    echo "<option value=\"0\">������</option>";
    echo "<option value=\"1\">�������</option>";
    echo "<option value=\"2\">������������/�� �������� �� ��������� ������� �������� � ������������</option>";
    echo "<option value=\"3\">�� ������ ����� ������ ������� � �����������</option>";
    echo "<option value=\"4\">�� ������ �� ������ ������� � �����������</option>";
    echo "<option value=\"5\">����������� ���������� (����� ����) �� ������ ������� � �����������</option>";
    
    echo "</select>";
}
function cmbPaidia ()
{
    echo "<select name=\"paidia\">";
    echo "<option value=\"\" selected>(�������� ��������:)</option>";
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
    echo "<option value=\"0\" selected>(�������� ��������:)</option>";
    global $av_dimos;
    $query = "SELECT * from $av_dimos";
    $result = mysql_query($query, $conn);
    while ($arr = mysql_fetch_array($result)){
        echo "<option value=".$arr['id'].">".$arr['name']."</option>";
    }
    echo "</select>";
}
function cmbDimos_edit ($str, $epil, $conn)
{
    echo "<select name=\"dhmos_$str\">";
    global $av_dimos;
    $query = "SELECT * from $av_dimos";
    $result = mysql_query($query, $conn);
    while ($arr = mysql_fetch_array($result)){
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
    if ($epil=='') echo "<option value=\"\" selected>(�������� ��������:)</option>";
    else echo "<option value=\"\">(�������� ��������:)</option>";
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
    if ($epil=='') echo "<option value=\"\" selected>(�������� ��������:)</option>";
    else echo "<option value=\"\">(�������� ��������:)</option>";
    if ($epil==0) echo "<option value=\"0\" selected>������</option>";
    else echo "<option value=\"0\">������</option>";
    if ($epil==1) echo "<option value=\"1\" selected>�������</option>";
    else echo "<option value=\"1\">�������</option>";
    if ($epil==2) echo "<option value=\"2\" selected>������������/�� �������� �� ��������� ������� �������� � ������������</option>";
    else echo "<option value=\"2\">������������/�� �������� �� ��������� ������� �������� � ������������</option>";
    if ($epil==3) echo "<option value=\"3\" selected>�� ������ ����� ������ ������� � �����������</option>";
    else echo "<option value=\"3\">�� ������ ����� ������ ������� � �����������</option>";
    if ($epil==4) echo "<option value=\"4\" selected>�� ������ �� ������ ������� � �����������</option>";
    else echo "<option value=\"4\">�� ������ �� ������ ������� � �����������</option>";
    if ($epil==5) echo "<option value=\"1\" selected>����������� ���������� (����� ����) �� ������ ������� � �����������</option>";
    else echo "<option value=\"1\">����������� ���������� (����� ����) �� ������ ������� � �����������</option>";
    echo "</select>";    
}

function cmbYgeia_edit ($epil)
{
    echo "<select name=\"ygeia\">";
    if ($epil==0) echo "<option value=\"0\" selected>(�������� ��������:)</option>";
        else echo "<option value=\"0\">(�������� ��������:)</option>";
    if ($epil==1) echo "<option value=\"1\" selected>50-60%</option>";
        else echo "<option value=\"1\">50-60%</option>";
    if ($epil==2) echo "<option value=\"2\" selected>67-79%</option>";
        else echo "<option value=\"2\">67-79%</option>";
    if ($epil==3) echo "<option value=\"3\" selected>80% ��� ���</option>";
        else echo "<option value=\"3\">80% ��� ���</option>";
    echo "</select>";
}
function cmbYgeia_g_edit ($epil)
{
    echo "<select name=\"ygeia_g\">";
    if ($epil==0) echo "<option value=\"0\" selected>(�������� ��������:)</option>";
        else echo "<option value=\"0\">(�������� ��������:)</option>";
    if ($epil==1) echo "<option value=\"1\" selected>50-66%</option>";
        else echo "<option value=\"1\">50-66%</option>";
    if ($epil==2) echo "<option value=\"2\" selected>67% ��� ���</option>";
        else echo "<option value=\"2\">67% ��� ���</option>";
    echo "</select>";
}
function cmbYgeia_a_edit ($epil)
{
    echo "<select name=\"ygeia_a\">";
    if ($epil==0) echo "<option value=\"0\" selected>(�������� ��������:)</option>";
        else echo "<option value=\"0\">(�������� ��������:)</option>";
    if ($epil==1) echo "<option value=\"1\" selected>67% ��� ���</option>";
        else echo "<option value=\"1\">67% ��� ���</option>";
    echo "</select>";
}
function getYgeia ($y)
{
    switch ($y)
    {
        case 0:
            $ret = "���";
            break;
        case 1:
            $ret = "50-60%";
            break;
        case 2:
            $ret = "67-79%";
            break;
        case 3:
            $ret = "80% ��� ���";
            break;
    }
    return $ret;
}
function getYgeia_g ($y)
{
    switch ($y)
    {
        case 0:
            $ret = "���";
            break;
        case 1:
            $ret = "50-66%";
            break;
        case 2:
            $ret = "67% ��� ���";
            break;
    }
    return $ret;
}
function getYgeia_a ($y)
{
    switch ($y)
    {
        case 0:
            $ret = "���";
            break;
        case 1:
            $ret = "67% ��� ���";
            break;
    }
    return $ret;
}
// source: http://stackoverflow.com/questions/4027769/running-mysql-sql-files-in-php
// Run .sql files in PHP
function run_sql_file($location, $av_emp, $av_dimos, $av_ait, $av_sch, $db_name){
    //load file & replace table names
    $tags = array ('apo_employee', 'apo_dimos','apo_aitisi','apo_school','%aposp%');
    $elem = array ( $av_emp, $av_dimos, $av_ait, $av_sch, $db_name );
    $commands = str_replace($tags, $elem, file_get_contents($location));

    //delete comments
    $lines = explode("\n",$commands);
    $commands = '';
    foreach($lines as $line){
        $line = trim($line);
        if( $line && !startsWith($line,'--') ){
            $commands .= $line . "\n";
        }
    }

    //convert to array
    $commands = explode(";", $commands);

    //run commands
    $total = $success = 0;
    foreach($commands as $command){
	
        if(trim($command)){
            $success += (@mysql_query($command)==false ? 0 : 1);
            $total += 1;
        }
    }

    //return number of successful queries and total number of queries found
    return array(
        "success" => $success,
        "total" => $total
    );
}


// Here's a startsWith function
function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}
?>
