<tr id="document-file">
    <td>
        <select class="form-control"
            name="subjects[]" id="subject{{$counter}}" required>
            <option value="">{{ ___('academic.Select subject') }}</option>
            @foreach ($data['subjects'] as $item)
                <option value="{{ $item->subject->id }}">{{ $item->subject->name }}</option>
            @endforeach
        </select> 
    </td>
    <td>
        <select class="form-control"
            name="time_schedules[]" id="teacher{{$counter}}" required>
            <option value="">{{ ___('academic.Select time schedule') }}</option>
            @foreach ($data['time_schedules'] as $item)
                <option value="{{ $item->id }}">{{ $item->start_time }} - {{ $item->end_time }}</option>
            @endforeach
        </select> 
    </td>
    <td>
        <select class="form-control"
            name="class_rooms[]" id="class_room{{$counter}}" required>
            <option value="">{{ ___('academic.Select class room') }}</option>
            @foreach ($data['class_rooms'] as $item)
                <option value="{{ $item->id }}">{{ $item->room_no }}</option>
            @endforeach
        </select> 
    </td>
    <td>
        <button class="btn btn-danger" onclick="removeRow(this)">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </td>
</tr>

