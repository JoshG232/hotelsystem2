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
	div.hiddenImages{
        display:none;
    }
	</style>
</head>

<body onLoad="displaySlideShow()">
<?php
$sql = "SELECT * FROM `image`";
$result = mysqli_query($conn,$sql);
$images = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
    
    <header>
      <?php include 'header.html';?>
      <?php include 'headerNav.php';?>
      
    </header>

    
    
    
    
    












    <h1>Slide show of images</h1>

    <div class = "imgsForSlide hiddenImages">
      <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[9]['image'])?>" alt="" height = "100px" weight="200px"  id="1" >
      <p>Caption 1</p>
    </div>
    <div class = "imgsForSlide hiddenImages">
      <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[10]['image'])?>" alt="" height = "100px" weight="200px"  id="1" >
      <p>Caption 2</p>
    </div>
    <div class = "imgsForSlide hiddenImages">
      <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[11]['image'])?>" alt="" height = "100px" weight="200px"  id="1" >
      <p>Caption 3</p>
    </div>
  
      
      
      
    
    <div>
      <div>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[9]['image'])?>" alt="" height="100px" width="100px" onClick="selectedSlide(0)">
      </div>
      <div>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[10]['image'])?>" alt="" height="100px" width="100px" onClick="selectedSlide(1)">
      </div>
      <div>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($images[11]['image'])?>" alt="" height="100px" width="100px" onClick="selectedSlide(2)">
      </div>
      <!-- <div>
        <img src="img4.jpg" alt="" height="100px" width="100px" onClick="selectedSlide(3)">
      </div> -->
    </div>       
        <a class="previous" onclick="slideShow(-1)"><-</a>
        <a class="next" onclick="slideShow(1)">-></a>
        <a class="first" onclick="selectedSlide(0)">First</a>
        <a class="last" onclick="selectedSlide(2)">Last</a>
        <a class="random" onclick="randomSlide()">Random</a>
        </div>
        
        <br>
        


        <footer>
          <?php include 'footer.html' ?>
        </footer>
        
        

</body>
</html>

