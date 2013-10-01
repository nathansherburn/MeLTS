<?php
// Written by Shea Yuin Ng
// Created 22 October 2012
// For lecturers to view the results of the posted question

// Resume session from previous session
session_start();

// Connect to mySQL
include('connections.php');

// Get username, unit code and unit name from session variable
$uname = $_SESSION['uname'];
$unit_code = $_SESSION['unit_chosen'];
$unit_name = $_SESSION['unit_name'];
$id = $_SESSION['id'];

// Select database to connect
mysql_select_db($unit_code, $dbcon) or die("Cannot select unit database!");

$table_name='q_'.$id;

$result = mysql_query("SELECT * FROM $table_name WHERE mcq_answer='btnA' && team='red'", $dbcon);
$cntARed = mysql_num_rows($result); 
$result = mysql_query("SELECT * FROM $table_name WHERE mcq_answer='btnA' && team='blue'", $dbcon);
$cntABlue = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM $table_name WHERE mcq_answer = 'btnB' && team='red'", $dbcon);
$cntBRed = mysql_num_rows($result);
$result = mysql_query("SELECT * FROM $table_name WHERE mcq_answer='btnB' && team='blue'", $dbcon);
$cntBBlue = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM $table_name WHERE mcq_answer = 'btnC' && team='red'", $dbcon);
$cntCRed = mysql_num_rows($result);
$result = mysql_query("SELECT * FROM $table_name WHERE mcq_answer='btnC' && team='blue'", $dbcon);
$cntCBlue = mysql_num_rows($result);

$result = mysql_query("SELECT * FROM $table_name WHERE mcq_answer = 'btnD' && team='red'", $dbcon);
$cntDRed = mysql_num_rows($result); 
$result = mysql_query("SELECT * FROM $table_name WHERE mcq_answer='btnD' && team='blue'", $dbcon);
$cntDBlue = mysql_num_rows($result);

$totalRed = $cntARed+$cntBRed+$cntCRed+$cntDRed;
$totalBlue = $cntABlue+$cntBBlue+$cntCBlue+$cntDBlue;

// Output data in XML format
header("Content-type: text/xml"); //Declare saving data in XML form
echo '<?xml version="1.0" encoding="utf-8"?>'; // Print XML tag
echo "<MCQAnswer>"; //Top root directory

// Print each element in XML
echo "<Answer>";
echo "<CntARed>$cntARed</CntARed>";
echo "<CntABlue>$cntABlue</CntABlue>";
echo "<CntBRed>$cntBRed</CntBRed>";
echo "<CntBBlue>$cntBBlue</CntBBlue>";
echo "<CntCRed>$cntCRed</CntCRed>";
echo "<CntCBlue>$cntCBlue</CntCBlue>";
echo "<CntDRed>$cntDRed</CntDRed>";
echo "<CntDBlue>$cntDBlue</CntDBlue>";
echo "<TotalRed>$totalRed</TotalRed>";
echo "<TotalBlue>$totalBlue</TotalBlue>";
echo "</Answer>";
echo "</MCQAnswer>";

// Close connection to mySOL
mysql_close($dbcon);
?>