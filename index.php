<?
require_once "config.php";

$firstName = $lastName = $email = $phone = $position = $details = $resume = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_firstName = trim($_POST["firstName"]);
    if (empty($input_firstName)) {
        $firstName_err = "Please enter a first name.";
    } else {
        $firstName = $input_firstName;
    }

    $input_lastName = trim($_POST["lastName"]);
    if (empty($input_lastName)) {
        $lastName_err = "Please enter a last name.";
    } else {
        $lastName = $input_lastName;
    }

    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter an email.";
    } else {
        $email = $input_email;
    }

    $input_phone = trim($_POST["phone"]);
    if (empty($input_phone)) {
        $phone_err = "Please enter an phone number.";
    } else {
        $phone = $input_phone;
    }

    $input_position = trim($_POST["position"]);
    if (empty($input_position)) {
        $position_err = "Please enter an position.";
    } else {
        $position = $input_position;
    }

    $input_details = trim($_POST["details"]);
    if (empty($input_details)) {
        $details_err = "Please enter an details.";
    } else {
        $details = $input_details;
    }

    $fileName = $_FILES["image"]["name"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    // Check input errors before inserting in database
    if (empty($firstName_err) && empty($lastName_err) && empty($email_err) && empty($phone_err) && empty($position_err) && empty($details_err) && in_array($fileType, $allowTypes)) {

        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        // Prepare an insert statement
        $sql = "INSERT INTO joboffers (firstName, lastName, email, phone, position, resume) VALUES ($firstName, $lastName, $email, $phone, $position, $imgContent)";

        $insert = $db->query($sql);
        if ($insert) {
            echo "you can register successfully.";
        } else {
            echo "Please try again.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<style>
    form {
        width: 600px;
        margin: 100px auto 0 auto;
    }
</style>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" name="firstName" class="form-control" id="firstName">
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" name="lastName" class="form-control" id="lastName">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone">
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Postion applied for</label>
            <input type="text" name="position" class="form-control" id="position">
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea type="text" name="details" class="form-control" id="details"></textarea>
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Resume</label>
            <input type="file" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>