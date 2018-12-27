//calling methods below here
$(document).ready(function() {
	site.lazyLoad();
	$(document).on("click", ".navbar-right .dropdown-menu", function(e){
		e.stopPropagation();
	});
});

var site = {};
site.ajax = {
	init: function() {
		this.response = {};
	},
	get_data: function(req) {
		var page = req.url ? req.url : 'route.php';
		if (window.location.hostname === 'localhost') page = 'projects/svengineeringworks.in/'+ page;
		var url = window.location.origin+'/'+page;
		var type = req.type;
		var request = req.req;
		var async = req.async;
		//var data_type = req.dataType;
		$.ajax({
			url: url,
			type: type || 'POST',
			//dataType: data_type || 'jsonp',
			async: async || false,
			data: request,
			success: function(res) {
				console.log(res);
				if(!res) return site.ajax.response = res;
				return site.ajax.response = JSON.parse(res);
			},
			error: function(err) {
				console.log(err);
				return site.ajax.response = err;
			}
		});
		return this.response;
	}
};
site.ajax.init();
//sample data
// var output = site.ajax.get_data({'req':{'_login':'_login','name':'bala','age':24}});
// console.log(output);

site.lazyLoad = function() {
	$('.js-lazy-load').each(function(index,elem){
		elem.src = $(elem).attr('data-src');
	});
};

site.popup = {
	popup : {
		$popup : $('#js-common_model'),
		$form : $('#js-common_popup'),
		$header : $('.js-modal-title'),
		$trigger : $('a[data-submit]'),
		$uname : $('input[name="uname"]'),
		$submit_btn : $('.js-popup-submit'),
	},
	init: function(popup) {
		popup.$trigger.click(function() {
			if($(this).attr('data-submit') === 'register') {
				site.popup.register_template();
			} else if($(this).attr('data-submit') === 'login') {
				site.popup.login_template();
			} else{
				let page = (window.location.hostname === 'localhost') ? '/projects/svengineeringworks.in' : '';
				window.location.href = window.location.origin+page+'?_logout=logout';
			}
		});
		return this;
	},
	register_template: function() {
		let field = `
			<div class="form-group js-uname-field">
              <label for="uname">User name:</label>
              <input type="text" class="form-control" id="uname" placeholder="EX: Kalam" name="uname" required>
            </div>
		`;
		site.popup.popup.$header.html('Register form');
		$('.js-uname-field').remove();
		site.popup.popup.$form.prepend(field);
		site.popup.popup.$submit_btn.html('Register').val('_register').attr('name','_register');
	},
	login_template: function() {
		site.popup.popup.$header.html('Login form');
		$('.js-uname-field').remove();
		site.popup.popup.$submit_btn.html('Login').val('_login').attr('name','_login');
	},
	popup_submit: function() {

	},
};
site.popup.init(site.popup.popup);

site.logic = {
	init: function(input) {
		$(input.trigger1).click(function() {
			$(input.target1).show();
			$(input.target2).hide();
		});
		$(input.trigger2).click(function() {
			$(input.target1).hide();
			$(input.target2).show();
		});
		$(input.trigger1).click();
		
	}
};
$('#js-option-btn').click(function() {
	site.logic.init({'trigger1':'[data-submit="add_post"]','target1':'#js-add_post_form','trigger2':'[data-submit="list_post"]','target2':'#js-prod_list_table'});
});

site.crud = {
	init: function() {

	},
	spp_view: function(data) {
		return `
			<tr id="js-sp-view-tr"><td colspan="4">
                    <div class="row">
                      <div class="col-md-4">
                        <img src="">
                      </div>
                      <div class="col-md-4">
                        <h2>Machine name</h2>
                        <p>Desc 1</p>
                        <p>Desc 1</p>
                      </div>
                      <div class="col-md-4">
                        <h2>Created date</h2>
                        <p>Last update</p>
                        <p>View count</p>
                      </div>
                    </div>
                  </td></tr>
		`;
	}
};

site.validator = {

	mobile_partten: /^\d+$/,
	email_partten: /^\S+@\S+\.\S+$/,
	init: function() {
		$('.mobile_validate').on('blur',function() {
			var output = site.validator.mobileno($(this), $(this).attr('data-min'), $(this).attr('data-max'));
			site.validator.error_show($(this), output);
		});

		// $('.email_validate').on('blur', function() {
		// 	var output = site.validator.email($(this));
		// 	site.validator.error_show($(this), output);
		// });
	},
	mobileno: function(input, min = 10, max = 13) {
		var number_validation = this.mobile_partten.test(input.val());
		var criteria = '';
		var length_msg = `Minimum ${min} digits and Maximum ${max} digits must needed.`;
		var num_val_err = (!number_validation) ? 'Only numbers are allowed. Please recheck.' : false;
		
		if(!number_validation && input.hasClass('email_validate')) {
			return site.validator.email(input);
			//site.validator.error_show($(this), output);
		}
		
		var length_err = (min > input.val().length) || (max < input.val().length) ? length_msg : false;
		criteria = (!number_validation) ? num_val_err : (!length_err) ? '' : length_err;
		return {'status': !criteria, 'criteria': criteria};
	},
	email: function(input) {
		var email_validation = this.email_partten.test(input.val());
		var criteria = !email_validation ? 'Please check your email format' : false;
		return {'status': email_validation, 'criteria': criteria};
	},
	error_show: function(elem, input) {
		if (input.status) {
			elem.next().remove();
			elem.closest('form').find('button[type="submit"]').removeAttr('disabled');
			return;
		}
		elem.next().remove();
		var template = `<span class='error'>${input.criteria}</span>`;
		elem.after(template);
		elem.closest('form').find('button[type="submit"]').attr('disabled',true);
	},
};
site.validator.init();

site.form_submit = {
	init: function() {
		$('#js-common_popup').submit(function(e) {
			e.preventDefault();
			var response = site.ajax.get_data({req: $(this).serializeArray()});
			console.log(response);
			site.login_update(true, response);
			$('#js-common_model').modal('hide');
			return false;
		});
	},
};
site.form_submit.init();

site.login_update = function(from = false, data) {
	if(!from) {
		data = site.ajax.get_data({type: 'GET',req: {'request': ''}});
	}

	if($.isEmptyObject(data)) {
		$('a[data-submit="logout"]').addClass('hidden');
		$('a[data-submit="login"]').html('Login');
		$('a[data-submit="register"]').removeClass('hidden');
		return;
	}
	$('a[data-submit="register"]').addClass('hidden');;
	$('a[data-submit="login"]').html(`Hi ${data.uname}`);
	$('a[data-submit="logout"]').removeClass('hidden');
	//$('.navbar-toggler').click();
};
site.login_update(false, {});