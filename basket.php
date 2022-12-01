<?php include "./config/database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<style>
    div.basketDisplay{
        display: block;
    }
    input.hiddenVariables{
        display:none;
    }


</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.html';?>
    <?php include 'headerNav.php';?>
    <?php
        $bookingHotelID = "";
        $customerID = $_SESSION["customerID"];
        $sql = "SELECT * FROM booking WHERE customerID='$customerID' AND booked='0' AND wishlist='0' ";
        $result = mysqli_query($conn,$sql);
        $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        if (isset($_POST["confirmBooking"])){
            $bookingID = filter_input(INPUT_POST, "bookingID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            echo $bookingID;
            $sql = "UPDATE booking SET booked='1' WHERE bookingID='$bookingID'";
            if (mysqli_query($conn, $sql)){
            
                header("Location: basket.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }
        if (isset($_POST["updateBooking"])){
            $bookingID = filter_input(INPUT_POST, "bookingID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $adults = filter_input(INPUT_POST, "adults",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $children = filter_input(INPUT_POST, "children",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "UPDATE booking SET 
                adults='$adults', 
                children='$children'
                 WHERE bookingID='$bookingID'";
            echo $sql;
            if (mysqli_query($conn, $sql)){
                
                header("Location: basket.php");
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
            
                echo "All confirmed";
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }
        


        
    ?>
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
        <div class="basketInfoDiv">
            <div class="wordsInBasket">
                <p class="text">Hotel: <?php echo $hotelName ?> </p>
                <P class="text">Date booked for: <?php echo $booking["dateBooked"] ?> </p>
                <p class="text">Booking ID: <?php echo $booking["bookingID"] ?> </p>
                <p class="text">Check in time:<?php echo $booking["checkIn"] ?> </p>
                <p class="text">Check out time:<?php echo $booking["checkOut"] ?> </p>
                <p class="text">Adults:<?php echo $booking["adults"] ?> </p>
                <p class="text">Children:<?php echo $booking["children"] ?> </p>
            </div>
            
            <div class="buttonsInBasket">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <label for="adults" class="text">Number of Adults</label>
                    <input type="number" name="adults" min="0" max="2" class="text"> 

                    <label for="children" class="text">Number of children</label>
                    <input type="number" name="children" min="0" max="2" class="text">
                    <br>
                    <input type="text" name="bookingID"  value=<?php echo $booking["bookingID"] ?> class="hiddenVariables text">
                    <input type="submit" value="Update booking" name="updateBooking" class="text">
                </form>
                <br>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <input type="text" name="bookingID"  value=<?php echo $booking["bookingID"] ?> class="hiddenVariables text">
                    <input type="submit" value="Confirm booking" name="confirmBooking" class="text"> 
                </form>
                <br>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <input type="text" name="bookingID"  value=<?php echo $booking["bookingID"] ?> class="hiddenVariables text">
                    <input type="submit" value="Delete booking" name="deleteBooking" class="text">
                </form>
            </div>



            
            <br>
        </div>


    <?php endforeach ?>

    <footer>
        <?php include 'footer.html' ?>
    </footer>
</body>
</html>