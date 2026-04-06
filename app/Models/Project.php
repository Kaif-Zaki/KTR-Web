<?php
class Project {
    private $conn;
    private $table_name = "projects";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (title, main_image, category, description, status, date, budget_used, ngo_partner) 
                  VALUES (:title, :main_image, :category, :description, :status, :date, :budget, :ngo)";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':title'       => $data['title'],
            ':main_image'  => $data['main_image'] ?? 'default-project.jpg',
            ':category'    => $data['category'],
            ':description' => $data['description'],
            ':status'      => $data['status'],
            ':date'        => $data['date'],
            ':budget'      => $data['budget_used'],
            ':ngo'         => $data['ngo_partner']
        ]);
    }
}