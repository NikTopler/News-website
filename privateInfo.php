<?php 
require_once realpath(__DIR__ . '/vendor/autoload.php');
use Dotenv\Dotenv;
$dotend = Dotenv::createImmutable(__DIR__);
$dotend->load();

if($_SERVER['REQUEST_METHOD'] !== 'POST') return;
if(isset($_POST['images'])) echo $_ENV['IMAGE_API_KEY']; 
else if(isset($_POST['user'])) echo $_ENV['USER_LOCATION_API_KEY'];
else if(isset($_POST['weather'])) echo $_ENV['WEATHER_API_KEY'];
else if(isset($_POST['news'])) echo $_ENV['NEWS_API_KEY'];
else if(isset($_POST['google_client_id'])) echo $_ENV['GOOGLE_CLIENT_ID'];