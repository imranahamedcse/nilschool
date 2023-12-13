<script src="{{ asset('backend/datatable/js') }}/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend/datatable/js') }}/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend/datatable/js') }}/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend/datatable/js') }}/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('backend/datatable/js') }}/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend/datatable/js') }}/buttons.print.min.js"></script>
<script src="{{ asset('backend/datatable/js') }}/jszip.min.js"></script>
<script src="{{ asset('backend/datatable/js') }}/pdfmake.min.js"></script>
<script src="{{ asset('backend/datatable/js') }}/vfs_fonts.js"></script>
<script src="{{ asset('backend/datatable/js') }}/buttons.html5.min.js"></script>

<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        new DataTable('#datatable', {
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'print',
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
        });
        // $('#myTable').DataTable({
        //     // searching: false,
        //     // paging: false,
        //     // info: false,
        //     responsive: true
        // });
    });
</script>
<script>
    $(document).ready(function() {
        $(".all").on('click', function(e) {
            if ($(".all").is(':checked')) {
                $(".child").prop("checked", true);
            } else {
                $(".child").prop("checked", false);
            }
        });

        $(document).on('click', '.child', function() {
            const checkboxes = document.querySelectorAll('.child');
            for (let i = 0; i < checkboxes.length; i++) {
                if (!checkboxes[i].checked) {
                    $(".all").prop("checked", false);
                    break;
                } else
                    $(".all").prop("checked", true);
            }
        });
    });
</script>
