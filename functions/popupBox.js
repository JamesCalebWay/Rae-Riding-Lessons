// got popup box from https://html-online.com/articles/simple-popup-box/

$(window).load(function () {
	$(".trigger_popup_fricc").click(function() {
		$('.hover_bkgr_fricc').show();
	});
	$('.hover_bkgr_fricc').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
});