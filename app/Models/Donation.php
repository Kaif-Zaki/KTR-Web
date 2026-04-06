<?php
class Donation {
    private $conn;
    private $table_name = "donations";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (donor_name, email, amount, type, project_id, message, date) 
                  VALUES (:name, :email, :amount, :type, :project_id, :message, :date)";
        $stmt  = $this->conn->prepare($query);
        return $stmt->execute([
            ':name'       => $data['donor_name'],
            ':email'      => $data['email'],
            ':amount'     => $data['amount'],
            ':type'       => $data['type'],
            ':project_id' => $data['project_id'],
            ':message'    => $data['message'],
            ':date'       => $data['date']
        ]);
    }

    public function getAll() {
        $query = "SELECT d.*, p.title as project_title 
                  FROM " . $this->table_name . " d
                  LEFT JOIN projects p ON d.project_id = p.id
                  ORDER BY d.created_at DESC";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getTotalByProject($project_id) {
        $query = "SELECT SUM(amount) as total FROM " . $this->table_name . " WHERE project_id = ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute([$project_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotal() {
        $query = "SELECT SUM(amount) as total FROM " . $this->table_name;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }
}