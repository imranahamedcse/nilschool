$(".class").on('change', function(e) {
    getSubject();
});
$(".section").on('change', function(e) {
    getSubject();
});

function getSubject() {
    var classId = $(".class").val();
    var sectionId = $(".section").val();

    if (classId && sectionId) {
        var url = $('#url').val();
        var formData = {
            classes_id: classId,
            section_id: sectionId,
        }
        $.ajax({
            type: "GET",
            dataType: 'html',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url + '/academic/assign-subject/get-subjects',
            success: function(data) {
                var subject_options = '';
                var subject_li = '';

                $.each(JSON.parse(data), function(i, item) {
                    subject_options += "<option value=" + item.subject.id + ">" + item.subject
                        .name + "</option>";
                    subject_li += "<li data-value=" + item.subject.id + " class='option'>" +
                        item.subject.name + "</li>";
                });

                $("select.subject option").not(':first').remove();
                $("select.subject").append(subject_options);


                $("div .subject .current").html($("div .subject .list li:first").html());
                $("div .subject .list li").not(':first').remove();
                $("div .subject .list").append(subject_li);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
}