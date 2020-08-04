$("input[name='sick1']").click(function () {
        if ($(this).is(':checked')) {
        $(this).parent().siblings().children().attr("disabled", true);
    } else {
        $(this).parent().siblings().children().attr("disabled", false);
    }
});
