@if ($balance < 0)
  <span class="text-danger">
    {{ $balance }}
  </span>
@else
  <span class="text-success">
    {{ $balance }}
  </span>
@endif
