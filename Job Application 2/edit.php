<?php 
require_once 'core/dbConfig.php';
require_once 'core/models.php';
$applicant = getApplicantByID($pdo, $_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant</title>
</head>
<body>
    <h1>Edit Applicant</h1>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $applicant['id']; ?>">
        <p><label>First Name</label> <input type="text" name="first_name" value="<?php echo $applicant['first_name']; ?>"></p>
        <p><label>Last Name</label> <input type="text" name="last_name" value="<?php echo $applicant['last_name']; ?>"></p>
        <p><label>Email</label> <input type="email" name="email" value="<?php echo $applicant['email']; ?>"></p>
        <p><label>Experience</label> <input type="number" name="experience" value="<?php echo $applicant['experience']; ?>"></p>
        <p><label>Specialization</label> <input type="text" name="specialization" value="<?php echo $applicant['specialization']; ?>"></p>
        <p><label>Degree</label> <input type="text" name="degree" value="<?php echo $applicant['degree']; ?>"></p>
        <p><label>Contact</label> <input type="text" name="contact" value="<?php echo $applicant['contact']; ?>"></p>
        <button type="submit" name="editUserBtn">Update Applicant</button>
    </form>
</body>
</html>
