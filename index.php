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

$user = 'u52814'; // Заменить на ваш логин uXXXXX
$pass = '2697434'; // Заменить на пароль, такой же, как от SSH
$db = new PDO('mysql:host=localhost;dbname=u52814', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
try {
  $stmt = $db->prepare("INSERT INTO application SET name = ?, email = ?, year = ?, gender = ?, limbs = ?, bio = ?");
  $stmt->execute([$_POST['name'], $_POST['email'], $_POST['year'], $_POST['gender'], $_POST['limbs'], $_POST['bio']]);
  if(!$stmt){
    print('Error - '. $stmt->errorInfo());
  }
}catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
$application_id = $db->lastInsertId();
$superpowers = $_POST['superpowers'];
foreach ($superpowers as $ability) {
  try{
      $sql = 'INSERT INTO collect (user_id, ability) VALUES (:user_id, :ability)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$application_id,$ability]);


      $sql = 'INSERT INTO collect (user_id, ability) VALUES (:user_id, :ability)';
      $stmt = $db->prepare($sql);
      $stmt->execute(['user_id' => $application_id, 'ability' => $ability]);
      
      if($stmt->rowCount() > 0) {
        print( "New record created successfully");
      } else {
        print( "Error: " . $sql . "<br>" . mysqli_error($conn));
      }
     // $stmt = $db->prepare("INSERT INTO sv SET id = ?, id2 = ?");
     // $stmt->execute([$id,$_POST['superpowers']]);]
      // if (mysqli_query($stmt, $sql)) {
      //   echo "New record created successfully";
      // } else {
      //  echo "Error: " . $sql . "<br>" . mysqli_error($conn);

      // }
      //    var_dump($_POST);
      // if(!$stmt){
      //   print('Error - ' . $stmt->errorInfo());
      // }  
  } catch(PDOException $e) {
   print('Error : ' . $e->getMessage());
    exit();
  }

  //foreach () {
    
}
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