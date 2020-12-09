<div>
    @if ($balance < 0)
      <span class="text-danger">
        {{ $balance * -1}}
      </span>
    @else
      <span class="text-success">
        {{ $balance }}
      </span>
    @endif
</div>
