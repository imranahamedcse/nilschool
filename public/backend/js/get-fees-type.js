$(".fees_group").on('change', function (e) {
    groupTypes();
});

function groupTypes() {
    var url = $('#url').val();
    var id = $(".fees_group").val();

    var formData = {
        id: id
    }

    $.ajax({
        type: "GET",
        dataType: 'html',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/fees/assign/get-all-type',
        success: function (data) {
            $("#types_table tbody").empty();
            $("#types_table tbody").append(data);
        },
        error: function (data) {
            console.log(data);
        }
    });
}