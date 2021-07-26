$(document).ready(() => {
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 1){
           $('.nav-menu').addClass("scrolled");
        } else {
           $('.nav-menu').removeClass("scrolled");
        }
     });

    $("#live_search").on('keyup', function() {
        var query = $(this).val();
        if (query != "") {
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#search_result').html(data);
                    $('#search_result').css('display', 'block');
                }
            });
        } else {
            $('#search_result').css('display', 'none');
        }
    });

    $('.reset').on('click', () => {
        $('#live_search').val('');
        $('#search_result').css('display', 'none');
    });

    $('.back').on('click', () => {
        history.back();
    });
});