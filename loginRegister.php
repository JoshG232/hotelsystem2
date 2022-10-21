<?php include "./config/database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Website</title>
    <script src="./app.js"></script>

</head>
<body>
    
    <?php include 'headerNav.php';?>
    


    </form>
    <?php
        // $firstName = $lastName = $email = $gender = $age = $nationality = "";
        if (isset($_POST["submitRegister"])){
            $firstName = filter_input(INPUT_POST, "firstName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, "lastName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $age = filter_input(INPUT_POST, "age",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nationality = filter_input(INPUT_POST, "nationality",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $sql= "SELECT email FROM customer WHERE email='$email'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result)==0) {
                $sql = "INSERT INTO customer(firstName,lastName,email,password,gender,age,nationality)
                VALUES ('$firstName','$lastName','$email','$password','$gender','$age','$nationality')";
                if (mysqli_query($conn, $sql)){
                    
                    header("Location: index.php");
                }
                else {
                    echo "Error" . mysqli_error($conn);
                }
            } else {
                echo "Email already in use. Please login or use another email.";
            }
            
        }
        if (isset($_POST["submitLogin"])){
            
            $email = filter_input(INPUT_POST, "email",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "SELECT firstName,password,customerID FROM customer WHERE email='$email'";
            $result = mysqli_query($conn,$sql);
            $loginInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $actPassword = $loginInfo[0]["password"];
            $firstName = $loginInfo[0]["firstName"];
            $customerID = $loginInfo[0]["customerID"];
            
            // var_export($actPassword);
            if ($password == "$actPassword"){
                $_SESSION["firstName"] = $firstName;
                $_SESSION["customerID"] = $customerID;
                
                header("Location: index.php");
            } else {
                echo "Incorrect login";
            }
        }
    ?>
    
    
    <h1>Login/Register</h1>
    <div class="registerForm">
        <h2>Register</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="registerForm">
        
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName">
        
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName">

            <label for="email">Email:</label>
            <input type="text" name="email" id="email">

            <label for="password">Password:</label>
            <input type="text" name="password" id="password">

            <label for="gender">Gender:</label>
            <input type="text" name="gender" id="gender">

            <label for="age">Age:</label>
            <input type="text" name="age" id="age">

            <label for="nationality">Nationality:</label>
            <input type="text" name="nationality" id="nationality">

            <br>
            <input type="submit" name="submitRegister" value="Submit">

        </form>
    </div>
        
    <div class="loginForm">
        <h2>Login</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="loginForm">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">

            <br>
            <input type="submit" name="submitLogin" value="Submit">

        </form>
    </div>

    
    <footer>
        <?php include 'footer.html' ?>
    </footer>





</body>
</html>