<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

use Carbon\Carbon;
use Tightenco\Collect\Support\Collection;

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';

use Mailgun\Mailgun;

$mg = Mailgun::create($_ENV['MAIL_GUN_API_KEY']);
$domain = $_ENV['MAIL_GUN_DOMAIN'];

$mg->messages()->send($domain, [
  'from'    => 'test@vanilla-php.twkhjl-test.org',
  'to'      => 'twkhjl@gmail.com',
  'subject' => '測試中文',
  'text'    => '這是信件內容'
]);

?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
  <?php include 'src/templates/head.php'; ?>
</head>

<body>
  <?php include 'src/templates/topnav.php'; ?>

  <h3>test</h3>

  <?php include 'src/templates/bottom.php'; ?>
</body>

</html>