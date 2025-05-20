<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'it_company';
    private $username = 'mysql';
    private $password = 'mysql';
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            );
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            error_log("Ошибка подключения: " . $exception->getMessage());
            echo "Произошла ошибка при подключении к базе данных. Пожалуйста, попробуйте позже.";
            exit;
        }

        return $this->conn;
    }

    public function getServices() {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM services ORDER BY id";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            error_log("Ошибка при получении услуг: " . $exception->getMessage());
            return [];
        }
    }

    public function saveContact($full_name, $email, $phone) {
        try {
            $conn = $this->getConnection();
            $query = "INSERT INTO contacts (full_name, email, phone) VALUES (:full_name, :email, :phone)";
            $stmt = $conn->prepare($query);
            
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch(PDOException $exception) {
            error_log("Ошибка при сохранении контакта: " . $exception->getMessage());
            return false;
        }
    }

    public function getContacts() {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM contacts ORDER BY submission_date DESC";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Получены контакты: " . print_r($result, true)); // Логируем данные
            return $result;
        } catch(PDOException $exception) {
            error_log("Ошибка при получении контактов: " . $exception->getMessage());
            return [];
        }
    }
}
?>
