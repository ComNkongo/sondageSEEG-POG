<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('MAIL_USERNAME', getenv('MAIL_USERNAME'));
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD'));

try {
    $host = getenv('DB_HOST') ?: "localhost";
    $dbname = getenv('DB_NAME') ?: "u883594543_sondage_seeg";
    $username = getenv('DB_USERNAME') ?: "u883594543_user";
    $password = getenv('DB_PASSWORD') ?: "@Lionel26";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à la base de données réussie!";
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Envoie des mails SMTP
$mail_host = getenv('MAIL_HOST');
$mail_username = getenv('MAIL_USERNAME');
$mail_password = getenv('MAIL_PASSWORD');
$mail_port = getenv('MAIL_PORT');

// Ajouter ici le code pour l'envoi des mails SMTP en utilisant les variables ci-dessus.

?>