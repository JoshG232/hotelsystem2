<?php include 'headerNav.php';?>
<?php include "./config/database.php"; ?>


<body>
    <?php
        $sql = "SELECT * FROM hotel";
        $result = mysqli_query($conn,$sql);
        $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>




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

    ?>
    <div class="basketDisplay">
        <p>Hotel: <?php echo $hotelName ?> </p>
        <P>Location<?php echo $hotel["location"] ?> </p>
        <p>Number of rooms : <?php echo $hotel["numberOfRooms"] ?> </p>
        <p>Unique Feature:<?php echo $hotel["uniqueFeature"] ?> </p>
        
        
        <br>
    </div>


<?php endforeach ?>
</body>