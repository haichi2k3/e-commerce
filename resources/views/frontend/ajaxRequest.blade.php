

<script>
  $(document).ready(function () {

    //vote
    $('.ratings_stars').hover(
        // Handles the mouseover
        function () {
            $(this).prevAll().andSelf().addClass('ratings_hover');
            // $(this).nextAll().removeClass('ratings_vote'); 
        },
        function () {
            $(this).prevAll().andSelf().removeClass('ratings_hover');
            // set_votes($(this).parent());
        }
    );

    $('.ratings_stars').click(function () {
        var checkLogin = "{{Auth::check()}}";
        if(checkLogin == true) {
            var ratingValue = $(this).find("input").val();
            alert(ratingValue); // Kiểm tra giá trị
    
            if ($(this).hasClass('ratings_over')) {
                $('.ratings_stars').removeClass('ratings_over');
                $(this).prevAll().andSelf().addClass('ratings_over');
            } else {
                $(this).prevAll().andSelf().addClass('ratings_over');
            }
    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            $.ajax({
                type: 'POST',
                url: "{{ url('/blog/rate')}}",
                data: {
                    ratingValue: ratingValue,
                    id_blog: '{{$blog->id}}', 
                }, 
    
                success: function (response) {
                    console.log(response.message);
                },
    
                error: function () {
                    console.error('Yêu cầu thất bại.');
                }
            });
        } else {
            alert('Bạn chưa đăng nhập');
        }

    });

    var avgRate = '{{ $avgRate ?? 0 }}'; 

    var roundedAvgRate = Math.round(avgRate);
    $('.ratings_stars').removeClass('ratings_over'); 
    $('.ratings_stars:lt(' + roundedAvgRate + ')').addClass('ratings_over');

    
});
</script>
