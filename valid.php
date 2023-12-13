<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["Name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $dateOfBirth = $_POST["dateofbirth"];
    $city = $_POST["city"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";

    $nameRegex = "/^[a-z ,.'-]+$/i";
    $emailRegex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
    $passwordRegex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    $dateRegex = "/^\d{4}-\d{2}-\d{2}$/";
    $cityRegex = "/^[a-zA-Z\s'-]+$/";
    $genderRegex = "/^(male|female|other|prefer not to say)$/i";

    $errors = [];

    if (empty($name) || !preg_match($nameRegex, $name)) {
        $errors["name"] = "Enter a valid name";
    }

    if (empty($email) || !preg_match($emailRegex, $email)) {
        $errors["email"] = "Enter a valid email";
    }

    if (empty($password) || !preg_match($passwordRegex, $password)) {
        $errors["password"] = "Enter a valid password";
    }

    if (empty($dateOfBirth) || !preg_match($dateRegex, $dateOfBirth)) {
        $errors["dateOfBirth"] = "Enter a valid date";
    }

    if (empty($city) || !preg_match($cityRegex, $city)) {
        $errors["city"] = "Enter a valid city";
    }

    if (empty($gender) || !preg_match($genderRegex, $gender)) {
        $errors["gender"] = "Please select a gender";
    }

    if (empty($errors)) {
        echo "Name: $name <br>";
        echo "Email: $email <br>";
        echo "Password: $password <br>";
        echo "Date of Birth: $dateOfBirth <br>";
        echo "City: $city <br>";
        echo "Gender: $gender <br>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(180, 120, 120, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: #321ee6;
            color: #fff;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <form action="formphp.php" method="post" name="myForm" onsubmit="return validateForm()">
        <label for="NameInput">Name</label>
        <input type="text" name="Name" id="NameInput" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : ''; ?>">
        <p class="error" id="nameError"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></p>

        <label for="EmailInput">Email</label>
        <input type="text" name="email" id="EmailInput" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        <p class="error" id="emailError"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></p>

        <label for="PasswordInput">Password</label>
        <input type="password" name="password" id="PasswordInput" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
        <p class="error" id="passwordError"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></p>

        <label for="DateOfBirthInput">Date of birth</label>
        <input type="date" name="dateofbirth" id="DateOfBirthInput" value="<?php echo isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : ''; ?>">
        <p class="error" id="dateError"><?php echo isset($errors['dateOfBirth']) ? $errors['dateOfBirth'] : ''; ?></p>

        <label for="CityInput">City</label>
        <input type="text" name="city" id="CityInput" value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>">
        <p class="error" id="cityError"><?php echo isset($errors['city']) ? $errors['city'] : ''; ?></p>

        <label>Gender:</label>
        <input type="radio" name="gender" value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'female') ? 'checked' : ''; ?>>Female
        <input type="radio" name="gender" value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'male') ? 'checked' : ''; ?>>Male
        <input type="radio" name="gender" value="other" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'other') ? 'checked' : ''; ?>>Other
        <p class="error" id="genderError"><?php echo isset($errors['gender']) ? $errors['gender'] : ''; ?></p>

        <input type="reset" value="Reset"><br>
        <button type="submit">Register</button>
    </form>

    <script>
    
        // variables.......................................
        function validateForm() {
            let A = document.forms["myForm"]["Name"].value;
            let B = document.forms["myForm"]["email"].value;
            let C = document.forms["myForm"]["password"].value;
            let D = document.forms["myForm"]["dateofbirth"].value;
            let E = document.forms["myForm"]["city"].value;
            let F = document.querySelector('input[name="gender"]:checked');

            // regex...............................................
            let nameRegex = /^[a-z ,.'-]+$/i;
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            let dateRegex = /^\d{4}-\d{2}-\d{2}$/;
            let cityRegex = /^[a-zA-Z\s'-]+$/;
            let genderRegex = /^(male|female|other|prefer not to say)$/i;

            // name...................................
            let nameError = document.getElementById("nameError");
            if (A === "") {
                nameError.innerHTML = "Name must be filled out";
                return false;
            } else if (!nameRegex.test(A)) {
                nameError.innerHTML = "Enter a valid name";
                return false;
            } else {
                nameError.innerHTML = "";
            }

            // email......................................
            let emailError = document.getElementById("emailError");
            if (B === "") {
                emailError.innerHTML = "Email must be filled out";
                return false;
            } else if (!emailRegex.test(B)) {
                emailError.innerHTML = "Enter a valid email";
                return false;
            } else {
                emailError.innerHTML = "";
            }

            // password...........................................
            let passwordError = document.getElementById("passwordError");
            if (C === "") {
                passwordError.innerHTML = "Password must be filled out";
                return false;
            } else if (!passwordRegex.test(C)) {
                passwordError.innerHTML = "Enter a valid password";
                return false;
            } else {
                passwordError.innerHTML = "";
            }

            // Date...............................
            let dateError = document.getElementById("dateError");
            if (D === "") {
                dateError.innerHTML = "Date must be filled out";
                return false;
            } else if (!dateRegex.test(D)) {
                dateError.innerHTML = "Enter a valid date";
                return false;
            } else {
                dateError.innerHTML = "";
            }

            // City................................
            let cityError = document.getElementById("cityError");
            if (E === "") {
                cityError.innerHTML = "City must be filled out";
                return false;
            } else if (!cityRegex.test(E)) {
                cityError.innerHTML = "Enter a valid city";
                return false;
            } else {
                cityError.innerHTML = "";
            }

            // Gender ...................................
            let genderError = document.getElementById("genderError");
            if (!F) {
                genderError.innerHTML = "Please select a gender";
                return false;
            } else {
                genderError.innerHTML = "";
            }

            return true;
        }
    
    </script>
</body>

</html>
