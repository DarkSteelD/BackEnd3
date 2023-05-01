<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
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
input:required, select:required, textarea:required {
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
  <h1 style="text-align: center;"> Набор героев</h1>
  <form action="index.php" method="POST">
  <label for="name">Имя:</label>
  <input type="text" id="name" name="name"  required>

  <label for="email">E-mail:</label>
  <input type="email" id="email" name="email" required>

  <label for="year">Год рождения:</label>
  <select id="year" name="year" required>
    <option value="">Выберите год</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <!-- и так далее -->
  </select>

  <label>Пол:</label>
  <input type="radio" id="male" name="gender" value="0" required>Мужской<br>
  <input type="radio" id="female" name="gender" value="1" required>Женский<br>

  <label>Количество конечностей:</label>
  <input type="radio" id="two" name="limbs" value="2" required>2<br>
  <input type="radio" id="four" name="limbs" value="4" required>4<br>
  

  <label for="superpowers">Сверхспособности:</label>
  <select id="superpowers" name="superpowers"  multiple="multiple">
    <option value="immortality" selected="selected">Бессмертие</option>
    <option value="intangibility">Прохождение сквозь стены</option>
    <option value="levitation">Левитация</option>
  </select>

  <label for="bio">Биография:</label>
  <textarea id="bio" name="bio" rows="6"></textarea>

  <label for="contract"><input type="checkbox" id="contract" name="contract" required>Я согласен с условиями контракта</label>
  

  <button type="submit">Отправить</button>
 
</form>

</body>
</html>