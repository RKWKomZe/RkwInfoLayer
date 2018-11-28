var RKWInfolayer = RKWInfolayer || {};

RKWInfolayer.Handle = (function ($) {

	var $infoLayer;
    var $infoLayerContent;
	var _infoLayerId = 'rkw-infolayer';

	var _init = function(){
		$(document).ready(_onReady);
	};

	var _onReady = function(){
		$infoLayer = $('#'+_infoLayerId);
        $infoLayerContent = $('#'+_infoLayerId + '-content');
		_checkLayerStatus();

	};

	var _checkLayerStatus = function(){

		var cookieAccepted = 0;
		if ($.cookie('rkw-infolayer')) {
			cookieAccepted = 1;
		}

        // check for data attribute
        var url = '/?type=1417609477&v=' + jQuery.now();
        if ($infoLayer.attr('data-url')) {
            if($infoLayer.attr('data-url').indexOf('?') === -1){
                url =  $infoLayer.attr('data-url') + '?v=' + jQuery.now();
            } else {
                url = $infoLayer.attr('data-url') + '&v=' + jQuery.now();
            }
        }

        $.ajax({
			url: url,
			data: {
				'tx_rkwinfolayer_infolayer[controller]': 'Infolayer',
				'tx_rkwinfolayer_infolayer[action]': 'content',
				'tx_rkwinfolayer_infolayer[cookie]': cookieAccepted
			},
			success: function (data) {
				if (data.data){
                    $infoLayerContent.html(data.data);
                    $infoLayer.on('click', '#'+_infoLayerId + '-close', _updateLayerStatus);
                    $infoLayer.on('click', '#'+_infoLayerId + '-agree', _setAgreeCookie);
                    $infoLayer.addClass('show');
				}
			},
			dataType: 'json'
		});
	};

	var _updateLayerStatus = function(e){
		e.preventDefault();
		$infoLayer.removeClass('show');

        // check for data attribute
        var url = '/?type=1417609477&v=' + jQuery.now();
        if ($infoLayer.attr('data-url')) {
            if($infoLayer.attr('data-url').indexOf('?') === -1){
                url =  $infoLayer.attr('data-url') + '?v=' + jQuery.now();
            } else {
                url = $infoLayer.attr('data-url') + '&v=' + jQuery.now();
            }
        }

		$.ajax({
			url: url,
			data: {
				'tx_rkwinfolayer_infolayer[controller]': 'Infolayer',
				'tx_rkwinfolayer_infolayer[action]': 'dismiss'
			},
			success: function (data) {},
			dataType: 'json'
		});

	};

	var _setAgreeCookie = function(e){
        e.preventDefault();
        $infoLayer.removeClass('show');
		$.cookie('rkw-infolayer', 1, {
			expires : 365,           	// expires in 365 days
			path    : '/',          	// The value of the path attribute of the cookie (default: path of page that created the cookie).
			// domain  : 'jquery.com',  // The value of the domain attribute of the cookie (default: domain of page that created the cookie).
			// secure  : true           // If set to true the secure attribute of the cookie will be set and the cookie transmission will require a secure protocol (defaults to false).
		});
	};

	/**
	 * Public interface
	 * @public
	 */
	return {
		init: _init,
		updateLayerStatus: _updateLayerStatus,
		setAgreeCookie : _setAgreeCookie
	}

})(jQuery);

RKWInfolayer.Handle.init();
