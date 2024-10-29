<?php

function createRequest( $date_from, $date_to, $reason,$pdo) {
    $query = "INSERT INTO vacation_requests "  . " ( date_from, date_to, reason) VALUES ( :date_from, :date_to, :reason)";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':date_from', $date_from);
    $stmt->bindParam(':date_to', $date_to);
    $stmt->bindParam(':reason', $reason);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getRequests($pdo) {
    $query = "SELECT id,date_from,date_to,reason,is_aprpoved FROM vacation_requests;";
    $stmt = $$pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function approveRequest($request_id,$pdo) {
    $query = "UPDATE vacation_requests SET is_approved = 1 WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $request_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function denyRequest($request_id,$pdo) {
    $query = "UPDATE vacation_requests SET is_approved = 0 WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $request_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);

}

function deleteRequest($id, $pdo){
    $statement = $pdo->prepare("DELETE FROM vacation_requests WHERE id = :id;");
    $statement->bindParam(':id', $id);
    $statement->execute();
}
