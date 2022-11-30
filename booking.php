<?php require './config/database.php';?>
<?php include 'headerNav.php';?>

<script src="./app.js"></script>
<?php $errBoxHidden = "none"; ?>
<style>
    input.hiddenVariables{display:none;}
    form.input{
        top: 10%;
    
    }
    
</style>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body ></body>
<?php 
    $start;
    $end ;
    $date;
    $alreadyBooked = False;
    $displayDates = "";
    $adultsEmpty = $childrenEmpty = $startDateBookedEmpty = $endDateBookedEmpty = "";
    
    $sql = "SELECT * FROM `image` ";
    $result = mysqli_query($conn,$sql);
    $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        
    
    
    if(isset($_POST['submitHotelList'])){
        $selectedHotel = $_POST['hotelList'];
        $sql = "SELECT * FROM room WHERE hotelID='$selectedHotel'";
        $result = mysqli_query($conn,$sql);
        $roomToBook = mysqli_fetch_all($result, MYSQLI_ASSOC);

        
    } 
    else{
        
        if(isset($_SESSION["hotelIDForBooking"])){
            $hotelID = $_SESSION["hotelIDForBooking"];
            $sql = "SELECT * FROM room WHERE hotelID='$hotelID'";
            $result = mysqli_query($conn,$sql);
            $roomToBook = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $sql = "SELECT * FROM hotel WHERE hotelID='$hotelID'";
            $result = mysqli_query($conn,$sql);
            $hotelSelected = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
        } 
        elseif(isset($_SESSION["roomIDForBooking"])){
            $roomID = $_SESSION["roomIDForBooking"];
            $sql = "SELECT * FROM room WHERE roomID='$roomID'";
            $result = mysqli_query($conn,$sql);
            $roomToBook = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } 
        else{
            
        }
        
        
    }
    

    if (isset($_POST["submitBooking"])){
        
        if (empty($_POST["adults"])){
            $adultsEmpty = "Number of adults is required";
        }
        else {
            $adults = filter_input(INPUT_POST, "adults", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    
        if (empty($_POST["children"])){
            $childrenEmpty = "Number of children is required";
        }
        else {
            $children = filter_input(INPUT_POST, "children", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    
        if (empty($_POST["startDateBooked"])){
            $startDateBookedEmpty = "Start date is required";
        }
        else {
            $startDateBooked = filter_input(INPUT_POST, "startDateBooked", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    
        if (empty($_POST["endDateBooked"])){
            $endDateBookedEmpty = "End date is required";
        }
        else {
            $endDateBooked = filter_input(INPUT_POST, "endDateBooked", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        
        if (empty($adultsEmpty) && empty($childrenEmpty) && empty($startDateBookedEmpty) && empty($endDateBookedEmpty)){
           
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
        }else{
            $errBoxHidden = "block";
        }
    }
    if (isset($_POST["addToWishlist"])){
        
        if (empty($_POST["adults"])){
            $adultsEmpty = "Number of adults is required";
        }
        else {
            $adults = filter_input(INPUT_POST, "adults", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    
        if (empty($_POST["children"])){
            $childrenEmpty = "Number of children is required";
        }
        else {
            $children = filter_input(INPUT_POST, "children", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    
        if (empty($_POST["startDateBooked"])){
            $startDateBookedEmpty = "Start date is required";
        }
        else {
            $startDateBooked = filter_input(INPUT_POST, "startDateBooked", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    
        if (empty($_POST["endDateBooked"])){
            $endDateBookedEmpty = "End date is required";
        }
        else {
            $endDateBooked = filter_input(INPUT_POST, "endDateBooked", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        
        if (empty($adultsEmpty) && empty($childrenEmpty) && empty($startDateBookedEmpty) && empty($endDateBookedEmpty)){
            
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
                $wishlist = "1";

                $dateBooked = $startDateBooked;
                $startDateBooked = new DateTime($startDateBooked);
                $endDateBooked = new DateTime($endDateBooked);
                $interval = $startDateBooked->diff($endDateBooked);
                $nights = $interval->days;
                
                
                for($x=0; $x < $nights; $x++){
                    $sql = "INSERT INTO booking(hotelID,roomID,customerID,adults,children,dateBooked,booked,checkIn,checkOut,wishlist)
                    VALUES ('$hotelID','$roomID','$customerID','$adults','$children','$dateBooked','$booked','$checkIn','$checkOut','$wishlist')";
                    if (mysqli_query($conn, $sql)){
                        
                        echo "Added to wishlist";
                    }
                    else {
                        echo "Error" . mysqli_error($conn);
                    }
                    $startDateBooked->modify('+1 day');
                    $dateBooked = $startDateBooked->format('Y-m-d');

                    
                    

                }
            }

    
            
        } 
        else{
            $errBoxHidden = "block";
        }
        
        
        
    

        
        
        
        
        

        

        
        
    }
?>



<div>
    
</div>
<br>
<?php $imageID = 6 ?>
<?php $imageID2 = 3 ?>


<div class="errBox">
    <p><?php echo $displayDates?></p>
    
    <p>
        <?php 
            echo nl2br($adultsEmpty . "\n" . $childrenEmpty . "\n" . $startDateBookedEmpty . "\n" . $endDateBookedEmpty)
        ?>


    </p>
</div>

<?php foreach($hotelSelected as $hotel): ?>
            
            <div class="hotelInfoDivBooking">
                <div class="wordsInHotelBooking">
                    <p class="text">Hotel: <?php echo $hotel["nameOfHotel"] ?> </p>
                    <P class="text">Location: <?php echo $hotel["location"] ?> </p>
                    <p class="text">Number of rooms: <?php echo $hotel["numberOfRooms"] ?> </p>
                    <p class="text">Unique Feature: <?php echo $hotel["uniqueFeature"] ?> </p>
                    <br>
                    
                    
                </div>
                
                
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$hotelID]["image"])?>" alt=""class="hotelImageBooking">
                
                
                <br>
            </div>
        <?php endforeach ?>
<?php foreach($roomToBook as $room): ?>

    <div class="roomInfoDiv">
        <div class="wordsInRoomBooking">
            <p class="text">Cost: <?php echo $room["cost"] ?></p>
            <p class="text">Number of Beds: <?php echo $room["beds"] ?></p>
            <p class="text">Maximum number of adults:<?php echo $room["maxAdults"] ?></p>
            <p class="text">Maximum number of children:<?php echo $room["maxChildren"] ?></p>
            <p class="text">Bathroom details:<?php echo $room["bathroomDetails"] ?></p>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <label for="adults" class="text">Number of Adults: </label>
                <input type="number" name="adults" min="0" max="2" class="text"> 
                
                <label for="children" class="text">Number of children</label>
                <input type="number" name="children" min="0" max="2" class="text">
                <br>
                <label for="startDateBooked" class="text">Select a start date to book:</label>
                <input type="date" name="startDateBooked" min="<?php echo date("Y-m-d"); ?>" class="text">
                <br>
                <label for="endDateBooked" class="text">Select a end date to book:</label>
                <input type="date" name="endDateBooked" min="<?php echo date("Y-m-d"); ?>" class="text">
                <br>
                <input type="text" name="hotelID" value=<?php echo $room["hotelID"] ?> class="hiddenVariables">
                <input type="text" name="roomID" value=<?php echo $room["roomID"] ?> class="hiddenVariables">
                
                <input type="submit" name="submitBooking" value="Submit Booking" class="text inputButtons" id=<?php $roomID ?> ></input>
                <br>
                <input type="submit" name="addToWishlist" value="Add to wishlist" class="text buttons" id=<?php $roomID ?> ></input>
            </form>
        </div>
        
        
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$imageID2]["image"])?>" alt="" class="roomImageBooking2">
        <br>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[$imageID]["image"])?>" alt=""  class="bathroomImageBooking2">
        
        <?php $imageID = $imageID + 1 ?>
        <?php $imageID2 = $imageID2 + 1 ?>
        
        
        
        <br>

    </div>

<style>
    div.errBox {
        display: <?php echo "$errBoxHidden" ?>
    }
</style>
<?php endforeach ?>



<footer>
    <?php include 'footer.html' ?>
</footer>