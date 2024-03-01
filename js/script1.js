/**
* @author Resalat Haque
* @link http://www.w3bees.com
*/


jQuery(document).ready(function() {
	/* variables */
	var status_sign = jQuery('.status_sign');
	var percent_sign = jQuery('.percentsign');
	var bar_sign = jQuery('.bar_sign');

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
	jQuery('.signform').ajaxForm({

		/* set data type json */
		dataType:  'json',

		/* reset before submitting */
		beforeSend: function() {
			status_sign.fadeOut();
			bar_sign.width('0%');
			percent_sign.html('0%');
		},

		/* progress bar call back*/
		uploadProgress: function(event, position, total, percentComplete) {
			var pVel = percentComplete + '%';
			bar_sign.width(pVel);
			percent_sign.html(pVel);
		},

		/* complete call back */
		complete: function(data) {
			//console.log(data.responseText);
			//status.html(data.responseJSON.status).fadeIn();
			var imgid = data.responseText.trim()
			var html = '<img height="50" width="200" src="user_images/'+imgid+'">';
			window.location.reload();
		}

	});
});