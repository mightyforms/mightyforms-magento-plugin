
let $ = jQuery;

$(document).on('ready', () => {

    $(document).ready( function () {
        $('#user_forms').DataTable();
    } );

	let app = {
		myForms: $('.my-forms'),
		formsBox: $('.forms-box'),
		application: $('.application'),
		applicationBox: $('.application-box')
	};

    $('iframe').css('height', jQuery(window).height());

    $('.tabs .my-forms').on('click', () => {

		app.myForms.addClass('active');
		app.application.removeClass('active');
		app.applicationBox.css('display', 'none');
		app.formsBox.css('display', 'block');

    });


    $('.tabs .application').on('click', () => {

		app.myForms.removeClass('active')
		app.formsBox.css('display', 'none');
		app.application.addClass('active');
		app.applicationBox.css('display', 'block');
	});
});