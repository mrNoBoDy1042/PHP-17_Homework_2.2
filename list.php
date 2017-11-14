<!-- Форма list для вывода списка доступных тестов -->
<!DOCTYPE html>
<meta charset="utf-8">
<h1>Список доступных тестов:</h1>
<?php
// Находим все JSON файлы в папке Tests
foreach (glob("Tests/*.json") as $file) {
  // Получаем имя файла
  $file = basename($file,".json");?>
  <!-- Создаем ссылку для прохождения этого теста -->
  <a href="test.php?t=<?echo $file?>"><?echo $file?></a><br>
  <?}?>
<a href="admin.php">Загрузить тест</a>
