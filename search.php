<?php
include "db.php";

if (isset($_GET["search"]))
    $search = $_GET["search"];
else
    $search = "";

$sql = "SELECT * FROM clients WHERE name LIKE '%$search%' OR email LIKE '%$search%' ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['hobby']}</td>
                <td>{$row['address']}</td>
                <td>{$row['created_at']}</td>
                <td>
                    <a class='btn btn-primary' href='edit.php?id={$row['id']}'>Edit</a>
                    <a class='btn btn-danger' href='delete.php?id={$row['id']}'>Delete</a>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No results found.</td></tr>";
}
?>