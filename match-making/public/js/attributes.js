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
	console.log(user_id);
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	$.post( '/attributes/get', data={"user_id": user_id, "_token": CSRF_TOKEN},function( data ) {
		let user = data.user;
		let attributes = data.attributes;
		let postcode = data.postcode;
		document.getElementById('modal_name').innerHTML = user.name;
		document.getElementById('modal_dob').innerHTML = attributes.date_of_birth;
		document.getElementById('modal_gender').innerHTML = attributes.gender;
		document.getElementById('modal_interestin').innerHTML = attributes.interested_in;
		document.getElementById('modal_suburb').innerHTML = postcode.suburb;
	});
}