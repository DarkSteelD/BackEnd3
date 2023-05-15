<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['name']) || !preg_match('/^([a-zA-Z\'\-]+\s*|[а-яА-ЯёЁ\'\-]+\s*)$/u', $_POST['name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}
if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
  print('Заполните год.<br/>');
  $errors = TRUE;
}

if (empty($_POST['email'])  || preg_match(('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $_POST['email'])) { 
  print('Заполните email.<br/>');
  $errors = TRUE;
}

if (empty($_POST['gender']) || ($_POST['gender']=='female' || $_POST['gender']=='male')) {
  print('Заполните гендер.<br/>');
  $errors = TRUE;
}
if (empty($_POST['limbs']) || !is_numeric($_POST['limbs']) || !($_POST['limbs']==2) || ($_POST['limbs']==4))  {
  print('Заполните количество конечностей.<br/>');
  $errors = TRUE;
}
$abilities = [1 => 'immortality', 2 => 'intangibility', 3 => 'levitation'];
if (empty($_POST['superpowers']) || !is_array($_POST['superpowers'])) {
 $errors = TRUE;
}
else {
foreach ($_POST['superpowers'] as $ability) {
if (!in_array($ability, $abilities)) {
 print('Расскажите о своих способностях.<br/>');
  $errors = TRUE;
  break;
}
}
}
if (empty($_POST['bio']) || !preg_match('/^([a-zA-Z\'\-]+\s*|[а-яА-ЯёЁ\'\-]+\s*)$/u', $_POST['bio'])) {
  print('Заполните биографию.<br/>');
  $errors = TRUE;
}
if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'u52814'; // Заменить на ваш логин uXXXXX
$pass = '2697434'; // Заменить на пароль, такой же, как от SSH
$db = new PDO('mysql:host=localhost;dbname=u52814', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
try {
  $stmt = $db->prepare("INSERT INTO application SET namee = ?, email = ?, godrod = ?, pol = ?, konech = ?, biogr = ?");
  $stmt->execute([$_POST['name'], $_POST['email'], $_POST['year'], $_POST['gender'], $_POST['limbs'], $_POST['bio']]);
  //foreach ($_POST['abilities'] as $ability)
  //{
  //  print($ability);
  //}
  $id_user = ($db->lastInsertId());
  foreach ($_POST['superpowers'] as $superpower) {
   // print($max_id_z);
    //$stmt = $db->prepare("INSERT INTO sposob SET tip = ? ");
    //$stmt->execute([$_POST['$ability']]);
    //$stmt = $db->prepare("INSERT INTO abilities SET tip = :mytip");
    //$stmt->bindParam(':mytip', $superpower);
    //$stmt->execute();

    //$max_id_s = ($db->lastInsertId());
    $ability_key = array_search($superpower, $abilities);
    if ($ability_key !== false) {
    $stmt = $db->prepare("INSERT INTO sv (id_z, id_s) VALUES (:myidz, :myids)");
    $stmt->bindParam(':myids', $ability_key + 1);
    $stmt->bindParam(':myidz', $id_user);
    $stmt->execute();
    }
  }
  
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

  //foreach () {
    

//}



//$max_id = ($db->lastInsertId());
  /// $stmt = $db->prepare("INSERT INTO ability SET ability = :myability");
   // $stmt->bindParam(':myability', $ability);
   /// $stmt->execute();
   // $max_id2 = ($db->lastInsertId());
  //  $stmt = $db->prepare("INSERT INTO sv (id, id2) VALUES (:myid, :myid2)");
  //  $stmt->bindParam(':myid', $max_id);
  //  $stmt->bindParam(':myid2', $max_id2);
  //  $stmt->execute();
//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');




?>