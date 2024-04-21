<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Make a password</title>
<style>
    body {
        margin: 0;
        padding: 10px;
        font-family: Arial, sans-serif;
        background-color: #ff5733; /* Changed background color to #ff5733 */
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    .container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .container label {
        display: block;
        margin-bottom: 10px;
    }

    .container input[type="password"],
    .container button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .container button {
        background-color: #ff5733;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .container button:hover {
        background-color: #ff3c1f;
    }

    .error-message {
        color: red;
        margin-bottom: 10px;
    }
</style>
</head>
<body>
    <div class="container">
        <?php
        $username = $_POST['inputData'];
        echo "<h2>Make a password for " . $username . "</h2>";
        ?>
        <div class="error-message" id="errorMessage"></div>
        <form id="registerForm" action="add_name.php" method="POST" onsubmit="return validateForm()">
            <!-- Hidden input for the username passed from the previous page -->
            <input type="hidden" id="username" name="inputData" value="<?php echo $username; ?>">
            <label for="password">Password:</label>
            <input type="password" id="password" name="moreData" required>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var errorMessage = document.getElementById("errorMessage");

            if (password !== confirmPassword) {
                errorMessage.textContent = "Error: Passwords do not match";
                return false;
            } else {
                errorMessage.textContent = "";
                return true;
            }
        }
    </script>
</body>
</html>
