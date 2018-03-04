$(document).ready(function() {

	form_functions();
	
	// form functions
	function form_functions() {
		var form_nav_a = $('#form-nav a'),
				form_content_div = $('#form-content > div'),
				next = $('#form-content .next');
		
		form_nav_a.click(function(e) {
			e.preventDefault();
			
			var $this = $(this),
					a_index = $this.parent().index();
			
			form_nav_a.parent().removeClass('active');
			$this.parent().prevAll().addClass('active');
			$this.parent().addClass('active');
			form_content_div.hide();
			$('#form-content .section-'+a_index).fadeIn();
		})
		
		next.click(function(e) {
			e.preventDefault();
			
			var $this = $(this),
					next_index = $this.closest('.section').index() + 1;
			
			form_nav_a.parent().removeClass('active');
			$('#form-nav .link-'+next_index).prevAll().addClass('active');
			$('#form-nav .link-'+next_index).addClass('active');	
			form_content_div.hide();
			$('#form-content .section-'+next_index).fadeIn();
		})
		
		var $inputs = $('input[type="text"], input[type="email"], input[type="tel"], textarea'),
				$select = $('select');
				
		$inputs.each(function() {
			var $this = $(this);
			
			if($this.val() != '') {
				$this.addClass('not-empty');
			} else {
				$this.removeClass('not-empty');
			}
		})
		
		$inputs.blur(function() {
			var $this = $(this);
			
			if($this.val() != '') {
				$this.addClass('not-empty');
			} else {
				$this.removeClass('not-empty');
			}
		})
		
		$select.change(function() {
			$this = $(this);
			
			$this.parent().addClass('selected');
		})
	}

})