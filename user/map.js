


function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 31.9045, lng: 34.8083},
    zoom: 15
  });

  var point_pos={};
  var tourPath=[]

  for (var i = 0; i < sorted_json_points.length; i++) {
    tourPath.push({lat: parseFloat(sorted_json_points[i].latitude), lng: parseFloat(sorted_json_points[i].longitude)});
    new google.maps.Marker({
      position: tourPath[i],
      map: map,
      label: {
        text: ""+(i+1),
        color: 'white',
      },
      title: "Station Number "+(i+1)+"\n"+sorted_json_points[i].name

    });
  }
  var lineSymbol = {
    path: 'M 0,-1 0,1',
    strokeOpacity: 1,
    scale: 4
  };
  tourPath.push({lat: parseFloat(sorted_json_points[0].latitude), lng: parseFloat(sorted_json_points[0].longitude)})
  var tourPath = new google.maps.Polyline({
    path: tourPath,
    geodesic: true,
    map: map,
    icons: [{
      icon: lineSymbol,
      offset: '0',
      repeat: '20px'
    }],
    strokeColor: '#FF0000',
    strokeOpacity: 0
  });

}
