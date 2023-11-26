<tr id="document-file">
    <td>
        <input type="text" name="document_names[{{ $counter }}]" class="form-control"
            placeholder="{{ ___('student_info.enter_name') }}" required>
        <input type="hidden" name="document_rows[]" value="{{ $counter }}">
    </td>
    <td>
        <input class="form-control" type="file" name="document_files[{{ $counter }}]" id="awesomefile{{ $counter }}">
    </td>
    <td>
        <button class="btn btn-danger" onclick="removeRow(this)">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </td>
</tr>