<?php
header('Content-Type: text/html; charset=UTF-8');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $messages = array();


  if (!empty($_COOKIE['save'])) {

    setcookie('save', '', 100000);

    $messages[] = 'Спасибо, результаты сохранены.';
  }


  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['limbs'] = !empty($_COOKIE['limbs_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['ability'] = !empty($_COOKIE['ability_error']);
  $errors['check'] = !empty($_COOKIE['check_error']);

  if ($errors['name']) {

    setcookie('name_error', '', 100000);

    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  if ($errors['email']) {

    setcookie('email_error', '', 100000);

    $messages[] = '<div class="error">Заполните почту.</div>';
  }
  if ($errors['year']) {

    setcookie('year_error', '', 100000);

    $messages[] = '<div class="error">Заполните год.</div>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);

    $messages[] = '<div class="error">Заполните пол.</div>';
  }
  if ($errors['limbs']) {

    setcookie('limbs_error', '', 100000);

    $messages[] = '<div class="error">Заполните число конечностей.</div>';
  }
  if ($errors['bio']) {

    setcookie('bio_error', '', 100000);

    $messages[] = '<div class="error">Заполните биографию.</div>';
  }
  if ($errors['ability']) {
    
    setcookie('ability_error', '', 100000);
    
    $messages[] = '<div class="error">Заполните суперспособность.</div>';
  }
  if ($errors['check']) {

    setcookie('check_error', '', 100000);

    $messages[] = '<div class="error">Согласитесь с контрактом.</div>';
  }


  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['ability'] = empty($_COOKIE['ability_value']) ? array() : json_decode($_COOKIE['ability_value']);
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];

  include('form.php');
}
else{
  
  $errors = FALSE;
if (empty($_POST['name']) || !preg_match('/^([a-zA-Z\'\-]+\s*|[а-яА-ЯёЁ\'\-]+\s*)$/u', $_POST['name'])) {
    
    setcookie('name_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
    else {

    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  }

if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
    
    setcookie('year_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60);
  }

if (empty($_POST['email'] || FILTER_VALIDATE_EMAIL($_POST['email']) || !preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $_POST['email'])) { // На случай если нельхя библиотеки
    
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }

if (empty($_POST['gender']) || !($_POST['gender']=='female' || $_POST['gender']=='male')) {
    
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }

if (empty($_POST['limbs']) || !is_numeric($_POST['limbs']) || ($_POST['amount_of_limbs']==2) || ($_POST['amount_of_limbs']==4))  {
    
    setcookie('limbs_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('limbs_value', $_POST['limbs'], time() + 30 * 24 * 60 * 60);
  }
  
if (empty($_POST['bio']) || !preg_match('/^([a-zA-Z\'\-]+\s*|[а-яА-ЯёЁ\'\-]+\s*)$/u', $_POST['bio'])) {
    
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60);
  }

  foreach ($_POST['ability'] as $ability) {
    if (!in_array($ability, ['intangibility', 'immortality', 'levitation'])) {
      setcookie('ability_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
      break;
    }
  }
  if (!empty($_POST['ability'])) {
    setcookie('ability_value', json_encode($_POST['ability']), time() + 24 * 60 * 60);
  }
  else{
    setcookie('ability_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }

  if (empty($_POST['check'])) {
    
    setcookie('check_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('check_value', $_POST['check'], time() + 30 * 24 * 60 * 60);
  }


  if ($errors) {

    header('Location: index.php');
    exit();
  }
  else {

    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('limbs_error', '', 100000);
    setcookie('ability_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('check_error', '', 100000);
    


    
  }
  //
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
    $max_id_z = ($db->lastInsertId());
    foreach ($_POST['superpowers'] as $ability) {
     print($max_id_z);
    //$stmt = $db->prepare("INSERT INTO sposob SET tip = ? ");
    //$stmt->execute([$_POST['$ability']]);
      $stmt = $db->prepare("INSERT INTO abilities SET tip = :mytip");
      $stmt->bindParam(':mytip', $ability);
      $stmt->execute();

      $max_id_s = ($db->lastInsertId());

      $stmt = $db->prepare("INSERT INTO sv (id_z, id_s) VALUES (:myidz, :myids)");
      $stmt->bindParam(':myids', $max_id_s);
      $stmt->bindParam(':myidz', $max_id_z);
      $stmt->execute();
    }
  
  }
  catch(PDOException $e){
   print('Error : ' . $e->getMessage());
    exit();
  } 
  setcookie('save', '1');
  header('Location: index.php');
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

?>