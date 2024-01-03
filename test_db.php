<?php
include 'db.php';

$db = new DB();

// Test Insert
$title = "Cracking The Coding Interview";
$author = "Gayle Laakman McDowell";
$published_year = "2020";

// Inserting into the 'books_for_rent' table
$db->insertBook('books_for_rent', $title, $author, $published_year);

$title = "Pep Guardiola: Another Way Of Winning";
$author = "Guillem Balague";
$published_year = "2016";

// Inserting into the 'books_for_sale' table
$db->insertBook('books_for_sale', $title, $author, $published_year);

// Test Read
$booksForRent = $db->getBooks('books_for_rent');
$booksForSale = $db->getBooks('books_for_sale');

echo "Books for Rent after insert:\n";
print_r($booksForRent);

echo "\nBooks for Sale after insert:\n";
print_r($booksForSale);

// Test Update
$bookToUpdateForRent = $booksForRent[0];
$idToUpdateForRent = $bookToUpdateForRent['id'];
$newTitleForRent = "New Title for Rent";
$newAuthorForRent = "New Author for Rent";
$newPublishedYearForRent = "2024";

$db->updateBook('books_for_rent', $idToUpdateForRent, $newTitleForRent, $newAuthorForRent, $newPublishedYearForRent);

// Test Read after Update
$updatedBooksForRent = $db->getBooks('books_for_rent');

echo "\nBooks for Rent after update:\n";
print_r($updatedBooksForRent);

// Test Delete
$bookToDeleteForRent = $updatedBooksForRent[0];
$idToDeleteForRent = $bookToDeleteForRent['id'];

$db->deleteBook('books_for_rent', $idToDeleteForRent);

// Test Read after Delete
$booksAfterDeleteForRent = $db->getBooks('books_for_rent');

echo "\nBooks for Rent after delete:\n";
print_r($booksAfterDeleteForRent);
?>
