<?php
ini_set('display_errors',"on");//エラーを画面に出力
//DBに接続
define('DB_HOST','127.0.0.1');
define('DB_NAME','0718homework');
define('DB_USER','root');
define('DB_PASSWORD','root');
define('DB_PORT','8889');


try{
$dbh = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME , DB_USER , DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$sql='SELECT image_path FROM images';
$stmt=$dbh->prepare($sql);
$stmt->bindParam(':image_path',$image_path,PDO::PARAM_STR);
$stmt->execute();
}
catch(Exception $e){
      echo $e -> getMessage();
      exit;
}
var_dump($stmt);

$images = $stmt->fetchColumn();
var_dump($images);
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>画像パスのDB保存</title>
</head>
<body>
  <!--
    <form action="index.php" method="GET" enctype='multipart/form-data'>
        <input type="file" name="image_path">
        <input type="submit" value="送信">
    </form>
    -->
    <?php foreach((array)$images as $image): ?>
    <img src=<?php echo $image; ?> alt="" srcset="" width="200">
    <?php endforeach ?>

</body>
</html>