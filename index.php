<?php
session_start();

// Initialize todo list
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// ADD TODO
if (isset($_POST['add_todo']) && !empty(trim($_POST['todo']))) {
    $_SESSION['todos'][] = htmlspecialchars(trim($_POST['todo']));
}

// DELETE TODO
if (isset($_POST['delete_index'])) {
    $index = $_POST['delete_index'];
    unset($_SESSION['todos'][$index]);
    $_SESSION['todos'] = array_values($_SESSION['todos']); // Re-index
}

// UPDATE TODO
if (isset($_POST['update_index'])) {
    $index = $_POST['update_index'];
    if (!empty(trim($_POST['updated_todo']))) {
        $_SESSION['todos'][$index] = htmlspecialchars(trim($_POST['updated_todo']));
    }
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
        input[type="submit"], button {
            padding: 6px 10px;
            margin-left: 5px;
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
        .actions {
            float: right;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>My TODO List</h2>

    <!-- Add Todo Form -->
    <form method="post">
        <input type="text" name="todo" placeholder="Enter new todo">
        <input type="submit" name="add_todo" value="Add">
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

                    <div class="actions">
                        <!-- Edit Button -->
                        <a href="?edit=<?php echo $index; ?>">Edit</a>

                        <!-- Delete Button (POST method) -->
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                            <button type="submit">Remove</button>
                        </form>
                    </div>

                <?php endif; ?>

            </li>
        <?php endforeach; ?>
    </ul>

</div>

</body>
</html>
