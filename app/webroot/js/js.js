var query = {};



window.onload = function () {

	var queries = window.location.search.replace('?', '').split('&');



	for (id in queries) {

		if (id && queries[id])

			query[queries[id].split('=')[0]] = queries[id].split('=')[1];

	}

	

	function recarrega () {

		var v = '?';

		for (q in query) {

			v = v + q + '=' + query[q] + '&';

		}

		window.location.replace(v);

	}

}



$(document).ready(function(e) {
	

	$('#ImovelLocalizacao').on('focus', function () { $(this).select(); });

	$('#ImovelLocalizacao').on('change', function () {

		if ($(this).val()) {

			$(this).attr("disabled", "disabled");

			$(this).parent().find('#alterarLocalizacao').remove();

			$(this).parent().append($('<a href="#" id="alterarLocalizacao" />').text('alterar').click(function(e) {e.preventDefault(); $('#ImovelLocalizacao').removeAttr("disabled"); $(this).remove();}));

			$.getJSON("http://upload.imoveldointerior.com.br/varByUrl.php", { url : $(this).val() }, function (data) {

				var ll = {};

				if (data.q)  ll = data.q.split(',');

				if (data.ll) ll = data.ll.split(',');

				if (!data.ll && !data.q) { console.log("Não tem valor;"); $('#ImovelLocalizacao').attr("disabled", false); return false }

				if (!$.isNumeric(ll[0]) || !$.isNumeric(ll[1])) { console.log("Nâo é número."); $('#ImovelLocalizacao').attr("disabled", false); return false }

				geoLoc = new google.maps.LatLng(ll[0], ll[1]);

				mapOpts = { 

					center: geoLoc, 

					zoom: 14, 

					mapTypeId: google.maps.MapTypeId.ROADMAP, 

					panControl: false,

					zoomControl: false,

					scaleControl: false,

					mapTypeControl: false,

					streetViewControl: false,

					overviewMapControl: false

				};

				$('#mapaInputs').html($('<input type="hidden" name="data[Imovel][geolocalizacao]" />').val(data.ll || data.q));

				var map = new google.maps.Map(document.getElementById("mapa"), mapOpts);

				var marker = new google.maps.Marker({ position: geoLoc, map: map });

			}).fail(function () { $(this).attr("disabled", false); });

		}

	});

	

	$('#btnYoutube').click(function(e) { e.preventDefault();

		if ($('#urlYoutube').val()) $.getJSON(

			"http://upload.imoveldointerior.com.br/yt_video_id.php", 

			{ url : $('#urlYoutube').val() }, 

			function (data) {

				if (data.error) alert(data.error);

				else if (data.id) {

					$('#videoYoutube').html($('<img />').attr('src', 'http://img.youtube.com/vi/' + data.id + '/0.jpg'));

					$('#videoYoutube').append($('<input />').prop({ "type" : "hidden",  "name" : "data[Imovel][video]",  "value" : data.id }));

				} else alert("Não encontrei o vídeo");

			}

		);

		return null;

    });

	$('#btnMaps').click(function(e) { e.preventDefault();

		if ($('#urlMaps').val()) $.post(

			"http://upload.imoveldointerior.com.br/varsByMaps.php", 

			{ url : $('#urlMaps').val() }, 

			function (data) {

				console.log(data);

				if (data.error) alert(data.error);

				else if (data.ll || data.q) { 

					$('#iframeMaps').html($("<iframe src='http://maps.google.com/?ie=UTF8&amp;ll=" + (data.ll || data.q) + "&amp;t=m&amp;z=17&amp;output=embed' />").prop({ "width" : "100%", "height" : "100%", "frameborder" : 0, "scrolling" : 0 }));

					$('#iframeMaps').append($('<input />').prop({ "type" : "hidden",  "name" : "data[Imovel][localizacao]",  "value" : (data.ll || data.q) }));

				} else alert('Não foi possível localizar'); 

			}, 'json'

		);

		return null;

    });

	

	$('.btnEnviarFoto .remove').click(function(e) { e.preventDefault();

		$fu = $(e.target).parent().removeClass('loading');

		$fu.find('img').remove();

		$fu.find('[name*=data]').val('');

    });

});