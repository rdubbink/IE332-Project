<?php
 	session_start();
	unset($_SESSION['student']);
	unset($_SESSION['employer']);
	unset($_SESSION['staff']);
	header('Location: index.php');
?>