var site = {};
site.lazyLoad = function() {
	$('.js-lazy-load').each(function(index,elem){
		elem.src = $(elem).attr('data-src');
	});
}

//calling methods below here
$(document).ready(function() {
	site.lazyLoad();
});