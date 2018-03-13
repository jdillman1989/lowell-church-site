jQuery(document).ready(function($) {
  $('input[name$="address"]').after('<a class="preview button get-coordinates" href="#">Get Coordinates</a>');
  $('body').on('click', '.get-coordinates', function(e) {
    e.preventDefault();
    var el = $(this);
    el.css({"opacity":0.5});
    var address = $(this).prev().val();
    $.ajax({
      type: 'GET',
      url: ajax_obj.ajax_url + '?action=get_coords',
      data: {address:address},
      complete: function(response) {
        var coordData = JSON.parse(response.responseText);
        $('input[name$="latitude"]').val(coordData.lat);
        $('input[name$="longitude"]').val(coordData.long);
        el.css({"opacity":1});
      }
    });
  });
})
