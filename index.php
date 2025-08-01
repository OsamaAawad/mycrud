<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <title>My Shop</title>



</head>

<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <input type="text" id="searchInput" class="form-control mb-3" name="search"
            placeholder="Search by name or email...">
        <a class="btn btn-primary" href="create.php">New Client</a>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Hobby</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Actions</th>

            </thead>
            <tbody id="clientTableBody">
                <?php
                include "db.php";



                $sql = "SELECT * FROM clients ORDER BY id ASC";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                          <tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[ext] $row[phone]</td>
                            <td>$row[hobby]</td>
                            <td>$row[address]</td>
                            <td>$row[created_at]</td>
                            <td>
                                <a class='btn btn-primary' href='edit.php?id=$row[id]'>Edit</a></button>
                                <a class='btn btn-danger' href='delete.php?id=$row[id]'>Delete</a>
                            </td>

                        </tr>
                    ";
                }
                ?>

                <script>
                    const searchInput = document.getElementById("searchInput");

                    searchInput.addEventListener("input", function () {
                        const searchValue = this.value;

                        fetch("search.php?search=" + searchValue)
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById("clientTableBody").innerHTML = data;
                            });
                    });
                </script>



            </tbody>
        </table>
    </div>

</body>

</html>