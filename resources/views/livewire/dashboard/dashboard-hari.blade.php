<div>
    <div class="content-wrapper">
        <h4>Hari ini</h4>
        <div class="mb-2">
            <div class="mt-2 col-3">
                <label for="">Pilih hari</label>
                <input type="date" wire:model='date' class="form-control" id="">
            </div>
        </div>
        @livewire('dashboard.dashboard-page', ['kasSaldo' => $kasSaldo])

    </div>

</div>
