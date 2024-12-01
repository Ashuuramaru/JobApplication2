<?php require_once 'core/handleForms.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add a New Applicant</h1>
    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="firstName">First Name</label> 
            <input type="text" name="first_name" required>
        </p>
        <p>
            <label for="lastName">Last Name</label> 
            <input type="text" name="last_name" required>
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="email" name="email" required>
        </p>
        <p>
            <label for="experience">Years of Experience</label> 
            <input type="number" name="experience" min="0" required>
        </p>
        <p>
            <label for="specialization">Specialization</label> 
            <input type="text" name="specialization" required>
        </p>
        <p>
            <label for="degree">Degree</label> 
            <input type="text" name="degree" required>
        </p>
        <p>
            <label for="contact">Contact Number</label> 
            <input type="text" name="contact" required>
        </p>
        <p>
            <input type="submit" name="insertUserBtn" value="Add Applicant">
        </p>
    </form>
</body>
</html>
