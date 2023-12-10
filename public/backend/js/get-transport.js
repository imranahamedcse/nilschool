$(".route").on('change', function (e) {
    var routeId = $(this).val();
    var url = $('#url').val();
    var formData = {
        id: routeId,
    }
    $.ajax({
        type: "GET",
        dataType: 'json',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/transport/setup/get-vehicle-pickup-point',
        success: function (data) {

            var vehicle_options = '';
            var vehicle_li = '';

            $.each(data.vehicles, function(i, item) {
                vehicle_options += "<option value=" + item.vehicle.id + ">" + item
                    .vehicle.name + "</option>";
                vehicle_li += "<li data-value=" + item.vehicle.id + " class='option'>" +
                    item.vehicle.name + "</li>";
            });

            $("select.vehicle option").not(':first').remove();
            $("select.vehicle").append(vehicle_options);

            $("div .vehicle .current").html($("div .vehicle .list li:first").html());
            $("div .vehicle .list li").not(':first').remove();
            $("div .vehicle .list").append(vehicle_li);

            var pickup_point_options = '';
            var pickup_point_li = '';

            $.each(data.pickup_points, function(i, item) {
                pickup_point_options += "<option value=" + item.pickup_point.id + ">" + item
                    .pickup_point.name + "</option>";
                pickup_point_li += "<li data-value=" + item.pickup_point.id + " class='option'>" +
                    item.pickup_point.name + "</li>";
            });

            $("select.pickup_point option").not(':first').remove();
            $("select.pickup_point").append(pickup_point_options);

            $("div .pickup_point .current").html($("div .pickup_point .list li:first").html());
            $("div .pickup_point .list li").not(':first').remove();
            $("div .pickup_point .list").append(pickup_point_li);
        },
        error: function (data) {
            console.log(data);
        }
    });
});
