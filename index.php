<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Library</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
require_once 'db.php';

$db = new DB();

// Handle Insert Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];

    $db->insert_book($title, $author, $published_year);
}

// Handle Update Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];

    $db->update_book($id, $title, $author, $published_year);
}

// Handle Delete Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $db->delete_book($id);
}

// Display Books
$books = $db->get_books();
?>

<h2>Book Library</h2>

<!-- Insert Form -->
<form method="post" action="">
    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="author">Author:</label>
    <input type="text" name="author" required>

    <label for="published_year">Published Year:</label>
    <input type="number" name="published_year" required>

    <button type="submit" name="insert">Add Book</button>
</form>

<!-- Display Books in Table -->
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Published Year</th>
        <th>Action</th>
    </tr>
    <?php foreach ($books as $book) : ?>
        <tr>
            <td><?= $book['id'] ?></td>
            <td><?= $book['title'] ?></td>
            <td><?= $book['author'] ?></td>
            <td><?= $book['published_year'] ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?= $book['id'] ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Update Form -->
<?php if (!empty($books)) : ?>
    <h3>Edit Book</h3>
    <form method="post" action="">
        <label for="id">Select Book:</label>
        <select name="id" required>
            <?php foreach ($books as $book) : ?>
                <option value="<?= $book['id'] ?>"><?= $book['title'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="author">Author:</label>
        <input type="text" name="author" required>

        <label for="published_year">Published Year:</label>
        <input type="number" name="published_year" required>

        <button type="submit" name="update">Update Book</button>
    </form>
<?php endif; ?>

</body>
</html>
