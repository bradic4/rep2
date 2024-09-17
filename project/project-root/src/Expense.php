<?php
class Expense {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addExpense($userId, $amount, $description) {
        $query = "INSERT INTO expenses (user_id, amount, description) VALUES (:user_id, :amount, :description)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function getExpenses($userId) {
        $query = "SELECT * FROM expenses WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
