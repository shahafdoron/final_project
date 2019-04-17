var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 31.9045, lng: 34.8083},
    zoom: 15
  });

  var point_pos={};
  for (var i = 0; i < json_points.length; i++) {
   point_pos={lat: parseFloat(json_points[i].latitude), lng: parseFloat(json_points[i].longitude)};
   console.log(point_pos);
   console.log(typeof(point_pos.lat))
    new google.maps.Marker({
        position: point_pos,
        map: map,
        title: json_points[i].name
    });
  }
}

//  var lngs = json_points.map(function(point) { return point.longitude; });
//  var lats = json_points.map(function(point) { return point.latitude; });
//   map.fitBounds({
//     west: Math.min.apply(null, lngs),
//     east: Math.max.apply(null, lngs),
//     north: Math.min.apply(null, lats),
//     south: Math.max.apply(null, lats),
// });
