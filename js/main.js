$(".change_likes").submit(function (e)
{
    e.preventDefault();
    let th = $(this);
    var likes = $("#likes");
    var id = $("#id");
    let btn = th.find('#btn_like');
    $.ajax({
        url: 'php/change_likes.php',
        type: "POST",
        cache: false,   
        data: th.serialize(),
        success: function(data) {
            th.find(".output_likes").text(data);
            btn.addClass('active');
        },
        error: function(){
            alert('Error');
        }
    });
});

