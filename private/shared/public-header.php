<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($page_title)  ? $page_title : 'The Record Database' ?></title>
</head>
<body>
  <?php if (isset($msg)) {
    echo $msg;
  } ?>
  <h1>Header</h1>
</body>
</html>