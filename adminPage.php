<?php include "./config/database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Website</title>
    <script src="./app.js"></script>
    <style>
    input.hiddenVariables{
        display:none;
    }


    </style>

</head>
<body>
    
    <?php include 'headerNav.php';?>
    <?php 
        //Display rooms
        $sql = "SELECT * FROM room";
        $result = mysqli_query($conn,$sql);
        $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //Add, delete and update rooms
        if (isset($_POST["updateRoomInfo"])){
            
            $roomID = filter_input(INPUT_POST, "roomID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $hotelID = filter_input(INPUT_POST, "hotelID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cost = filter_input(INPUT_POST, "cost",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $beds = filter_input(INPUT_POST, "beds",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $roomNumber = filter_input(INPUT_POST, "roomNumber",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $maxAdults = filter_input(INPUT_POST, "maxAdults",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $maxChildren = filter_input(INPUT_POST, "maxChildren",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $bathroomDetails = filter_input(INPUT_POST, "bathroomDetails",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sql = "UPDATE room SET  
                hotelID='$hotelID', 
                cost='$cost',
                beds='$beds', 
                roomNumber='$roomNumber',
                maxAdults='$maxAdults',
                maxChildren='$maxChildren',
                bathroomDetails='$bathroomDetails'
                 WHERE roomID='$roomID'";
            
            if (mysqli_query($conn, $sql)){
                
                header("Location: adminPage.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }
        if (isset($_POST["deleteRoom"])){
            $roomID = filter_input(INPUT_POST, "roomID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "DELETE FROM `room` WHERE roomID='$roomID'";
            if (mysqli_query($conn, $sql)){
            
                echo "All confirmed";
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }

        if (isset($_POST["addRoomInfo"])){
            $hotelID = filter_input(INPUT_POST, "hotelID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cost = filter_input(INPUT_POST, "cost");
            $beds = filter_input(INPUT_POST, "beds",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $roomNumber = filter_input(INPUT_POST, "roomNumber",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $maxAdults = filter_input(INPUT_POST, "maxAdults",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $maxChildren = filter_input(INPUT_POST, "maxChildren",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $bathroomDetails = filter_input(INPUT_POST, "bathroomDetails",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $sql= "SELECT hotelID,roomNumber FROM room WHERE hotelID='$hotelID' AND roomNumber='$roomNumber'";
            // echo $sql;
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result)==0) {
                $sql = "INSERT INTO room(hotelID,cost,beds,roomNumber,maxAdults,maxChildren,bathroomDetails)
                VALUES ('$hotelID','$cost','$beds','$roomNumber','$maxAdults','$maxChildren','$bathroomDetails')";
                if (mysqli_query($conn, $sql)){
                    
                    // header("Location: adminPage.php");
                }
                else {
                    echo "Error" . mysqli_error($conn);
                }
            } else {
                echo "Room number already in use in that hotel";
            }
            
        }
        //Display customers 
        $sql = "SELECT * FROM customer";
        $result = mysqli_query($conn,$sql);
        $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //Add, delete and update customers
        if (isset($_POST["updateCustomerInfo"])){
            
            $customerID = filter_input(INPUT_POST, "customerID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $firstName = filter_input(INPUT_POST, "firstName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, "lastName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $age = filter_input(INPUT_POST, "age",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nationality = filter_input(INPUT_POST, "nationality",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sql = "UPDATE customer SET  
                firstName='$firstName', 
                lastName='$lastName',
                email='$email', 
                password='$password',
                gender='$gender',
                age='$age',
                nationality='$nationality'
                 WHERE customerID='$customerID'";
            
            if (mysqli_query($conn, $sql)){
                header("Location: adminPage.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }
        if (isset($_POST["deleteCustomer"])){
            $customerID = filter_input(INPUT_POST, "customerID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "DELETE FROM `customer` WHERE customerID='$customerID'";
            
            if (mysqli_query($conn, $sql)){
                header("Location: adminPage.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }

        if (isset($_POST["addCustomerInfo"])){
            $firstName = filter_input(INPUT_POST, "firstName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, "lastName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $age = filter_input(INPUT_POST, "age",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nationality = filter_input(INPUT_POST, "nationality",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $sql= "SELECT email FROM customer WHERE email='$email'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result)==0) {
                $sql = "INSERT INTO customer(firstName,lastName,email,password,gender,age,nationality)
                VALUES ('$firstName','$lastName','$email','$password','$gender','$age','$nationality')";
                if (mysqli_query($conn, $sql)){
                    
                    header("Location: adminPage.php");
                }
                else {
                    echo "Error" . mysqli_error($conn);
                }
            } else {
                echo "Email already in use. Please login or use another email.";
            }
            
        }




        //Display bookings
        $sql = "SELECT * FROM booking";
        $result = mysqli_query($conn,$sql);
        $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //Add, delete and update bookings
        if (isset($_POST["updateBookingInfo"])){
            
            $bookingID = filter_input(INPUT_POST, "bookingID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $hotelID = filter_input(INPUT_POST, "hotelID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $roomID = filter_input(INPUT_POST, "roomID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $customerID = filter_input(INPUT_POST, "customerID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $adults = filter_input(INPUT_POST, "adults",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $children = filter_input(INPUT_POST, "children",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateBooked = filter_input(INPUT_POST, "dateBooked",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $booked = filter_input(INPUT_POST, "booked",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $checkIn = filter_input(INPUT_POST, "checkIn",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $checkOut = filter_input(INPUT_POST, "checkOut",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sql = "UPDATE booking SET  
                hotelID='$hotelID', 
                roomID='$roomID',
                customerID='$customerID', 
                adults='$adults',
                children='$children',
                dateBooked='$dateBooked',
                booked='$booked',
                checkIn='$checkIn',
                checkOut='$checkOut'
                 WHERE bookingID='$bookingID'";
            
            if (mysqli_query($conn, $sql)){
                
                header("Location: adminPage.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }
        if (isset($_POST["deleteBooking"])){
            $bookingID = filter_input(INPUT_POST, "bookingID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "DELETE FROM `booking` WHERE bookingID='$bookingID'";
            if (mysqli_query($conn, $sql)){
                header("Location: adminPage.php");
                
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }

        if (isset($_POST["addBookingInfo"])){
            
            $hotelID = filter_input(INPUT_POST, "hotelID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $roomID = filter_input(INPUT_POST, "roomID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $customerID = filter_input(INPUT_POST, "customerID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $adults = filter_input(INPUT_POST, "adults",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $children = filter_input(INPUT_POST, "children",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateBooked = filter_input(INPUT_POST, "dateBooked",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $booked = filter_input(INPUT_POST, "booked",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $checkIn = filter_input(INPUT_POST, "checkIn",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $checkOut = filter_input(INPUT_POST, "checkOut",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $sql= "SELECT roomID,dateBooked FROM booking WHERE roomID='$roomID' AND dateBooked='$dateBooked'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result)==0) {
                $sql = "INSERT INTO booking(hotelID,roomID,customerID,adults,children,dateBooked,booked,checkIn,checkOut)
                VALUES ('$hotelID','$roomID','$customerID','$adults','$children','$dateBooked','$booked','$checkIn','$checkOut')";
                if (mysqli_query($conn, $sql)){
                    
                    header("Location: adminPage.php");
                }
                else {
                    echo "Error" . mysqli_error($conn);
                }
            } else {
                echo "Booking already in that hotel";
            }
            
        }




        //Display hotels
        $sql = "SELECT * FROM hotel";
        $result = mysqli_query($conn,$sql);
        $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //Add, delete and update bookings
        if (isset($_POST["updateHotelInfo"])){
            
            $hotelID = filter_input(INPUT_POST, "hotelID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $location = filter_input(INPUT_POST, "location",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $numberOfRooms = filter_input(INPUT_POST, "numberOfRooms",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $uniqueFeature = filter_input(INPUT_POST, "uniqueFeature",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "UPDATE hotel SET  
                location='$location', 
                numberOfRooms='$numberOfRooms',
                uniqueFeature='$uniqueFeature'
                
                 WHERE hotelID='$hotelID'";
            
            if (mysqli_query($conn, $sql)){
                
                header("Location: adminPage.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }
        if (isset($_POST["deleteHotel"])){
            $hotelID = filter_input(INPUT_POST, "hotelID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "DELETE FROM `hotel` WHERE hotelID='$hotelID'";
            if (mysqli_query($conn, $sql)){
                header("Location: adminPage.php");
                
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }

        if (isset($_POST["addHotelInfo"])){
            
            $location = filter_input(INPUT_POST, "location",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $numberOfRooms = filter_input(INPUT_POST, "numberOfRooms",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $uniqueFeature = filter_input(INPUT_POST, "uniqueFeature",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "INSERT INTO hotel(location,numberOfRooms,uniqueFeature)
            VALUES ('$location','$numberOfRooms','$uniqueFeature')";
            if (mysqli_query($conn, $sql)){
                
                header("Location: adminPage.php");
            }
            else {
                echo "Error" . mysqli_error($conn);
            }
            
            
        }

        //Display images
        $sql = "SELECT * FROM `image`";
        $result = mysqli_query($conn,$sql);
        $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //Add, delete and update bookings
        if (isset($_POST["updateImageInfo"])){
            
            $imageID = filter_input(INPUT_POST, "imageID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $imageName = filter_input(INPUT_POST, "imageName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $imageClass = filter_input(INPUT_POST, "imageClass",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            
            $sql = "UPDATE `image` SET  
                imageName='$imageName', 
                imageClass='$imageClass'
                
                
                 WHERE imageID='$imageID'";
            
            if (mysqli_query($conn, $sql)){
                
                header("Location: adminPage.php");
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }
        if (isset($_POST["deleteImage"])){
            $imageID = filter_input(INPUT_POST, "imageID",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $sql = "DELETE FROM `image` WHERE imageID='$imageID'";
            if (mysqli_query($conn, $sql)){
                header("Location: adminPage.php");
                
            }
              else {
                echo "Error" . mysqli_error($conn);
            }
            
        }

        if (isset($_POST["addImageInfo"])){
            
            $image = $_FILES["images"]["tmp_name"];
            $imageContent = addslashes(file_get_contents($image));
            $imageName = filter_input(INPUT_POST, "imageName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $imageClass = filter_input(INPUT_POST, "imageClass",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            
            $sql = "INSERT INTO `image`(image,imageName,imageClass)
            VALUES ('$imageContent','$imageName','$imageClass')";
            if (mysqli_query($conn, $sql)){
                
                header("Location: adminPage.php");
            }
            else {
                echo "Error" . mysqli_error($conn);
            }
            
            
        }

    ?>


<h1>Room details</h1>



    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                
                <label for="hotelID">HotelID:</label>
                <input type="text" name="hotelID" >

                <label for="cost">Cost:</label>
                <input type="text" name="cost"  >

                <label for="beds">Beds:</label>
                <input type="text" name="beds" >

                <label for="roomNumber">Room Number:</label>
                <input type="text" name="roomNumber"  >

                <label for="maxAdults">Max Adults:</label>
                <input type="text" name="maxAdults"  >

                <label for="nationality">Max Children:</label>
                <input type="text" name="maxChildren"  >

                <label for="bathroomDetails">Bathroom Details:</label>
                <input type="text" name="bathroomDetails"  >

                <input type="submit" value="Add room" name="addRoomInfo">
    </form>
<?php foreach($rooms as $room): ?>

    <div class="roomDisplay">
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            
            <label for="roomID">RoomID: <?php echo $room["roomID"]?></label>
            <input type="text" name="roomID" value=<?php echo $room["roomID"]?> class="hiddenVariables">

            <label for="hotelID">HotelID:</label>
            <input type="text" name="hotelID" value=<?php echo $room["hotelID"]?> >

            <label for="cost">Cost:</label>
            <input type="text" name="cost" value=<?php echo $room["cost"]?> >

            <label for="beds">Beds:</label>
            <input type="text" name="beds" value=<?php echo $room["beds"]?> >

            <label for="roomNumber">Room Number:</label>
            <input type="text" name="roomNumber" value=<?php echo $room["roomNumber"]?> >

            <label for="maxAdults">Max Adults:</label>
            <input type="text" name="maxAdults" value=<?php echo $room["maxAdults"]?> >

            <label for="nationality">Max Children:</label>
            <input type="text" name="maxChildren" value=<?php echo $room["maxChildren"]?> >

            <label for="bathroomDetails">Bathroom Details:</label>
            <input type="text" name="bathroomDetails" value=<?php echo $room["bathroomDetails"]?> >

            <input type="submit" value="Update information" name="updateRoomInfo">
        </form>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="roomID"  value=<?php echo $room["roomID"] ?> class="hiddenVariables">
            <input type="submit" value="Delete room" name="deleteRoom">
        </form>
        <br>
        
    </div>


<?php endforeach ?>



<h1>Customer details</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                
                <label for="firstName">First name:</label>
                <input type="text" name="firstName" >

                <label for="lastName">Last name:</label>
                <input type="text" name="lastName"  >

                <label for="email">Email:</label>
                <input type="text" name="email" >

                <label for="password">Password:</label>
                <input type="password" name="password"  >
                <button onclick="showPassword()"></button>

                <label for="gender">Gender:</label>
                <input type="text" name="gender"  >

                <label for="age">Age:</label>
                <input type="text" name="age"  >

                <label for="nationality">Nationality:</label>
                <input type="text" name="nationality"  >

                <input type="submit" value="Add customer" name="addCustomerInfo">
    </form>
<?php foreach($customers as $customer): ?>

    <div class="customerDisplay">
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            
            <label for="customerID">CustomerID: <?php echo $customer["customerID"]?></label>
            <input type="text" name="customerID" value=<?php echo $customer["customerID"]?> class="hiddenVariables">

            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" value=<?php echo $customer["firstName"]?> >

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" value=<?php echo $customer["lastName"]?> >

            <label for="email">Email:</label>
            <input type="text" name="email" value=<?php echo $customer["email"]?> >

            <label for="password">Password:</label>
            <input type="password" name="password" value=<?php echo $customer["password"]?> >

            <label for="gender">Gender:</label>
            <input type="text" name="gender" value=<?php echo $customer["gender"]?> >

            <label for="age">Age:</label>
            <input type="text" name="age" value=<?php echo $customer["age"]?> >

            <label for="nationality">Nationality:</label>
            <input type="text" name="nationality" value=<?php echo $customer["nationality"]?> >

            <input type="submit" value="Update information" name="updateCustomerInfo">
        </form>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="customerID"  value=<?php echo $customer["customerID"] ?> class="hiddenVariables">
            <input type="submit" value="Delete customer" name="deleteCustomer">
        </form>
        <br>
        
    </div>


<?php endforeach ?>

<h1>Booking details</h1>

<?php

?>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                
                <label for="hotelID">HotelID:</label>
                <input type="text" name="hotelID" >

                <label for="roomID">RoomID:</label>
                <input type="text" name="roomID"  >

                <label for="customerID">CustomerID:</label>
                <input type="text" name="customerID" >

                <label for="adults">Adults:</label>
                <input type="text" name="adults"  >

                <label for="children">Children:</label>
                <input type="text" name="children"  >

                <label for="dateBooked">Date Booked:</label>
                <input type="date" name="dateBooked" min="<?php echo date("Y-m-d"); ?>" >

                <label for="booked">Booked:</label>
                <input type="text" name="booked"  >

                <label for="checkIn">CheckIn:</label>
                <input type="text" name="checkIn"  >

                <label for="checkOut">CheckOut:</label>
                <input type="text" name="checkOut"  >

                <input type="submit" value="Add booking" name="addBookingInfo">
    </form>
<?php foreach($bookings as $booking): ?>

    <div class="roomDisplay">
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            
            <label for="bookingID">BookingID: <?php echo $booking["bookingID"]?></label>
            <input type="text" name="bookingID" value=<?php echo $booking["bookingID"]?> class="hiddenVariables">

            <label for="hotelID">HotelID:</label>
            <input type="text" name="hotelID" value=<?php echo $booking["hotelID"]?> >

            <label for="roomID">RoomID:</label>
            <input type="text" name="roomID" value=<?php echo $booking["roomID"]?> >

            <label for="customerID">CustomerID:</label>
            <input type="text" name="customerID" value=<?php echo $booking["customerID"]?> >

            <label for="adults">Adults:</label>
            <input type="text" name="adults" value=<?php echo $booking["adults"]?> >

            <label for="children">Children:</label>
            <input type="text" name="children" value=<?php echo $booking["children"]?> >

            <label for="dateBooked">Date booked:</label>
            <input type="date" name="dateBooked" value=<?php echo $booking["dateBooked"]?> >

            <label for="booked">Booked:</label>
            <input type="text" name="booked" value=<?php echo $booking["booked"]?> >

            <label for="checkIn">Check in time:</label>
            <input type="text" name="checkIn" value=<?php echo $booking["checkIn"]?> >

            <label for="checkOut">Check out time:</label>
            <input type="text" name="checkOut" value=<?php echo $booking["checkOut"]?> >

            <input type="submit" value="Update information" name="updateBookingInfo">
        </form>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="bookingID"  value=<?php echo $booking["bookingID"] ?> class="hiddenVariables">
            <input type="submit" value="Delete booking" name="deleteBooking">
        </form>
        <br>
        
    </div>


<?php endforeach ?>

<h1>Hotel details</h1>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                
                <label for="location">Location:</label>
                <input type="text" name="location" >

                <label for="numberOfRooms">Number of rooms:</label>
                <input type="text" name="numberOfRooms"  >

                <label for="uniqueFeature">Unique Feature:</label>
                <input type="text" name="uniqueFeature" >

                <input type="submit" value="Add hotel" name="addHotelInfo">
    </form>
<?php foreach($hotels as $hotel): ?>

    <div class="roomDisplay">
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            
            <label for="hotelID">HotelID: <?php echo $hotel["hotelID"]?></label>
            <input type="text" name="hotelID" value=<?php echo $hotel["hotelID"]?> class="hiddenVariables">

            <label for="location">Location:</label>
            <input type="text" name="location" value=<?php echo $hotel["location"]?> >

            <label for="numberOfRooms">Number of rooms:</label>
            <input type="text" name="numberOfRooms" value=<?php echo $hotel["numberOfRooms"]?> >

            <label for="uniqueFeature">Unique Feature:</label>
            <input type="text" name="uniqueFeature" value=<?php echo $hotel["uniqueFeature"]?> >

            <input type="submit" value="Update information" name="updateHotelInfo">
        </form>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="hotelID"  value=<?php echo $hotel["hotelID"] ?> class="hiddenVariables">
            <input type="submit" value="Delete hotel" name="deleteHotel">
        </form>
        <br>
        
    </div>


<?php endforeach ?>





<h1>Image details</h1>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                
                <label for="image">Add image:</label>
                <input type="file" name="image">

                <label for="imageName">Image name:</label>
                <input type="text" name="imageName"  >

                <label for="imageClass">Image class:</label>
                <input type="text" name="imageClass" >

                <input type="submit" value="Add image" name="addImageInfo">
    </form>
<?php foreach($images as $image): ?>

    <div class="imageDisplay">
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
            
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image['image'])?>" alt="">
            <label for="imageID">ImageID: <?php echo $image["imageID"]?></label>
            <input type="text" name="imageID" value=<?php echo $image["imageID"]?> class="hiddenVariables">

            <label for="imageName">Image name:</label>
            <input type="text" name="imageName" value=<?php echo $image["imageName"]?> >

            <label for="imageClass">Image class:</label>
            <input type="text" name="imageClass" value=<?php echo $image["imageClass"]?> >

            <input type="submit" value="Update information" name="updateImageInfo">
        </form>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="imageID"  value=<?php echo $image["imageID"] ?> class="hiddenVariables">
            <input type="submit" value="Delete image" name="deleteImage">
        </form>
        <br>
        
    </div>


<?php endforeach ?>

</body>