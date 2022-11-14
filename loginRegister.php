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
        $firstNameEmpty = $lastNameEmpty = $emailEmpty = $passwordEmpty = $genderEmpty = $ageEmpty = $nationalityEmpty = $incorrectLogin = "";
        
        // $firstName = $lastName = $email = $gender = $age = $nationality = "";
        if (isset($_POST["submitRegister"])){
            if (empty($_POST["firstName"])){
                $firstNameEmpty = "First name is required";
            }
            else {
                $firstName = filter_input(INPUT_POST, "firsName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }

            if (empty($_POST["lastName"])){
                $lastNameEmpty = "Last name is required";
            }
            else {
                $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }

            if (empty($_POST["email"])){
                $emailEmpty = "Email is required";
            }
            else {
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }

            if (empty($_POST["password"])){
                $passwordEmpty = "Password is required";
            }
            else {
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            }

            if (empty($_POST["gender"])){
                $genderEmpty = "Gender is required";
            }
            else {
                $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            if (empty($_POST["age"])){
                $ageEmpty = "Age is required";
            }
            else {
                $age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            if (empty($_POST["nationality"])){
                $nationalityEmpty = "Nationality is required";
            }
            else {
                $nationality = filter_input(INPUT_POST, "nationality", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            
            if (empty($firstNameEmpty) && empty($lastNameEmpty) && empty($emailEmpty) && empty($passwordEmpty) && empty($genderEmpty) && empty($ageEmpty) && empty($nationalityEmpty)){
                $sql= "SELECT email FROM customer WHERE email='$email'";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)==0) {
                    echo $sql = "INSERT INTO customer(firstName,lastName,email,password,gender,age,nationality)
                    VALUES ('$firstName','$lastName','$email','$hashedPassword','$gender','$age','$nationality')";
                    if (mysqli_query($conn, $sql)){
                        
                        // header("Location: index.php");
                    }
                    else {
                        echo "Error" . mysqli_error($conn);
                    }
                } else {
                    echo "Email already in use. Please login or use another email.";
                }
            } 
            else {

            }
            
            
            
        }
        if (isset($_POST["submitLogin"])){
            
            $email = filter_input(INPUT_POST, "emailLogin",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "passwordLogin",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "SELECT firstName,password,customerID FROM customer WHERE email='$email'";
            $result = mysqli_query($conn,$sql);
            $loginInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $actPassword = $loginInfo[0]["password"];
            $firstName = $loginInfo[0]["firstName"];
            $customerID = $loginInfo[0]["customerID"];
            
            // var_export($actPassword);
            if (password_verify($password,$actPassword)){
                $_SESSION["firstName"] = $firstName;
                $_SESSION["customerID"] = $customerID;
                
                header("Location: index.php");
            } else {
                $incorrectLogin = "Incorrect login. Please try again.";
            }
        }
    ?>
    
    
    <h1>Login/Register</h1>
    <div class="registerForm">
        <h2>Register</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="registerForm">
            
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName" value="<?php echo $_POST['firstName'] ?? ''; ?>">
            <div>
                <?php echo $firstNameEmpty; ?>
            </div>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName" value="<?php echo $_POST['lastName'] ?? ''; ?>">
            <div>
                <?php echo $lastNameEmpty; ?>
            </div>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? ''; ?>">
            <div>
                <?php echo $emailEmpty; ?>
            </div>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $_POST['password'] ?? ''; ?>">
            <div>
                <?php echo $passwordEmpty; ?>
            </div>

            <label for="gender">Gender:</label>
            <input type="text" name="gender" id="gender" value="<?php echo $_POST['gender'] ?? ''; ?>">
            <div>
                <?php echo $genderEmpty; ?>
            </div>

            <label for="age">Age:</label>
            <input type="number" name="age" id="age" value="<?php echo $_POST['age'] ?? ''; ?>">
            <div>
                <?php echo $ageEmpty; ?>
            </div>

            <label for="nationality">Nationality:</label>
            <input type="text" name="nationality" id="nationality" value="<?php echo $_POST['nationality'] ?? ''; ?>">
            <div>
                <?php echo $nationalityEmpty; ?>
            </div>

            <br>
            <input type="submit" name="submitRegister" value="Submit">

        </form>
    </div>
        
    <div class="loginForm">
        <h2>Login</h2>
        <div> <?php echo $incorrectLogin ?></div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="loginForm">
            <label for="emailLogin">Email:</label>
            <input type="email" name="emailLogin" id="email" value="<?php echo $_POST['emailLogin'] ?? ''; ?>">

            <label for="passwordLogin">Password:</label>
            <input type="password" name="passwordLogin" id="password">

            <br>
            <input type="submit" name="submitLogin" value="Submit">

        </form>
    </div>

    
    <footer>
        <?php include 'footer.html' ?>
    </footer>





</body>
</html>