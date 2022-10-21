
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Website</title>
    <script src="./app.js"></script>

</head>
<body onLoad="slideShow(0)">


    <header>
      <?php include 'headerNav.php';?>
      <!-- <?php include 'header.html';?> -->
    </header>
    
    
    
    <h1>Slide show of images</h1>

    <img name="slide" alt="" height = "100px" weight="200px"> 
    <div>
      <div>
        <img src="img1.jpg" alt="" height="100px" width="100px" onClick="selectedSlide(0)">
      </div>
      <div>
        <img src="img2.jpg" alt="" height="100px" width="100px" onClick="selectedSlide(1)">
      </div>
      <div>
        <img src="img3.jpg" alt="" height="100px" width="100px" onClick="selectedSlide(2)">
      </div>
      <div>
        <img src="img4.jpg" alt="" height="100px" width="100px" onClick="selectedSlide(3)">
      </div>
    </div>       
        <a class="previous" onclick="slideShow(-1)">❮</a>
        <a class="next" onclick="slideShow(1)">❯</a>
        <a class="random" onclick="randomSlide()">Random</a>
        </div>
        
        <br>
        


        <footer>
          <?php include 'footer.html' ?>
        </footer>
        
        

</body>
</html>

