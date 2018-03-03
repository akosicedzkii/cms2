var yearAutofill = function() {
    var $dateGroup = $('.date-autofill');
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();

    $dateGroup.each(function() {
        var $year = $(this).find('.date-year');

        for (var ycount = currentYear; ycount >= currentYear - 100; ycount--) {
            $year.append('<option value="' + ycount + '">' + ycount + '</option>');
        }
    });
}

var dayAutofill = function($day, month, year) {
    var days;

    switch (month) {
        case '01':
        case '03':
        case '05':
        case '07':
        case '08':
        case '10':
        case '12':
            days = 31;
            break;
        case '2':
            if (year % 2 === 0) {
                days = 29;
            } else {
                days = 28;
            }
            break;
        default:
            days = 30;
            break;
    }
    $day.html('<option value="default">DD</option>');
    for (var dcount = 1; dcount <= days; dcount++) {
        if(dcount <= 9)
        {
            dcount = "0" + dcount;
        }
        $day.append('<option value="' + dcount + '">' + dcount + '</option>');
    }
}

$(document).ready(function() {
    yearAutofill();

    $('.date-month').on('change', function(e) {
        var $day = $(this).siblings('.date-day');
        var month = $(this).val();
        var year = $(this).siblings('.date-year').val();

        dayAutofill($day, month, year);

        $day.prop('disabled', false)
    });

    $('.date-year').on('change', function() {
        var $month = $(this).siblings('.date-month');
        var $day = $(this).siblings('.date-day');
        var year = $(this).val();
        var month = $month.val();

        if(month !== 'default') {
        	dayAutofill($day, month, year);
        }

        $month.prop('disabled', false);
    });
});