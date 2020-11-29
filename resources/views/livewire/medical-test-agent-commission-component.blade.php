<div>
  <div class="form-group form-inline">
    <label for="Price" class="mr-3">Referrer</label>
    <input type="text" class="form-control" id="" placeholder="Amount" wire:model="agentCommissionAmount">
  </div>

  <div class="form-group form-inline">
    <label for="paymentStatus" class="mr-3">Payment Status</label>
    <select class="custom-select" wire:model="agentCommissionStatus">
      <option>---</option>
        <option>Waiting</option>
        <option>Paid</option>
    </select>
  </div>
  <div class="btn btn-sm btn-info" wire:click="create">Update</div>

  {{ $msg }}
</div>
