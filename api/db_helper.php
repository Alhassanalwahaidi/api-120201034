<?php
class DbHelper {
    private $conn;

    function createDbConnection() {
        try {
            $this->conn = new mysqli("localhost", "root", "", "iugphp");
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    function insertNewStudent($name, $email) {
        try {
            $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";
            $result = $this->conn->query($sql);
            if ($result == true) {
                echo json_encode(array(
                    "success" => true,
                    "message" => "New user has been added"
                ));
            } else {
                echo json_encode(array(
                    "success" => false,
                    "message" => "New user has not been added"
                ));
            }
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    function getAllStudents() {
        try {
            $sql = "SELECT * FROM students";
            $result = $this->conn->query($sql);

            $students = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $students[] = $row;
                }
            }

            return $students;
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    function getStudentById($id) {
        try {
            $sql = "SELECT * FROM students WHERE id = '$id'";
            $result = $this->conn->query($sql);

            if ($result->num_rows == 1) {
                $student = $result->fetch_assoc();
                return $student;
            } else {
                return null; // If student with the given ID is not found
            }
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    function deleteStudent($id) {
        try {
            $sql = "DELETE FROM students WHERE id = '$id'";
            $result = $this->conn->query($sql);

            if ($result == true) {
                echo json_encode(array(
                    "success" => true,
                    "message" => "Student has been deleted"
                ));
            } else {
                echo json_encode(array(
                    "success" => false,
                    "message" => "Failed to delete student"
                ));
            }
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    function updateStudent($id, $name, $email) {
        try {
            $sql = "UPDATE students SET name = '$name', email = '$email' WHERE id = '$id'";
            $result = $this->conn->query($sql);

            if ($result == true) {
                echo json_encode(array(
                    "success" => true,
                    "message" => "Student has been updated"
                ));
            } else {
                echo json_encode(array(
                    "success" => false,
                    "message" => "Failed to update student"
                ));
            }
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    
    }
}

// Usage example:
$dbHelper = new DbHelper();
$dbHelper->createDbConnection();
$allStudents = $dbHelper->getAllStudents();
var_dump($allStudents); // Output all student records
?>
