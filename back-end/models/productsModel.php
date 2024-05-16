<?php
class ProductsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProducts() {
        $query = "SELECT product.id, product.code, product.category, product.name as name_product, category.name as name_category, product.price FROM product LEFT JOIN category ON product.category = category.id;";
        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduct($data) {
        try { 
            date_default_timezone_set('America/Bogota');
            $createAt = date("Y-m-d H:i:s");

            $query = "INSERT INTO product (code, name, category, price, createAt) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([ $data['code'], $data['name'], $data['category'], $data['price'], $createAt ]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function updateProduct($data) {
        try {
            date_default_timezone_set('America/Bogota');
            $updateAt = date("Y-m-d H:i:s");

            $query = "UPDATE product SET code = ?, name = ?, category = ?, price = ?, updateAt = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$data['code'], $data['name'], $data['category'], $data['price'], $updateAt, $data['id']]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function deleteProduct($id) {
        try {
            $query = "DELETE FROM product WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
?>
