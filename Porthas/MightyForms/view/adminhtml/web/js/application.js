
require(['jquery'], function($){
    jQuery(document).ready( function() {

        // $(document).ready( function () {
        //     $('#user_forms').DataTable();
        // } );

        jQuery('#mightyforms').css('height', jQuery(window).height());

        $(window).on('message', function (e) {

            let rawData = e.originalEvent.data;

            try {
                if (typeof rawData !== 'string') return;

                let post = JSON.parse(rawData);

                if ('userApiKey' === post.message) {
                    // $.post(
                    //     ajaxurl, {
                    //         action: 'upsert_user_api_key',
                    //         userApiKey: post.data
                    //     }, function (response) {
                    //         if (!response.success) {
                    //             alert(response.message)
                    //         }
                    //     });
                }
            } catch (err) {
                console.error(err);
            }
        });
    });
});