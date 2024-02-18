$("[data-background]").each(function () {
    $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
});

var currentUrl = window.location.pathname;
if (currentUrl == '/') {
    $(".navbar").addClass("color_navbar");
} else {
    $(".navbar").addClass("white_navbar");
}

$(document).ready(function () {
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll > 300) {
            $(".navbar").addClass("fixed-top");
            $(".navbar").removeAttr("data-bs-theme");
            $(".navbar").addClass("white_navbar");
            $(".navbar").removeClass("color_navbar");
        }

        else {
            $(".navbar").removeClass("fixed-top");
            $(".navbar").attr("data-bs-theme", "dark");
            $(".navbar").removeClass("white_navbar");
            if (currentUrl == '/') {
                $(".navbar").addClass("color_navbar");
            } else {
                $(".navbar").addClass("white_navbar");
            }
        }
    })
})

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

// Contact start
$(document).ready(function () {
    var form = $('#contact');
    form.on('submit', function (e) {
        e.preventDefault();

        var name = $(".name").val();
        var phone = $(".phone").val();
        var email = $(".email").val();
        var subject = $(".subject").val();
        var message = $(".message").val();
        var url = $('#url').val();

        var formData = {
            name: name,
            phone: phone,
            email: email,
            subject: subject,
            message: message
        }

        $.ajax({
            url: url + '/contact',
            type: 'POST',
            dataType: 'json',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                form.trigger('reset');
                Swal.fire({
                    title: data[0],
                    text: data[1],
                    icon: data[2],
                    confirmButtonText: data[3]
                })
            },
            error: function (e) {
                Swal.fire({
                    title: data[0],
                    text: data[1],
                    icon: data[2],
                    confirmButtonText: data[3]
                })
            }
        });
    });
});
// Contact end

// Subscription start
$(document).ready(function () {
    var form = $('#subscription');

    form.on('submit', function (e) {
        e.preventDefault();

        var email = $(".email").val();
        var url = $('#url').val();

        var formData = {
            email: email,
        }

        $.ajax({
            url: url + '/subscribe',
            type: 'POST',
            dataType: 'json',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                form.trigger('reset');
                Swal.fire({
                    title: data[0],
                    text: data[1],
                    icon: data[2],
                    confirmButtonText: data[3]
                })
            },
            error: function (e) {
                Swal.fire({
                    title: data[0],
                    text: data[1],
                    icon: data[2],
                    confirmButtonText: data[3]
                })
            }
        });
    });
});
// Subscription end




// Online admission start

$(document).ready(function () {
    var form = $('#online_admission');
    form.on('submit', function (e) {
        e.preventDefault();
        var first_name = $(".first_name").val();
        var last_name = $(".last_name").val();
        var phone = $(".phone").val();
        var email = $(".email").val();
        var session = $(".session").val();
        var classes = $(".classes").val();
        var sections = $(".sections").val();
        var dob = $(".dob").val();
        var gender = $(".gender").val();
        var religion = $(".religion").val();
        var guardian_name = $(".guardian_name").val();
        var guardian_phone = $(".guardian_phone").val();

        if (first_name == '' ||
            last_name == '' ||
            phone == '' ||
            session == '' ||
            classes == '' ||
            sections == '' ||
            dob == '' ||
            gender == '' ||
            religion == '' ||
            guardian_name == '' ||
            guardian_phone == '') {
            Swal.fire(
                'Attention',
                'Please fill all the required fields',
                'warning'
            )
            e.preventDefault();
            return;
        }

        var url = $('#url').val();

        var formData = {
            first_name: first_name,
            last_name: last_name,
            phone: phone,
            email: email,
            session: session,
            classes: classes,
            sections: sections,
            dob: dob,
            gender: gender,
            religion: religion,
            guardian_name: guardian_name,
            guardian_phone: guardian_phone
        }


        $.ajax({
            url: url + '/online-admission', // form action url
            type: 'POST', // form submit method get/post
            dataType: 'json', // request type html/json/xml
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                Swal.fire({
                    title: data[0],
                    text: data[1],
                    icon: data[2],
                    confirmButtonText: data[3]
                })
                form.trigger('reset'); // reset form
                // session
                $("div .session .current").html($("div .session .list li:first").html());
                // classes
                $("select.classes option").not(':first').remove();
                $("div .classes .current").html($("div .classes .list li:first").html());
                $("div .classes .list li").not(':first').remove();
                // sections
                $("select.sections option").not(':first').remove();
                $("div .sections .current").html($("div .sections .list li:first").html());
                $("div .sections .list li").not(':first').remove();
                // gender
                $("select.gender option").not(':first').remove();
                $("div .gender .current").html($("div .gender .list li:first").html());
                $("div .gender .list li").not(':first').remove();
                // religion
                $("select.religion option").not(':first').remove();
                $("div .religion .current").html($("div .religion .list li:first").html());
                $("div .religion .list li").not(':first').remove();
            },
            error: function (e) {
                Swal.fire({
                    title: data[0],
                    text: data[1],
                    icon: data[2],
                    confirmButtonText: data[3]
                })
            }
        });
    });
});
// Online admission end
