let modal;
let modalImg;
let caption;
let photoDir = "../picuploadw600h400/";
let photoId;

window.onload = function(){
	
	modal = document.getElementById("myModal");
	modalImg = document.getElementById("modalImg");
	caption = document.getElementById("caption");
	let allThumbs = document.getElementById("gallery").getElementsByTagName("img");
	let thumbCount = allThumbs.length;
	for(let i = 0; i < thumbCount; i ++){
		allThumbs[i].addEventListener("click", openModal);
	}
	document.getElementById("close").addEventListener("click", closeModal);
	document.getElementById("storeRating").addEventListener("click", storeRating);
}

function storeRating(){
	let rating = 0;
	for(let i = 1; i < 6; i++){
		if(document.getElementById("rate" + i).checked){
			//rating = document.getElementById("rate" + i).value;
			rating = i;
		}
	}
	if (rating > 0){
		//AJAX
		let webRequest = new XMLHttpRequest();
		webRequest.onreadystatechange = function(){
			if(this.readyState ==4 && this.status == 200){
				console.log(this.responseText);
			}
		}
		webRequest.open("GET", "savepicrating.php?rating=" + rating, true);
		webRequest.send();
	}
}

function openModal(e){
	for(let i = 1; i < 6; i ++){
		document.getElementById("rate" + i).checked = false;
	}
	//console.log(e);
	modalImg.src = photoDir + e.target.dataset.fn;
	photoId = e.target.dataset.id;
	caption.innerHTML = "<p>" + e.target.alt + "</p>";
	document.getElementById("avgRating").innerHTML = "";
	modal.style.display = "block";
}

function closeModal(){
	modal.style.display = "none";
}



