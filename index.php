<?php
session_start();

// Initialize todo list
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// Add new todo
if (isset($_POST['todo']) && !empty(trim($_POST['todo']))) {
    $_SESSION['todos'][] = htmlspecialchars($_POST['todo']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Todo App</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            padding: 40px;
        }
        .box {
            background: white;
            width: 400px;
            padding: 20px;
            border-radius: 8px;
        }
        input[type="text"] {
            width: 70%;
            padding: 8px;
        }
        input[type="submit"] {
            padding: 8px 12px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #e3e7ea;
            margin: 8px 0;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>My TODO List</h2>

    <!-- Add Todo Form -->
    <form method="post">
        <input type="text" name="todo" placeholder="Enter new todo">
        <input type="submit" value="Add">
    </form>

    <ul>
        <?php
        foreach ($_SESSION['todos'] as $todo) {
            echo "<li>$todo</li>";
        }
        ?>
    </ul>
</div>

</body>
</html>
