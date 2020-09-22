$(document).ready(function() {

});

// hide all option icons

function hideIcons() {
  $(".active-icon").css("opacity", "0");
}

// show an image

function showImage(id) {
  $("#"+id).css("opacity", "1.0");
}
