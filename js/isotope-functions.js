$(document).ready(function() {
	
	// Isotope
	var $container = $('.grid');
	var	colWidth = function() {
		var w = $container.width(), 
			columnNum = 1,
			columnWidth = 0;
		if(w > 1154) {
			columnNum  = 4;
		} else if(w > 736) {
			columnNum  = 3;
		} else if(w > 500) {
			columnNum  = 2;
		} else {
			columnNum  = 1;
		}
		columnWidth = Math.floor(w/columnNum);
		$container.find('.item').each(function() {
			var $item = $(this),
				multiplier_w = $item.attr('class').match(/item-w(\d)/),
				multiplier_h = $item.attr('class').match(/item-h(\d)/),
				width = multiplier_w ? columnWidth*multiplier_w[1] : columnWidth,
				height = multiplier_h ? columnWidth*multiplier_h[1]*0.5-4 : columnWidth*0.5-4;
			$item.css({
				width: width,
				height: width * .9
			});
		});
		return columnWidth;
	},
	isotope = function() {
		$container.isotope({
			resizable: false,
		  itemSelector: '.item',
		  masonry: {
		  	columnWidth: colWidth(),
		  	gutter: 0,
		  	isFitWidth: true
		  }
		});
		  
		function concatValues( obj ) {
		  var value = '';
		  for ( var prop in obj ) {
		    value += obj[ prop ];
		  }
		  return value;
		}
	}
	isotope();
  $(window).smartresize(isotope);
	
})