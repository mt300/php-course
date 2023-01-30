$( document ).ready(function() {
    $("#search").keyup( function () {
        var search = $(this).val();
        if(search !== ""){
            // console.log(search + " diferente de empty")
            $.ajax({
                url: $('form').attr('data-url-search'),
                method: 'POST',
                data: {
                    search: search
                },
                success: function (data) {
                    $('#search-result').html(data);
                    $('#search-result').css('display','block')
                }
            });
        } else {
            // console.log(search)
            $('#search-result').css('display','none')
        }
    });
});