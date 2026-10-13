<?php

namespace App\Livewire;

use App\Models\ExpiryNotificationLog;
use App\Support\ExpiryEmailSettings as Settings;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpiryEmailSettings extends Component
{
    use WithFileUploads;

    public $enabled = false;
    public $subject;
    public $body;
    public $newAttachments = [];
    public $attachments = [];
    public $saved = false;

    public function mount()
    {
        $this->enabled = Settings::enabled();
        $this->subject = Settings::subject();
        $this->body = Settings::body();
        $this->attachments = Settings::attachments();
    }

    protected function rules()
    {
        return [
            'subject' => 'required|string|max:150',
            'body' => 'required|string|max:5000',
            'newAttachments.*' => 'file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png',
        ];
    }

    public function save()
    {
        $this->validate();

        foreach ($this->newAttachments as $file) {
            $this->attachments[] = $file->storeAs(
                'expiry-attachments',
                now()->format('YmdHis').'-'.$file->getClientOriginalName(),
                'local'
            );
        }
        $this->newAttachments = [];

        Settings::set('expiry_email_enabled', $this->enabled ? '1' : '0');
        Settings::set('expiry_email_subject', $this->subject);
        Settings::set('expiry_email_body', $this->body);
        Settings::set('expiry_email_attachments', json_encode(array_values($this->attachments)));

        $this->saved = true;
    }

    public function removeAttachment($index)
    {
        if (isset($this->attachments[$index])) {
            Storage::disk('local')->delete($this->attachments[$index]);
            unset($this->attachments[$index]);
            $this->attachments = array_values($this->attachments);
            Settings::set('expiry_email_attachments', json_encode($this->attachments));
        }
    }

    public function render()
    {
        return view('livewire.expiry-email-settings', [
            'logs' => ExpiryNotificationLog::with('club')->latest()->limit(50)->get(),
        ]);
    }
}
