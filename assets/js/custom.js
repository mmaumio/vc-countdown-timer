jQuery(document).ready(function () {

    // Countdown js
    if (jQuery('#countdown_dashboard').length) {

        var day = jQuery('.days_dash').data('day');
        var month = jQuery('.hours_dash').data('month');
        var year = jQuery('.minutes_dash').data('year');

        jQuery('#countdown_dashboard').countDown({
            targetDate: {
                'day': day,
                'month': month,
                'year': year,
                'hour': 0,
                'min': 0,
                'sec': 0
            },
        });

        var digitColor = jQuery('.event-countdown .digit').data('digit-color');
        if (digitColor) {
            jQuery('.event-countdown .digit').css('color', function () {
                return digitColor;
            });
        }

        var borderColor = jQuery('.event-countdown .time-number').data('border-color');
        jQuery('.event-countdown .time-number').css('border-color', function () {
            return borderColor;
        });
    }

});
