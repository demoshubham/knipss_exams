/**
* @author Resalat Haque
* @link http://www.w3bees.com
*/


jQuery(document).ready(function() {
	/* variables */
	var status = jQuery('.status');
	var percent = jQuery('.percent');
	var bar = jQuery('.bar');

	/* only for image preview 
	$("#image").change(function(){
		preview.fadeOut();

		/* html FileRender Api 
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("image").files[0]);

		oFReader.onload = function (oFREvent) {
			preview.attr('src', oFREvent.target.result).fadeIn();
		};
	});

	/* submit form with ajax request */
	jQuery('.pure-form').ajaxForm({

		/* set data type json */
		dataType:  'json',

		/* reset before submitting */
		beforeSend: function() {
			status.fadeOut();
			bar.width('0%');
			percent.html('0%');
		},

		/* progress bar call back*/
		uploadProgress: function(event, position, total, percentComplete) {
			var pVel = percentComplete + '%';
			bar.width(pVel);
			percent.html(pVel);
		},

		/* complete call back */
		complete: function(data) {
			//console.log(data.responseText);
			//status.html(data.responseJSON.status).fadeIn();
			var imgid = data.responseText.trim()
			var html = '<img height="225" width="200" src="user_images/'+imgid+'">';
			window.location.reload();
		}

	});
});