<?php 
require_once realpath(__DIR__ . '/vendor/autoload.php');
use Dotenv\Dotenv;
$dotend = Dotenv::createImmutable(__DIR__);
$dotend->load();

if($_SERVER['REQUEST_METHOD'] !== 'POST') return;
if(isset($_POST['images'])) return image();
if(isset($_POST['user'])) return user();
if(isset($_POST['weather'])) return weather();

function image() { echo $_ENV['IMAGE_API_KEY']; }
function user() { echo $_ENV['USER_LOCATION_API_KEY']; }
function weather() { echo $_ENV['WEATHER_API_KEY']; }
    