<?php 
require_once 'dbConfig.php';

function getAllApplicants($pdo) {
    $sql = "SELECT * FROM applicants ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getApplicantByID($pdo, $id) {
    $sql = "SELECT * FROM applicants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function searchForAUser($pdo, $searchQuery, $userId) {
    $sql = "SELECT * FROM applicants WHERE 
            CONCAT(first_name, last_name, email, specialization, degree, contact) LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$searchQuery%"]);

    // Log the search query
    logActivity($pdo, $userId, "SEARCH", "Searched for: $searchQuery");

    return $stmt->fetchAll();
}


function insertNewApplicant($pdo, $first_name, $last_name, $email, $experience, $specialization, $degree, $contact) {
    $response = [];
    $sql = "INSERT INTO applicants (first_name, last_name, email, experience, specialization, degree, contact) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$first_name, $last_name, $email, $experience, $specialization, $degree, $contact])) {
        $response = [
            "message" => "Applicant added successfully!",
            "statusCode" => 200,
        ];
    } else {
        $response = [
            "message" => "Failed to add applicant.",
            "statusCode" => 400,
        ];
    }
    return $response;
}

function editApplicant($pdo, $id, $first_name, $last_name, $email, $experience, $specialization, $degree, $contact) {
    $sql = "UPDATE applicants SET 
            first_name = ?, last_name = ?, email = ?, experience = ?, specialization = ?, degree = ?, contact = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first_name, $last_name, $email, $experience, $specialization, $degree, $contact, $id]);
}

function deleteApplicant($pdo, $id) {
    $sql = "DELETE FROM applicants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]);
}

function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}



function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function logActivity($pdo, $userId, $action, $details) {
    $sql = "INSERT INTO activity_logs (user_id, action, details) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId, $action, $details]);
}

function getUserLogs($pdo, $userId) {
    $sql = "SELECT * FROM activity_logs WHERE user_id = ? ORDER BY timestamp DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}


?>