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

    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .login-container label {
        display: block;
        margin-bottom: 10px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"],
    .login-container button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .login-container button {
        background-color: #ff5733;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .login-container button:hover {
        background-color: #ff3c1f;
    }
</style>
</head>
<body>
    <div class="login-container">
        <h2>Create a Username</h2>
        <div class="error-message" id="errorMessage" style="color:red;"></div>
        <form action="check_create.php" method="POST" onsubmit="return validateForm()">
            <label for="inputData">Create Username:</label>
            <input type="text" id="inputData" name="inputData" required>
            <button type="submit">Submit</button>
        </form>
    </div>
    <script>
    function validateForm() {
        var username = document.getElementById("inputData").value;
        var errorMessage = document.getElementById("errorMessage");

        // Make an AJAX request to validate.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "validate.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log("Response received:", xhr.responseText); // Debugging
                var response = xhr.responseText.trim();
                console.log("response: "+response);
                if (response === "true") {
                    errorMessage.textContent = ""; // Clear error message
                    // Proceed with form submission after validation
                    document.querySelector("form").submit();
                } if(response === "false") {
                    errorMessage.textContent = "Username Already Exists"; // Display error message
                    // Prevent form submission
                    return false;
                }
            }
        };
        xhr.send("uzername=" + username); // Send username for validation
        return false; // Prevent default form submission
    }
</script>

</body>
</html>
