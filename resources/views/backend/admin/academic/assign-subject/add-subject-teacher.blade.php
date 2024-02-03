<tr id="document-file">
    <td>
        <select class="form-control @error('subjects') is-invalid @enderror" name="subjects[]"
            id="subject{{ $counter }}" required>
            <option value="">{{ ___('create.Select subject') }}</option>
            @foreach ($data['subjects'] as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-control @error('teachers') is-invalid @enderror" name="teachers[]"
            id="teacher{{ $counter }}" required>
            <option value="">{{ ___('create.Select teacher') }}</option>
            @foreach ($data['teachers'] as $item)
                <option value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <button class="btn btn-danger" onclick="removeRow(this)">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </td>
</tr>
