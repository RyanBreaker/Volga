$(document).ready(function() {

	const FAILEDCHECK = "failedcheck";
	var form = $("#register");
	var inputs = form.find("input[class!='notrequired'], select");

	function removeFailed() {
		$(this).parent().removeClass(FAILEDCHECK);
	}

	inputs.focusin(removeFailed);

	form.find("button[type='reset']").click(function() {
		inputs.each(removeFailed);
	});

	// Submit pushed
	form.submit(function() {

		// Returned at end, set to false under any check failure
		var goodToGo = true;

		function addFailedCheck(obj) {
			obj.parent().addClass(FAILEDCHECK);
			goodToGo = false;
		}


		// General check for emptiness
		$(this).find("input[class!='notrequired']").each(function() {
			if($(this).val() == '') {
				addFailedCheck($(this));
			}
		});


		// Email check
		var email = $(this).find("#email");
		if(!email.val().match(/^\w+@[a-z]+\.[a-z]+$/i)) {
			addFailedCheck(email);
		}


		// Password check
		var password = $(this).find("#pass");
		if(!password.val().match(/^[a-z0-9]{6,12}$/i)) {
			addFailedCheck(password);
		}


		// Names and City checks
		var namesAndCity = $(this).find("[id$='name'], [id='city']");
		namesAndCity.each(function() {
			if(!$(this).val().match(/^[a-z]+$/i)) {
				addFailedCheck($(this));
			}
		});


		// ZIP check
		var zip = $(this).find("#zip");
		if(!zip.val().match(/^[0-9]{5}$/)) {
			addFailedCheck(zip);
		}


		// Credit card check
		var cc = $(this).find("#cardnumber");
		// Super-long regex is condensed, checks validity of providers' numbers
		if(!cc.val().match(/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/)) {
			addFailedCheck(cc);
		}


		// Confirmation checks
		var confs = $(this).find("input[id$='conf']");
		confs.each(function() {
			// Traversal to matching input
			var other = $(this).parents("tr").prev().find("input");

			if ($(this).val() != other.val()) {
				addFailedCheck($(this));
			}
		});

		return goodToGo;

	});
});
