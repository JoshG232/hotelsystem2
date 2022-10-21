<?php include "./config/database.php"; ?>
<?php include 'headerNav.php';?>
<script src="./app.js"></script>

<style>
    input.hiddenVariables{display:none;}
    form.input{
        top: 10%;
    
    }
</style>
<body onload="locationSelection()"></body>
<?php 
    
    if(isset($_POST['submitHotelList'])){
        $selectedHotel = $_POST['hotelList'];
        $sql = "SELECT * FROM room WHERE hotelID='$selectedHotel'";
        $result = mysqli_query($conn,$sql);
        $roomToBook = mysqli_fetch_all($result, MYSQLI_ASSOC);

    } 
    else{
        $sql = "SELECT * FROM room";
        $result = mysqli_query($conn,$sql);
        $roomToBook = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    

    if (isset($_POST["submitBooking"])){
        
        $hotelID = filter_input(INPUT_POST, "hotelID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $roomID = filter_input(INPUT_POST, "roomID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $customerID = $_SESSION['customerID'];
        $dateBooked = filter_input(INPUT_POST, "dateBooked",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $adults = filter_input(INPUT_POST, "adults",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $children = filter_input(INPUT_POST, "children",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $booked = "0";
        $checkIn = "11AM" ;
        $checkOut = "10AM";
        

        
        $sql = "INSERT INTO booking(hotelID,roomID,customerID,adults,children,dateBooked,booked,checkIn,checkOut)
        VALUES ('$hotelID','$roomID','$customerID','$adults','$children','$dateBooked','$booked','$checkIn','$checkOut')";
        if (mysqli_query($conn, $sql)){
            
            echo "All Booked";
        }
          else {
            echo "Error" . mysqli_error($conn);
        }
    }
?>





<form action="" method="post" class="selectForm">
    <label for="hotelList">Select Hotel:</label>
    <select id="hotelList" name="hotelList">
        <option value="1">Nottingham</option>
        <option value="2">Derby</option>
        <option value="3">Liverpool</option>
    </select>

    <input type="submit" name="submitHotelList" value="Submit">

</form>



<?php foreach($roomToBook as $room): ?>

    <div>
        Cost: <?php echo $room["cost"] ?>
        Number of Beds: <?php echo $room["beds"] ?>
        Maximum number of adults:<?php echo $room["maxAdults"] ?>
        Maximum number of children:<?php echo $room["maxChildren"] ?>
        Bathroom details:<?php echo $room["bathroomDetails"] ?>
        
        <?php $details = []   ?>
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <label for="adults">Number of Adults</label>
            <input type="number" name="adults" min="0" max="2"> 
            <label for="children">Number of children</label>
            <input type="number" name="children" min="0" max="2">
            <label for="dateBooked">Select a date to book:</label>
            <input type="date" name="dateBooked" >

            <input type="text" name="hotelID" value=<?php echo $room["hotelID"] ?> class="hiddenVariables">
            <input type="text" name="roomID" value=<?php echo $room["roomID"] ?> class="hiddenVariables">
            
            <input type="submit" name="submitBooking" value="Submit Booking" id=<?php $roomID ?>></input>


        </form>
        
        <br>
    </div>


<?php endforeach ?>



<footer>
    <?php include 'footer.html' ?>
</footer>