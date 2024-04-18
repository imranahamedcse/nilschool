$(".class").on('change', function (e) {
    getExamType();
});
$(".section").on('change', function (e) {
    getExamType();
});
function getExamType() {
    var classId = $(".class").val();
    var sectionId = $(".section").val();
    var url = $('#url').val();
    var formData = {
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
        url: url + '/exam/assign/get-exam-type',
        success: function (data) {

            var exam_type_options = '';
            var exam_type_li = '';

            // $.each(JSON.parse(data), function (i, item) {
            //     exam_type_options += "<option value=" + item.exam_type.id + ">" + item.exam_type
            //         .name + "</option>";
            //     exam_type_li += "<li data-value=" + item.exam_type.id + " class='option'>" +
            //         item.exam_type.name + "</li>";
            // });

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
