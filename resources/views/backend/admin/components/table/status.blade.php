@if ($row->status == App\Enums\Status::ACTIVE)
    <span class="btn btn-sm btn-success">{{ ___('common.active') }}</span>
@else
    <span class="btn btn-sm btn-danger">{{ ___('common.inactive') }}</span>
@endif
