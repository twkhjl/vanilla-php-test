<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

use Carbon\Carbon;
use Tightenco\Collect\Support\Collection;


?>
  <?php

  // https://blog.tarswork.com/article/quick-start-operation-mysql-using-php-pdo/


  // PDO 連線設定
  $options = [
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_STRINGIFY_FETCHES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
  ];

  $dbname = $_ENV['DB_DATABASE'];
  $username = $_ENV['DB_USERNAME'];
  $password = $_ENV['DB_PASSWORD'];


  //資料庫連線
  try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=$dbname", "$username", "$password", $options);
    $pdo->exec('SET CHARACTER SET utf8mb4');
  } catch (PDOException $e) {
    throw new PDOException($e->getMessage());
  }


  $date = Carbon::now();

  // SELECT
  // $data = [':id' => 2];
  // $sql = 'SELECT * FROM `test` WHERE id = :id;';
  // $stmt = $pdo->prepare($sql);
  // $stmt->execute($data);

  $sql = 'SELECT * FROM `test`';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  // 取得單筆資料
  // $result = $stmt->fetch(PDO::FETCH_ASSOC);



  // 取得多筆資料
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  $result = new Collection($result);
  $output = $result->pluck('id');
  $output = new Collection($output);
  
  $output->map(function($item){
    echo $item.'<br>';
  });
  

  // UPDATE
  // $id = 3;
  // $data = ['aasdsadsalkkwel;qwkeq;wleqw;elqweqe'];
  // $sql = "UPDATE `vanilla-php`.`test` SET `text`=? WHERE  `id`=$id;";

  //UPDATE: Named Parameters
  // $data = [':text' => 'David', ':id' => 1];
  // $sql = "UPDATE `test` SET `text` = :text WHERE id = :id";

  // INSERT
  // $data = ['a', 'abc',123,$date];
  // $sql = "INSERT INTO `vanilla-php`.`test` (`varchar`, `text`, `int`,`datetime`) VALUES (?,?,?,?);";

  // DELETE
  // $data=[':id'=>1];
  // $sql ="DELETE FROM `test` WHERE `id`=:id;";


  // $stmt = $pdo->prepare($sql);
  // try {
  //   if ($stmt->execute($data)) {
  //     echo 'done';
  //   } else {
  //     echo 'fail';
  //   }
  // } catch (PDOException $e) {
  //   echo $e;
  // }

  $stmt = null;


  //關閉資料庫
  unset($pdo);
  ?>
