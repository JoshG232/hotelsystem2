<?php include "./config/database.php"; ?>

<?php include 'header.html';?>
<?php include 'headerNav.php';?>


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
            <div class="basketDisplay">
                <p>Hotel: <?php echo $hotelName ?> </p>
                <P>Location<?php echo $hotel["location"] ?> </p>
                <p>Number of rooms : <?php echo $hotel["numberOfRooms"] ?> </p>
                <p>Unique Feature:<?php echo $hotel["uniqueFeature"] ?> </p>
                
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$hotelID]["image"])?>" alt="" height="100px" width="200px">
                
                <br>
            </div>
        <?php endforeach ?>
    </div>
    <div class="bathrooms">
        <?php $imageID = 6 ?>
        <?php foreach($bathrooms as $room): ?>
            <div class="bathroomDetails">
                
                <p>Bathroom Type:<?php echo $room["bathroomDetails"] ?> </p>
                
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$imageID]["image"])?>" alt="" height="100px" width="200px">
                <?php $imageID = $imageID + 1 ?>
            </div>
            
        
        
        <?php endforeach ?>
    </div>
    <div class="rooms">
        <?php $imageID = 3 ?>
        <?php foreach($rooms as $room): ?>
            <div class="roomDetails">
                <p>RoomID: <?php echo $room["roomID"] ?> </p>
                <P>Cost: <?php echo $room["cost"] ?> </p>
                <p>Beds : <?php echo $room["beds"] ?> </p>
                <p>Max adults:<?php echo $room["maxAdults"] ?> </p>
                <p>Max children:<?php echo $room["maxChildren"] ?> </p>
                <p>Bathroom Type:<?php echo $room["bathroomDetails"] ?> </p>
                
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$imageID]["image"])?>" alt="" height="100px" width="200px">
                <?php $imageID = $imageID + 1 ?>
            </div>
            
        
        
        <?php endforeach ?>
    </div>
</div>

<?php include 'footer.html' ?>
</body>