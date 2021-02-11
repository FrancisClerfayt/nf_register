// new date instance
let date = new Date();

// parsing day, month & year
let day = date.getDate();
let month = date.getMonth() + 1;
let year = date.getFullYear();

// parsing hours & minutes
let hours = date.getHours();
if (hours < 10) hours = '0' + hours;
let minutes = date.getMinutes();
if (minutes < 10) minutes = '0' + minutes;

// adding a 0 to month & day if lesser than 10
if (month < 10) month = '0' + month;
if (day < 10) day = '0' + day;

// formating today's date
let today = year + '-' + month + '-' + day;

// formating arriving time
let time = hours + ':' + minutes;

// setting today's date
document.getElementById('date').value = today;

// setting arriving time
document.getElementById('time').value = time;

// function triggered when form is submitted
document.getElementById('registerForm').addEventListener('submit', function(e){
	
	// we prevent the default behaviour
	e.preventDefault();
	
	// we gather all values entered in the form
	let dateValue = document.getElementById('date').value;
	let arrTimeValue = document.getElementById('time').value;
	let lastnameValue = document.getElementById('lastname').value;
	let firstnameValue = document.getElementById('firstname').value;
	let phoneValue = document.getElementById('phone').value;
	let emailValue = document.getElementById('email').value;
	let placeValue = document.getElementById('place').value;
	
	// if valid we create a FormData object which we feel with the inputs values
	let formData = new FormData();
	formData.append('date', dateValue);
	formData.append('time', arrTimeValue);
	formData.append('lastname', lastnameValue);
	formData.append('firstname', firstnameValue);
	formData.append('phone', phoneValue);
	formData.append('email', emailValue);
	formData.append('place_id', placeValue);
	
	// we prepare the url for the form treatment
	let URL = "http://localhost/Projets/nf_register/register_send.php";
	
	// we create a xml http request object
	let xhr = new XMLHttpRequest();
	
	// when request is send
	xhr.onload = function() {
		alert("Votre visite a bien été enregistré");
	};
	
	// when error occured
	xhr.onerror = function() {
		alert("Une erreur est survenue lors de l'envoie du formulaire");
	}
	
	// openning request
	xhr.open("POST", URL, true);
	
	// sending request
	xhr.send(formData);
});