$(document).ready(function () {

    var user_href, user_href_splitted, user_id;
    var img_src, img_src_splitted, img_name;

    // MODAL

    $('.modal_thumbnails').click(function () {

        $('#set_user_image').prop('disabled', false);

        user_href = $('#user_id').prop('href');
        user_href_splitted = user_href.split('=');
        user_id = user_href_splitted[user_href_splitted.length - 1];

        img_src = $(this).prop('src');
        img_src_splitted = img_src.split("/");
        img_name = img_src_splitted[img_src_splitted.length - 1];

    });

    $('#set_user_image').click(function () {

        $.ajax({
            url: 'includes/ajax_code.php',
            data:{img_name: img_name, user_id: user_id},
            type: "POST",
            success: function (data) {
                if (!data.error) {
                    $(".user_image_box a img").prop('src', data);
                }
            }
        })

    });

    // PHOTO DETAILS(EDIT PHOTO)

    $('#toggle').click(function () {
        $('.box-inner').toggle();
        $("#toggle").toggleClass("glyphicon-menu-down glyphicon-menu-up")
    })
});