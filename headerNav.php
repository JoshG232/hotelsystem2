<?php
    $loggedIn = "none";
    $adminRights = "none";
    $firstName = "";
    $bookings = "1"
?>
<link rel="stylesheet" href="style.css">
<style>
    .navListItem2 {
        display: <?php echo "$loggedIn" ?>;
    }
    .navListItem4 {
        display: <?php echo "$adminRights" ?>;
    }
</style>

<?php
    session_start();

    if (isset($_SESSION["firstName"])){

        $firstName = $_SESSION["firstName"];
        $customerID = $_SESSION["customerID"];
        $loggedIn = "unset";
        $loggedIn2 = "none";
        if ($customerID == "22"){
            $adminRights = "unset";
        }
        
        
    } else {
        
        
    }

?>
    <!-- <div class="nav"> -->
        <!-- <ul class="navList">
            <li class="navListItem"><a href="index.php" class="navListItemText">Home</a></li>
            <li class="navListItem"><a href="report.php" class="navListItemText">Report</a></li>
            <li class="navListItem"><a href="content.php" class="navListItemText">Content</a></li>
        </ul>
        <ul class="navList2">
            <li class="navListItem2"><a class="navListItemText"><?php echo "Welcome ". $firstName; ?> </a></li>
            <li class="navListItem2"><a href="booking.php" class="navListItemText">Booking</a></li>
            <li class="navListItem2"><a href="basket.php" class="navListItemText"><?php echo "Basket " . "(" . $bookings . ")"?></a></li>
            <li class="navListItem2"><a href="account.php" class="navListItemText">Account</a></li>
            <li class="navListItem2"><a href="logout.php" class="navListItemText">Logout</a></li>

            <li class="navListItem3"><a href="loginRegister.php" class="navListItemText">Login/Registration</a></li>

            
        </ul> -->
        <div class="leftNav">
            <a href="index.php" class="navListItem">Home</a>
            <a href="report.php" class="navListItem">Report</a>
            <a href="content.php" class="navListItem">Content</a>
            <div class="rightNav">
                <a href="" class="navListItem2"><?php echo "Welcome ". $firstName; ?> </a>

                <a href="adminPage.php" class="navListItem4">Admin Page</a>
                <a href="booking.php" class="navListItem2">Booking</a>
                <a href="basket.php" class="navListItem2">Basket</a>
                <a href="account.php" class="navListItem2">Account</a>
                <a href="logout.php" class="navListItem2">Logout</a>
                <a href="loginRegister.php" class="navListItem3">Login/Register</a>
            </div>
        </div>
    <!-- </div> -->
    

<style>
    .navListItem2 {
        display: <?php echo "$loggedIn" ?>;
    }
    .navListItem3 {
        display: <?php echo "$loggedIn2" ?>;
    }
    .navListItem4 {
        display: <?php echo "$adminRights" ?>;
    }
</style>
