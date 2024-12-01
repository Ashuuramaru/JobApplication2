<?php 
require_once 'core/models.php';
require_once 'core/dbConfig.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Are you sure you want to delete this applicant?</h1>
    <?php 
    if (isset($_GET['id'])) {
        $applicant = getApplicantByID($pdo, $_GET['id']);
    }
    ?>
    <div class="container" style="border: 2px solid red; background-color: #ffcbd1; padding: 20px; margin-top: 20px;">
        <h2>First Name: <?php echo htmlspecialchars($applicant['first_name']); ?></h2>
        <h2>Last Name: <?php echo htmlspecialchars($applicant['last_name']); ?></h2>
        <h2>Email: <?php echo htmlspecialchars($applicant['email']); ?></h2>
        <h2>Experience: <?php echo htmlspecialchars($applicant['experience']); ?> years</h2>
        <h2>Specialization: <?php echo htmlspecialchars($applicant['specialization']); ?></h2>
        <h2>Degree: <?php echo htmlspecialchars($applicant['degree']); ?></h2>
        <h2>Contact: <?php echo htmlspecialchars($applicant['contact']); ?></h2>

        <div style="margin-top: 20px;">
            <form action="core/handleForms.php" method="GET">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                <input type="submit" name="deleteUserBtn" value="Delete" style="background-color: #f69697; border: none; padding: 10px 20px; color: white; cursor: pointer;">
            </form>           
        </div>    
    </div>
</body>
</html>
