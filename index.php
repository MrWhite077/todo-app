<?php
include("./connect.php");
$sql = "SELECT * FROM todo_list";
$result=$conn->query($sql);
$errors=[];

if (isset($_POST['submit'])) {
    // print_r($_POST);
    $text=$_POST['text'] ;
    echo "data submit";
    if (empty($text)) {
        $errors['text']="please write any todo";
    }


    if (empty($errors)) {

        $sql="INSERT INTO `todo_list`(`todo`) VALUES ('$text')";

        if ($conn->query($sql) == true) {
            echo 'data saved successfully';
        };
        header('Location: index.php');

        

            
    }
}
// print_r($errors);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>todo list</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">

    <?php  if ($errors) : ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>ERROR ! <hr></strong>
   <ul>
    <li>
        <?php  echo $errors['text']; ?>
    </li>
   </ul>
    
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php  endif ?>

    
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    
        <input type="text" name="text">    <input type="submit" name="submit" class="btn btn-primary">
     
</div>


        <?php   while($row = $result->fetch_assoc()) :?>
    <ul>
        <li>
       <?php  echo  $row["todo"] . "<br>" ;?><a href="./delete.php?id=<?php echo $row['id'] ?> " class="btn btn-danger">delete</a>

       <a href="./update.php?id=<?php echo $row['id'] ?> " class="btn btn-primary">update</a>
        </li>
    </ul>
  <?php endwhile ?>
  
</ul>


</form>
    
</body>
</html>