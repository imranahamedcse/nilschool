<tr>
    <td>
        <label class="form-label">{{ ___('create.name') }}</label>
        <input class="form-control mb-5" name="name[]"placeholder="{{ ___('create.Enter name') }}">
    </td>
    <td>
        <label class="form-label">{{ ___('create.Icon') }}</label>
        <input class="form-control mb-5" name="icon[]"placeholder="{{ ___('create.Enter icon') }}">
    </td>
    <td>
        <label class="form-label">{{ ___('create.Link') }}</label>
        <div class="d-flex align-items-center mb-5">
            <input class="form-control mr-2" name="link[]"placeholder="{{ ___('create.Enter link') }}">
            <button class="drax_close_icon mark_distribution_close" onclick="removeRow(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </td>
</tr>
