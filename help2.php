<?php require_once 'config.php'; ?>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic&subset=greek,latin' rel='stylesheet' type='text/css'>
    </head>
    <body>
<br><br><br>
<p class="main"><?php echo $av_title." ($av_foreas)"; ?>
<br>
<br>
    <u><strong>������� �������� ����������� <?php if ($av_type==1) echo "(���� 2):"; ?></strong></u>
<br>
- ��� �� ��������� ��� ������� �� ����������� ���������, �������� �� ��� �� �����.
<br>
- ��� �� ���������� ��� �������, ������� ����� ���, ��� ��������� <img src="js/clear_cross.png">.
<br>
������, ��������� ��������� ��� ��� ��� ��������� �����������.
<br><br>
- ��� �� ������������ ��������� ��� ������ ���, ������� ��� ������ <strong>"����������"</strong>.
<br>
����, �� ����������� ��� ���������� ������������� ��� ���� ������������� ��� ���������������.
<br><br>
<?php if ($av_type == 1) echo "- ��� �� ����������� ��� ����������� ����, ������� �� ���������� ������.<br><br>"; ?>
- ��� �� ��������� �������� ��� ������, ������� <strong>"�������� �������"</strong> ��� ������ "���" ���� ���������� ��� �����������.
<br>
<br>
<?php if ($av_type == 2) echo "- ��� �� ������ <strong>�������� ������</strong>, ������� \"����������\" ��� ������ \"�������� �������\" ����� �� ����� �������� ������ �������.<br><br>"; ?>
<strong><u>�������:</u></strong> � �������� ������� ����� <strong>�����������</strong> ��� �� ������� �� ������ ������� ���� ���������������.
<br>
</p>
<?php if ($av_type == 2) echo "<p><a href=\"$av_link_vel\" target=\"_blank\"><small>������� �������</small></a></p>"; ?>
<p>
<br>
<small>
    �������� - ��������: <a href="mailto:sugarv@sch.gr?subject=����������/����������">�.�������������, ��20</a>
<br>
���������: ���������� <?php echo $av_foreas; ?>
</small>
</p>
</body>
</html>