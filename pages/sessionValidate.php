<?php 
session_start();

if  (!isset($_SESSION['status']) || $_SESSION['status'] != 1){
  session_unset();
  header('Location: /Blog');
}
?>