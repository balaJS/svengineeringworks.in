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
		//var data_type = req.dataType;
		var processData = req.processData ? false : true;
		var contentType = req.contentType ? false : 'application/x-www-form-urlencoded; charset=UTF-8';
		$.ajax({
			url: url,
			type: req.type || 'POST',
			//dataType: data_type || 'jsonp',
			processData: processData,
			contentType: contentType,
			async: req.async || false,
			data: req.req,
			beforeSend: function() {

			},
			success: function(res) {
				// console.log(res);
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
	popup_close: function(popup) {
		$('.error').remove();
		$(popup).modal('hide');
	},
};
site.popup.init(site.popup.popup);

site.logic = {
	init: function(input) {
		$(input.trigger1).click(function() {
			let $h2 = $('.js-prod_form_h2');
			let $submit = $('.js-prod_form_submit');

			$(input.target1).show();
			$(input.target1).next().hide();

			$(input.target1).attr('data-purpose','add');
			$h2.html('Add product');
			$submit.html('Add');

		});
		$(input.trigger2).click(function() {
			if($(input.target1).attr('data-purpose') === 'edit') {
				$(input.target1).hide();
				$(input.target1).next().show();
			} else {
				$(input.target1).hide();
				$(input.target1).next().show();
			}

		});
		$(input.trigger1).click();

	}
};
$('#js-option-btn').click(function() {
	site.logic.init({'trigger1':'[data-submit="add_post"]','target1':'#js-add_post_form','trigger2':'[data-submit="list_post"]'});
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
	},
	prod_list: function($table, $template, overall_data) {
		var $innerHtml;var $new_tr;
		$template.removeClass('hidden');
		var  td_length = $('td', $template).length;
		var obj_values = ['product_image1','product_name','product_spec','product_desc','product_id'];

		$(overall_data).each(function(i, data) {
			$new_tr = $template.clone(true);
			$('td', $new_tr).each(function(index, elem) {
				$innerHtml = index === 0 ? `<img src='resources/${data[obj_values[index]]}' style="width: 5em;">` : data[obj_values[index]];

				if((td_length - 1) === index) {
					$(elem).attr('data-id', parseInt(data[obj_values[index]])); return;
				}
				$(elem).html($innerHtml);
			});

			$($table + ' > tbody').append($new_tr);
		});
		$template.addClass('hidden');
	},
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
	error_show: function(elem, input, type = 0 ,submit_enable = 0) {
		if (input.status) {
			if(type) {
				$('.error').remove();
				var template = `<span class='error' style='color:green;'>${input.criteria} <br/></span>`;
				elem.closest('form').find('button').before(template); return;
			}
			elem.next().remove();
			elem.closest('form').find('button[type="submit"]').removeAttr('disabled');
			return;
		}
		elem.next().remove();
		var template = `<span class='error'>${input.criteria}</span>`;
		elem.after(template);
		if(!submit_enable) elem.closest('form').find('button[type="submit"]').attr('disabled',true);
	},
};
site.validator.init();

site.login_update = function(from = false, data) {
	if(!from) {
		data = site.ajax.get_data({type: 'GET',req: {'request': ''}});
	}

	if($.isEmptyObject(data) || !data.status) {
		$('a[data-submit="logout"]').addClass('hidden');
		$('a[data-submit="login"]').html('Login');
		$('a[data-submit="register"]').removeClass('hidden');
		localStorage.setItem('sv_user', '');
		return;
	}
	$('a[data-submit="register"]').addClass('hidden');;
	$('a[data-submit="login"]').html(`Hi ${data.uname}`);
	$('a[data-submit="logout"]').removeClass('hidden');
	localStorage.setItem('sv_user', data.id);
	//$('.navbar-toggler').click();
};
site.login_update(false, {});

site.form_submit = {
	init: function() {
		$('#js-common_popup').submit(function(e) {
			e.preventDefault();
			var response = site.ajax.get_data({req: $(this).serializeArray()});
			//console.log(response);
			site.login_update(true, response);

			if(!response.status) {
				$(response).each(function(index, response) {
					site.validator.error_show($(`#${response.field}`), response, 0 ,1);
				});
				return false;
			}
			site.popup.popup_close('#js-common_model');
			return false;
		});

		$('#js-add_post_form').submit(function(e) {
			e.preventDefault();
			var form_data = new FormData(this);
			//var response = site.ajax.get_data({req: $(this).serializeArray()});
			var response = site.ajax.get_data({req: form_data,processData: true, contentType: true});

			if(!response.status && response.redirect) {
				alert('You need to login first.'); location.reload();
			}
			if(!response.status) {
				$(response).each(function(index, response) {
					site.validator.error_show($(`#${response.field}`), response, 0 ,1);
				});
				return false;
			}
			site.validator.error_show($(`#${response.field}`), response, 1 ,1);
			//site.popup.popup_close('#js-option_model');
		});
		if(!(localStorage.getItem('sv_user'))) return;
		var response = site.ajax.get_data({req: {'user_id': localStorage.getItem('sv_user'), 'limit': 5}});
		if(response.status) site.crud.prod_list('#js-prod_list_table', $('.list_product_tr'), response.data.result);
	},
};
site.form_submit.init();


site.prod_form = {
	init: function() {
		this.attribute_manipulation();
		this.deleted();
		this.edited();
	},
	attribute_manipulation: function() {
		$('.js-attr-modifier').click(function() {
			if($(this).attr('data-value') === '+') {
				$(this).parents('.js-attr-row:first').clone(true).insertBefore('.js-main-attr-span');
				$(this).parents('.js-attr-row:last').find('[name="attr_name[]"]').val('');
				$(this).parents('.js-attr-row:last').find('[name="attr_value[]"]').val('');
			} else {
				if($('.js-attr-row').length <= 1) {
					alert('Must one attirbute pair needed for continue the process');
					return false;
				}
				$(this).parents('.js-attr-row:first').remove();
			}
		});
	},
	deleted: function() {
		$('.js-prod_delete_btn').click(function() {
			var self = $(this);
			var response = site.ajax.get_data({req: {'type': 'delete','user_id': localStorage.getItem('sv_user'), 'product_id': self.parents('td').attr('data-id')}});
			$('.error').remove();
			var data_for_temp = response.status ? {criteria: response.criteria,color: 'green'} : {criteria: "This product won't deleted.Please try again. ",color: 'red'};
			var template = `<tr class='error_tr'><td colspan="5"><span class='error' style='color:${data_for_temp.color};'>${data_for_temp.criteria} <br/></span></td></tr>`;
			self.parents('tr').after(template);
			if(!response.status) return;
			setTimeout(function(){
				self.parents('tr').remove();
			 $('.error_tr').remove();
			},2000);
		});
	},
	edited: function() {
		$('.js-prod_edit_btn').click(function() {
			let $self = $(this);
			let $form = $('#js-add_post_form');
			let $h2 = $('.js-prod_form_h2');
			let $submit = $('.js-prod_form_submit');
			let $images = $('[name="images"]');

			$form.show();$form.next().hide();
			$form.attr('data-purpose', 'edit');
			$h2.html('Edit product');
			$submit.html('Update');

			let response = site.ajax.get_data({req: {'type': 'get','user_id': localStorage.getItem('sv_user'), 'product_id': $self.parents('td').attr('data-id')}});
			if(!response.status) return;

			let res = response.data.result[0];
			let attr_obj = $.parseJSON(res.product_spec);

			var selector = '.js-attr-row';
			$(`${selector}:not(:first)`).remove();
			$.each(attr_obj, function(key, value) {
				$(`${selector}:first`).clone(true).appendTo('.js-main-attr-span');
				$(`${selector}:last`).find('[name="attr_name[]"]').val(key);
				$(`${selector}:last`).find('[name="attr_value[]"]').val(value);
			});
			$(`${selector}:first`).remove();

			$('[name="prod_cat"]').val(res.product_cat);
			$('[name="machine_type"]').val(res.product_type);
			$('[name="product_name"]').val(res.product_name);
			$images.nextAll('img').remove();
			$images.prev().hide();
			$images.hide().after(`<img src='resources/${res.product_image1}' class='img-thumbnail' alt='${res.product_name}' style='width:45%;'>`);
			$('.js-prod_form_submit').attr('data-id',res.product_id);

		});
	},
	element_update: function(data) {
		data.input === 1 ? data.element.val(data.value) : data.element.html(data.value);
	},
};
site.prod_form.init();