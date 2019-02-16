const site = {
    init: function() {
        this.add_product.attr_modifier();
        this.add_product.preview_img();
        this.add_product.toggle_cat_option();
        this.add_product.unique_prod_name();
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
                    $product_name.focus();
                    returnData.criteria = 'Product exists already';
                    returnData.status = false;
                    site.generic.msg_handler($product_name, returnData);
                }
            });
        },
        
    },

    generic: {
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
            if(!disableSubmit) elem.closest('form').find('button[type="submit"]').attr('disabled',true);
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
    },

    
};

site.init();