
@php
    $total = 0;
@endphp
@foreach ($types as $item)
<tr>
    <td><input class="form-check-input fees_type" type="checkbox" name="fees_type_ids[]" value="{{$item->id}}"></td>
    <td>{{ $item->type->name }}</td>
    <td>{{ $item->amount }}</td>
</tr>
@php
    $total += $item->amount;
@endphp
@endforeach
@if ($total > 0)
<tr>
    <td><strong></strong></td>
    <td><strong>{{ ___('index.total') }}</strong></td>
    <td><strong>{{ $total }}</strong></td>
</tr>
@endif

