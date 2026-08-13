<?php
// Process registration form (POST) and insert into MySQL

require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php");
    exit;
}

$name     = trim($_POST["name"] ?? "");
$email    = trim($_POST["email"] ?? "");
$password = trim($_POST["password"] ?? "");
$plan     = trim($_POST["plan"] ?? "");
$message  = trim($_POST["message"] ?? "");

$errors = [];

if ($name === "") {
    $errors[] = "Name is required.";
}
if ($email === "") {
    $errors[] = "Email is required.";
}
if ($password === "") {
    $errors[] = "Password is required.";
}
if ($plan === "") {
    $errors[] = "Plan is required.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel and Dice Cafe - Registration Result</title>
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
            <li><a href="members.php">Members</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>

    <main class="container">
        <h1>Registration Result</h1>

        <?php if (!empty($errors)): ?>
            <div class="card alert-error">
                <h2>Could not register</h2>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p><a class="btn" href="register.php">Back to form</a></p>
            </div>
        <?php else: ?>
            <?php
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO members (name, email, password, plan, message) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("sssss", $name, $email, $hashedPassword, $plan, $message);

            $result = null;
            if ($stmt->execute()):
                $result = $conn->query(
                    "SELECT id, name, email, plan, message, registered_at FROM members ORDER BY registered_at DESC"
                );
            ?>
                <div class="card alert-success">
                    <h2>Registration successful</h2>
                    <p>Thank you. Your details were received via <strong>POST</strong> and saved to the database.</p>
                    <ul>
                        <li><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></li>
                        <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
                        <li><strong>Plan:</strong> <?php echo htmlspecialchars($plan); ?></li>
                        <li><strong>Message:</strong> <?php echo htmlspecialchars($message !== "" ? $message : "None"); ?></li>
                    </ul>
                </div>

                <h2>Members table (from database)</h2>
                <p>These rows were retrieved from the <code>members</code> table using MySQLi.</p>

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
                <?php endif; ?>

                <p>
                    <a class="btn" href="members.php">Refresh members page</a>
                    <a class="btn" href="register.php">Register another</a>
                </p>
            <?php else: ?>
                <div class="card alert-error">
                    <h2>Database error</h2>
                    <p><?php echo htmlspecialchars($stmt->error); ?></p>
                    <p><a class="btn" href="register.php">Back to form</a></p>
                </div>
            <?php
            endif;

            if ($result) {
                $result->free();
            }
            $stmt->close();
            ?>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <p>Copyright 2026 Pixel and Dice Cafe</p>
    </footer>

</body>
</html>
<?php
$conn->close();
?>
