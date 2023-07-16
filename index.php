<?php
declare(strict_types=1);

use Dotenv\Dotenv;
use App\Database;
use App\ErrorHandler;
use App\ListingController;
use App\ListingGateway;
use App\ModelController;
use App\ModelGateway;
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

set_error_handler([ErrorHandler::class, "handleError"]);
set_exception_handler([ErrorHandler::class, "handleException"]);

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$database = new Database($dbHost, $dbName, $dbUser, $dbPass);

if ($parts[1] != "api") {
    http_response_code(404);
    exit;
}

switch ($parts[2]) {
    case "listings":
        $gateway = new ListingGateway($database);
        $controller = new ListingController($gateway);
        break;
    case "models":
        $gateway = new ModelGateway($database);
        $controller = new ModelController($gateway);
        break;
    default:
        http_response_code(404);
        exit;
}

$controller->processRequest($_SERVER["REQUEST_METHOD"]);
