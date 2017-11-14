<!-- Форма admin для загрузки новых тестов -->
<!DOCTYPE html>
<meta charset="utf-8">
<!-- Форма загрузки теста -->
<form method="post" enctype="multipart/form-data" name="upload_form">
  <input type="file" name="userfile">
  <input type="submit" value="UPLOAD">
</form>
<br>

<?php
// Обрабатываем загруженный файл
if(isset($_FILES['userfile'])){
  $file = $_FILES['userfile'];
  $path = $file['name'];
  // Если файл JSON, то сохраняем его в папку с тестами
  if(substr($file['name'], -5) == '.json'){
    if (move_uploaded_file($file['tmp_name'], "Tests/".$path))
    {
      echo "Файл успешно зашружен";
    }
    else {
      echo "Произошла ошибка при загрузке файла";
    }
  }
  // иначе выдаем сообщение об ошибке
  else {
    echo "<script>alert('Загружен не JSON файл')</script>";
  }
}
 ?>
<br>
<!-- Ссылка для возврата к списку тестов -->
<a href="list.php">Перейти к списку тестов</a>
