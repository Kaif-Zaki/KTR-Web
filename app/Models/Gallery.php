<?php
class Gallery {
    private $conn;
    private $table_name = "gallery";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT g.*, p.title as project_title 
                  FROM " . $this->table_name . " g 
                  LEFT JOIN projects p ON g.project_id = p.id 
                  ORDER BY g.created_at DESC";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getByProject($project_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE project_id = ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute([$project_id]);
        return $stmt;
    }

    public function addImage($project_id, $path, $caption) {
        $query = "INSERT INTO " . $this->table_name . " (project_id, image_path, caption) VALUES (?, ?, ?)";
        $stmt  = $this->conn->prepare($query);
        return $stmt->execute([$project_id, $path, $caption]);
    }
}