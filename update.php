<?php
include("./connect.php");

// Check if 'id' is set in the URL parameters
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Display the received ID for debugging purposes
    echo $id;

    // Retrieve todo information from the database based on the provided ID
    $sql = "SELECT `id`, `todo` FROM `todo_list` WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Initialize the errors array
    $errors = [];
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve data from the submitted form
    $text = $_POST['text'];
    $id = $_POST['id'];

    // Display a message for debugging purposes
    echo "data submit";

    // Validate the submitted data
    if (empty($text)) {
        $errors['text'] = "Please write any todo";
    } else {
        // Update the todo in the database
        $sql = "UPDATE `todo_list` SET `todo`='$text' WHERE id=$id";
        $conn->query($sql);
    }

    // Redirect to the index.php page after processing the form
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">

        <?php if ($errors) : ?>
            <!-- Display error messages if there are any -->
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>ERROR ! <hr></strong>
                <ul>
                    <li>
                        <?php echo $errors['text']; ?>
                    </li>
                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <!-- Input field for entering todo text -->
            <input type="text" name="text" value="<?php echo $row['todo'] ?>">
            
            <!-- Hidden input to store the todo item's ID -->
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <!-- Submit button -->
            <input type="submit" name="submit" class="btn btn-primary">
        </form>

    </div>
</body>

</html>
