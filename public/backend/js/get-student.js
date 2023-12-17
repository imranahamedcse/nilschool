$(".class").on('change', function (e) {
    getStudents();
});
$(".section").on('change', function (e) {
    getStudents();
});

// Start Class Section wise get Students
function getStudents() {
    var url = $('#url').val();
    var classId = $(".class").val();
    var sectionId = $(".section").val();
    var formData = {
        class: classId,
        section: sectionId,
    }

    if (classId && sectionId) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // url: url + '/report/marksheet/get-students',
            url: url + '/students/list/get-class-section-students',

            success: function (data) {
                console.log(data);

                var student_options = '';
                var student_li = '';
                $.each(data, function (i, item) {
                    student_options += "<option value=" + item.student_id + ">" + item.student
                        .first_name + ' ' + item.student.last_name + "</option>";
                    student_li += "<li data-value=" + item.student_id + " class='option'>" +
                        item.student.first_name + ' ' + item.student.last_name + "</li>";
                });

                $("select.student option").not(':first').remove();
                $("select.student").append(student_options);

                $("div .student .current").html($("div .student .list li:first").html());
                $("div .student .list li").not(':first').remove();
                $("div .student .list").append(student_li);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}
