<?php
$host = 'localhost';
$db   = 'classic_eedev';
$user = 'classic_ccl';
$pass = 'ElizabethBattt2';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdod = new \PDO($dsn, $user, $pass, $opt);

?>