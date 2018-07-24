$(function() {
    $('.critic-report-link').each(function() {
        $(this).click(function(event) {
            event.preventDefault();
            $.ajax({
                context: this,
                url: $(this).attr('href'),
                data: {}
            })
                .done(function(data) {
                    $(this).text(data.message);
                    $(this).addClass('disabled-link');
                })
                .fail(function(jqXHR, textStatus) {
                    console.log("Request failed: "+textStatus);
                });
        });
    });
});