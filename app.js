var x = 0;
var images = [];

images = document.getElementsByClassName("imgsForSlide");

function displaySlideShow(){
	images[0].style.display = "block";
	
}

function slideShow(i){
	x += i
	if (x > images.length - 1){
		x = 0;
		images[x].style.display = "block";
		images[images.length-1].style.display = "none";
	}
	if (x < 0){
		x = images.length - 1
		images[x].style.display = "block";
		images[0].style.display = "none";

	}
	else{
		images[x].style.display = "block";
		images[x-i].style.display = "none";
	}
	

	
}
//Random image for slide show
function randomSlide(){
	current = x
	x = Math.floor(Math.random() * images.length);
	console.log(x)
	//Stops the slide show display no image with logic of code
	if (current === x){
		randomSlide()
	}
	images[x].style.display = "block";
	images[current].style.display = "none";


}

function selectedSlide(current){
	console.log(current,x);
	if (current === x){

	}
	else {
		images[current].style.display = "block";
		images[x].style.display = "none";
		x = current;
	}

	
}


function myFunction() {
	
	var x = document.getElementById("leftNavBar");
	if (x.className === "leftNav") {
		x.className += " responsive";
	} else {
		x.className = "leftNav";
	}
}