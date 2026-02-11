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

// Delete todo
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($_SESSION['todos'][$index]);
    $_SESSION['todos'] = array_values($_SESSION['todos']); // Re-index
}

// Update todo
if (isset($_POST['update_index'])) {
    $index = $_POST['update_index'];
    $_SESSION['todos'][$index] = htmlspecialchars($_POST['updated_todo']);
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
            width: 450px;
            padding: 20px;
            border-radius: 8px;
        }
        input[type="text"] {
            width: 60%;
            padding: 8px;
        }
        input[type="submit"] {
            padding: 6px 10px;
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
        a {
            text-decoration: none;
            margin-left: 10px;
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
        <?php foreach ($_SESSION['todos'] as $index => $todo): ?>
            <li>
                <?php if (isset($_GET['edit']) && $_GET['edit'] == $index): ?>
                    
                    <!-- Edit Form -->
                    <form method="post" style="display:inline;">
                        <input type="text" name="updated_todo" value="<?php echo $todo; ?>">
                        <input type="hidden" name="update_index" value="<?php echo $index; ?>">
                        <input type="submit" value="Save">
                    </form>

                <?php else: ?>
                    
                    <?php echo $todo; ?>
                    <a href="?edit=<?php echo $index; ?>">Edit</a>
                    <a href="?delete=<?php echo $index; ?>" style="color:red;">Delete</a>

                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
