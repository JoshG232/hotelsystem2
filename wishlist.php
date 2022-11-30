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
    
</head>
<body>
    <?php include 'headerNav.php';?>
    <?php 
        $customerID = $_SESSION["customerID"];
        $sql = "SELECT * FROM booking WHERE customerID='$customerID' AND wishlist='1' ";
        $result = mysqli_query($conn,$sql);
        $wishlist = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (isset($_POST["deleteWishlistItem"])){
            $bookingID = filter_input(INPUT_POST, "bookingID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            echo $bookingID;
            $sql = "DELETE FROM `booking` WHERE bookingID='$bookingID'";
            if (mysqli_query($conn, $sql)){
                header("Location: wishlist.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
        }
        if (isset($_POST["addToBasket"])){
            $bookingID = filter_input(INPUT_POST, "bookingID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "UPDATE booking SET wishlist='0' WHERE bookingID='$bookingID'";
            if (mysqli_query($conn, $sql)){
            
                header("Location: wishlist.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }


    ?>
    <?php foreach($wishlist as $wishlistItem): ?>
        <?php
            if ($wishlistItem["hotelID"] == '1'){
                $hotelName = "Nottingham";
            }
            if ($wishlistItem["hotelID"] == '2'){
                $hotelName = "Derby";
            }
            if ($wishlistItem["hotelID"] == '3'){
                $hotelName = "Liverpool";
            }

        ?>
        <div class="basketInfoDiv">
            <div class="wordsInBasket">
                <p class="text">Hotel: <?php echo $hotelName ?> </p>
                <P class="text">Date booked for: <?php echo $wishlistItem["dateBooked"] ?> </p>
                <p class="text">Booking ID: <?php echo $wishlistItem["bookingID"] ?> </p>
                <p class="text">Check in time:<?php echo $wishlistItem["checkIn"] ?> </p>
                <p class="text">Check out time:<?php echo $wishlistItem["checkOut"] ?> </p>
                <p class="text">Adults:<?php echo $wishlistItem["adults"] ?> </p>
                <p class="text">Children:<?php echo $wishlistItem["children"] ?> </p>
            </div>
            
            
            <div class="buttonsInBasket">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <input type="text" name="bookingID"  value=<?php echo $wishlistItem["bookingID"] ?> class="hiddenVariables">
                </form>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <input type="text" name="bookingID"  value=<?php echo $wishlistItem["bookingID"] ?> class="hiddenVariables">
                    <input type="submit" value="Add to basket" name="addToBasket" class="text">
                </form>
                <br>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <input type="text" name="bookingID"  value=<?php echo $wishlistItem["bookingID"] ?> class="hiddenVariables">
                    <input type="submit" value="Delete wishlist item" name="deleteWishlistItem" class="text">
                </form>
            </div>
            

            
            
            <br>
        </div>


    <?php endforeach ?>
    <footer>
        <?php include 'footer.html' ?>
    </footer>
</body>