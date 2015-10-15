$(document).ready(function () {

var i,
	array = [],
	content = $('.content'),
	a;

$('.submit').on('click', function (e) {
	e.preventDefault();
	$.post('traitement.php', {
		nom : $('.nom')[0].value,
		message : $('.message')[0].value
	},'JSON');

	 $('.nom')[0].value = "";
	 $('.message')[0].value = "";
});



var refreshData = function () {
	$.post('traitement.php', {}, function (data) {
		array = data;
		for (i = 0; i < data.length; i++) {
			console.log(data[1].nom);
			content.append('<p>' + data[i].nom + ' : ' + data[i].message + '</p>');
		}
	},'JSON');
}

refreshData();

setInterval(function() {
		$.post('lastmessage.php', {}, function (data) {
		for (a = 0; a < data.length; a++) {
			var x = data[a].id;
			if(x > array.length) {
				content.append('<p>' + data[a].nom + ' : ' + data[a].message + '</p>');
	 		array.length ++;
			}
		}
	},'JSON');
}, 0.1);


});