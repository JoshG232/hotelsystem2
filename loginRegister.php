<?php include "./config/database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<style>
    
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Website</title>
    <script src="./app.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <?php include 'headerNav.php';?>
    


    </form>
    <?php
        $firstNameEmpty = $lastNameEmpty = $emailEmpty = $passwordEmpty = $genderEmpty = $ageEmpty = $nationalityEmpty = $incorrectLogin = $emailLoginEmpty = $passwordLoginEmpty = $registerMessage =   "";
        
        // $firstName = $lastName = $email = $gender = $age = $nationality = "";
        if (isset($_POST["submitRegister"])){
            if (empty($_POST["firstName"])){
                $firstNameEmpty = "First name is required";
            }
            else {
                $firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
                    $sql = "INSERT INTO customer(firstName,lastName,email,password,gender,age,nationality)
                    VALUES ('$firstName','$lastName','$email','$hashedPassword','$gender','$age','$nationality')";
                    if (mysqli_query($conn, $sql)){
                        
                        header("Location: loginRegister.php");
                    }
                    else {
                        echo "Error" . mysqli_error($conn);
                    }
                } else {
                    $registerMessage = "Email already in use. Please login or use another email.";
                }
            } 
            else {

            }
            
            
            
        }
        if (isset($_POST["submitLogin"])){
            if (empty($_POST["emailLogin"])){
                $emailLoginEmpty = "Email is required";
            }
            else {
                $email = filter_input(INPUT_POST, "emailLogin", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }

            if (empty($_POST["passwordLogin"])){
                $passwordLoginEmpty = "Password is required";
            }
            else {
                $password = filter_input(INPUT_POST, "passwordLogin", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            
            
            if(empty($emailLoginEmpty) && empty($passwordLoginEmpty)){
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
            
        }
    ?>
    
    <div class="emailInUse">
        <p class="text" style="color:red"><?php echo "$registerMessage" ?></p>
    </div>
    
    <div class="registerForm">
        <h2 class="text">Register</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="registerForm">
            
            <label for="firstName" class="text">First Name:</label>
            <input type="text" name="firstName" id="firstName" value="<?php echo $_POST['firstName'] ?? ''; ?>" class="textInput">
            <div>
                <p class="formText"> <?php echo $firstNameEmpty; ?></p>
            </div>

            <label for="lastName" class="text">Last Name:</label>
            <input type="text" name="lastName" id="lastName" value="<?php echo $_POST['lastName'] ?? ''; ?>" class="textInput">
            <div>
                <p class="formText"> <?php echo $lastNameEmpty; ?> </p>
                
            </div>

            <label for="email" class="text">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? ''; ?>" class="textInput">
            <div>
                <p class="formText"><?php echo $emailEmpty; ?></p>
                
            </div>

            <label for="password" class="text">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $_POST['password'] ?? ''; ?>" class="textInput">
            <div>
                <p class="formText"><?php echo $passwordEmpty; ?></p>
                
            </div>

            <label for="gender" class="text">Gender:</label>
            <input type="text" name="gender" id="gender" value="<?php echo $_POST['gender'] ?? ''; ?>" class="textInput">
            <div>
                <p class="formText"><?php echo $genderEmpty; ?></p>
                
            </div>

            <label for="age" class="text">Age:</label>
            <input type="number" name="age" id="age" value="<?php echo $_POST['age'] ?? ''; ?>" class="textInput">
            <div>
                <p class="formText"><?php echo $ageEmpty; ?></p>
                
            </div>

            <label for="nationality" class="text">Nationality:</label>
            <input type="text" name="nationality" id="nationality" value="<?php echo $_POST['nationality'] ?? ''; ?>" class="textInput">
            <div>
                <p class="formText"> <?php echo $nationalityEmpty; ?></p>
            </div>

            <br>
            <input type="submit" name="submitRegister" value="Submit" class="textInput">

        </form>
    </div>
        
    <div class="loginForm">
        <h2 class="text">Login</h2>
        <div> 
            
            <p class="formText"> <?php echo $incorrectLogin ?></p>
        </div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="loginForm">
            <label for="emailLogin" class="text">Email:</label>
            <input type="email" name="emailLogin" id="email" value="<?php echo $_POST['emailLogin'] ?? ''; ?>" class="textInput">
            <div> <p class="formText"><?php echo $emailLoginEmpty; ?></p></div>

            <label for="passwordLogin" class="text">Password:</label>
            <input type="password" name="passwordLogin" id="password" class="textInput">
            <div> <p class="formText"><?php echo $passwordLoginEmpty; ?></p></div>
            <br>
            <input type="submit" name="submitLogin" value="Submit" class="textInput">

        </form>
    </div>

    <footer>
        <?php include 'footer.html' ?>
    </footer>





</body>
</html>