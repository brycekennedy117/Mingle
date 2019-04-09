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

$( document ).ready(function() {
	$("#openness").change(function(){
		if ($(this).val() >= 1 && $(this).val() <= 2) {
			$("#openness-value").text("closed off");
		}
		else if ($(this).val() >= 3 && $(this).val() <= 4) {
			$("#openness-value").text("somewhat closed");
		}
		else if ($(this).val() >= 5 && $(this).val() <= 6) {
			$("#openness-value").text("neither open nor closed");
		}
		else if ($(this).val() >= 7 && $(this).val() <= 8) {
			$("#openness-value").text("somewhat open");
		}
		else {
			$("#openness-value").text("an open book");
		}
	});
});

$( document ).ready(function() {
	$("#conscientiousness").change(function(){
		if ($(this).val() >= 1 && $(this).val() <= 2) {
			$("#conscientiousness-value").text("very casual");
		}
		else if ($(this).val() >= 3 && $(this).val() <= 4) {
			$("#conscientiousness-value").text("somewhat casual");
		}
		else if ($(this).val() >= 5 && $(this).val() <= 6) {
			$("#conscientiousness-value").text("neither conscientious nor casual");
		}
		else if ($(this).val() >= 7 && $(this).val() <= 8) {
			$("#conscientiousness-value").text("somewhat conscientious");
		}
		else {
			$("#conscientiousness-value").text("very conscientious");
		}
	});
});

$( document ).ready(function() {
	$("#extraversion").change(function(){
		if ($(this).val() >= 1 && $(this).val() <= 2) {
			$("#extraversion-value").text("as meek as a mouse");
		}
		else if ($(this).val() >= 3 && $(this).val() <= 4) {
			$("#extraversion-value").text("an introvert");
		}
		else if ($(this).val() >= 5 && $(this).val() <= 6) {
			$("#extraversion-value").text("neither an extravert nor an introvert");
		}
		else if ($(this).val() >= 7 && $(this).val() <= 8) {
			$("#extraversion-value").text("an extravert");
		}
		else {
			$("#extraversion-value").text("the life of the party");
		}
	});
});

$( document ).ready(function() {
	$("#agreeableness").change(function(){
		if ($(this).val() >= 1 && $(this).val() <= 2) {
			$("#agreeableness-value").text("as stubborn as a mule");
		}
		else if ($(this).val() >= 3 && $(this).val() <= 4) {
			$("#agreeableness-value").text("somewhat disagreeable");
		}
		else if ($(this).val() >= 5 && $(this).val() <= 6) {
			$("#agreeableness-value").text("neither agreeable nor disagreeable");
		}
		else if ($(this).val() >= 7 && $(this).val() <= 8) {
			$("#agreeableness-value").text("somewhat agreeable");
		}
		else {
			$("#agreeableness-value").text("always willing to comply");
		}
	});
});

$( document ).ready(function() {
	$("#neuroticism").change(function(){
		if ($(this).val() >= 1 && $(this).val() <= 2) {
			$("#neuroticism-value").text("paranoid");
		}
		else if ($(this).val() >= 3 && $(this).val() <= 4) {
			$("#neuroticism-value").text("somewhat neurotic");
		}
		else if ($(this).val() >= 5 && $(this).val() <= 6) {
			$("#neuroticism-value").text("neither neurotic nor stable");
		}
		else if ($(this).val() >= 7 && $(this).val() <= 8) {
			$("#neuroticism-value").text("somewhat stable");
		}
		else {
			$("#neuroticism-value").text("mentally robust");
		}
	});
});
$(document).ready(function() {
	hideSuburbTableContainer();
	hidePostcodeEditButton();
});

$( document ).ready(function() {
	$("#neuroticism").change(function(){
		if ($(this).val() >= 1 && $(this).val() <= 2) {
			$("#neuroticism-value").text("paranoid");
		}
		else if ($(this).val() >= 3 && $(this).val() <= 4) {
			$("#neuroticism-value").text("somewhat neurotic");
		}
		else if ($(this).val() >= 5 && $(this).val() <= 6) {
			$("#neuroticism-value").text("neither neurotic nor stable");
		}
		else if ($(this).val() >= 7 && $(this).val() <= 8) {
			$("#neuroticism-value").text("somewhat stable");
		}
		else {
			$("#neuroticism-value").text("mentally robust");
		}
	});
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

