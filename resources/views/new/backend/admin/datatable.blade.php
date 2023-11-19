@extends('new.backend.admin.partial.master')

@section('title')
  Dashboard
@endsection

@push('style')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<style>
    div.dt-buttons>.dt-button, div.dt-buttons>div.dt-button-split .dt-button {
        margin-left: -2px;
        margin-bottom: 18px;
        padding: .5em 1em;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 30px;
        color: white;
        background: #11101d;
    }

    div.dataTables_wrapper div.dataTables_filter label {
        background: black;
        color: white;
        border-radius: 25px;
        padding: 4px 15px;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        margin-left: .5em;
        display: inline-block;
        width: auto;
        border-radius: 15px;
    }
    .page-item .page-link {
        background: #11101d;
        border-radius: 25px;
        color: white;
        padding: 6px 14px;
        margin: 0 2px;
    }
    li.paginate_button.page-item.active .page-link {
        background: #0d6efd;
    }

    div.dataTables_wrapper div.dataTables_info {
        display: inline;
        background: black;
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
    }
    table.dataTable {
        margin-bottom: 25px !important;
    }

</style>

@endpush


@section('content')

    <nav class="mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active" aria-current="page"><strong>Datatatable</strong></li>
        </ol>
    </nav>

    <div class="app-bar row justify-content-between m-0 p-2 rounded-4 rounded-bottom-0">
        <div class="col-6 align-self-center">
            <h4 class="m-0">Table Name</h4>
        </div>
        <div class="col-6 text-end">
            <button type="button" class="btn btn-rounded-sm btn-primary rounded-5">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>
    </div>

    <div class="border-start border-end border-5 border-black p-3">

        <table id="datatable" class="table cell-border" style="width:100%">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                    <th>Extn.</th>
                    <th>E-mail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger</td>
                    <td>Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011-04-25</td>
                    <td>$320,800</td>
                    <td>5421</td>
                    <td>t.nixon@datatables.net</td>
                    <td>
                        <button type="button" class="btn btn-rounded-sm btn-primary rounded-5"><i class="fa-solid fa-pencil"></i></button>
                        <button type="button" class="btn btn-rounded-sm btn-danger rounded-5"><i class="fa-solid fa-trash-can"></i></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Garrett</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011-07-25</td>
                    <td>$170,750</td>
                    <td>8422</td>
                    <td>g.winters@datatables.net</td>
                    <td>
                        <button type="button" class="btn btn-rounded-sm btn-primary rounded-5"><i class="fa-solid fa-pencil"></i></button>
                        <button type="button" class="btn btn-rounded-sm btn-danger rounded-5"><i class="fa-solid fa-trash-can"></i></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Ashton</td>
                    <td>Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009-01-12</td>
                    <td>$86,000</td>
                    <td>1562</td>
                    <td>a.cox@datatables.net</td>
                    <td>
                        <button type="button" class="btn btn-rounded-sm btn-primary rounded-5"><i class="fa-solid fa-pencil"></i></button>
                        <button type="button" class="btn btn-rounded-sm btn-danger rounded-5"><i class="fa-solid fa-trash-can"></i></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Donna</td>
                    <td>Snider</td>
                    <td>Customer Support</td>
                    <td>New York</td>
                    <td>27</td>
                    <td>2011-01-25</td>
                    <td>$112,000</td>
                    <td>4226</td>
                    <td>d.snider@datatables.net</td>
                    <td>
                        <button type="button" class="btn btn-rounded-sm btn-primary rounded-5"><i class="fa-solid fa-pencil"></i></button>
                        <button type="button" class="btn btn-rounded-sm btn-danger rounded-5"><i class="fa-solid fa-trash-can"></i></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <div class="app-bar text-center p-3 rounded-4 rounded-top-0">
        Copyright © 2023 nilsofthat.
    </div>

@endsection

@push('script')

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
    $(document).ready( function () {
        async function getData() {
            const records = await fetch('http://nilschool.test/get-classes');
            const data = records.json();
            console.log(data);
        }

        getData();

        new DataTable('#datatable', {
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'print',
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
        // $('#myTable').DataTable({
        //     // searching: false,
        //     // paging: false,
        //     // info: false,
        //     responsive: true
        // });
    } );
</script>
@endpush