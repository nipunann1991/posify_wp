jQuery(document).ready(function($){
	'use strict';
	console.time('load-time-framework');

	var TS_WRAP = $('.ts_frameworkarea,.inside,.slupy_menuex');
	var TS_MENU = $('.ts_menu',TS_WRAP);

	/*---------------------------------------------
		Last Activated Tab & Hash Link Tab
	---------------------------------------------*/
	if( $.cookie('activated_subtab') === undefined ){
		$.cookie('activated_subtab','logo');
	}
	if(window.location.hash) {
		var open_tab = window.location.hash.replace('#','');
		if( $('.ts_sub_tab[data-tab="'+open_tab+'"]',TS_MENU).length > 0 ){
			$.cookie('activated_subtab',open_tab);
		}
	}

	/*---------------------------------------------
		Mega Menu
	---------------------------------------------*/
	function filter_megamenu_items(){
		$('#menu-to-edit li.menu-item-depth-0').each(function(){
			var this_ = $(this);
			var mega_active = this_.find('.mega-menu-control').is(':checked') ? true : false;
			if(mega_active){
				this_.nextUntil('li.menu-item-depth-0').removeClass('mega-not-active');
			}else{
				this_.nextUntil('li.menu-item-depth-0').addClass('mega-not-active');
			}
			
		});
	}
	filter_megamenu_items();
	
	$( '#menu-to-edit' ).on( 'sortupdate', function( event, ui ) {
		filter_megamenu_items();
	}).on( 'sortstop', function( event, ui ) {
		setTimeout(filter_megamenu_items,1000);
	});

	$('.mega-menu-control').on('click',function(){
		filter_megamenu_items();
	});

	$( 'ul#menu-to-edit' ).on( 'click', '.menu-item-bar a.item-edit', function() {
		var this_ = $(this).parents('li').find('.icon-selectbox');
		if( !this_.hasClass('select2-offscreen') ){
			this_.select2({
				allowClear: true,
				data: { results: FontAwasomeIcons, text: function(item) { return item.id; } },
				formatResult: format,
				formatSelection: format
			});
		}
	});

	/*---------------------------------------------
		Framework Accordion Menu
	---------------------------------------------*/
	$('.ts_main_tab',TS_MENU).click(function(){
		var this_ = $(this);
		if( !this_.hasClass('activated_tab') ){
			TS_MENU.find('.activated_tab').removeClass('activated_tab').find('>ul').slideUp(200);
			$('>ul',this_).slideDown(200,function(){
				this_.addClass('activated_tab');
			});
		}
		return false;
	});

	/*---------------------------------------------
		Framework Accordion Sub (Tab) Menu
	---------------------------------------------*/
	$('.ts_sub_tab',TS_MENU).click(function(){
		var this_ = $(this);
		if( !this_.hasClass('activated_subtab') ){
			$('.ts_sub_tab').removeClass('activated_subtab');
			this_.addClass('activated_subtab');
			$('.tab_contents > .tab_content',TS_WRAP).hide();
			var activated_tab = $(this_).data('tab');
			$('.tab_'+activated_tab,TS_WRAP).fadeIn();
			$.cookie('activated_subtab',activated_tab);
		}
	});
	$('.ts_sub_tab[data-tab="'+$.cookie('activated_subtab')+'"]').trigger('click');

	/*---------------------------------------------
		Group Field Config
	---------------------------------------------*/
	$('.add_group_item').click(function(){
		var d_group = $(this).next('.duplicate_group');
		var clone_ = $(this).next('.duplicate_group').find('.a_group').clone();
		var content_ = $(this).prev('.ts_field_group');
		var new_id = d_group.data('id')+1;
		d_group.data('id',new_id);
		
		clone_.appendTo(content_);
		content_.html(content_.html().replace(/fake_/g, ''));
		$('.a_group',content_).each(function(){
			$(this).html($(this).html().replace(/{id}/g, new_id));
		});
		return false;
	});
	//toggle group field - change title - delete group field
	$(TS_WRAP).on('click','.a_group span',function(){
		$('.fa',this).toggleClass('ts_up');
		$(this).next().slideToggle(300);
	}).on('keyup','.a_group input[name$="[title]"]',function(){
		var change_title = $(this).parents('.a_group').find('.a_item_title');
		if($(this).val() !== ''){
			change_title.text($(this).val());
		}else{
			change_title.text(change_title.data('placeholder'));
		}
	}).on('click','.delete_group_item',function(){
		$(this).parents('.a_group_content').slideUp(300,function(){
			$(this).parents('.a_group').remove();
		});
		return false;
	});
	//sortable group field with jQuery UI Sortable
	$( '.ts_field_group' ).sortable({ 
		axis: 'y',
		handle: '> span',
		start: function( event, ui ) {
			console.log(ui);
			$('.a_group_content',this).slideUp(300).prev().find('.ts_up').removeClass('ts_up');
			ui.placeholder.height($('>span',ui.item.context).outerHeight());
			$( this ).sortable( 'refreshPositions' );
		}
	});

	/*---------------------------------------------
		Checkbox Group Single Choose Mode
	---------------------------------------------*/
	$('.ts_single_checkbox').click(function(){
		$(this).parent().siblings().find('.ts_single_checkbox').removeAttr('checked');
	});

	/*---------------------------------------------
		Wordpress Color Picker
	---------------------------------------------*/
	$('.ts_color_picker').wpColorPicker();

	/*---------------------------------------------
		Depends Form Elements
	---------------------------------------------*/
	console.time('load-time-depends');
	$('.tab_content').FormDependencies({
          inactiveClass : 'hidden',
          clearValues   : true
        });
	console.timeEnd('load-time-depends');

	/*---------------------------------------------
		Framework Text & Textarea Field Multi Lang Tab
	---------------------------------------------*/
	$(TS_WRAP).on('click','.lang_tab li a',function(){
		if( !$(this).hasClass('ts_active') ){
			var content_ = $(this).parents('.ts_content_a_field');
			var active_tab = 'lang_'+$(this).data('lang');
			$('label',content_).hide();
			$('.ts_active',content_).removeClass('ts_active');
			$(this).addClass('ts_active');
			$('.'+active_tab,content_).fadeIn();
		}
		return false;
	});

	/*---------------------------------------------
		Custom Uploader for Upload Option Type
	---------------------------------------------*/
	var custom_uploader;
    var themesama_upload_button;
 
    $( 'body' ).on('click', '.ts_upload_button', function(e) {
 
        e.preventDefault();

        themesama_upload_button = $(this);
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: themesama_upload_button.data('uploadertitle'),
            button: {
                text: themesama_upload_button.data('uploaderbutton')
            },
            library:{
                type: themesama_upload_button.data('filetype')
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {

            var selection = custom_uploader.state().get('selection');
            selection.map( function( attachment ) {
 
                attachment = attachment.toJSON();

                if(themesama_upload_button.data('getid')==='on'){
                    themesama_upload_button.prev('input').val(attachment.id).change();
                    var media_thumbnail = ( attachment.sizes !== undefined && attachment.sizes.thumbnail !== undefined ) ? attachment.sizes.thumbnail.url : attachment.url;
                    themesama_upload_button.parent().prev('.live_preview').html('<a href="'+attachment.url+'" target="_blank"><img src="'+media_thumbnail+'" alt="'+attachment.title+'" /></a>');
                	themesama_upload_button.next().removeClass('ts_hidden');
                }else{
                    themesama_upload_button.prev('input').val(attachment.url).change();
                }
         
            });
            
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });

	/*---------------------------------------------
		Uploader Image Remove Icon
	---------------------------------------------*/
	$('body').on('click','.ts_remove_button',function(){
		$(this).addClass('ts_hidden').prev().prev().val('').parent().prev().html('');
		return false;
	});

	/*---------------------------------------------
		Icon Box
	---------------------------------------------*/
	$('body').on('click','.icon_toggle',function(){
		var this_ = $(this);
		var content_ = this_.next();
		var current_ = this_.parent().prev().find('input').val();
		var new_content = '';
		if( content_.hasClass('ts_content_active') ){
			content_.slideUp(300,function(){
				content_.removeClass('ts_content_active');
				$('.all_icons',content_).html('');
			});
		}else{
			$.each(font_awesome.icons,function(key,value){
				new_content = new_content + '<i data-id="'+value+'" class="choose_this_icon fa fa-'+value + (current_ == value ? ' activated_icon':'') +'"></i>' ;
			});
			content_.removeClass('hidden');
			$('.all_icons',content_).html(new_content);
			content_.slideDown(300,function(){
				content_.addClass('ts_content_active');
			});
		}
		return false;
	}).on('click','.choose_this_icon',function(){
		if( !$(this).hasClass('activated_icon') ){
			$(this).parent().find('.activated_icon').removeClass('activated_icon');
			$(this).addClass('activated_icon').parents('.ts_content_icon').find('label input').val($(this).data('id'));
		}else{
			$(this).removeClass('activated_icon').parents('.ts_content_icon').find('label input').val('');
		}
		$(this).parents('.ts_content_icon').find('.current_icon').html('<i class="fa fa-'+($(this).parents('.ts_content_icon').find('label input').val())+'"></i>');
	}).on('change', 'input[name="filter_icons"]', function() {
        var filter = $(this).val();
        if (filter) {
            $(this).next().find('.choose_this_icon').hide();
            $(this).parent().find('.choose_this_icon[data-id*="' + filter + '"]').show();
        } else {
            $(this).parent().find('.choose_this_icon').show();
        }
        return false;
    }).on('keyup', 'input[name="filter_icons"]', function() {
        $(this).change();
    }).on('click', 'input[name="filter_icons"]', function() {
        $(this).val('').change();
    });

  /*---------------------------------------------
		Font (Typography) Field
	---------------------------------------------*/
    console.time('load-time-chosen');
    $('.font_subsets,.font_variants,.select_google_font, .ts_content_font .ts_content_select select, .google-subsets').chosen();
    console.timeEnd('load-time-chosen');
    $('.select_google_font').change(function(){

    	var content_ = $(this).parents('.ts_content_font');
    	var subsets = $('option:selected',this).data('subsets');
    	var variants = $('option:selected',this).data('variants');
    	var subsets_item = '';
    	$.each(subsets.split(','),function(key,value){
    		subsets_item += '<option value="'+value+'">'+value+'</option>';
    	});
    	var variants_item = '';
    	$.each(variants.split(','),function(key,value){
    		variants_item += '<option value="'+value+'">'+value+'</option>';
    	});

    	$('.font_subsets',content_).html(subsets_item);
    	$('.font_variants',content_).html(variants_item);
    	$('.all_subsets',content_).val(subsets);
    	$('.all_variants',content_).val(variants);

    	$('.font_subsets,.font_variants').trigger("chosen:updated");

    });
    
    /*---------------------------------------------
		Google Fonts Ajax
	---------------------------------------------*/
    console.time('load-time-googlefonts-ajax');
    //Check Google Font Select Box
    if( $('.select_google_font').length > 0 ){
    	$.getJSON( decodeURIComponent(ts_framework.url)+'/js/webfonts.txt', function( data ) {
		  	var items_ = '';
	    	$.each(data.items,function(key,value){
	    		items_ += '<option data-subsets="'+value.subsets.join()+'" data-variants="'+value.variants.join()+'" value="'+value.family+'">'+value.family+'</option>';
	    	});
	    	
	    	$('.select_google_font').each(function(){
	    		$(this).append(items_);
	    	}).trigger("chosen:updated");
		});
    }
    console.timeEnd('load-time-googlefonts-ajax');

    /*---------------------------------------------
		Framework Reset Button
	---------------------------------------------*/
    $('input[name="ts_framework_reset"],input[name="ts_framework_import"]').click(function(){
    	var reset_all = window.confirm($(this).parent().data('alert'));
    	if( reset_all === false ){
    		return false;
    	}

    });

  /*---------------------------------------------
		Hide Framework Notice
	---------------------------------------------*/
    $('#ts_framework_notices').click(function(){
    	$(this).slideUp();	
    });

  /*---------------------------------------------
		Metabox Tabs
	---------------------------------------------*/
	$('ul.ts_metabox_tabs li a').click(function(){
		var content_ = $(this).parents('.tab_content');
		var show_tab = $(this).attr('href');
		$('.ts_metabox_alltabs .ts_metabox_tab',content_).hide();
		$('ul.ts_metabox_tabs li.ts_activetab',content_).removeClass('ts_activetab');
		$(this).parent().addClass('ts_activetab');
		$(show_tab).show();
		return false;
	});

	/*---------------------------------------------
		Visual Composer
	---------------------------------------------*/
	$('body').on('change','.slupy_switch_for_vc', function(){
		var new_val = '';
		if ($(this).is(':checked')) {
			new_val = 'on';
		}else{
			new_val = 'off';
		}
		$(this).parents('.slupy_switch').find('.wpb_vc_param_value').val(new_val).trigger('change');
	});
	console.timeEnd('load-time-framework');
});