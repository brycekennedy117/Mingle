$( document ).ready(function() {
	$("#gender").change(function(){
		let selectedGender = $(this).children("option:selected").val();
		if (selectedGender === 'M') {
			$("#interested_in").val('F');
		}
		else {
			$("#interested_in").val('M');
		}
	});
});
$(document).ready(function() {
	hideSuburbTableContainer();
	hidePostcodeEditButton();
});

function getSuburbsForPostcode(e) {
	let postcode = e.value;

	if (postcode.length === 4) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		$.post( '/attributes/suburbs', data={"postcode": postcode, "_token": CSRF_TOKEN},function( data ) {
			$( "#suburb-table" ).empty();

			for(suburb in data) {
				let key = data;
				$( "#suburb-table" ).append( `<tr style="cursor: pointer;" class="table-row" data-value="${suburb}" data-content="${data[suburb]['suburb']}" onclick="suburbClicked(this)"><td>${data[suburb]['suburb']}</td></tr>` );
			}
			$('#suburb-container').show();

		});
	}
	else {
		hideSuburbTableContainer();
		$( "#suburb-table" ).empty();
		$('#postcode-id').remove();
	}


}

function hidePostcodeEditButton() {
	$('#postcode-edit').hide()
}

function hideSuburbTableContainer() {
	$('#suburb-container').hide();
}

function suburbClicked(e) {
	let postcodeID = e.dataset['value'];
	let suburb = e.dataset['content'];
	//$('#postcode-id').remove();
	$( "#attribute-form" ).append(`<input id="postcode-id" type="hidden" name="postcode-id" value="${postcodeID}"></input>`);
	$( "#suburb" ).val(suburb);
	$( "#suburb-table" ).empty();
	$('#suburb-container').hide();
	$('#postcode').attr('readonly', true);
	$('#postcode-edit').show()

}

function editPostcodeButtonClicked() {
	$('#postcode').attr('readonly', false);
	hidePostcodeEditButton();

}

function loadUserIntoDashboardModal(user_id) {
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	$.post( '/attributes/get', data={"user_id": user_id, "_token": CSRF_TOKEN},function( data ) {
		let user = data.user;
		let attributes = data.attributes;
		let postcode = data.postcode;


		///Age calculation
		var birth = new Date(attributes.date_of_birth);
		var now = new Date();
		var age = now.getFullYear() - birth.getFullYear();

		if(now.getMonth() >= birth.getMonth() && now.getDate() > birth.getDate())
		{
			age = age--;
		}
function activate(e) {
	e.setAttribute('class', e.getAttribute('class') + " active")
}
function deactivate(e) {
	e.setAttribute('class', e.getAttribute('class').replace('active', ''));
}

function redirect(url) {
	console.log(url);
	window.location.replace(url);
}





		///Change value display of gender
		if(attributes.gender == 'M')
		{
			gender = 'Male';
		}
		else
		{
			gender = 'Female';

		}
		///Change value display of interested in
		if(attributes.interested_in == 'M')
		{
			interest = 'Male'
		}
		else if(attributes.interested_in == 'F')
		{
			interest = 'Female'
		}
		else
		{
			interest = 'Both'
		}

		document.getElementById('modal_image').src = data.attributes.image_url;
		document.getElementById('modal_name').innerHTML = user.name;
		document.getElementById('modal_dob').innerHTML = age;
		document.getElementById('modal_gender').innerHTML = gender;
		document.getElementById('modal_interestin').innerHTML = interest;
		document.getElementById('modal_suburb').innerHTML = postcode.suburb;
	});
}