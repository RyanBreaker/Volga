$(document).ready(function() {

	// Apply a mouseover tooltip to each tr with a title
	$("#register").find("tr[title]").tooltip({
		position: {
			my: "left",
			at: "right-25"
		}
	});

});
