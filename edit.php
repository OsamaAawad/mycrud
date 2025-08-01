<?php
include "db.php";


if (isset($_GET["id"]))
    $id = $_GET["id"];
else
    die("Client not found.");


$sql = "SELECT * FROM clients WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$name = $row["name"];
$email = $row["email"];
$phone = $row["phone"];
$address = $row["address"];
$hobby = $row["hobby"];
$ext = $row["ext"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["hobby"]) && isset($_POST["address"]) && isset($_POST["ext"]) && isset($_POST["phone"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $ext = $_POST["ext"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $hobby = $_POST["hobby"];
        
        $domain = substr(strrchr($email, "@"), 1);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Invalid email format!";
        } elseif (!checkdnsrr($domain, "MX")) {
            $errorMessage = "Email domain is invalid!";
        }

        if(empty($errorMessage)){
        $updateClient = "UPDATE clients SET name='$name', email='$email', hobby = '$hobby', address= '$address', ext='$ext', phone='$phone' where id = $id";
        $result = mysqli_query($conn, $updateClient);

        if (!$result) {
            die("Invalid Query" . mysqli_error($conn));
        }

        header("location: index.php");
        exit;
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
                    <input class="form-control border-black" type="email" name="email" value="<?php echo $email ?>"   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
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
                <div class="col-sm-2">
                    <label for="ext" class="form-label">Country Code</label>
                    <input 
                    type="text" 
                    minlength = 3
                    title="Please enter a valid country code +XX." 
                    pattern="^\+\d{1,4}$"  
                    class="form-control border-black" 
                    name="ext" 
                    placeholder="+961"
                    value="<?php echo htmlspecialchars($ext); ?>"

                    >
                </div>

                <div class="col-sm-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input 
                    type="text" 
                    class="form-control border-black" 
                    name="phone"
                    placeholder="70123456" 
                    minlength = 5  
                    maxlength = 10 
                    pattern="^\d{7,10}$"   
                    title="Enter only digits (7 to 10 numbers)"
                    value="<?php echo htmlspecialchars($phone); ?>"
                    >
                </div>
            </div>



            <div class="my-3">
                <a href="index.php" class="btn">Cancel</a>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
</body>

</html>