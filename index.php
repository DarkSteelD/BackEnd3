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
if (empty($_POST['name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}

if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
  print('Заполните год.<br/>');
  $errors = TRUE;
}

if (empty($_POST['email'])) {
  print('Заполните email.<br/>');
  $errors = TRUE;
}

if (empty($_POST['gender'])) {
  print('Заполните гендер.<br/>');
  $errors = TRUE;
}
if (empty($_POST['limbs']) || !is_numeric($_POST['limbs'])) {
  print('Заполните количество конечностей.<br/>');
  $errors = TRUE;
}
if (empty($_POST['superpowers'])) {
 print('Расскажите о своих способностях.<br/>');
 $errors = TRUE;
}
if (empty($_POST['bio'])) {
  print('Заполните биографию.<br/>');
  $errors = TRUE;
}

// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

if ($errors) {
  print('Ошибки.<br/>');
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'dalertry'; // Заменить на ваш логин uXXXXX
$pass = '2UNL11wP%K1VQXQ8'; // Заменить на пароль, такой же, как от SSH
$db = new PDO('mysql:host=localhost;dbname=dalertry', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX
 print('Вход в бд.<br/>');
// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO application SET name = ?, email = ?, year = ?, gender = ?, limbs = ?, bio = ?");
  $stmt->execute([$_POST['name'], $_POST['email'], $_POST['year'], $_POST['gender'], $_POST['limbs'], $_POST['bio']]);
  print('Вход в бд2.<br/>');
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
$user_id = $db->lastInsertId();
foreach ($_POST['abilities'] as $ability) {
  try{
    $max_id = ($db->lastInsertId());
  
    $stmt = $db->prepare("INSERT INTO ability SET ability = :myability");
    $stmt->bindParam(':myability', $ability);
    $stmt->execute();
    $max_id2 = ($db->lastInsertId());
    $stmt = $db->prepare("INSERT INTO sv (id, id2) VALUES (:myid, :myid2)");
    $stmt->bindParam(':myid', $max_id);
    $stmt->bindParam(':myid2', $max_id2);
    $stmt->execute();
     print('Вход в бд3.<br/>');
  }

  catch(PDOException $e){
   print('Error : ' . $e->getMessage());
    exit();
  }
}

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