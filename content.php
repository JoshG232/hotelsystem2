<?php include "./config/database.php"; ?>

<?php include 'header.html';?>
<?php include 'headerNav.php';?>
<style>
    input.hiddenVariables{display:none;}
    form.input{
        top: 10%;
    
    }
</style>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        
        $sql = "SELECT * FROM hotel";
        $result = mysqli_query($conn,$sql);
        $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $sql = "SELECT * FROM room WHERE roomID = '1' OR roomID = '2' OR roomID = '4'";
        $result = mysqli_query($conn,$sql);
        $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $sql = "SELECT * FROM room WHERE roomID = '2' OR roomID = '5' OR roomID = '6'";
        $result = mysqli_query($conn,$sql);
        $bathrooms = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $sql = "SELECT * FROM `image` ";
        $result = mysqli_query($conn,$sql);
        $images = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if(isset($_POST["bookingHotel"])){
            $hotelIDForBooking = filter_input(INPUT_POST, "hotelID", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $_SESSION["hotelIDForBooking"] = $hotelIDForBooking; 
            header("Location: booking.php");
            
        }
        if(isset($_POST["bookingRoom"])){
            $roomIDForBooking = filter_input(INPUT_POST, "roomID", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $_SESSION["roomIDForBooking"] = $roomIDForBooking; 
            header("Location: booking.php");
            
        }
        
    ?>






<div>
    <div class="hotels">
        <?php foreach($hotels as $hotel): ?>
            <?php
                if ($hotel["hotelID"] == '1'){
                    $hotelName = "Nottingham";
                }
                if ($hotel["hotelID"] == '2'){
                    $hotelName = "Derby";
                }
                if ($hotel["hotelID"] == '3'){
                    $hotelName = "Liverpool";
                }
                $hotelID = $hotel["hotelID"] - 1
            ?>
            <div class="hotelInfoDiv">
                <div class="wordsInHotel">
                    <p class="text">Hotel: <?php echo $hotel["nameOfHotel"] ?> </p>
                    <P class="text">Location: <?php echo $hotel["location"] ?> </p>
                    <p class="text">Number of rooms: <?php echo $hotel["numberOfRooms"] ?> </p>
                    <p class="text">Unique Feature: <?php echo $hotel["uniqueFeature"] ?> </p>
                    <br>
                    
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <input type="text" name="hotelID" value=<?php echo $hotel["hotelID"] ?> class="hiddenVariables" >
                        <input type="submit" name ="bookingHotel" value="Find rooms in this hotel" class="text">
                    </form>
                </div>
                
                
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$hotelID]["image"])?>" alt=""class="hotelImage">
                
                
                <br>
            </div>
        <?php endforeach ?>
    </div>
    <div class="bathrooms">
        <?php $imageID = 6 ?>
        <?php foreach($bathrooms as $room): ?>
            <div class="bathroomInfoDiv">
                <div class="wordsInBathroom">
                    <p class="text">Bathroom Type: <?php echo $room["bathroomDetails"] ?> </p>
                </div>
                
                
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$imageID]["image"])?>" alt="" class="bathroomImage">
                <?php $imageID = $imageID + 1 ?>
            </div>
            
        
        
        <?php endforeach ?>
    </div>
    <div class="rooms">
        <?php $imageID = 3 ?>
        <?php foreach($rooms as $room): ?>
            <div class="roomInfoDiv">
                <div class="wordsInRoom">
                    <p class="text">RoomID: <?php echo $room["roomID"] ?> </p>
                    <P class="text">Cost: <?php echo $room["cost"] ?> </p>
                    <p class="text">Beds: <?php echo $room["beds"] ?> </p>
                    <p class="text">Max adults: <?php echo $room["maxAdults"] ?> </p>
                    <p class="text">Max children: <?php echo $room["maxChildren"] ?> </p>
                    <p class="text">Bathroom Type: <?php echo $room["bathroomDetails"] ?> </p>
                    <?php $imageID = $imageID + 1 ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <input type="text" name="roomID" value=<?php echo $room["roomID"]?> class="hiddenVariables" >
                        <input type="submit" name ="bookingRoom" value="Book this room" class="text">
                    </form>
                </div>

                
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$imageID]["image"])?>" alt="" class="roomImage">
                
            </div>
            
        
        
        <?php endforeach ?>
    </div>
</div>

<?php include 'footer.html' ?>
</body>