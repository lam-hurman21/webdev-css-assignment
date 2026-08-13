<?php
// Retrieve and display members from the database

require_once "db_connect.php";

$result = $conn->query(
    "SELECT id, name, email, plan, message, registered_at FROM members ORDER BY registered_at DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel and Dice Cafe - Members</title>
    <link rel="stylesheet" href="csslab.css">
</head>
<body>

    <nav class="nav">
        <a class="nav-brand" href="index.html">Pixel &amp; Dice Cafe</a>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="games.html">Games</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a class="active" href="members.php">Members</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>

    <main class="container">
        <div class="page-intro">
            <h1>Registered Members</h1>
            <p>Records retrieved from the MySQL database using MySQLi.</p>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="table-wrap">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Plan</th>
                    <th>Message</th>
                    <th>Registered</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["plan"]); ?></td>
                        <td><?php echo htmlspecialchars($row["message"]); ?></td>
                        <td><?php echo htmlspecialchars($row["registered_at"]); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            </div>
        <?php else: ?>
            <div class="card">
                <p>No members found yet. <a href="register.php">Register</a> to add the first one.</p>
            </div>
        <?php endif; ?>

        <p><a class="btn" href="register.php">Register a new member</a></p>
    </main>

    <footer class="footer">
        <p>Copyright 2026 Pixel and Dice Cafe</p>
    </footer>

</body>
</html>
<?php
if ($result) {
    $result->free();
}
$conn->close();
?>
