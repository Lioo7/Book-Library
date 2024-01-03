<?php
require_once 'db.php';

$db = new DB();

// Handle Insert Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    $table = $_POST['table'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];

    $db->insertBook($table, $title, $author, $published_year);
}

// Handle Update Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_year = $_POST['published_year'];

    $db->updateBook($table, $id, $title, $author, $published_year);
}

// Handle Delete Operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];

    $db->deleteBook($table, $id);
}

// Display Books
$selectedTable = isset($_GET['table']) ? $_GET['table'] : 'books_for_rent'; // Default table
$books = $db->getBooks($selectedTable);
?>

<!-- Main Header -->
<h1>Book Library Management System</h1>

<!-- Insert Form -->
<h3>Add a New Book</h3>
<form method="post" action="" style="margin-bottom: 20px;">
    <label for="table">Select Table:</label>
    <select name="table" required>
        <option value="books_for_rent">Books for Rent</option>
        <option value="books_for_sale">Books for Sale</option>
    </select>

    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="author">Author:</label>
    <input type="text" name="author" required>

    <label for="published_year">Published Year:</label>
    <input type="number" name="published_year" required>

    <button type="submit" name="insert">Add Book</button>
</form>

<!-- Display Books in Table -->
<h3>Book List</h3> <!-- Added header -->

<label for="tableSelection">Select Table:</label>
<form method="get" action="">
    <select name="table" id="tableSelection" onchange="this.form.submit()">
        <option value="books_for_rent" <?= ($selectedTable == 'books_for_rent') ? 'selected' : '' ?>>Books for Rent</option>
        <option value="books_for_sale" <?= ($selectedTable == 'books_for_sale') ? 'selected' : '' ?>>Books for Sale</option>
    </select>
</form>

<div style="margin-top: 10px;">
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
                        <input type="hidden" name="table" value="<?= $selectedTable ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


<!-- Update Form -->
<?php if (!empty($books)) : ?>
    <h3>Edit Book</h3>
    <form method="post" action="" style="margin-bottom: 20px;">
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
