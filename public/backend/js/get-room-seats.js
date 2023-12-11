$(".room").on('change', function (e) {
    var roomId = $(this).val();
    var url = $('#url').val();
    var formData = {
        id: roomId,
    }

    $.ajax({
        type: "GET",
        dataType: 'json',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/dormitory/room/get-room-seat',
        success: function (data) {
            
            var seat_options = '';
            var seat_li = '';

            for (var i = 0; i < data.type.total_seat; i++) {
                var item = i + 1;
                seat_options += "<option value=" + item + ">" + item
                    + "</option>";
                seat_li += "<li data-value=" + item + " class='option'>" +
                    item + "</li>";
            };

            $("select.seat option").not(':first').remove();
            $("select.seat").append(seat_options);

            $("div .seat .current").html($("div .seat .list li:first").html());
            $("div .seat .list li").not(':first').remove();
            $("div .seat .list").append(seat_li);
        },
        error: function (data) {
            console.log(data);
        }
    });
});
