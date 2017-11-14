<?php
// Форма test.php для вывода и обработки результатов тестов
/* Подгатавливаем начальные данные:
- название теста,
- JSON структура теста,
- количество вопросов в тесте.
*/
error_reporting(0);
$test = $_GET['t'];
// Проверяем, выбран ли тест и есть ли файл с таким именем
if (empty($test) || !$json = file_get_contents("Tests/$test.json")) {
  // в случае неверных параметров - возвращаем к списку тестов
  header("Location: list.php");
}
//если все условия соблюдены - обрабатываем файл с тестом
else {
  echo "<!DOCTYPE html>".PHP_EOL."<meta charset=\"utf-8\">".PHP_EOL;
  $json = json_decode($json, true);
  $count_questions = count($json);
  ?>

<!-- Вывод вопросов теста -->
  <h2>Тест <?echo $test?></h2>
  <form action="" method="POST">
    <?php foreach ($json as $name => $question)
    {?>
      <!-- Выводим вопрос и список ответов -->
      <fieldset>
          <legend><?echo $question["question"]?></legend>
          <?foreach ($question['answers'] as $key => $answer)
          {?>
          <label>
            <input type="radio" name=<?echo "$name";?> value="<?echo $answer?>">
            <?echo $answer;?>
          </label>
        <?}?>
      </fieldset>
    <?} ?>
    <input type="submit" value="Отправить">
  </form>
  <!-- Ссылка для возврата к списку тестов -->
  <a href="list.php">Перейти к списку тестов</a><br>

  <?
  /* Обработка ответов */

  // Получаем переданные ответы
  $answers = $_REQUEST;
  // Убираем номер теста, оставляем только ответы на вопросы
  unset($answers['t']);

  // Если массив ответов не пуст, и число ответов равно числу вопросов
  // подсчитываем число верных ответов
  if (!empty($answers) && ($count_questions == count($answers)))
  {
    $point = 0;
    // Проверяем ответы на каждый вопрос
    foreach ($answers as $question=>$answer) {
       if ($json[$question]['correct'] === $answer) $point += 1;
      }
    // Говорим пользователю его результат
    echo "<script>alert(\"Ваш результат: $point\")</script>";
    }
    // Если условия не были соблюдены - говорим об этом пользователю
    else {
      echo "<script>alert('Необходимо ответить на все вопросы')</script>";
  }
}
?>
