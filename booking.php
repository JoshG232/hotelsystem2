<?php require './config/database.php';?>
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
    $start;
    $end ;
    $date;
    $alreadyBooked = False;
    $displayDates = "";
    
    
    
    
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
        $startDateBooked = filter_input(INPUT_POST, "startDateBooked",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $endDateBooked = filter_input(INPUT_POST, "endDateBooked",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $roomID = filter_input(INPUT_POST, "roomID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $datesToCheck = [];
        $arrDatesBooked = [];
        $start = new DateTime($startDateBooked);
        $end = new DateTime($endDateBooked);
        $interval = $start->diff($end);
        if ($interval->days === 1){
            $start = $start->format('Y-m-d');
            $datesToCheck = [$start];
        } else{
            $start = $start->format('Y-m-d');
            $datesToCheck = [$start];
            $start = new DateTime($start);
            for ($x=0; $x<$interval->days; $x++){
                $date = $start->modify('+1 day');
                $date = $date->format('Y-m-d');
                array_push($datesToCheck,$date);
            }
            array_pop($datesToCheck);
        }
        
        foreach ($datesToCheck as $date){
            $sql= "SELECT dateBooked FROM booking WHERE `dateBooked`='$date' AND roomID='$roomID' ";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result)==0) {
                
                // echo "nice not booked";
            } else {
                $alreadyBooked = True;
                array_push($arrDatesBooked,$date);
                // echo "already booked";
            }
            
        }
        if ($alreadyBooked === True){
            $displayDates = "Sorry but the dates " . implode($arrDatesBooked) . " are already booked for this room. Please try again.";
        }
        else{
            $hotelID = filter_input(INPUT_POST, "hotelID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $customerID = $_SESSION['customerID'];
            $nights = filter_input(INPUT_POST, "nights",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $adults = filter_input(INPUT_POST, "adults",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $children = filter_input(INPUT_POST, "children",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $booked = "0";
            $checkIn = "11AM" ;
            $checkOut = "10AM";


            $dateBooked = $startDateBooked;
            $startDateBooked = new DateTime($startDateBooked);
            $endDateBooked = new DateTime($endDateBooked);
            $interval = $startDateBooked->diff($endDateBooked);
            $nights = $interval->days;
            
            
            for($x=0; $x < $nights; $x++){
                $sql = "INSERT INTO booking(hotelID,roomID,customerID,adults,children,dateBooked,booked,checkIn,checkOut)
                VALUES ('$hotelID','$roomID','$customerID','$adults','$children','$dateBooked','$booked','$checkIn','$checkOut')";
                if (mysqli_query($conn, $sql)){
                    
                    echo "All Booked";
                }
                else {
                    echo "Error" . mysqli_error($conn);
                }
                $startDateBooked->modify('+1 day');
                $dateBooked = $startDateBooked->format('Y-m-d');

                
                

            }
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

<p><?php echo $displayDates?></p>

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

            <label for="startDateBooked">Select a start date to book:</label>
            <input type="date" name="startDateBooked" min="<?php echo date("Y-m-d"); ?>">

            <label for="endDateBooked">Select a end date to book:</label>
            <input type="date" name="endDateBooked" min="<?php echo date("Y-m-d"); ?>">

            
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