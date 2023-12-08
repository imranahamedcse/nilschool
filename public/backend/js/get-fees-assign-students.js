$(".section").on('change', function (e) {
    getStudents();
});

$(".student_category").on('change', function (e) {
    getStudents();
});

$(".gender").on('change', function (e) {
    getStudents();
});

function getStudents() {
    var url = $('#url').val();
    var classId = $(".class").val();
    var sectionId = $(".section").val();
    var categoryId = $(".student_category").val();
    var genderId = $(".gender").val();

    var formData = {
        class: classId,
        section: sectionId,
        category: categoryId,
        gender: genderId,
    }

    $("#students_table tbody").empty();
    if (classId && sectionId) {
        $.ajax({
            type: "GET",
            dataType: 'html',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url + '/fees/assign/get-fees-assign-students',
            success: function (data) {
                $("#students_table tbody").empty();
                $("#students_table tbody").append(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}