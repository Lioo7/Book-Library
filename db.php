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

    public function insertBook($table, $title, $author, $published_year) {
        $sql = "INSERT INTO $table (title, author, published_year) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $title, $author, $published_year);
        $stmt->execute();
        $stmt->close();
    }

    public function getBooks($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $books = [];

        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }

        return $books;
    }

    public function updateBook($table, $id, $title, $author, $published_year) {
        $sql = "UPDATE $table SET title = ?, author = ?, published_year = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $author, $published_year, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteBook($table, $id) {
        $sql = "DELETE FROM $table WHERE id = ?";
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
