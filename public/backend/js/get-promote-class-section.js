// get class
$(".session").on('change', function (e) {
    var sessionId = $(this).val();
    var url = $('#url').val();
    var formData = {
        id: sessionId,
    }
    $.ajax({
        type: "GET",
        dataType: 'html',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/students/promote/get-class',
        success: function (data) {
            var session_options = '';
            var session_li = '';
            $.each(JSON.parse(data), function (i, item) {
                session_options += "<option value=" + item.classes_id + ">" + item.class
                    .name + "</option>";
                session_li += "<li data-value=" + item.classes_id + " class='option'>" +
                    item.class.name + "</li>";
            });
            $("select.promote_class option").not(':first').remove();
            $("select.promote_class").append(session_options);

            $("div .promote_class .current").html($("div .promote_class .list li:first").html());
            $("div .promote_class .list li").not(':first').remove();
            $("div .promote_class .list").append(session_li);

            $("div .promote_section .current").html($("div .promote_section .list li:first")
                .html());
        },
        error: function (data) {
            console.log(data);
        }
    });
});
// get section
$(".promote_class").on('change', function (e) {
    var sessionId = $(".session").val();
    var classId = $(this).val();
    var url = $('#url').val();
    var formData = {
        session: sessionId,
        class: classId,
    }
    $.ajax({
        type: "GET",
        dataType: 'html',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/students/promote/get-sections',
        success: function (data) {
            var section_options = '';
            var section_li = '';
            $.each(JSON.parse(data), function (i, item) {
                section_options += "<option value=" + item.section.id + ">" + item
                    .section.name + "</option>";
                section_li += "<li data-value=" + item.section.id + " class='option'>" +
                    item.section.name + "</li>";
            });
            $("select.promote_section option").not(':first').remove();
            $("select.promote_section").append(section_options);

            $("div .promote_section .current").html($("div .promote_section .list li:first")
                .html());
            $("div .promote_section .list li").not(':first').remove();
            $("div .promote_section .list").append(section_li);
        },
        error: function (data) {
            console.log(data);
        }
    });
});