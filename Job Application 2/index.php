<?php
require_once 'core/models.php';
require_once 'core/dbConfig.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch all applicants
$applicants = getAllApplicants($pdo);

// Fetch activity logs for the logged-in user
$logs = getUserLogs($pdo, $_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <a href="core/handleForms.php?logoutUserBtn=true">Logout</a>
    </header>

    <!-- Message Section -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message">
            <p><?php echo htmlspecialchars($_SESSION['message']); ?></p>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Search Form -->
    <form action="index.php" method="GET">
        <input type="text" name="search" placeholder="Search for applicants...">
        <button type="submit">Search</button>
    </form>

    <?php
    // Handle search logic
    if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
        $searchQuery = trim($_GET['search']);
        $applicants = searchForAUser($pdo, $searchQuery, $_SESSION['user_id']);
    }
    ?>

    <!-- Applicants Table -->
    <h2>Applicants</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Experience</th>
                <th>Specialization</th>
                <th>Degree</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicants as $applicant): ?>
                <tr>
                    <td><?php echo htmlspecialchars(string: $applicant['id']); ?></td>
                    <td><?php echo htmlspecialchars(string: $applicant['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['email']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['experience']); ?> years</td>
                    <td><?php echo htmlspecialchars($applicant['specialization']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['degree']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['contact']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $applicant['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $applicant['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="insert.php">Add New Applicant</a>

    <!-- Activity Logs Section -->
    <h2>Your Activity Logs</h2>
    <table>
        <thead>
            <tr>
                <th>Action</th>
                <th>Details</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($logs)): ?>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($log['action']); ?></td>
                        <td><?php echo htmlspecialchars($log['details']); ?></td>
                        <td><?php echo htmlspecialchars($log['timestamp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No activity logs found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
