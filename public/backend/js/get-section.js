$(".class").on('change', function (e) {
    var classId = $(this).val();
    var url = $('#url').val();
    var formData = {
        id: classId,
    }
    $.ajax({
        type: "GET",
        dataType: 'html',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/academic/class-setup/get-sections',
        success: function (data) {
            var section_options = '';
            var section_li = '';

            $.each(JSON.parse(data), function (i, item) {
                section_options += "<option value=" + item.section.id + ">" + item
                    .section.name + "</option>";
                section_li += "<li data-value=" + item.section.id + " class='option'>" +
                    item.section.name + "</li>";
            });

            $("select.section option").not(':first').remove();
            $("select.section").append(section_options);

            $("div .section .current").html($("div .section .list li:first").html());
            $("div .section .list li").not(':first').remove();
            $("div .section .list").append(section_li);
        },
        error: function (data) {
            console.log(data);
        }
    });
});