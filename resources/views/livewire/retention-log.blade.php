<div>
    <form wire:submit="update" class="flex items-center">
        <label for="days" class="text-sm text-gray-600 mr-2">Days of log's retention</label>
        <select name="days" id="days" wire:model="retentionLogTime">
            <option disabled>Select number of days</option>
            <option value="30">30</option>
            <option value="60">60</option>
            <option value="90">90</option>
            <option value="180">180</option>
        </select>
        <button class="button-judo ml-2">Update</button>
    </form>
</div>
