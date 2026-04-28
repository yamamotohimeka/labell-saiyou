var map;
var marker = [];
var infoWindow = [];
function initMap() {
	//地図スタイルの変種
	var styleOptions = [
		{
			"elementType": "geometry",
			"stylers": [
				{ "hue": "#ff00bb" },
				{ "visibility": "simplified" },
				{ "gamma": 1.18 },
				{ "saturation": -99 },
				{ "lightness": 17 }
			]
		}
	];

	// 緯度軽度
	var mapLatLng = new google.maps.LatLng(34.49058,135.423753);
	map = new google.maps.Map(document.getElementById('map_canvas'), { // #sampleに地図を埋め込む
		center: mapLatLng, 
		zoom: 13
	});

	var icon = {
		url : 'img/icon_map.png',
		scaledSize : new google.maps.Size(45, 68)
		// ↑ここで画像のサイズを指定
	}
	var marker = new google.maps.Marker({
		position: mapLatLng,
		map: map,
		icon: icon

	});
	map.setOptions({styles: styleOptions});
}

initMap();//関数呼び出し