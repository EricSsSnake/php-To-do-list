<?php include "database.php"; ?>

<!-- post to database -->
<?php
if (isset($_POST['submit'])) {
    $task = '';
    $taskErr = '';

    $task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($_POST['task'])) {
        $taskErr = 'Enter a task';
    }

    if (empty($taskErr)) {
        $sql = "INSERT INTO tasks (title) VALUES ('$task')";
        $conn->query($sql);
    }
}
?>

<!-- delete task (must be before fetch from database) -->
<?php
if (isset($_POST['delete'])) {
    $id = $_POST['hidden'];

    $sql = "DELETE FROM tasks WHERE id = $id";
    $conn->query($sql);
}
?>


<!-- fetch task from database -->
<?php
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
$tasks_arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
</head>

<body>
    <h2>To-Do list</h2>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <input type="text" name="task" placeholder="Enter your task">
        <input type="submit" name="submit" value="submit">
    </form>

    <?php echo !empty($taskErr) ? $taskErr : null; ?>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>task</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($tasks_arr as $task) : ?>
                <tr>
                    <td><?php echo $task['id']; ?></td>
                    <td><?php echo $task['title']; ?></td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                            <input type="hidden" name="hidden" value="<?php echo $task['id']; ?>">

                            <input type="submit" value="delete" name="delete">
                        </form>
                    </td>


                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>