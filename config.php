<?php
  // ������� ���������� ���������� 
  // �������� �������������, ��20
  // �����������: sugarv@sch.gr
  // (c) 2013-14
  //
  // ���.: ���� ��� �����������, ���� �� �������� ��� config.php, ����������� �� ������� �� init.php
    
  // ���������� ���������
  // ���.: ���� � ���������� ����� 1 �������� ��������������. ��� �������������� ����� 0.
  //
  // ���������� ����� ���������
  // �������� ��������
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
  // ������� �������
  // ���: �� init.php �������� ���� �� �� ������� apo_employee, apo_aitisi, apo_school, apo_dimos ����� �� �������� �� aposp.sql
  $av_emp = "apo_employee";
  $av_ait = "apo_aitisi";
  $av_sch = "apo_school";
  $av_dimos = "apo_dimos";
  
  
  // **** ����� ���������: 1 = ����������, 2 = ���������� ****
  $av_type = 1;
  // ������ ��������� (�.�. Online ������� �������� ��� �������� - ��������� ����������)
  //$av_title = "Online ������� �������� ��� �������� - �������� ����������";
  $av_title = "Online ������� �������� ��� �������� - ��������� ����������";
  // ������ �������� (����� / �����) (�.�. ����� ���������)
  $av_foreas = "����� ���������";
  // ����� (��. ������������ �������)
  $av_nomos = "���������";
  // �/��� �������� (�.�. ��������� ������������ ���/��� ���������)
  $av_dnsh = "��������� ������������ ���/��� ���������";
  // ����� �� �/��� ������������
  $av_athmia = 1;
  // Custom ������ (����������� ���� ����� Login, ���� ��'�� login)
  $av_custom = "";
  
  // ������� � ��� ��� login
  $av_display_login = 1;
  // ������� ������ � ���
  $av_is_active = 1;
  // ������ ���
  $av_active_from = "��������� 01/08/2014";
  // ������ ���
  $av_active_to = "������� 18/08/2014";
  // ������ ��� ���
  $av_active_to_time = "09:00";
  // ����� �������� ����� (��� ���������� ���������)
  $av_endofyear = "31/08/2014";
  // ���� ��������
  $av_etos = "2014";
  // ������� ����
  $av_sxoletos = "2014-15";
    
  // ��������� ��������� (����������� ��� ������� ��� ���������)(_vel : ������� ����������)
  $av_link = "http://dipe.ira.sch.gr/files/apospaseis_pyspe_2014-15.pdf";
  $av_link_vel = "http://dipe.ira.sch.gr/portal/images/stories/Documents/anakoinwseis/dioikhtika/2014/140716_dhlwseis_velt-top.pdf"; 
  
  // �������� �����������
  // ����� ������ ����������� (�������: ������ �� ����� ����������)
  // � ������� ������ ����� �� ����� ��� ��� ��� ��������� ��� init.php � ��������� ��� ����.
  $av_admin = "121212";
  // ������� ��������� ��� �� ������������ ����� (init.php)
  $av_init_pass = "321123";
  // � ������������ ������ �� ��������� ��� �������
  $av_canundo = 1;
  // � ������������ ������ �� ������� ��� �������� ��� �� �������� �������� ��� ���/���
  $av_canalter = 1;
  
  
// Report all errors except E_NOTICE
// This is the default value set in php.ini  
// to avoid notices on some configurations
  error_reporting(E_ALL ^ E_NOTICE);
  
?>