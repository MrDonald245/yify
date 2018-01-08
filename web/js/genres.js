$(document).ready(function() {
    $('#genres_form').submit(function(event) {
        event.preventDefault();

        var checkbox_values = {};
        var ccc = [];
        var weburl = weburl = $(location).attr('pathname');

        checkbox_values.genre = [];
        $('#genres_form input:checkbox:checked').each(function() {
            checkbox_values.genre.push($(this).val());
        });

        $.each(checkbox_values, function(key, value) {
            if (!$.isEmptyObject(value)) {
                ccc.push({name: key, value: value.join('-')});
            }
        });

        var get_values = decodeURIComponent($.param(ccc));
        if (get_values) {
            get_values = '/'+get_values;
        }
        var new_values = get_values.replace('genre=','');

        $(location).attr('href', weburl+new_values);

    });
});
$(document).ready(function(){
    $("input[type=button]").click(function() {
        $('#genres_form').find(':checked').each(function() {
            $(this).removeAttr('checked');
        });
    });
});