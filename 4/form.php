
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

<html lang="ru">
  <head>
    <title>Superhero Registration Form</title>
    <style>
/* Общие стили формы */
form {
  width: 80%;
  margin: 0 auto;
  font-family: Arial, sans-serif;
}

label {
  display: flex;
  margin-bottom: 5px;
}
input, select, textarea {
  display: flex;
  align-self: center;
  margin-right: 1vw;
  margin-left: vw ;
  padding: 5px;
  margin-bottom: 10px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
}

input[type="radio"], input[type="checkbox"] {
  display: inline-block;
  margin-right: 10px;
}

textarea {
  resize: vertical;
}

button[type="submit"] {
  background-color: #4b0082;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  margin: 0 auto;
  display: flex;
}

/* Стили для фона формы */
form {
  background: linear-gradient(to bottom right, #6a5acd, #1e90ff);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.5);
}

/* Стили для текстовых полей */
input[type="text"], input[type="email"], select {
  background-color: rgba(255, 255, 255, 0.7);
}

/* Стили для радиокнопок и чекбокса */
input[type="radio"], input[type="checkbox"] {
  margin-right: 5px;
}
label.radio {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
/* Стили для кнопки отправки формы */
button[type="submit"] {
  background-color: #483d8b;
}

/* Стили для обязательных полей */
input: , select: , textarea:  {
  border: 2px solid #dda0dd;
}

/* Адаптивность для мобильных устройств */
@media (max-width: 480px) {
  form {
    width: 100%;
    padding: 10px;
  }
  
  input, select, textarea {
    font-size: 14px;
    margin-right: 5px;
  }
  
  button[type="submit"] {
    padding: 8px 16px;
    font-size: 14px;
  }
  </style>
  </head>
<body>

  <?php
  if (!empty($messages)) {
    print('<div id="messages">');
    // Выводим все сообщения.
    foreach ($messages as $message) {
      print($message);
    }
    print('</div>');
  }

  // Далее выводим форму отмечая элементы с ошибками классом error
  // и задавая начальные значения элементов ранее сохраненными.
  ?>

<h1 style="text-align: center;"> Набор героев</h1>
  <form action = "index.php" method="POST">
    
          <label>
            Имя:
            <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" />
          </label>
      
        <label>
            e-mail:
            <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>" type="email" />
        </label>
      
       <label>
            Год рождения:v
            <label><input type="radio" name="year" value = "2006" <?php print($errors['year'] ? 'class="error"' : '');?> <?php if ($values['year']=='2006') print 'checked';?>/> 2006 </label>
            <label><input type="radio" name="year" value = "2005" <?php print($errors['year'] ? 'class="error"' : '');?> <?php if ($values['year']=='2005') print 'checked';?>/> 2005 </label>
            <label><input type="radio" name="year" value = "2004" <?php print($errors['year'] ? 'class="error"' : '');?> <?php if ($values['year']=='2004') print 'checked';?>/> 2004 </label>
        </label>
     
        <label>
            Пол:
            <label><input type="radio" name="gender" value = "2" <?php print($errors['gender'] ? 'class="error"' : '');?> <?php if ($values['gender']=='2') print 'checked';?>/> женский </label>
            <label><input type="radio" name="gender" value = "1" <?php print($errors['gender'] ? 'class="error"' : '');?> <?php if ($values['gender']=='1') print 'checked';?>/> мужской </label> 
        </label>
      
          <label>
            Выберите количество конечностей:
            <label><input type="radio" name="limbs" value = "2" <?php print($errors['limbs'] ? 'class="error"' : '');?> <?php if ($values['limbs']=='2') print 'checked';?>/> 2 </label>
            <label><input type="radio" name="limbs" value = "4" <?php print($errors['limbs'] ? 'class="error"' : '');?> <?php if ($values['limbs']=='4') print 'checked';?>/> 4 </label>
      
          <label>
            Выберите желаемые сверхспособности: 
            <select name="ability[]" multiple="multiple" <?php print($errors['ability'] ? 'class="error"' : '');?>>
              <option value="intangibility" <?php print(in_array('intangibility', $values['ability']) ? 'selected ="selected"' : '');?>>Хождение сковзь стены</option>
              <option value="immortality" <?php print(in_array('immortality', $values['ability']) ? 'selected ="selected"' : '');?>>Бессмертие</option>
              <option value="levitation" <?php print(in_array('levitation', $values['ability']) ? 'selected ="selected"' : '');?>>Левитация</option>
            </select>
          </label>
      
        <label>
            Биография :
            
            <textarea name="bio" <?php print($errors['bio'] ? 'class="error"' : '');?> value = "<?php print $values['bio']; if (empty($values['bio'])) print('Empty Bio')?>"></textarea>
        </label>
      
        <label>
            Чекбокс:
            <label><input type="checkbox" checked="checked" name="check" /> С контрактом ознакомлен</label>
        </label>
      
    <input type="submit" value="Отправить">
  </form>



</body>

</html>