<?php
  session_start();
  header('Content-type: text/html; charset=iso8859-7'); 
  Require "config.php";
  require_once 'functions.php';
?>
<html>
  <head>
	<LINK href="style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="content-type" content="text/html; charset=iso8859-7">
        <title><?php echo "$av_title ($av_dnsh)"; ?></title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.clearableTextField.js"></script>
        <link rel="stylesheet" href="js/jquery.clearableTextField.css" type="text/css" media="screen" />
	<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
	<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic&subset=greek,latin' rel='stylesheet' type='text/css'>
  </head>
  <body>
<?php
if (!isset($_POST['pass']) && !isset($_SESSION['auth']))
{
	echo "<h2> ������������ ����� ��������� </h2>";
	echo "<h3>���������� ����� ��������� � ��������� ���� ������ ��������� (���� ����)</h3>";
	echo "���.: To script ���� ���������� �� ���� �� ����� <strong>$db_name</strong> ��� ������� <strong>$av_emp, $av_ait, $av_sch, $av_dimos</strong>.<br><br>";
	echo "�������: ���� �����������, ������ �� ��������� ��� ����������� ��� ������ <strong><i>config.php</i></strong><br><br>";
	echo "<strong>�������������: � �������� ���� ��� ����� �����������...</strong><br><br>";
	echo "<form action='init.php' method='POST'>";
	echo "����� ��������� ������ ����������� (����������� ����������) :&nbsp;&nbsp;&nbsp;<input type='text' id='adminpass' name='adminpass'><br>";
	echo "����� ������ ��������� ��� ������������ <small>(��. config.php)</small>:&nbsp;&nbsp;&nbsp;<input type='text' id='pass' name='pass'><br><input type='submit' value='������������'></form>";
	exit;
}
if (($_POST['pass'] == $av_init_pass) && !isset($_SESSION['auth']))
		$_SESSION['auth'] = 1;
elseif (!isset ($_SESSION['auth']))
	die ('����� �������');
	
if ($_SESSION['auth'])
{
    $mysqlconnection = mysql_connect($db_host, $db_user, $db_password);
    mysql_select_db($db_name, $mysqlconnection);
    mysql_query("SET NAMES 'greek'", $mysqlconnection);
    mysql_query("SET CHARACTER SET 'GREEK'", $mysqlconnection);
    if (!$_SESSION['inserted'])
    {
	echo "<h3>������������ ����� ���������</h3>";
	
	$sql_res = run_sql_file('aposp.sql', $av_emp, $av_dimos, $av_ait, $av_sch, $db_name);
	
	if (strlen($_POST['adminpass'])>0 && is_numeric($_POST['adminpass']))
		$admin_pass = $_POST['adminpass'];
	else
		$admin_pass = "321";
	$query = "INSERT INTO `apo_employee` (`id`, `name`, `surname`, `patrwnymo`, `klados`, `am`, `afm`, `org`, `eth`, `mhnes`, `hmeres`, `lastlogin`) VALUES (0, 'admin', '', '', '', '$av_admin', '$admin_pass', '0', '0', '0', '0', CURRENT_TIMESTAMP)";
	$result = mysql_query($query, $mysqlconnection);
		
	echo "������������ �� �������� ".$sql_res['success']." ��� ".$sql_res['success']." ��������� ��� ���� ���������.<br>";
	echo "������� �����������: $admin_pass<br><br>";
        $_SESSION['inserted']=1;
    }   
        
        //Upload File
        
        if (isset($_POST['submit'])) {
                if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                    echo "<h3>" . "To ������ ". $_FILES['filename']['name'] ." ������� �� ��������." . "</h3>";


                    //Import uploaded file to Database
                    $handle = fopen($_FILES['filename']['tmp_name'], "r");
                    switch ($_POST['type'])
                    {
                        case 1:
                            mysql_query("DELETE FROM $av_emp WHERE am <> '$av_admin'");
                            $tbl = $av_emp;
                            break;
                        case 2:
                            mysql_query("TRUNCATE $av_sch");
                            $tbl = $av_sch;
                            break;
                        case 3:
                            mysql_query("TRUNCATE $av_dimos");
                            $tbl = $av_dimos;
                            break;
                    }
                    $num = 0;
                    $checked = 0;
                    $headers = 1;
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        // skip header line
                        if ($headers){
                            $headers = 0;
                            continue;
                        }
                        // check if csv & table columns are equal
                        if (!$checked)
                        {
                            $csvcols = count($data);
                            $qry = "SELECT count(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '$db_name' AND table_name = '$tbl'";
                            $res = mysql_query($qry);
                            $tblcols = mysql_result($res, 0);
                            if ($csvcols <> $tblcols)
                            {
                                echo "<h3>������: ����� ������ (������ �������: $csvcols <> ������ ������: $tblcols)</h3>";
                                $ret = 0;
                                break;
                            }
                            else
                                $checked = 1;
                        }

                        switch ($_POST['type']){
                            // employees
                            case 1:

                                $import="INSERT into $av_emp(id,name,surname,patrwnymo,klados,am,afm,org,eth,mhnes,hmeres,lastlogin) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]')";
                                break;
                            // schools
                            case 2:
                                $import="INSERT into $av_sch(id,name,kwdikos,dim,omada,inactive) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";
                                break;
                            // dimoi
                            case 3:
                                $import="INSERT into $av_dimos(id,name) values('$data[0]','$data[1]')";
                                break;
                        }
                        // set max execution time (for large files)
                        set_time_limit (480);
                            $ret = mysql_query($import);
                        $num++;
                    }

                    fclose($handle);
                    if ($ret){
                        print "<h3>� �������� ���������������� �� ��������</h3>";
                        echo "����� �������� $num �������� ���� ������ $tbl.<br>";
                    }
                    else
                    {
                        echo "<h3>������������� ������ ���� ��� ��������</h3>";
                        echo "������� �� ������ � ������������� �� �� �����������.<br>";
                        echo mysql_error() ? "������ ������:".mysql_error() : '';
                        echo $num ? "����� �������� $num �������� ���� ������ $tbl.<br>" : '';
                    }
                }
                else {
                    echo "��� ��������� ������";
                }

                //view upload form
        }
                echo "<h2>�������� ���������</h2>";
                print "������������ �������� ��� �������<br />\n";
                print "<form enctype='multipart/form-data' action='init.php' method='post'>";
                print "����� ������� ���� ��������:<br />\n";
                print "<input size='50' type='file' name='filename'><br />\n";
                echo "<br>����� ���������:<br>";
                echo "<input type='radio' name='type' value='1'>���������<br>";
                echo "<input type='radio' name='type' value='2'>�������<br>";
                echo "<input type='radio' name='type' value='3' >�����<br>";
                print "<input type='submit' name='submit' value='�����������'></form>";
                echo "<small>���.: � �������� ��������� �� ��������� ������ �����, ������ ��� ������ ������.<br>�� ������ ��� �� ������ �� ��� ������ ������ ������.</small>";

                
	echo "<h3>��� ������ ���������, �������� ��������� �� ������ init.php ���� ����������...</h3><br>";
	echo "<a href='login.php'>���������</a>";
	exit;
}	
	
?>

</body>
</html>
	