$(function(){

  if($("select.pick-and-go").length > 0) {      //only care if I exist on the page
    $("select.pick-and-go").change(function(){  //when I change
      if($(this).val().length) {                //only if I have length
        location.href = $(this).val();          //go to the link
      }
    })
  }
})
var marker;
var statelat;
var statelng;

function initMap() {

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  }
  else {
    console.log('Geolocation is not supported by this browser.');
  }

  var map = new google.maps.Map(document.getElementById('googleMap'), {
    zoom: 12,
    center: {lat: statelat, lng: statelng}
  });
  providers = providers; //providers is a global populated on the single-state.php page, there is no reason for this line but to tell you where it comes from
  for(var provider in providers) {
    var p = providers[provider];
    marker = new google.maps.Marker({
      map: map,
      draggable: true,
      animation: google.maps.Animation.DROP,
      position: {lat: p.lat, lng: p.lng},
      title: p.title,
    });
  }
  if(providers.length) {  //no one has entered any providers yet
    marker.addListener('click', toggleBounce);
  }
}

function showPosition(position) {
  statelat = parseFloat(position.coords.latitude);
  statelng = parseFloat(position.coords.longitude);
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      console.log('User denied the request for Geolocation.');
      break;
    case error.POSITION_UNAVAILABLE:
      console.log('Location information is unavailable.');
      break;
    case error.TIMEOUT:
      console.log('The request to get user location timed out.');
      break;
    case error.UNKNOWN_ERROR:
      console.log('An unknown error occurred.');
      break;
  }
}

function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
