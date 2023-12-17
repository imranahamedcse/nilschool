$(".dormitory").on('change', function (e) {
    var dormitoryId = $(this).val();
    var url = $('#url').val();
    var formData = {
        id: dormitoryId,
    }

    $.ajax({
        type: "GET",
        dataType: 'json',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/dormitory/setup/get-dormitory-room',
        success: function (data) {
            var room_options = '';
            var room_li = '';

            $.each(data.rooms, function (i, item) {
                room_options += "<option value=" + item.room.id + ">" + item
                    .room.room_no + "</option>";
                room_li += "<li data-value=" + item.room.id + " class='option'>" +
                    item.room.room_no + "</li>";
            });

            $("select.room option").not(':first').remove();
            $("select.room").append(room_options);

            $("div .room .current").html($("div .room .list li:first").html());
            $("div .room .list li").not(':first').remove();
            $("div .room .list").append(room_li);
        },
        error: function (data) {
            console.log(data);
        }
    });
});
