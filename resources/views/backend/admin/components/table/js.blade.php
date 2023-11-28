<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

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
