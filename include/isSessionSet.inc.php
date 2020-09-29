<?php session_start();

echo  $_SERVER['REQUEST_URI'];

if(isset($_SESSION['user_id'])) {

}