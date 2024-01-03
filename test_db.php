<?php
include 'db.php';

$db = new DB();

// Test Insert
$title = "Craking The Coding Interview";
$author = "Gayle Laakman Mcdowell";
$published_year = "2020";

$db->insert_book($title, $author, $published_year);

$title = "Pep Guardiola Another Way Of Winning";
$author = "Guillem Balague";
$published_year = "2016";

$db->insert_book($title, $author, $published_year);

// Test Read
$books = $db->get_books();

echo "Books after insert:\n";
print_r($books);

// Test Update
$bookToUpdate = $books[0];
$idToUpdate = $bookToUpdate['id'];
$newTitle = "New Title";
$newAuthor = "New Author";
$newPublishedYear = "2024";

$db->update_book($idToUpdate, $newTitle, $newAuthor, $newPublishedYear);

// Test Read after Update
$updatedBooks = $db->get_books();

echo "\nBooks after update:\n";
print_r($updatedBooks);

// Test Delete
$bookToDelete = $updatedBooks[0];
$idToDelete = $bookToDelete['id'];

$db->delete_book($idToDelete);

// Test Read after Delete
$booksAfterDelete = $db->get_books();

echo "\nBooks after delete:\n";
print_r($booksAfterDelete);
?>
