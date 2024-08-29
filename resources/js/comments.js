$(document).ready(function() {
    $('.reply-btn').click(function(event) {
        event.preventDefault();
        
        var idParent = $(this).data('parent');

        $('input[name="id_parent"]').val(idParent);

        $('html, body').animate({
            scollTop:$('.replay-box').offset().top
        }, 500);
    });
})