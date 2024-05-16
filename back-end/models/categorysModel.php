<?php
class CategorysModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCategorys() {
        $query = "SELECT * FROM category";
        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
