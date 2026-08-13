<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel and Dice Cafe - Register</title>
    <link rel="stylesheet" href="csslab.css">
</head>
<body>

    <nav class="nav">
        <a class="nav-brand" href="index.html">Pixel &amp; Dice Cafe</a>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="games.html">Games</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a class="active" href="register.php">Register</a></li>
            <li><a href="members.php">Members</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>

    <main class="container">
        <div class="page-intro">
            <h1>Register</h1>
            <p>Fill in this form to join our cafe. Data is sent with the <strong>POST</strong> method.</p>
        </div>
        <h2>Sign Up Form</h2>

        <form id="register-form" action="process_register.php" method="post" data-validate>
            <p class="form-error" aria-live="polite"></p>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" data-required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" data-required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" data-required>
            </div>

            <div class="form-group">
                <label for="plan">Plan:</label>
                <select id="plan" name="plan">
                    <option value="Student (Free)">Student (Free)</option>
                    <option value="Regular">Regular</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="3"></textarea>
            </div>

            <button class="btn" type="submit">Sign Up</button>
        </form>
    </main>

    <footer class="footer">
        <p>Copyright 2026 Pixel and Dice Cafe</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
