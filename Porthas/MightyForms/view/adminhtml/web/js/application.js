require([
    'jquery'
], function ($) {
    $(document).ready(function () {

        jQuery('#mightyforms').css('height', jQuery(window).height());

        $(window).on('message', function (e) {

            let rawData = e.originalEvent.data;

            try {
                if (typeof rawData !== 'string') return;

                let post = JSON.parse(rawData);

                if ('userApiKey' === post.message) {
                    console.log('This is key:', post.data);

                    var customurl = "<?php echo $this->getUrl().'frontname/index/index'?>";
                    $.ajax({
                        url: customurl,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            customdata1: 'test1',
                            customdata2: 'test2',
                        },
                        complete: function(response) {
                            country = response.responseJSON.default_country;
                            state = response.responseJSON.state;
                            console.log(state + ' ' + country);
                        },
                        error: function (xhr, status, errorThrown) {
                            console.log('Error happens. Try again.');
                        }
                    });
                }
            } catch (err) {
                console.error(err);
            }
        });
    });
})