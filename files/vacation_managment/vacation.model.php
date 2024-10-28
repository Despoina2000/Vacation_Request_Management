<?php
class VacationRequest {
    private $conn;
    private $table_name = "vacation_request";

    public $id;
    public $uid;
    public $date_from;
    public $date_to;
    public $reason;
    public $is_approved;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createRequest($uid, $date_from, $date_to, $reason) {
        $query = "INSERT INTO " . $this->table_name . " (uid, date_from, date_to, reason) VALUES (:uid, :date_from, :date_to, :reason)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':date_from', $date_from);
        $stmt->bindParam(':date_to', $date_to);
        $stmt->bindParam(':reason', $reason);

        return $stmt->execute();
    }

    public function approveRequest($request_id) {
        $query = "UPDATE " . $this->table_name . " SET is_approved = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $request_id);

        return $stmt->execute();
    }

    public function denyRequest($request_id) {
        $query = "UPDATE " . $this->table_name . " SET is_approved = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $request_id);

        return $stmt->execute();
    }
}
