<div>
    <form wire:submit="save" class="max-w-3xl">
        <div class="mb-4">
            <label class="block font-semibold">
                <input type="checkbox" wire:model="enabled" class="mr-2">Send certificate expiry emails
            </label>
            <div class="text-sm text-gray-500 mt-1">(off by default – enable once the email copy and GDPR approach are signed off)</div>
        </div>

        <p class="text-sm text-gray-600 mb-4">
            Emails go out daily at 09:00 (Irish time) to anyone whose Safeguarding, Vetting or First Aid certificate expired in the last 7 days.
            One email is sent per expired certificate, and never twice for the same expiry date.
        </p>

        <h4 class="font-bold text-gray-600 mb-2">Email copy</h4>
        <p class="text-xs text-gray-500 mb-2">Placeholders: {name} {certificate} {expiry_date} {club}</p>
        <div class="mb-2">
            <label class="block text-sm font-bold mb-1">Subject</label>
            <input type="text" class="input-box w-full" wire:model="subject">
            @error('subject') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-6">
            <label class="block text-sm font-bold mb-1">Message</label>
            <textarea rows="8" class="input-box w-full" wire:model="body"></textarea>
            @error('body') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <h4 class="font-bold text-gray-600 mb-2">Attachments (included in every email)</h4>
        @forelse ($attachments as $i => $path)
            <div class="flex items-center text-sm mb-1">
                <span>{{ basename($path) }}</span>
                <button type="button" class="text-red-600 ml-3" wire:click="removeAttachment({{ $i }})">Remove</button>
            </div>
        @empty
            <p class="text-sm text-gray-500 mb-1">No attachments.</p>
        @endforelse
        <input type="file" multiple wire:model="newAttachments" class="mt-2 text-sm">
        <div class="text-xs text-gray-500">PDF, Word or image files, up to 5MB each.</div>
        @error('newAttachments.*') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        <div class="mt-6">
            <button class="button-judo">Save</button>
            @if ($saved)
                <span class="text-sm text-green-700 ml-3">Saved</span>
            @endif
        </div>
    </form>

    <h4 class="font-bold text-gray-600 mt-10 mb-2">Recent notifications (last 50)</h4>
    <table class="min-w-full text-sm">
        <thead>
        <tr class="bg-gray-600 text-white text-left">
            <th class="px-3 py-2">Date</th>
            <th class="px-3 py-2">Person</th>
            <th class="px-3 py-2">Club</th>
            <th class="px-3 py-2">Recipient</th>
            <th class="px-3 py-2">Certificate</th>
            <th class="px-3 py-2">Expired</th>
            <th class="px-3 py-2">Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($logs as $log)
            <tr class="border-b">
                <td class="px-3 py-2">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-3 py-2">{{ $log->person_name }}</td>
                <td class="px-3 py-2">{{ optional($log->club)->name }}</td>
                <td class="px-3 py-2">{{ $log->recipient ?? '–' }}</td>
                <td class="px-3 py-2">{{ \App\Support\CertificateExpiry::CERTIFICATES[$log->certificate] ?? $log->certificate }}</td>
                <td class="px-3 py-2">{{ $log->expiry_date->format('d/m/Y') }}</td>
                <td class="px-3 py-2" @if ($log->error) title="{{ $log->error }}" @endif>
                    {{ ['sent' => 'Sent', 'skipped_no_email' => 'Skipped – no email', 'failed' => 'Failed'][$log->status] ?? $log->status }}
                </td>
            </tr>
        @empty
            <tr><td class="px-3 py-2 text-gray-500" colspan="7">Nothing sent yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
