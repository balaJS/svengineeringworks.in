$(document).ready(function() {
	var site = {};
	site.lazyLoad = function() {
		$('.js-lazy-load').each(function(index,elem){
			elem.src = $(elem).attr('data-src');
		});		
	}
	site.lazyLoad();
});