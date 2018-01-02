$(document).ready(function() {
    $('#year_form').submit(function(event) {
        event.preventDefault();

        var checkbox_values = {};
        var ccc = [];
        var weburl = weburl = $(location).attr('pathname');

        checkbox_values.years = [];
        $('#year_form input:checkbox:checked').each(function() {
            checkbox_values.years.push($(this).val());
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
        var new_values = get_values.replace('years=','');

        $(location).attr('href', weburl+new_values);

    });
});

$(document).ready(function(){
    $("input[type=button]").click(function() {
        $('#year_form').find(':checked').each(function() {
            $(this).removeAttr('checked');
        });
    });
});

$(function() {
    $( "#tabs" ).tabs();
});
$(document).ready(function() {
    $( "#help" ).dialog({
        autoOpen: false,
        show: {
            effect: "fade",
            duration: 300
        },
        hide: {
            effect: "fade",
            duration: 300
        },

        clickOutside: true,
        clickOutsideTrigger: ".help"
    });

    $('.help').click(function() {
        if ($('#help').is(":hidden")) {
            $('#help').dialog('open');
        } else {
            $('#help').dialog('close');
        }
    });
});

$.widget( "ui.dialog", $.ui.dialog, {
    options: {
        clickOutside: false,
        clickOutsideTrigger: ""
    },

    open: function() {
        var clickOutsideTriggerEl = $( this.options.clickOutsideTrigger );
        var that = this;

        if (this.options.clickOutside){
            $(document).on( "click.ui.dialogClickOutside" + that.eventNamespace, function(event){
                if ( $(event.target).closest($(clickOutsideTriggerEl)).length == 0 && $(event.target).closest($(that.uiDialog)).length == 0){
                    that.close();
                }
            });
        }
        this._super();
    },

    close: function() {
        var that = this;
        $(document).off( "click.ui.dialogClickOutside" + that.eventNamespace );
        this._super();
    },
});