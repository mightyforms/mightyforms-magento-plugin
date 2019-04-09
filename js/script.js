
let $ = jQuery;

$(document).on('ready', () => {

    $(document).ready( function () {
        $('#user_forms').DataTable();
    } );

    $('iframe').css('height', jQuery(window).height());
});