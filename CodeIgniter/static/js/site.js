const site = {
    init: function() {
        this.add_product.attr_modifier();
        this.add_product.preview_img();
        this.add_product.toggle_cat_option();
        this.add_product.unique_prod_name();
        this.mpp.delete_product();
        this.account.form_submit(['#js-login-form', '#js-reg-form']);
        this.generic.auto_complete("[name='search_input']");
        this.generic.search_form_submit();
    },
    ajax_response : '',
    add_product: {
        attr_modifier: function() {
            $('.js-attr-modifier').on('click', function(e) {
                e.preventDefault();
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
        preview_img: function() {
            $('input[name="product_image1"]').on('change', function(e) {
                let tmppath = URL.createObjectURL(e.target.files[0]);
                $('.js-preview-img').fadeIn("fast").attr('src',tmppath);
            });
        },
        toggle_cat_option : function() {
            $('.js-category-add').on('click', function() {
                
                if($('.js-cat_select_box').is(':visible')) {
                    $('.js-cat_select_box').addClass('d-none').removeAttr('required');
                    $('.js-cat_text_box').removeClass('d-none').attr('required', true);
                    $(this).attr('title', 'Choose one');
                } else {
                    $('.js-cat_text_box').addClass('d-none').removeAttr('required');
                    $('.js-cat_select_box').removeClass('d-none').attr('required', true);
                    $(this).attr('title', 'Add new');
                }
            });
        },
        unique_prod_name: function() {
            $('[name="product_name"]').on('focusout', function() {
                var $cat_field = $('[name="product_cat[]"]:visible');
                var $product_name = $('[name="product_name"]');
                if($cat_field[0].nodeName === 'INPUT' || $product_name.val() === '') { return; }
                var req = {
                    url: 'user_products/unique_check',
                    req: {
                        'product_name': $(this).val(),
                        'product_cat': $cat_field.val()
                    }
                };
                var returnData = site.generic.ajax(req);
                $('.error').remove();
                
                if(returnData.data && returnData.data.count) {
                    if($product_name.attr('data-page') === 'edit' && $product_name.attr('data-raw-value') === returnData.data.name && returnData.data.count <= 1) return;
                    $product_name.focus();
                    returnData.criteria = 'Product exists already';
                    returnData.status = false;
                    site.generic.msg_handler($product_name, returnData);
                }
            });
        },
        
    },
    mpp: {
        delete_product: function() {
            $('.js-delete-btn').on('click', function(e) {
                e.preventDefault();
                
                var $deleteBtn = $(this);
                var prod_name = $deleteBtn.parents('.col-md-8').children('.js-prod-name').text().trim();
                var isPermission = confirm('Are you want to delete '+prod_name+' ?');
                
                if(!isPermission) return;

                var href_str = $deleteBtn.siblings('a').attr('href');
                var href_arr = href_str.split('/');
                var hrefArrLen = href_arr.length;
                var req = {
                    url: 'user_products/delete',
                    req: {
                        'product_slug': href_arr[hrefArrLen - 1],
                        'product_cat': href_arr[hrefArrLen - 2]
                    }
                };
                var returnData = site.generic.ajax(req);
                $deleteBtn.parents('.js-product').siblings('.js-product').length === 0 
                    ? $deleteBtn.parents('.js-category').remove() 
                    : $deleteBtn.parents('.js-product').remove();
                //site.generic.msg_handler($deleteBtn.parents('.js-product'), returnData.data); //fix me
            });
            
        },
    },
    account: {
        setMobileOrEmail: function(selector, nameValue) {
            $(selector).attr('name', nameValue);
        },
        form_submit: function(selectors) {
            $.each(selectors, function(index, selector) {
                $(selector).on('submit', function(e) {
                    var $field = $('.js-reg-unique-field', $(selector));
                    var emailOrMobileVal = $field.val();
                    if(site.generic.nonNumberExp.test(emailOrMobileVal)) { //Fix me.
                        var emailOrMobileValArr = emailOrMobileVal.split('@');//reduce the steps using regexp
                        if(emailOrMobileValArr.length === 2) {
                            var domain = emailOrMobileValArr[1];
                            var emailDomainArr = domain.split('.');
                            if(emailDomainArr.length === 2) {
                                $field.attr('name', 'email');
                                return true;
                            } else {
                                e.preventDefault();
                                site.generic.msg_handler($field, {'criteria': 'Email format is wrong','status': false});
                                return false;
                            }
                        } else {
                            //wrong email. throw error
                            e.preventDefault();
                            site.generic.msg_handler($field, {'criteria': 'Email format is wrong','status': false});
                            return false;
                        }
                    } else {
                        //mobile section
                        var mobileno_length = emailOrMobileVal.length;
                        if(mobileno_length <= 12 && mobileno_length >= 10) {
                            $field.attr('name', 'mobile');
                            return true;
                        }
                        e.preventDefault();
                        site.generic.msg_handler($field, {'criteria': `Mobile number must be between 10 - 12 digits. But your mobile number length is ${mobileno_length}.`,'status': false});
                        return false;
                    }
                    
                });
            });
        },
    },

    generic: {
        nonNumberExp: /[^0-9+]/,
        msg_handler: function(elem, data, isSuccess = 0, disableSubmit = 0) {
            if (data.status) {
                if(isSuccess) {
                    $('.error').remove();
                    let template = `<span class='error text-success'>${data.criteria} <br/></span>`;
                    elem.closest('form').find('button').before(template); return;
                }
                elem.next().remove();
                elem.closest('form').find('button[type="submit"]').removeAttr('disabled');
                return;
            }
            elem.next().remove();
            let template = `<span class='error text-danger'>${data.criteria}</span>`;
            elem.after(template);
            if(disableSubmit) elem.closest('form').find('button[type="submit"]').attr('disabled',true);
        },
        ajax: function(req) {
            let base_url = location.host === '127.0.0.1' ? location.origin+'/projects/new-svengineeringworks.in/CodeIgniter' : location.origin;
            let url = req.url ? base_url+'/index.php/'+req.url : 'fix me';
            //var data_type = req.dataType;
            var processData = req.processData ? false : true;
            var contentType = req.contentType ? false : 'application/x-www-form-urlencoded; charset=UTF-8';
            req.req.isAjax = 1;
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
                    if(!res) return site.ajax_response = {'status': false, 'data': res};
                    return site.ajax_response = {'status': true, 'data': JSON.parse(res)};
                },
                error: function(err) {
                    console.log(err.responseText);
                    return site.ajax_response = {'status': false, 'data': err.responseText};
                }
            });
            return site.ajax_response;
        },
        auto_complete: function(selector) {
            let base_url = location.host === '127.0.0.1' ? location.origin+'/projects/new-svengineeringworks.in/CodeIgniter' : location.origin;
            $(selector).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                      url: base_url+"/index.php/Products/auto_complete",
                      data: {
                        term: request.term,
                        isAjax: 1
                      },
                      success: function( data ) {
                        site.generic.autoCompleteResults = $.parseJSON(data);
                        var search_names = site.generic.autoCompleteResults.map(function(result) { return result.product_name || result.cat_name; })
                        response( search_names );
                      }
                    });
                },
                minLength: 2,
                select: function( event, ui ) {
                    var $search_input = $(this);
                    site.generic.autoCompleteResults.map(function(result) {
                        if(result.product_name === ui.item.label || result.cat_name === ui.item.label) {
                            $search_input.attr('data-product_cat', result.product_cat || result.cat_slug);
                            $search_input.attr('data-product_slug', result.product_slug  || 0);
                        }
                    });
                }
            });
        },
        search_form_submit: function() {
            $('#js-search-form').on('submit', function(e) {
                e.preventDefault();
                var $form = $('#js-search-form');
                var $input = $('[name="search_input"]');
                
                if(!$input.val()) {
                    $input.focus();
                    return false;
                }
                
                var urlDeterminateArr = $input.attr('data-product_slug') === '0' ?  ['list_products', '']: ['view_product', $input.attr('data-product_slug')];
                var url_suffix = '/index.php/Products/'+urlDeterminateArr[0]+'/'+$input.attr('data-product_cat')+'/'+urlDeterminateArr[1];
                
                var base_url = location.host === '127.0.0.1' ? location.origin+'/projects/new-svengineeringworks.in/CodeIgniter' : location.origin;
                location.href = base_url+url_suffix;
            });
        },
    },    
};

site.init();
