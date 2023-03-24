<?php
$conn = mysqli_connect(
  'localhost', 
  'user',
  'password1234',
  'template'); 

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title']) && isset($_POST['contents'])) {
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $contents = mysqli_real_escape_string($conn, $_POST['contents']);
    
      if (trim($title) !== '' && trim($contents) !== '') {
        $sql = "INSERT INTO board (title, contents, created) VALUES ('$title', '$contents', NOW())";
        $result = mysqli_query($conn, $sql);
    
        if ($result === false) {
          echo '에러';
          error_log(mysqli_error($conn));
        } else {
          header('Location: board.php');
          exit();
        }
      } else {
        echo '입력값이 공백입니다.';
      }
    }
  }

$sql = "SELECT * FROM board";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <title>Board</title>
  </head>
  <body>
    <h1 id="titleaa">게시판</h1>
   

    <h2>글 목록</h2>
    <?php
    while($row = mysqli_fetch_array($result)) {
      echo '<h3>'.$row['title'].'</h3>';
      echo $row['created'].'<br>';
      echo $row['contents'].'<br><br>';
    }
    ?>

<h3>게시글을 작성하세요.</h3>
    <form action="board.php" method="POST">
      <p><input type="text" name="title" placeholder="제목."></p>
      <p><input type="text" name="contents" placeholder="내용."></p>      
      <p><input type="submit"></p>
    </form>
  </body>
</html>
