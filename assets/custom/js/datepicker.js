var ComponentsDateTimePickers = function() {
    var t = function() {
            jQuery().datepicker && $(".date-picker").datepicker({
                rtl: App.isRTL(),
                orientation: "bottom",
                autoclose: !0,
                format: 'dd-mm-yyyy',
                }), $(document).scroll(function() {
                    $("#form_input_user .date-picker").datepicker("place")
            });
        },
        f = function() {
            jQuery().datepicker && $(".date-picker-from").datepicker({
                rtl: App.isRTL(),
                orientation: "bottom",
                autoclose: !0,
                format: 'dd-mm-yyyy',
                 minDate: new Date(2009, 10 - 1, 25),

                }), $(document).scroll(function() {
                    $("#form_input_user .date-picker-from").datepicker("place")
            });
        },
        to = function() {
            jQuery().datepicker && $(".date-picker-to").datepicker({
                rtl: App.isRTL(),
                orientation: "bottom",
                autoclose: !0,
                 format: 'dd-mm-yyyy',
                }), $(document).scroll(function() {
                    $("#form_input_user .date-picker-to").datepicker("place")
            });
        };
    return {
        init: function() {
            t(),f(),to()
        }
    }
}();
App.isAngularJsApp() === !1 && jQuery(document).ready(function() {
    ComponentsDateTimePickers.init()
});