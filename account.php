<?php include 'header.html';?>
<?php include 'headerNav.php';?>
<?php include "./config/database.php"; ?>
<link rel="stylesheet" href="style.css">
<style>
    div.basketDisplay{
        display: block;
    }
    input.hiddenVariables{
        display:none;
    }


</style>
<body>

<?php 
    $customerID = $_SESSION['customerID'];
    $sql = "SELECT * FROM customer WHERE customerID='$customerID'";
    $result = mysqli_query($conn,$sql);
    $customerDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $customerID = $_SESSION["customerID"];
    $sql = "SELECT * FROM booking WHERE customerID='$customerID' AND booked='1' AND dateBooked < CURDATE()";
    $result = mysqli_query($conn,$sql);
    $previousBookings = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $customerID = $_SESSION["customerID"];
    $sql = "SELECT * FROM booking WHERE customerID='$customerID' AND booked='1' AND dateBooked >= CURDATE()";
    $result = mysqli_query($conn,$sql);
    $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);


    if (isset($_POST["updateInfo"])){
        $customerID = $_SESSION["customerID"];
        $firstName = filter_input(INPUT_POST, "firstName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "lastName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $gender = filter_input(INPUT_POST, "gender",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $age = filter_input(INPUT_POST, "age",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nationality = filter_input(INPUT_POST, "nationality",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sql = "UPDATE customer SET 
            firstName='$firstName', 
            lastName='$lastName', 
            email='$email',
            password='$hashedPassword', 
            gender='$gender',
            age='$age',
            nationality='$nationality'
             WHERE customerID='$customerID'";
        if (mysqli_query($conn, $sql)){
            
            header("Location: account.php");
        }
          else {
            echo "Error" . mysqli_error($conn);
        }
        
    }

    if (isset($_POST["deleteBooking"])){
        $bookingID = filter_input(INPUT_POST, "bookingID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        echo $bookingID;
        $sql = "DELETE FROM `booking` WHERE bookingID='$bookingID'";
        if (mysqli_query($conn, $sql)){
        
            header("Location: account.php");
        }
          else {
            echo "Error" . mysqli_error($conn);
        }
        
    }



?>
    <div class="customerDisplay">
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            
            <label for="firstName" class="text" >First Name:</label>
            <input type="text" name="firstName" value=<?php echo $customerDetails[0]["firstName"]?> >

            <label for="lastName" class="text">Last Name:</label>
            <input type="text" name="lastName" value=<?php echo $customerDetails[0]["lastName"]?> >

            <label for="email" class="text">Email:</label>
            <input type="email" name="email" value=<?php echo $customerDetails[0]["email"]?> >

            <label for="password" class="text">Password:</label>
            <input type="text" name="password" placeholder="Enter new password" >

            <label for="gender" class="text">Gender:</label>
            <input type="text" name="gender" value=<?php echo $customerDetails[0]["gender"]?> >

            <label for="age" class="text">Age:</label>
            <input type="number" name="age" value=<?php echo $customerDetails[0]["age"]?> >

            <label for="nationality" class="text">Nationality:</label>
            <input type="text" name="nationality" value=<?php echo $customerDetails[0]["nationality"]?> >
            <br>
            <br>
            
            <input type="submit" value="Update information" name="updateInfo">
        </form>
        
        <br>
    </div>
    <div class="titleDiv">
        <h2 class="titleText">Current bookings</h2>
    </div>
    
    
    <?php foreach($bookings as $booking): ?>
    
        <?php
        if ($booking["hotelID"] == '1'){
            $hotelName = "Nottingham";
        }
        if ($booking["hotelID"] == '2'){
            $hotelName = "Derby";
        }
        if ($booking["hotelID"] == '3'){
            $hotelName = "Liverpool";
        }

    ?>
    <div class="accountInfoDiv">
        <div class="wordsInAccount">
            <p class="text">Hotel: <?php echo $hotelName ?> </p>
            <P class="text">Date booked for: <?php echo $booking["dateBooked"] ?> </p>
            <p class="text">Booking ID: <?php echo $booking["bookingID"] ?> </p>
            <p class="text">Check in time:<?php echo $booking["checkIn"] ?> </p>
            <p class="text">Check out time:<?php echo $booking["checkOut"] ?> </p>
            <p class="text">Adults:<?php echo $booking["adults"] ?> </p>
            <p class="text">Children:<?php echo $booking["children"] ?> </p>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <input type="text" name="bookingID"  value=<?php echo $booking["bookingID"] ?> class="hiddenVariables">
                <input type="submit" value="Delete booking" name="deleteBooking" class="text">
            </form>
        </div>
        
        
        
        <br>
    </div>

    


    <?php endforeach ?>
    <div class="titleDiv">
        <h2 class="titleText">Previous Bookings</h2>
    </div>
 
    
    <?php foreach($previousBookings as $booking): ?>
    
        <?php
            if($booking["dateBooked"] < date("Y-m-d")){
                
            }
            if ($booking["hotelID"] == '1'){
                $hotelName = "Nottingham";
            }
            if ($booking["hotelID"] == '2'){
                $hotelName = "Derby";
            }
            if ($booking["hotelID"] == '3'){
                $hotelName = "Liverpool";
            }

        ?>
    <div class="accountInfoDiv" >
        <div class="wordsInAccount">
            <p class="text">Hotel: <?php echo $hotelName ?> </p>
            <P class="text">Date booked for: <?php echo $booking["dateBooked"] ?> </p>
            <p class="text">Booking ID: <?php echo $booking["bookingID"] ?> </p>
            <p class="text">Check in time:<?php echo $booking["checkIn"] ?> </p>
            <p class="text">Check out time:<?php echo $booking["checkOut"] ?> </p>
            <p class="text">Adults:<?php echo $booking["adults"] ?> </p>
            <p class="text">Children:<?php echo $booking["children"] ?> </p>
        </div>
        
        <!-- <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="bookingID"  value=<?php echo $booking["bookingID"] ?> class="hiddenVariables">
            <input type="submit" value="Delete booking" name="deleteBooking">
        </form> -->
        
        <br>
    </div>

    


    <?php endforeach ?>

    
    <footer>
        <?php include 'footer.html' ?>
    </footer>
</body>