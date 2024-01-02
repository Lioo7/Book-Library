<?php
include 'config.php';

class DB {
    private $conn;

    public function __construct() {
        global $dbConfig;

        $this->conn = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function insert_book($title, $author, $published_year) {
        $sql = "INSERT INTO books (title, author, published_year) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $title, $author, $published_year);
        $stmt->execute();
        $stmt->close();
    }

    public function get_books() {
        $sql = "SELECT * FROM books";
        $result = $this->conn->query($sql);

        $books = [];

        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }

        return $books;
    }

    public function update_book($id, $title, $author, $published_year) {
        $sql = "UPDATE books SET title = ?, author = ?, published_year = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $author, $published_year, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function delete_book($id) {
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>
