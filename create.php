<?php


include("db.php");
$name = "";
$email = "";
$hobby = "";
$address = "";
$phone = "";


$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["hobby"]) && isset($_POST["address"]) && isset($_POST["phone"])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $hobby = $_POST["hobby"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];

        if (!empty($name) && !empty($email) && !empty($hobby) && !empty($address) && !empty($phone)) {
            $newClient = "INSERT INTO clients (name, email, hobby, address, phone)
              VALUES ('$name', '$email', '$hobby', '$address', '$phone')";

            $result = mysqli_query($conn, $newClient);

            if (!$result) {
                die("Invalid Query" . mysqli_error($conn));
            }

            $errorMessage = "";
            header("location: index.php");
            exit;
        } else {
            $errorMessage = "All the fields are required.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <title>Create Client</title>
</head>

<body>
    <div class="container my-5">
        <?php
        if (!empty($errorMessage)) {
            echo "
                <strong>$errorMessage</strong>
            ";
        }
        ?>
        <form action="" method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="name">Name:</label>
                <div>
                    <input class="form-control border-black" type="text" name="name" value="<?php echo $name ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="email">Email:</label>
                <div>
                    <input class="form-control border-black" type="text" name="email" value="<?php echo $email ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="hobby">Hobby:</label>
                <select class="form-control border-black" name="hobby">
                    <option value="">Select Your Hobby</option>
                    <option value="swimming" <?= $hobby === 'swimming' ? 'selected' : '' ?>>Swimming</option>
                    <option value="football" <?= $hobby === 'football' ? 'selected' : '' ?>>Football</option>
                    <option value="running" <?= $hobby === 'running' ? 'selected' : '' ?>>Running</option>
                    <option value="coding" <?= $hobby === 'coding' ? 'selected' : '' ?>>Coding</option>
                </select>

            </div>



            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="address">Address:</label>
                <div>
                    <input class="form-control border-black border-black" type="text" name="address"
                        value="<?php echo $address ?>">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="phone">Phone:</label>
                <div>
                    <input class="form-control border-black border-black" type="text" name="phone"
                        value="<?php echo $phone ?>">
                </div>
            </div>

            <div class="my-3">
                <a href="index.php" class="btn btn-outline-primary ">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</body>

</html>