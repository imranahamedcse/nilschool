$(".session").on('change', function (e) {
    var sessionId = $(".session").val();
    var url = $('#url').val();
    var formData = {
        session: sessionId,
    }
    $.ajax({
        type: "GET",
        dataType: 'html',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/get-classes',
        success: function (data) {

            var classes_options = '';
            var classes_li = '';

            $.each(JSON.parse(data), function (i, item) {
                classes_options += "<option value=" + item.class.id + ">" + item.class
                    .name + "</option>";
                classes_li += "<li data-value=" + item.class.id + " class='option'>" +
                    item.class.name + "</li>";
            });

            $("select.class option").not(':first').remove();
            $("select.class").append(classes_options);

            $("div .class .current").html($("div .class .list li:first").html());
            $("div .class .list li").not(':first').remove();
            $("div .class .list").append(classes_li);

        },
        error: function (data) {
            console.log(data);
        }
    });
});

function getResultSections() {
    var sessionId = $(".session").val();
    var classId = $(".class").val();
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
        url: url + '/get-sections',
        success: function (data) {

            var section_options = '';
            var section_li = '';

            $.each(JSON.parse(data), function (i, item) {
                section_options += "<option value=" + item.section.id + ">" + item.section
                    .name + "</option>";
                section_li += "<li data-value=" + item.section.id + " class='option'>" + item
                    .section.name + "</li>";
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
}

$(".session").on('change', function (e) {
    getResultSections();
});
$(".class").on('change', function (e) {
    getResultSections();
});

function getResultExamTypes() {
    var sessionId = $(".session").val();
    var classId = $(".class").val();
    var sectionId = $(".section").val();
    var url = $('#url').val();
    var formData = {
        session: sessionId,
        class: classId,
        section: sectionId,
    }

    $.ajax({
        type: "GET",
        dataType: 'html',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/get-exam-type',
        success: function (data) {

            var exam_type_options = '';
            var exam_type_li = '';

            $.each(JSON.parse(data), function (i, item) {
                exam_type_options += "<option value=" + item.type.id + ">" + item.type
                    .name + "</option>";
                exam_type_li += "<li data-value=" + item.type.id + " class='option'>" +
                    item.type.name + "</li>";
            });

            $("select.exam_type option").not(':first').remove();
            $("select.exam_type").append(exam_type_options);

            $("div .exam_type .current").html($("div .exam_type .list li:first").html());
            $("div .exam_type .list li").not(':first').remove();
            $("div .exam_type .list").append(exam_type_li);

        },
        error: function (data) {
            console.log(data);
        }
    });
}

$(".session").on('change', function (e) {
    getResultExamTypes();
});
$(".class").on('change', function (e) {
    getResultExamTypes();
});
$(".section").on('change', function (e) {
    getResultExamTypes();
});
