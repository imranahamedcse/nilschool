
<!DOCTYPE html>
<html>
<head>
    <title>Marksheet</title>
    <style>
body {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        margin: 0;
        padding: 0;
        -webkit-print-color-adjust: exact !important;
}
.report {
    background: white;
}
.report_header {
    background: #392C7D;
    border-radius: 10px 10px 0 0;
    padding: 10px;
}
.report_header_logo {
    float: left;
    padding: 10px;
    border-right: #E6E6E6 3px solid;
    margin-right: 10px;
}
.report_header_logo img {
    height: 65px;
}
.report_header_content {
    color: white;
}
.report_header_content h3 {
    font-size: 24px;
    margin: 0;
}
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.table{
    width: 100%;
}
.table_th {
    border-right: 0;
    border-color: transparent !important;
    text-align: left;
    background: #E6E6E6 !important;
    font-size: 16px;
    font-weight: 500;
    text-transform: capitalize;
    padding: 8px 4px;
}
.table_td {
    border-right: 0;
    border-color: transparent !important;
    text-align: left;
    font-size: 14px;
    padding: 8px 4px;
}
.table tr:nth-of-type(odd) {
    padding: 0;
    border-color: white;
    background: #F8F8F8;
}
.table tr:nth-of-type(even) {
    border: 0;
    border-color: white;
    background: #EFEFEF;
}
.footer {
    padding: 5px;
    text-align: center;
    background: #E6E6E6 !important;
    border-radius:  0 0 10px 10px;
}
.markseet_title {
    text-align: center;
    font-size: 24px;
}

</style>
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="report">
                <div class="report_header">
                    <div class="report_header_logo">
                        <img class="header_logo" src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}" alt="{{ __('light logo') }}">
                    </div>
                    <div class="report_header_content">
                        <h3>{{ setting('application_name') }}</h4>
                        <p>{{ setting('address') }}</p>
                    </div>
                </div>


                <table class="table">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="table_th">{{___('index.Student Name')}} :</th>
                            <td class="table_td">{{ @$data['student']->first_name }} {{ @$data['student']->last_name }}</td>
                            <th class="table_th">{{___('index.Guardian Phone')}} :</th>
                            <td class="table_td">{{ @$data['student']->parent->guardian_mobile }}</td>
                        </tr>
                        <tr>
                            <th class="table_th">{{___('index.Guardian Name')}} :</th>
                            <td class="table_td">{{ @$data['student']->parent->guardian_name }}</td>
                            <th class="table_th">{{___('index.Guardian Email')}} :</th>
                            <td class="table_td">{{ @$data['student']->parent->guardian_email }}</td>
                        </tr>
                        <tr>
                            <th class="table_th">{{___('index.Class(Section)')}} :</th>
                            <td class="table_td">{{ @$data['student']->session_class_student->class->name }}
                                ({{ @$data['student']->session_class_student->section->name }}) </td>
                            <th class="table_th">{{___('index.Result')}} :</th>
                            <td class="table_td">{{ @$data['resultData']['result'] }}</td>
                        </tr>
                        <tr>
                            <th class="table_th">{{___('index.DOB')}} :</th>
                            <td class="table_td">{{ dateFormat(@$data['student']->dob) }}</td>
                            <th class="table_th">{{___('index.GPA')}} :</th>
                            <td class="table_td">
                                @if($data['resultData']['result'] == "Passed")
                                {{ @$data['resultData']['gpa'] }}
                                @else
                                {{ '0.00' }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>


                <div class="markseet_title">
                    <h5>{{___('index.Grade Sheet')}}</h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="table_th">{{___('index.Subject Code')}}</th>
                                <th class="table_th">{{___('index.Subject Name')}}</th>
                                <th class="table_th">{{___('index.Grade')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$data['resultData']['marks_registers'] as $item)
                                <tr>
                                    <td class="table_td">
                                        {{ $item->subject->code }}
                                    </td>
                                    <td class="table_td">
                                        {{ $item->subject->name }}
                                    </td>
                                    <td class="table_td">
                                        @php
                                            $n = 0;
                                        @endphp
                                        @foreach ($item->marksRegisterChilds as $item)
                                                @php
                                                    $n += $item->mark;
                                                @endphp
                                        @endforeach
                                        {{ markGrade($n) }}
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="footer">
                    <img src="{{ globalAsset(setting('favicon')) }}" alt="Icon">
                    <p>{{ setting('footer_text') }}</p>
                </div>
            </div>


        </div>
    </div>
</body>
</html>
