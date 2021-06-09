if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition( position => {
		localCoord = position.coords;
		objLocalCoord = {
			lat: localCoord.latitude,
			lng: localCoord.longitude
		}

		// Get Api Key
		let platform = new H.service.Platform({
	        'apikey': window.hereApiKey
	    });

	    // Get the default map types from the Platform object:
	    let defaultLayers = platform.createDefaultLayers();

	    // Instantiate the map:
	    let map = new H.Map(
		    document.getElementById('mapContainer'),
		    defaultLayers.vector.normal.map,
		    {
		        zoom: 13,
		        center: objLocalCoord, // Lokasi Perangkat Yang membuka aplikasi
		        pixelRatio: window.devicePixelRatio || 1
		    });

	    // Resize
	    window.addEventListener('resize', () => map.getViewPort().resize());

	    // Tampilan default maps
	    let ui = H.ui.UI.createDefault(map, defaultLayers);
	    let mapEvents = new H.mapevents.MapEvents(map); // Fungsi zoom in zoom out
	    let behavior = new H.mapevents.Behavior(mapEvents); // Aktifkan behavior

	    // Marker Draggable & Input lat,lng to input
	    function addDraggableMarker(map, behavior) {
	    	let inputLat = document.getElementById('lat');
	    	let inputLng = document.getElementById('lng');

	    	// Jika lat & lng di isi maka ubah isi objLocalCoord
	    	if (inputLat.value != '' && inputLng.value != '') {
	    		objLocalCoord = {
	    			lat: inputLat.value,
					lng: inputLng.value
	    		}
	    	}

	    	let marker = new H.map.Marker(objLocalCoord, {
	    		volatilty: true
	    	});

	    	marker.draggable = true;
	    	// Tambahkan marker di objek map
	    	map.addObject(marker);

	    	// Aktifkan behavior marker
	    	map.addEventListener('dragstart', function(ev) {
                let target = ev.target,
                    pointer = ev.currentPointer;

                // Validasi marker
                if (target instanceof H.map.Marker) {
                    let targetPosition = map.geoToScreen(target.getGeometry());
                    target['offset'] = new H.math.Point(
                        pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y
                    );

                    // Non-aktif behavior agar maps tidak berpindah ketika marker di pindahkan
                    behavior.disable();
                }
            }, false);

            // Untuk mendapatkan data saat maps sedang di geser dan mendapatkan nilai pointer berdasarkan garis H/V
            map.addEventListener('drag', function(ev) {
                let target = ev.target,
                    pointer = ev.currentPointer;
                if (target instanceof H.map.Marker) {
                    target.setGeometry(
                        map.screenToGeo(
                            pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y
                        )
                    );
                }
            }, false);

            // Ketika berhenti menggeser marker maps dapat digeser kembali dan mendapatkan titik koordinat
            map.addEventListener('dragend', function(ev) {
                let target = ev.target;
                if (target instanceof H.map.Marker) {
                    behavior.enable();
                    let resultCoord = map.screenToGeo(
                        ev.currentPointer.viewportX,
                        ev.currentPointer.viewportY
                    );

                    // Inputkan nilai ke id lat & lng
                    inputLat.value = resultCoord.lat.toFixed(5);
                    inputLng.value = resultCoord.lng.toFixed(5);
                }
            }, false);
	    }

	    // Fungsi addDraggableMarker akan aktif jika memiliki window.action bernilai submit
	    if (window.action == "submit") {
	    	addDraggableMarker(map, behavior);
	    }

	    // Rute ke tujuan
	    let urlParams = new URLSearchParams(window.location.search);

	    function calculateRouteAtoB (platform) {
            let router = platform.getRoutingService(),
                routeRequestParam = {
                    mode: 'fastest;car', // Kendaraaan
                    representation: 'display',
                    routeattributes : 'summary', // Jarak Tempuh Waktu
                    maneuverattributes: 'direction,action',
                    waypoint0: urlParams.get('from'), // Titik Perangkat
                    waypoint1: urlParams.get('to') // Tujuan Yang Akan Di Tempuh
                }

            router.calculateRoute(
                routeRequestParam,
                onSuccess,
                onError
            )
        }

        function onSuccess(result) {
            route = result.response.route[0];

            addRouteShapeToMap(route); // Membuat Rute Jalan Dalam Maps
            addSummaryToPanel(route.summary);
        }

        function onError(error) {
            alert('Can\'t reach the remote server' + error);
        }

        function addRouteShapeToMap(route){
            let linestring = new H.geo.LineString(), // Membuat Garis Rute
                routeShape = route.shape,
                startPoint, endPoint,
                polyline, routeline, svgStartMark, iconStart, startMarker, svgEndMark, iconEnd, endMarker;

             // Membuat Garis Titik-Titik Dalam Maps
            routeShape.forEach(function(point) {
                let parts = point.split(',');
                linestring.pushLatLngAlt(parts[0], parts[1]); // Menggambarkan Garis Jalan
            });

            startPoint = route.waypoint[0].mappedPosition; // Lokasi Perangkat
            endPoint = route.waypoint[1].mappedPosition; // Lokasi Tujuan

            polyline = new H.map.Polyline(linestring, {
                style: {
                lineWidth: 5,
                strokeColor: 'rgba(0, 128, 255, 0.7)', // Panah
                lineTailCap: 'arrow-tail',
                lineHeadCap: 'arrow-head'
                }
            });

            // Menggambarkan Rute
            routeline = new H.map.Polyline(linestring, {
                style: {
                    lineWidth: 5,
                    fillColor: 'white',
                    strokeColor: 'rgba(255, 255, 255, 1)',
                    lineDash: [0, 2],
                    lineTailCap: 'arrow-tail',
                    lineHeadCap: 'arrow-head'
                }
            });

            // Ikon
            svgStartMark = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 52 52" style="enable-background:new 0 0 52 52;" xml:space="preserve" width="512px" height="512px"><g><path d="M38.853,5.324L38.853,5.324c-7.098-7.098-18.607-7.098-25.706,0h0  C6.751,11.72,6.031,23.763,11.459,31L26,52l14.541-21C45.969,23.763,45.249,11.72,38.853,5.324z M26.177,24c-3.314,0-6-2.686-6-6  s2.686-6,6-6s6,2.686,6,6S29.491,24,26.177,24z" data-original="#1081E0" class="active-path" data-old_color="#1081E0" fill="#C12020"/></g> </svg>`;

            iconStart = new H.map.Icon(svgStartMark, {
                size: { h: 45, w: 45 }
            });

            startMarker = new H.map.Marker({
                lat: startPoint.latitude,
                lng: startPoint.longitude
            }, { icon: iconStart });

            // Titik Akhir
            svgEndMark = `<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 52 52" style="enable-background:new 0 0 52 52;" xml:space="preserve"> <path style="fill:#1081E0;" d="M38.853,5.324L38.853,5.324c-7.098-7.098-18.607-7.098-25.706,0h0 C6.751,11.72,6.031,23.763,11.459,31L26,52l14.541-21C45.969,23.763,45.249,11.72,38.853,5.324z M26.177,24c-3.314,0-6-2.686-6-6 s2.686-6,6-6s6,2.686,6,6S29.491,24,26.177,24z"/></svg>`;

            iconEnd = new H.map.Icon(svgEndMark, {
                size: { h: 45, w: 45 }
            });

            endMarker = new H.map.Marker({
                lat: endPoint.latitude,
                lng: endPoint.longitude
            }, { icon: iconEnd });


            // Add the polyline to the map
            map.addObjects([polyline, routeline, startMarker, endMarker]);

            // Zoom In Zoom Out
            map.getViewModel().setLookAtData({
                bounds: polyline.getBoundingBox()
            });
        }

        function addSummaryToPanel(summary){
            const sumDiv = document.getElementById('ringkasan');
            const markup = `
                <ul>
                    <li>Jarak Tempuh : ${summary.distance/1000}Km</li>
                    <li>Waktu Perjalanan : ${summary.travelTime.toMMSS()} (Dalam lalu lintas saat ini)</li>
                </ul>
            `;
            sumDiv.innerHTML = markup;
        }

        if (window.action == "detail") {
            calculateRouteAtoB(platform);

            Number.prototype.toMMSS = function () {
                return  Math.floor(this / 60)  +' minutes '+ (this % 60)  + ' seconds.';
            }
        }

	})

	function tampilDetail(lat,lng,id) {
		window.open(`/detail/${id}/perusahaan?from=${objLocalCoord.lat},${objLocalCoord.lng}&to=${lat},${lng}`, "_self");
	}

    function tampilPengajuan(lat,lng,id) {
        window.open(`/detail/${id}/pengajuan/perusahaan?from=${objLocalCoord.lat},${objLocalCoord.lng}&to=${lat},${lng}`, "_self");
    }
} else {
	alert("Maps Tidak Support Dengan Browser Anda!");
}