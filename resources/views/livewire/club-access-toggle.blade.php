<div>
    @if($status == 'disabled')
        <div class="my-6">
            <span class="text-red-700 px-4 py-2 rounded bg-red-100">Club access is currently {{ $clubAccess->option_value }}</span>
        </div>
        <button class="button-judo" wire:click="toggleClubAccess">Enable</button>
    @else
        <div class="my-6">
            <span class="text-judo-500 bg-green-50 px-4 py-2 rounded">Club access is currently {{ $clubAccess->option_value }}</span>
        </div>
        <button class="button-danger" wire:click="toggleClubAccess">Disable</button>
    @endif
</div>
