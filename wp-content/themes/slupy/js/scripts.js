;(function($, window, document, undefined) {
  'use strict';

  var $window = $(window);
  var $document = $(document);

  var windowHeight = $window.height();
  var is_device_mobile = (navigator.userAgent.match(/(Android|iPhone|iPad|iPod|Opera Mini|webOS|BlackBerry|IEMobile)/)) ? true : false;
  var is_slupy_rtl = $('body').hasClass('direction-rtl') ? true : false;

  $window.resize(function () {
    windowHeight = $window.height();
  });

  $.exists = function(selector) {
    return ($(selector).length > 0);
  };

  /*---------------------------------------------
    Main Menu
  ---------------------------------------------*/
  $.fn.slupyMainMenu = function() {

    return this.each(function() {

      var _this   = $(this),
          _sub    = _this.children("ul.sub-menu:eq(0)"),
          _header = $('#header'),
          _header_type = _header.find('.header-type'),
          _sub_pos;

      $('#site-content').bind( "touchstart", function(e){
        _this.trigger('mouseleave');
      });

      _this.hover(
        function() {
          if (_sub.queue().length <= 1){
            _sub.fadeIn(100).removeClass('fadeOutDown');

            if(!_this.parents('li').hasClass('mega-menu')){
              _sub.addClass('fadeInDown');
            }
          }

          var left_pos = _sub.width() + _sub.offset().left;

          if($window.width() < left_pos || _sub.parents('ul').hasClass('in-window') ){
            _sub.addClass('in-window');
          }else if( _sub.hasClass('in-window') && $window.width() > left_pos ){
            _sub.removeClass('in-window');
          }

          //mega menu position
          if( _this.hasClass('mega-menu') && !_header.hasClass('sticky-header') && _header_type.hasClass('header-underlogo') && _sub.position().left > 15 ) {
            _sub_pos = 0;
            if( $('body').hasClass('container-boxed') ) {
              _sub_pos = 15;
            }

            if( _this.position().left > _sub.outerWidth() ) {
              _sub_pos = _this.position().left + _this.outerWidth() - _sub.outerWidth() - _sub_pos;
            }

            _sub.css({left: _sub_pos,right: 'auto'});

          }else if( _this.hasClass('mega-menu') && !_header.hasClass('sticky-header') && _header_type.hasClass('header-center') && _sub.position().left > 15 ) {
            _sub_pos = ( _header_type.width() - _sub.outerWidth() ) / 2;
            
            if( _sub_pos + _sub.outerWidth() < _this.position().left + _this.outerWidth() ) {
              _sub_pos = _this.position().left + _this.outerWidth() - _sub.outerWidth() - 15;
            }else if( _sub_pos > _this.position().left ) {
              _sub_pos = _this.position().left - 15;
            }

            _sub.css({left: _sub_pos,right: 'auto'});

          }else if( _this.hasClass('mega-menu') && _this.position().left < _sub.position().left ){
            _sub.css({right: 'auto',left: _this.position().left-15});
          }/*else if(_this.hasClass('mega-menu') && _this.position().left + _this.outerWidth() - _sub.outerWidth() > 0){
            _sub.css({right: 'auto',left: _this.position().left + _this.outerWidth() - _sub.outerWidth() - 15});
          }*/
        },
        function() {
          _sub.fadeOut(100,function(){
            _sub.removeClass('in-window');

            if(_this.hasClass('mega-menu')){
              _sub.css({right: '15px',left: 'auto'});
            }
          }).removeClass('fadeInDown');

          if(!_this.parents('li').hasClass('mega-menu')){
            _sub.addClass('fadeOutDown');
          }
        }
      );

    });
  };

  /*---------------------------------------------
    Mobile Menu
  ---------------------------------------------*/
  $.fn.slupyMobileMenu = function() {

    return this.each(function() {

      var _this     = $(this),
          _back_btn = _this.find('.back-site-content'),
          _submenu  = _this.find('.menu-item-has-children > a'),
          _menu_btn = $('#mobile-menu-button');

      _menu_btn.click(function(e) {
        e.stopPropagation();
        e.preventDefault();

        //disable menu additional content
        $('.menu-additional-btn').removeClass('active-menu-content');

        if( _this.hasClass('in-window') ) {
          _back_btn.trigger('click');
        }else {
          _this.addClass('in-window');
          $('body').addClass('mobile-site-content');
        }
      });

      _back_btn.click(function(e) {
        e.stopPropagation();
        e.preventDefault();

        _this.removeClass('in-window');
        $('body').removeClass('mobile-site-content');
      });

      _submenu.click(function(e) {
        e.preventDefault();

        $(this).parent().toggleClass('active-sub-menu').find('> ul').slideToggle();
      });

      _this.click(function(e) {
        e.stopPropagation();
      });

      $document.click(function() {
        if( $('body').hasClass('mobile-site-content') ) {
          _this.removeClass('in-window');
          $('body').removeClass('mobile-site-content');
        }
      });

    });

  };

  /*---------------------------------------------
    Sticky Menu
  ---------------------------------------------*/
  $.fn.slupyStickyMenu = function() {

    return this.each(function() {

    var _header           = $(this),
        _site_content     = _header.next(),
        _offset           = _header.offset().top,
        _header_height    = _header.outerHeight(),
        _position         = 'right',
        _container_offset = _header.find('> .container').offset(),
        _sticky_is_active = true;

    //check admin bar
    if( $.exists('#wpadminbar') ) {
      _offset -= $('#wpadminbar').outerHeight();
    }

    if( is_device_mobile ) return;

    $window.scroll(function() {

      if( (_header_height + _offset >= $window.scrollTop() || $window.width() < 992) && _sticky_is_active !== true ){

        _header.removeClass('sticky-header').css('top','0');
        $('.fake-height',_site_content).remove();

        if( $.exists('#top-bar .sticky-menu-additional') ){
          $('nav',_header).css('margin-right','0');
          $('#top-bar .menu-additional').removeClass('sticky-menu-additional');
        }

        _sticky_is_active = true;
      }else if( $window.width() > 992 && _header_height + _offset < $window.scrollTop() && _sticky_is_active !== false ){

        _header.css('top','-40px').animate({top:'0'},300).addClass('sticky-header');

        _site_content.prepend('<div class="fake-height" style="height:'+_header_height+'px;"></div>');
        
        if( $.exists('#top-bar .menu-additional') && !$.exists('#header .menu-additional') ){

          if( $('body').hasClass('direction-rtl') ) {
            _position = 'left';
          }

          if( !$('#top-bar .menu-additional').hasClass('sticky-menu-additional') ) {
            $('#top-bar .menu-additional').css( _position, (_container_offset.left+15)+'px').css('top','-40px').addClass('sticky-menu-additional').animate({top:'0'},300);
          }

          if( $('body').hasClass('container-boxed') ) {
            $('nav',_header).css('margin-' + _position, $('#top-bar .menu-additional').width()-30);
          }else {
            $('nav',_header).css('margin-' + _position, $('#top-bar .menu-additional').width());
          }
        }

        _sticky_is_active = false;
      }

    }).resize(function() {
      $window.scroll();
      _container_offset = _header.find('> .container').offset();
      $('#top-bar .menu-additional').css({right:(_container_offset.left+15)+'px'});
    });

    });
    
  };

  /*---------------------------------------------
    Back Top
  ---------------------------------------------*/
  $.fn.slupyBackTop = function() {

    return this.each(function() {

      var _this   = $(this),
          _offset = $('body').height() / 3;

      _this.click(function(e) {
        e.preventDefault();

        $('html, body').animate({scrollTop : 0},500);
        _this.fadeOut();
      });

      $window.scroll(function() {
        if( $window.scrollTop() > _offset ){
          _this.fadeIn();
          $('.demo_store').fadeOut();
        }else if( $window.scrollTop() < _offset ){
          $('.back-site-top').fadeOut();
          $('.demo_store').fadeIn();
        }

      });

    });

  };

  /*---------------------------------------------
    FitVids
  ---------------------------------------------*/
  $.fn.slupyFitVids = function() {

    return this.each(function() {

      var _this = $(this);

      if (typeof $.fn.fitVids == 'function') {

        _this.fitVids({
          customSelector: "iframe[src*='blip.tv'],iframe[src*='dailymotion.com'],iframe[src*='funnyordie.com'],iframe[src*='viddler.com'],iframe[src*='rd.io'],iframe[src*='hulu.com']"
        });

      }

    });

  };

  /*---------------------------------------------
    FitVideo
  ---------------------------------------------*/
  $.fn.slupyFitVideo = function() {

    return this.each(function() {

      var _this           = $(this),
          _video          = _this.find('.bg-video'),
          _content        = _this.parent(),
          _content_width  = _content.outerWidth(),
          _content_height = _content.outerHeight(),
          _video_width    = _video.width(),
          _video_height   = _video.height();

      if( !is_device_mobile ) {
        $window.resize(function(){

          _video.removeAttr('style');

          _content_width  = _content.outerWidth();
          _content_height = _content.outerHeight();
          _video_width    = _video.width();
          _video_height   = _video.height();

          if(_video_height < _content_height){
            var dimension = (120 * _content_height) / _video_height;
            _video.css({width:dimension+'%', height: _content_height+'px'});
            _video_width  = _video.width();
            _video_height = _video.height();
          }

          if(_content_width < _video_width){
            _video.css({position:'relative',left:'-'+((_video_width-_content_width)/2)+'px'});
          }

          if(_content_height < _video_height){
            _video.css({position:'relative',top:'-'+((_video_height-_content_height)/2)+'px'});
          }

        }).resize();
      }else {
        _this.remove();
      }

    });

  };

  /*---------------------------------------------
    WP Responsive Video
  ---------------------------------------------*/
  $.fn.slupyWPVideo = function() {

    return this.each(function() {

      var _this           = $(this),
          _content        = _this.find('.mejs-container'),
          _video          = _this.find('video.wp-video-shortcode'),
          _video_width    = _video.attr('width'),
          _video_height   = _video.attr('height'),
          _percentage     = _video_height / _video_width;

          _video.css({'width' : '100%', 'height' : '100%'});

      $window.resize(function(){
          _this.css({'width' : '100%', 'height' : (_this.width() * _percentage) + 'px', 'opacity' : '1'});
      }).resize();

    });

  };

  /*---------------------------------------------
    OWL Slider
  ---------------------------------------------*/
  $.fn.slupyOwlSlider = function() {

    return this.each(function() {

      var _this = $(this),
          _count = _this.find('> *').length;

      if( _count > 1 ) {

      _this.imagesLoaded(function() {

        _this.owlCarousel({
          nav               : _this.data('navigation') === 'on' ? true : false,
          autoplay          : _this.data('autoplay') === 'on' ? true : false,
          autoplayTimeout   : _this.data('autoplay') === 'on' ? parseInt(_this.data('time'))*1000 : 5000,
          autoplayHoverPause: _this.data('stophover') === 'on' ? true : false,
          touchDrag         : _this.data('touch') === 'on' ? true : false,
          mouseDrag         : _this.data('touch') === 'on' ? true : false,
          animateOut        : _this.data('fade') === 'on' ? 'owl-fadeOut' : false,
          animateIn         : _this.data('fade') === 'on' ? 'owl-fadeIn' : false,
          dots              : _this.data('pagination') === 'on' ? true : false,
          autoHeight        : _this.data('autoheight') !== 'on' ? false : true,
          navText           : [],
          items             : 1,
          loop              : true,
          rtl               : is_slupy_rtl,
          lazyLoad          : true
        }).on('changed.owl.carousel', function(event) {
          if( _this.next().is('.thumbnails') ){
            var _total = event.item.count,
                _current = event.item.index - 2,
                _current_pos = _total > _current ? _current : _current - _total;
            _this.next().find('a')
              .removeClass('active-thumbnail').eq(_current_pos)
              .addClass('active-thumbnail');
          }
        });

      });

      }else {
        _this.addClass('owl-carousel owl-loaded');
      }

    });

  };

  /*---------------------------------------------
    OWL Carousel
  ---------------------------------------------*/
  $.fn.slupyOwlCarousel = function() {

    return this.each(function() {

      var _this = $(this);

      _this.owlCarousel({
        responsive        : {
          0 :   {
            items : parseInt(_this.data('maxmobile')) || 1
          },
          768 : {
            items : parseInt(_this.data('maxtablet')) || 2
          },
          992 : {
            items : parseInt(_this.data('maxdesktop')) || 4
          },
          1200 : {
            items : parseInt(_this.data('maxitem')) || 6,
          }
        },
        autoplay          : _this.data('autoplay') === 'on' ? true : false,
        autoplayTimeout   : _this.data('autoplay') === 'on' ? parseInt(_this.data('time'))*1000 : 5000,
        autoplayHoverPause: _this.data('stophover') === 'on' ? true : false,
        touchDrag         : _this.data('touch') === 'on' ? true : false,
        mouseDrag         : _this.data('touch') === 'on' ? true : false,
        dots              : _this.data('pagination') === 'on' ? true : false,
        autoHeight        : false,
        navText           : [],
        loop              : true,
        rtl               : is_slupy_rtl,
        lazyLoad          : true
      });

    });

  };

  /*---------------------------------------------
    Revolution Slider for Load More
  ---------------------------------------------*/
  $.fn.slupyRevolutionSlider = function() {

    return this.each(function() {

      var _this     = $(this),
          js_lines  = _this.next('script').text(),
          custom_script = document.createElement('script');
      
      _this.next('script').remove();
      custom_script.type = 'text/javascript';

      try {
        custom_script.appendChild(document.createTextNode(js_lines));
        document.body.appendChild(custom_script);
      } catch (e) {
        custom_script.text = js_lines;
        document.body.appendChild(js_lines);
      }

    });

  };

  /*---------------------------------------------
    Slupy Load More
  ---------------------------------------------*/
  $.fn.slupyLoadMore = function() {

    return this.each(function() {

      var _this       = $(this),
          lm_conf     = lm_config,
          _next       = parseInt(lm_conf.next),
          _nextlink   = '',
          _max        = parseInt(lm_conf.max),
          _link       = lm_conf.link,
          _text       = lm_conf.text,
          _loading    = lm_conf.loading,
          _nomore     = lm_conf.nomore,
          _content    = $(lm_conf.content),
          _btn        = $(lm_conf.btn),
          _removelast = lm_conf.removelast,
          _button_conf = {
            change_text :  function() {
              if(_next <= _max) {
                _this.html(_text).removeClass('loadmore-active');
              } else if(_removelast === 'yes') {
                _this.remove();
              } else {
                _this.html(_nomore).addClass('disable-more').removeClass('loadmore-active');
              }
            }
          };

      if(_next <= _max) {
        _btn.html(_text).click(function(e) {
          e.preventDefault();

          if(_this.hasClass('loadmore-active')){
            return;
          }

          if(_next <= _max) {
            _this.html(_loading).addClass('loadmore-active');
            _nextlink = _link.replace(/9999999999/, _next);

            _next++;

            $.ajax({
              url: _nextlink,
              dataType: 'html',
              success: function( data ) {

                var new_page = $(lm_conf.content+' > *',data);
                
                _content.append(new_page);
                $(new_page).css('opacity','0');
                
                if( _content.hasClass('masonry-active') || _content.hasClass('portfolio-items') ){
                  _content.imagesLoaded(function() {
                    _content.isotope( 'appended', new_page ).isotope('layout');
                    _button_conf.change_text.apply();

                    if( _content.hasClass('portfolio-items') ){
                      _content.slupyPortfolio('filter');
                    }else{
                      _content.slupyMasonryBlog('effect');
                    }
                  });
                }else{
                  $(new_page).animate({opacity:1},300);
                  _button_conf.change_text.apply();
                }

                //trigger js
                if (typeof $.fn.mediaelementplayer == 'function') {
                  $('.wp-audio-shortcode, .wp-video-shortcode', new_page).mediaelementplayer();
                }
                $('.wp-video, .ts-video', new_page).slupyWPVideo();
                $('.slupy-slider', new_page).slupyOwlSlider();
                $('.fit-entry-media', new_page).slupyFitVids();
                $('.rev_slider_wrapper', new_page).slupyRevolutionSlider();
                $('.gallery-lightbox .gallery-item a, .gallery-lightbox .owl-item a', new_page).magnificPopup({
                  type: 'image',
                  gallery: {
                    enabled: true
                  }
                });
              }

            });
          }

        });
      }

    });

  };

  /*---------------------------------------------
    Portfolio
  ---------------------------------------------*/
  $.fn.slupyPortfolio = function(method) {

    var _this   = $(this),
        _layout = _this.data('layoutmode'),
        _filter = $('.portfolio-filter-menu'),
        _filter_val = '',
        methods = {

        init : function() {
          _this.imagesLoaded(function() {
            _this.isotope({
                layoutMode: _layout,
                isOriginLeft: !is_slupy_rtl
            }).animate({opacity: 1}, 300);
          });

          if( $.exists(_filter) ) {

          $('body').on('click', '.portfolio-filter-menu a, .portfolio-categories a', function(e) {
            e.preventDefault();

            _filter_val = $(this).data('filter');

            //select filter for mobile devices
            _filter.find('option:selected').removeAttr('selected');
            _filter.find('option[data-filter="'+_filter_val+'"]').attr('selected','selected');

            methods.filter_trigger.apply();

          }).on('change','.portfolio-filter-menu select', function() {

            _filter_val = $(this).find('option:selected').data('filter');
            
            methods.filter_trigger.apply();
          });

          }

          methods.filter.apply();

        },
        filter : function() {

          _filter.find('li').each(function(){
            var _menu_item = $(this),
                _filter = $('a',_menu_item).data('filter');
            if( $.exists(_this.find(_filter)) ){
              _menu_item.removeClass('hidden');
            }else{
              _menu_item.addClass('hidden');
            }
          });

          _filter.animate({opacity: 1}, 300);

        },
        filter_trigger : function() {

          _this.isotope({ filter: _filter_val });
          _filter.find('.activated-filter').removeClass('activated-filter');
          _filter.find('a[data-filter="'+_filter_val+'"]').addClass('activated-filter');
        }
    };

    $('body').on('mouseover', '.portfolio-model-1 .portfolio-item, .portfolio-model-2 .portfolio-item', function(){
      var detail_height = $('.portfolio-short-details',this).outerHeight();
      $('.portfolio-image',this).css('bottom', detail_height+'px');
    }).on('mouseleave', '.portfolio-model-1 .portfolio-item, .portfolio-model-2 .portfolio-item', function(){
      $('.portfolio-image',this).removeAttr('style');
    });

    return this.each(function () {
      if( methods[method] ) {
        return methods[method].apply();
      }else if( typeof method === 'object' || !method ) {
        methods.init.apply();
      }
    });

  };

  /*---------------------------------------------
    Masonry Blog
  ---------------------------------------------*/
  $.fn.slupyMasonryBlog = function(method) {

    var _this   = $(this),
        _effect = _this.data('blogeffect'),
        methods = {
          init : function() {

            imagesLoaded( _this, function() {
              _this.isotope({
                transitionDuration: 0,
                isOriginLeft: !is_slupy_rtl,
                hiddenStyle: {
                  opacity:0
                },
                visibleStyle: {
                  opacity:0
                }
              });
            });

            $window.resize(function() {
              methods.resize.apply();
            });

            methods.effect.apply();

          },
          effect : function() {
            setTimeout(function () {
              _this.find('.type-post').addClass(_effect);
            }, 400);
            setTimeout(function () {
              _this.find('.type-post').addClass('disable-animate');
            }, 2000);
          },
          resize : function() {
            setTimeout(function () {
              _this.isotope('layout');
            }, 400);
          }
    };

    return this.each(function () {
      if( methods[method] ) {
        return methods[method].apply();
      }else if( typeof method === 'object' || !method ) {
        methods.init.apply();
      }
    });

  };

  /*---------------------------------------------
    Parallax BG
  ---------------------------------------------*/
  $.fn.slupyParallax = function() {

    return this.each(function() {

      var _this       = $(this),
          _speed      = parseFloat(_this.data('speed')) || 0.2,
          _offset     = _this.data('offset') || '50%',
          _first      = _this.offset().top;

      // function to be called whenever the window is scrolled or resized
      function update(){
        var pos = $window.scrollTop(),
            top = _this.offset().top,
            height = _this.height();

        // Check if totally above or totally below viewport
        if (top + height < pos || top > pos + windowHeight) {
          return;
        }

        _this.css('backgroundPosition', _offset + " " + Math.round((_first - pos) * _speed) + "px");
      }

      if( !is_device_mobile ) {
        $window.bind('scroll', update).resize(update);
        update();
      }else {
        _this.addClass('is-mobile-background');
      }

    });

  };

  /*---------------------------------------------
    Live Search
  ---------------------------------------------*/
  $.fn.slupyLiveSearch = function() {

    return this.each(function() {

      var _this = $(this),
          _result_content = _this.parent().parent().find('.search-results'),
          live_search,
          ajaxurl = decodeURIComponent(slupyAjax.ajaxurl);

      _this.change(function(){
        if( _this.val().length >= 2 ){

          if( live_search ){
            live_search.abort();
          }

          var data = {
            action: 'slupy_live_search',
            nonce: slupyAjax.nonce,
            s: _this.val()
          };

          live_search = $.get(ajaxurl, data, function(response) {
            _result_content.html(response.data).show();
          });
        }

        if( _this.val() === '' ){
          _result_content.hide();
        }
      }).keyup(function(){
        _this.change();
      });

    });

  };

  /*---------------------------------------------
    Menu Additional
  ---------------------------------------------*/
  $.fn.slupyMenuAdditional = function() {

    return this.each(function() {

      var _this = $(this),
          _back_btn = $('.mobile-menu-content .back-site-content'),
          _menu_item = _this.find('.menu-additional-btn'),
          _menu_content = _menu_item.find('.menu-content');

      _menu_item.click(function(e) {
        e.stopPropagation();

        if( $('body').hasClass('mobile-site-content') ) {
          _back_btn.trigger('click');
        }

        var _btn = $(this);

        if( _btn.hasClass('active-menu-content') ) {
          _btn.removeClass('active-menu-content');
        }else{
          _btn.addClass('active-menu-content').siblings().removeClass('active-menu-content');
        }

      }).bind( "touchstart", function(e){
        e.stopPropagation();
      });

      _menu_content.click( function(e) {
        e.stopPropagation();
      });

      /*$window.scroll(function() {
        $('.menu-additional-btn').removeClass('active-menu-content');
      });*/

      $document.click(function() {
        $('.menu-additional-btn').removeClass('active-menu-content');
      }).bind( "touchstart", function(e){
        $('.menu-additional-btn').removeClass('active-menu-content');
      });

    });

  };

  /*---------------------------------------------
    Contact Form
  ---------------------------------------------*/
  $.fn.slupyContact = function() {

    return this.each(function() {

      var _this     = $(this),
          _btn      = _this.find('.contact-form-submit'),
          _name     = _this.find('input[name="name"]'),
          _email    = _this.find('input[name="mail"]'),
          _subject  = _this.find('input[name="subject"]'),
          _message  = _this.find('textarea[name="message"]'),
          _alertbox = _this.find('.contact-form-response'),
          _allfield = _this.find('.slupy-contact-field'),
          ajaxurl   = decodeURIComponent(slupyAjax.ajaxurl),
          send_contact;

      _btn.click(function(){
        _alertbox.html('');
        _allfield.removeClass('error-field');
        _this.find('span').addClass('button-loading');
        
        if( send_contact ){
          send_contact.abort();
        }

        var data = {
          action: 'slupy_contact_form',
          nonce: slupyAjax.nonce,
          name: _name.val(),
          email: _email.val(),
          subject: _subject.val(),
          message: _message.val()
        };

        send_contact = $.post(ajaxurl, data, function(response) {
          _this.find('span').removeClass('button-loading');
          _alertbox.html(response.message).hide().fadeIn();

          if(response.ID == 1){
            _allfield.val('');
          }
        });

        if( _name.val() === '' ){
          _name.addClass('error-field');
        }
        if( _email.val() === '' ){
          _email.addClass('error-field');
        }
        if( _subject.val() === '' ){
          _subject.addClass('error-field');
        }
        if( _message.val() === '' ){
          _message.addClass('error-field');
        }
      });

    });

  };

  /*---------------------------------------------
    WooCommerce
  ---------------------------------------------*/
  $.fn.slupyWooCommerce = function() {

    return this.each(function() {

      var _this = $(this),
          _slider = _this.find('.product-slider'),
          _thumb_btn = _this.find('.thumbnails a'),
          _images = _this.find('.mcf-gallery .single-product-image');

      _slider.slupyOwlSlider();

      _thumb_btn.click(function(e){
        e.preventDefault();

        var _btn = $(this);

        _thumb_btn.removeClass('active-thumbnail');
        _btn.addClass('active-thumbnail');

        _slider.trigger('to.owl.carousel', [_btn.index(), 500, true]);

      });

      _images.magnificPopup({
        type: 'image',
        gallery: {
          enabled: true
        }
      });
      
    });

  };

  /*---------------------------------------------
    Easy Digital Downloads
  ---------------------------------------------*/
  $.fn.slupyEasyDigitalDownloads = function() {

    return this.each(function() {

      var _this = $(this),
          _items = _this.find('.edd-download-item');

      _items.removeAttr('style');

      imagesLoaded( _this, function() {
        _this.isotope({
          transitionDuration: 0,
          itemSelector: '.edd-download-item',
          isOriginLeft: !is_slupy_rtl
        }).animate({'opacity':'1'},300);

        $window.resize(function() {
          setTimeout(function () {
            _this.isotope('layout');
          }, 400);
        });
      });
      
    });

  };

  /*---------------------------------------------
    Blog Gallery
  ---------------------------------------------*/
  $.fn.slupyBlogGallery = function() {

    return this.each(function() {

      var _this = $(this),
          _item = _this.find('.gallery-item');

      _item.each(function() {
        var _t_item = $(this),
            _caption = _t_item.find('.wp-caption-text');

        if( $.exists(_caption) ){
          _t_item.addClass('gallery-item-has-caption');
        }

      });

      _this.imagesLoaded(function() {
        _this.isotope({
          transitionDuration: 0,
          isOriginLeft: !is_slupy_rtl
        });
      });
      
    });

  };

  /*---------------------------------------------
    Slupy Load More
  ---------------------------------------------*/
  $.fn.slupyLandingPage = function() {

    return this.each(function() {

      var _this = $(this),
          _header = $('#header'),
          _logo = $('#logo'),
          _nav_height = _header.outerHeight(),
          _main_menu = _header.find('.menu'),
          _mobile_menu = $('.mobile-menu-content .menu'),
          _slider_btn = $('.landing-slider a[href^="#"]'),
          _sections = _this.find('[data-section-menu-id]');

      if( $.exists('#wpadminbar') ) {
        _nav_height += 32;
      }

      //Replace menu items url with single landing page
      _sections.each(function() {
        var _s = $(this),
            _id = '#'+_s.attr('id'),
            _menu_item = $('#menu-item-'+_s.data('section-menu-id')+' > a');

        _menu_item.attr('href',_id);

      });

      _main_menu.onePageNav({
        changeHash: true,
        currentClass: 'active-menu-item',
        navItems: 'a[href^="#"]',
        easing: 'easeInOutQuint',
        scrollSpeed: 1800,
        stickyNavHeight: _nav_height,
        scrollThreshold: 0.5,
        scrollChange: function(_list) {
          if( _list.parent().hasClass('sub-menu') ) {
            _list.parents('li.menu-item-has-children').addClass('active-menu-item');
          }
        }
      });

      _mobile_menu.on('click', 'a[href^="#"]', function(e) {
        e.preventDefault();

        var currentPos = $(this).parent().attr('id');
        _main_menu.find('#'+currentPos+' > a').trigger('click');
      });

      _slider_btn.click(function(e) {
        e.preventDefault();
        var _section = $(this).attr('href');
        _main_menu.find('a[href="'+_section+'"]').trigger('click');
      });

      _logo.click(function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop : 0},500);
      });

    });

  };

  /*---------------------------------------------
    IE9 Placeholder
  ---------------------------------------------*/
  $.fn.slupyPlaceHolder = function() {

    return this.each(function() {

      var _this     = $(this),
          _text     = _this.attr('placeholder');

      _this.attr('value', _text).focus(function() {
        if (_this.val() == _text){ 
          _this.val('');
        }
      }).blur(function() {
        if (_this.val() == ''){
          _this.val(_text);
        }
      });
      
    });

  };

  /*---------------------------------------------
    Selectbox wrapper
  ---------------------------------------------*/
  $.fn.slupySelectWrap = function() {

    return this.each(function() {

      var _this     = $(this),
          _wrap     = _this.parent();

      if( !_wrap.hasClass('select-wrapper') ) {
        _this.wrap('<div class="select-wrapper"></div>');
      }
      
    });

  };

  /*---------------------------------------------
    CSS Animation
  ---------------------------------------------*/
  $.fn.slupyAnimate = function() {

    return this.each(function() {

      var _this = $(this),
          _extra;

      _this.waypoint(function() {

        if( _this.hasClass('slupy-fadein') ) {
          _extra = 'fadeIn';
        }else if( _this.hasClass('slupy-fadeindown') ) {
          _extra = 'fadeInDown';
        }else if( _this.hasClass('slupy-fadeinup') ) {
          _extra = 'fadeInUp';
        }else if( _this.hasClass('slupy-fadeinleft') ) {
          _extra = 'fadeInLeft';
        }else{
          _extra = 'fadeInRight';
        }

        _this.addClass('slupy-animated ' + _extra);
      },{offset: '85%'});
      
    });

  };

  /*---------------------------------------------
    Transparent Header
  ---------------------------------------------*/
  $.fn.slupyTransparentHeader = function(method) {

    var _this     = $(this),
        _header   = $('#header'),
        _pheader  = $('#page-header'),
        _slider   = _pheader.find('.rev_slider_wrapper'),
        _height,
        methods   = {
          init : function() {

            $window.resize(function() {
              methods.resize.apply();
            });

            methods.resize.apply();

          },
          resize : function() {
            if( !_header.hasClass('.sticky-header') ){
              _height = _header.outerHeight();

              _pheader.css({'padding-top':_height, 'margin-top': (_height * -1)});
              _slider.css({'margin-top': (_height * -1)});
            }
          }
    };

    return this.each(function () {
      if( methods[method] ) {
        return methods[method].apply();
      }else if( typeof method === 'object' || !method ) {
        methods.init.apply();
      }
    });

  };

  /*---------------------------------------------
    Feature Box
  ---------------------------------------------*/
  $.fn.tsFeatureBox = function() {

    return this.each(function() {

      var _this           = $(this),
          _content        = _this.find('.ts-box-details'),
          _content_left   = _this.outerWidth() - _content.outerWidth(),
          _trigger        = is_device_mobile ? 'click' : _this.data('trigger'),
          _desc           = _this.find('.ts-feature-desc'),
          _slider_content = _this.find('.ts-box-slider'),
          _owl_slider     = _this.find('.ts-fb-slider'),
          _autoplay       = _owl_slider.data('autoplay'),
          _time           = parseInt(_owl_slider.data('time')),
          _height         = _this.outerHeight(),
          _padding        = _this.find('.ts-box-icon').outerHeight() / 2;

      if( _content.html() != '' ) {

        $(_this).on(_trigger, function(e) {
          e.preventDefault();

          _height = _this.outerHeight();
          _content_left = _this.outerWidth() - _content.outerWidth();

          if( _content_left < 0 ) {
            _content.css('left', _content_left / 2);
          } else {
            _content.css('left', '0');
          }

          _this.addClass('show-feature-box');

          _slider_content.css('padding-bottom',_height - _padding);
          if( _content.html() != '' ) {
            _content.addClass('ts-box-detail-visible');

            if( !_owl_slider.hasClass('ts-slider') ) {
              _owl_slider.addClass('ts-slider').slupyOwlSlider();
            }else if( _autoplay == 'on' ) {
              _owl_slider.trigger('play.owl.autoplay',[_time,300]);
            }

            _content.animate({opacity : 1}, 300);
          }

          $window.resize();
        }).on('mouseleave',function(){
          if( _autoplay == 'on' ) {
            _owl_slider.trigger('stop.owl.autoplay');
          }

          _content.animate({opacity: 0}).removeClass('ts-box-detail-visible');
          _this.removeClass('show-feature-box');
        });

      }
      
    });

  };

  /*---------------------------------------------
    Social Tooltip
  ---------------------------------------------*/
  $.fn.tsSocial = function() {

    return this.each(function() {

      var _this = $(this),
          _tooltip = _this.parent().find('.ts-social-tooltip'),
          _title = _this.data('title');

      _this.mouseover(function(){
        _tooltip.text(_title).stop().animate({opacity:1},300);
      }).mouseleave(function(){
        _tooltip.stop().animate({opacity:0},300);
      });
      
    });

  };

  /*---------------------------------------------
    Pie Charts
  ---------------------------------------------*/
  $.fn.tsPieChart = function() {

    return this.each(function() {

      var _this = $(this),
          _color = _this.data('barcolor'),
          _trackcolor = _this.data('trackcolor') || '#dcdde0',
          _content = _this.parent(),
          _tooltip = _content.hasClass('ts-charts-tooltip') ? true : false,
          _title = _this.find('.ts-skill-title'),
          _animation = _content.data('animated') === 'on' ? 1000 : false,
          _size = _content.data('size'),
          _trigger = _content.data('trigger');

      function init_ts_pie() {
        _this.easyPieChart({
          barColor : _color,
          trackColor: _trackcolor,
          lineCap: 'square',
          lineWidth: 6,
          animate: _animation,
          size: _size,
          scaleColor: false,
          onStep: function(from, to, percent) {
              _this.find('.ts-chart-percent').text(Math.round(percent));
          }
        }).css("opacity","1");

        if( _tooltip ){
          _this.on(_trigger, function(){
            _title.stop().fadeToggle();
          }).on("mouseleave", function(){
            _title.fadeOut();
          });
        }
      }

      if( _animation ) {
        _this.waypoint(function() {
          init_ts_pie();
        },{offset: '95%'});

      }else {
        init_ts_pie();
      }
      
    });

  };

  /*---------------------------------------------
    Progress Bars
  ---------------------------------------------*/
  $.fn.tsProgressBars = function() {

    return this.each(function() {

      var _this = $(this),
          _percentage = _this.data('percentage')+'%',
          _speed = _this.data('percentage') * 20,
          _bar = _this.find('.ts-bar-color'),
          _animation = _this.parent().data('animated') === 'on' ? true : false;

      if( _animation ){
        _this.waypoint(function() {
          _bar.animate({width: _percentage},_speed,'easeOutQuint');
        },{offset: '95%'});
      }else{
        _bar.css('width',_percentage);
      }
      
    });

  };

  /*---------------------------------------------
    Milestone
  ---------------------------------------------*/
  $.fn.tsMilestone = function() {

    return this.each(function() {

      var _this     = $(this),
          _options  = {
            useEasing : true, 
            useGrouping : true, 
            separator : _this.data('separator') == 'on' ? ',' : '',
            decimal : '.'
          },
          _duration = _this.data('duration') || 3.5,
          _decimals = _this.data('decimals') || 0,
          _start    = _this.data('start'),
          _end      = _this.data('end'),
          _control  = true;

      _this.waypoint(function() {
        if( _control ) {
          _control = false;
          var numAnim = new countUp(this, _start, _end, _decimals , _duration, _options);
          numAnim.start();
        }
        
      },{offset: '95%'});
      
    });

  };

  /*---------------------------------------------
    CountDown
  ---------------------------------------------*/
  $.fn.tsCountDown = function() {

    return this.each(function() {

      var _this     = $(this),
          _date     = new Date(_this.data('date')),
          _timezone = _this.data('timezone') || null,
          _labels   = _this.data('labels') ? _this.data('labels').split(',')  : ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'],
          _labels1  = _this.data('labels1') ? _this.data('labels1').split(',') : ['Year', 'Month', 'Week', 'Day', 'Hour', 'Minute', 'Second'],
          _digits   = _this.data('digits') ? _this.data('digits').split(',') : ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
          _format   = _this.data('format') || 'YOWDHMS';

      _this.countdown({
        until     : _date,
        timezone  : _timezone,
        labels    : _labels,
        labels1   : _labels1,
        digits    : _digits,
        format    : _format
      });
      
    });

  };

  /*---------------------------------------------
    Tabs
  ---------------------------------------------*/
  $.fn.tsTabs = function() {

    return this.each(function() {

      var _this = $(this),
          _trigger = _this.data('trigger'),
          _buttons = _this.find('.ts-tab-nav li'),
          _content = _this.find('.ts-tab-content'),
          _active_tab = _this.find('.ts-tab-nav .ts-current-tab').index();

      if( _active_tab == -1 ){
        _active_tab = 0;
        _buttons.first().addClass('ts-current-tab');
        _content.first().show();
      }else{
        _content.eq(_active_tab).show();
      }

      _buttons.on(_trigger, function(e) {
        e.preventDefault();

        var _btn = $(this);

        if( _active_tab != _btn.index() ){

          _active_tab = _btn.index();
          _buttons.removeClass('ts-current-tab');
          _btn.addClass('ts-current-tab');
          _content.hide().eq(_active_tab).fadeIn();

        }

      }).on('click', 'a', function(e) {
        e.preventDefault();
      });
      
    });

  };

  /*---------------------------------------------
    Accordions
  ---------------------------------------------*/
  $.fn.tsAccordions = function() {

    return this.each(function() {

      var _this = $(this),
          _buttons = _this.find('.ts-accordion-button'),
          _collapsible = _this.data('collapsible'),
          _active_tab = _this.find('.ts-active-accordion .ts-accordion-content'),
          _activated = _this.find('.ts-active-accordion').first().index(),
          _contents = _this.find('.ts-accordion-content'),
          _trigger = _this.data('trigger');

      _active_tab.show();

      _buttons.on(_trigger, function(e){
        e.preventDefault();

        var _btn = $(this),
            _accordion = _btn.parents('.ts-accordion'),
            _content = _btn.parent().find('.ts-accordion-content');

        if( _accordion.hasClass('ts-active-accordion') && _collapsible === 'on'  ){
                
          _content.slideToggle(400);
          _accordion.removeClass('ts-active-accordion');

        }else if( !_accordion.hasClass('ts-active-accordion') ){

          _contents.slideUp(400).parents('.ts-accordion').removeClass('ts-active-accordion');
          _accordion.addClass('ts-active-accordion');
          _content.slideToggle();

        }

      });

    });

  };

  /*---------------------------------------------
    Photo Stream
  ---------------------------------------------*/
  $.fn.tsPhotoStream = function() {

    return this.each(function() {

      var _this = $(this),
          _images = _this.find('img');

      _this.magnificPopup({
        delegate: 'a[data-gallery="photostream"]',
        gallery: {
          enabled: true
        },
        type: 'image'
      });

      _images.each(function() {

        var _image = $(this);

        _image.imagesLoaded(function() {

          var _width = _image.width(),
              _height = _image.height();

          if( _width < _height ){
            _image.css({width: '101%',height:'auto'});
          }

          _image.parent().css('opacity','1');

        });

      });
      
    });

  };

  /*---------------------------------------------
    Media Player
  ---------------------------------------------*/
  $.fn.tsMediaPlayer = function() {

    return this.each(function() {

      var _this = $(this).find('video');
      _this.mediaelementplayer();
      
    });

  };

  /*---------------------------------------------
    Buttons
  ---------------------------------------------*/
  $.fn.tsButtons = function() {

    return this.each(function() {

      var _this     = $(this),
          _left_w   = _this.find('.ts-button-left').outerWidth(),
          _right_w  = _this.find('.ts-button-right').outerWidth();

      if( _right_w > _left_w ) {
        _left_w = _right_w;
      }

      _this.css('width', (_left_w * 2) + 'px' ).addClass('ts-buttons-init');
      
    });

  };

  /*---------------------------------------------
    Call Plugins
  ---------------------------------------------*/
  $(document).ready(function(){
    
    $('#header .menu-item-has-children').slupyMainMenu();
    $('.mobile-menu-content').slupyMobileMenu();
    $('.sticky-menu-active #header').slupyStickyMenu();
    $('.slupy-articles.masonry-active').slupyMasonryBlog();
    $('.slupy-loadmore-link').slupyLoadMore();
    $('.portfolio-items').slupyPortfolio();
    $('.portfolio-carousel, .ts-clients-carousel').slupyOwlCarousel();
    $('.slupy-slider, .ts-slider, .ts-testimonials').slupyOwlSlider();
    $('.back-site-top').slupyBackTop();
    $('.fit-entry-media, .ts-fitvids, .entry-content').slupyFitVids();
    $('.section-bgvideo').slupyFitVideo();
    $('.wp-video, .ts-video').slupyWPVideo();
    $('[data-parallax="background"]').slupyParallax();
    $('#live-search').slupyLiveSearch();
    $('.menu-additional').slupyMenuAdditional();
    $('.slupy-landing-page').slupyLandingPage();
    $('.slupy-contact-form').slupyContact();
    $('.woocommerce, .woocommerce-page').slupyWooCommerce();
    $('.gallery').slupyBlogGallery();
    $('.no-placeholder input[placeholder]').slupyPlaceHolder();
    $('.edd-select, select.gfield_select, .country-wrap select, .list-dropdown-wrap select,.woocommerce select, .woocommerce-page select, .slupy-widget select, .wpcf7-select, #bbpress-forums select').slupySelectWrap();
    $('.slupy-fadein, .slupy-fadeindown, .slupy-fadeinup, .slupy-fadeinleft, .slupy-fadeinright').slupyAnimate();
    
    $('.edd-downloads-wrap').slupyEasyDigitalDownloads();
    $('.slupy-transparent-header').slupyTransparentHeader();

    $('.ts-feature-box').tsFeatureBox();
    $('.ts-social a[data-title]').tsSocial();
    $('.ts-chart').tsPieChart();
    $('.ts-bar').tsProgressBars();
    $('.ts-tabs').tsTabs();
    $('.ts-accordions').tsAccordions();
    $('.ts-photostream').tsPhotoStream();
    $('.ts-video').tsMediaPlayer();
    $('.ts-buttons').tsButtons();
    $('.ts-milestone-number').tsMilestone();
    $('.ts-countdown').tsCountDown();

    $('.single .format-image-media, .edd-downloads-media .edd-download-img').magnificPopup({type: 'image'});
    $('.mgf-modal').magnificPopup({type: 'inline'});
    $('.gallery-lightbox .gallery-item a, .gallery-lightbox .owl-item a').magnificPopup({
      type: 'image',
      gallery: {
        enabled: true
      }
    });

    /*---------------------------------------------
        AlertBoxes Close Button
    ---------------------------------------------*/
    $('body').on('click', '.ts-alertbox-close',function(){

      var _this = $(this).parent();

      _this.slideUp('normal',function(){
        _this.remove();
      });
    });


    $('body').on('focus', '.wpcf7-not-valid', function(){

      var _this = $(this),
          _remove = _this.parents('.wpcf7-form-control-wrap').find('.wpcf7-not-valid-tip');

      _this.removeClass('wpcf7-not-valid');
      _remove.remove();

    });

  });

}(jQuery, window, document));