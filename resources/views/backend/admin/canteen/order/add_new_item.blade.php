<tr>
    <th scope="row">1</th>
    <td>
        <img height="30" src="{{ @globalAsset(@$item->upload->path, '100X100.svg') }}" alt="Photo">
    </td>
    <td>{{ $item->name }}</td>
    <td class="unit_price">{{ $item->price }}</td>
    <td class="subtotal">0.00</td>
    <td>
        <input type="hidden" name="ids[]" value="{{ $item->id }}">
        <input type="number" name="quantities[]" class="quantity form-control" placeholder="Enter quantity" value="1">
    </td>
    <td>
        <button type="button" class="btn btn-sm btn-danger px-2" onclick="removeRow(this)">
            <i class="fa-solid fa-close"></i>
        </button>
    </td>
</tr>
