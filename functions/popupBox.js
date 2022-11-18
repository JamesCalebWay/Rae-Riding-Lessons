// Student Name: James Caleb Way
// Program Name: Rae Riding Lessons
// Creation Date: 9/17/2022
// Last Modified Date: 11/9/2022
// CSCI Course: CSCI 495
// Grade Received: TBA
// Design Comments: Created by Karina Quick

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
