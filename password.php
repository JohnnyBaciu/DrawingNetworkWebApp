<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
    body {
        margin: 0;
        padding: 10px;
        font-family: Arial, sans-serif;
        background-color: #ff5733;
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

    .container input[type="text"],
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
</style>
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputData = $_POST['inputData'];
            echo "<h2>Welcome " . $inputData . "</h2>";
        } else {
            echo "<h2>Error: Invalid Request</h2>";
        }
        ?>
        <!-- Hidden input to pass along the first set of data -->
        <div class="login-container">
        <h2>Login</h2>
        <div class="error-message" id="errorMessage" style="color:red;"></div>
        <form action="add_name.php" method="POST" onsubmit="return validateForm()">
    <input type="hidden" name="inputData" value="<?php echo $inputData; ?>">
    <label for="passwordInput">Enter your Password:</label>
    <input type="password" id="passwordInput" name="moreData" autocomplete="off" required>
    <button type="submit">Submit</button>
</form>
        </div>
    </div>
    <script>
    function validateForm() {
        var username = "<?php echo $inputData; ?>";
        var password = document.getElementById("passwordInput").value;
        var errorMessage = document.getElementById("errorMessage");
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "validatep.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                var response = xhr.responseText.trim();
                console.log(response);
                if (response === "true") {
                    errorMessage.textContent = ""; // Clear error message
                    document.querySelector("form").submit(); // Submit the form if validation passes
                } else {
                    errorMessage.textContent = "Password does not match"; // Display error message
                }
            }
        };
        xhr.send("uzername=" + username + "&password=" + password); // Send username and password for validation
        return false; // Prevent default form submission
    }
    </script>
</body>
</html>
