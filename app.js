var x = 0;
var images = [];

images = ["img1.jpg","img2.jpg","img3.jpg","img4.jpg"]

function slideShow(i){
	// console.log(image)
	
	x += i
	if (x > images.length - 1){
		x = 0;
	}
	if (x < 0){
		x = images.length - 1
	}
	document.slide.src = images[x]

}
function randomSlide(){
	x = Math.floor(Math.random() * images.length);
	console.log(x)
	document.slide.src = images[x]

}

function selectedSlide(current){
	document.slide.src = images[current]
	x = current;
}


