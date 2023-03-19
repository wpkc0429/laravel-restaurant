$(document).ready(function() {
    $('.select2').select2({
        width: '100%',
        theme: 'bootstrap4',
        language: 'zh-TW',
        maximumInputLength: 10,
        minimumInputLength: 0,
        language: {
            noResults: function(){
            return "查無結果";
            },
            inputTooShort: function(args) {
            return "";
            },
            inputTooLong: function(args) {
            return "關鍵字過長";
            },
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });
});