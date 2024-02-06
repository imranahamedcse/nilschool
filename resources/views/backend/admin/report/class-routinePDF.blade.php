
<!DOCTYPE html>
<html>
<head>
    <title>Class routine</title>
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
    text-align: center;
    background: #E6E6E6 !important;
    font-size: 16px;
    font-weight: 500;
    text-transform: capitalize;
    padding: 8px 4px;
}
.table_td {
    border-right: 0;
    border-color: transparent !important;
    text-align: center;
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
.title{
    padding: 10px 0px;
    margin: 10px 0px;
    font-size: 16px;
    text-align: center;
    background: #E6E6E6;
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
                @if ($data['result'])
                    <p class="title">{{___('index.Class (Section)')}} : <strong>{{$data['result'][0]->class->name}} ({{$data['result'][0]->section->name}})</p></strong>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="table_th">{{___('index.Day/Time')}}</th>
                                @foreach ($data['time'] as $item)
                                    <th class="table_th">{{ $item->timeSchedule->start_time }} - {{ $item->timeSchedule->end_time }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 0;
                            @endphp
                            @foreach (\Config::get('site.days') as $key=>$item)
                            <tr>
                                <th class="table_th">{{ ___($item) }}</th>
                                @if (isset($data['result'][$n]))
                                    @if ($data['result'][$n]->day == $key)
                                        @foreach ($data['time'] as $key=>$item0)
                                            <td class="table_td">
                                                @foreach ($data['result'][$n]->classRoutineChildren as $item)
                                                    @if ($item->time_schedule_id == $item0->time_schedule_id)
                                                        <div class="classBox_wiz">
                                                            <p><strong>{{ $item->subject->name }}</strong></p>
                                                            {{-- <p>
                                                                @foreach ($data['result'][$n]->TeacherName->subjectTeacher as $item2)
                                                                    @if ($item2->subject_id == $item->subject->id)
                                                                        {{$item2->teacher->first_name}} {{$item2->teacher->last_name}}
                                                                    @endif
                                                                @endforeach
                                                            </p> --}}
                                                            <p>{{___('index.Room No')}}: {{ $item->classRoom->room_no }}</p>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
                                        @php
                                            ++$n;
                                        @endphp
                                    @else
                                        @foreach ($data['time'] as $item)
                                            <td></td>
                                        @endforeach
                                    @endif
                                @else
                                    @foreach ($data['time'] as $item)
                                        <td></td>
                                    @endforeach
                                @endif
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
