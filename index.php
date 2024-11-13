<?php
if (file_exists('todo.json')){
  $json = file_get_contents('todo.json');
  $todos = json_decode($json, true);
} else {
  $todos = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <form action="newtodo.php" method="POST">
    <input type="text" name="todo_name" placeholder="Enter your toto">
    <button>New Todo</button>
  </form>
  <br>

  <?php foreach ($todos as $todoName => $todo): ?>
    <div style="margin-bottom: 10px">
      <form style="display: inline-block" action="change_status.php" method="POST">
        <input type="hidden" name="todo_name" value="<?= $todoName; ?>">
        <input type="checkbox" <?= $todo['completed'] ? 'checked' : ''; ?>>
      </form>
      <?= $todoName; ?>
      <form style="display: inline-block" action="delete.php" method="POST">
        <input type="hidden" name="todo_name" value="<?= $todoName; ?>">
        <button>Delete</button>
      </form>
    </div>
  <?php endforeach; ?>

<script>
  const checkboxes = document.querySelectorAll('input[type=checkbox]');
  checkboxes.forEach(cb => {
    cb.onclick = function(){
      this.parentNode.submit();
    };
  });
</script>
</body>
</html>