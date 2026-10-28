<?php

namespace App\Livewire;

use App\Models\ExpiryNotificationLog;
use App\Support\CertificateExpiry;
use App\Support\ExpiryEmailSettings as Settings;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpiryEmailSettings extends Component
{
    use WithFileUploads;

    public $enabled = false;
    public $subject = [];
    public $body = [];
    public $newAttachments = [];
    public $attachments = [];
    public $saved = false;

    public function mount()
    {
        $this->enabled = Settings::enabled();

        foreach (array_keys(CertificateExpiry::CERTIFICATES) as $key) {
            $this->subject[$key] = Settings::subject($key);
            $this->body[$key] = Settings::body($key);
            $this->attachments[$key] = Settings::attachments($key);
            $this->newAttachments[$key] = [];
        }
    }

    protected function rules()
    {
        return [
            'subject.*' => 'required|string|max:150',
            'body.*' => 'required|string|max:5000',
            'newAttachments.*.*' => 'file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png',
        ];
    }

    protected function validationAttributes()
    {
        $attributes = [];
        foreach (CertificateExpiry::CERTIFICATES as $key => $label) {
            $attributes["subject.$key"] = "$label subject";
            $attributes["body.$key"] = "$label message";
            $attributes["newAttachments.$key.*"] = "$label attachment";
        }

        return $attributes;
    }

    public function save()
    {
        $this->validate();

        Settings::set('expiry_email_enabled', $this->enabled ? '1' : '0');

        foreach (array_keys(CertificateExpiry::CERTIFICATES) as $key) {
            foreach ($this->newAttachments[$key] ?? [] as $file) {
                $this->attachments[$key][] = $file->storeAs(
                    'expiry-attachments',
                    now()->format('YmdHis').'-'.$file->getClientOriginalName(),
                    'local'
                );
            }
            $this->newAttachments[$key] = [];

            Settings::set("expiry_email_{$key}_subject", $this->subject[$key]);
            Settings::set("expiry_email_{$key}_body", $this->body[$key]);
            Settings::set("expiry_email_{$key}_attachments", json_encode(array_values($this->attachments[$key])));
        }

        $this->saved = true;
    }

    public function removeAttachment($certificate, $index)
    {
        if (isset(CertificateExpiry::CERTIFICATES[$certificate], $this->attachments[$certificate][$index])) {
            Storage::disk('local')->delete($this->attachments[$certificate][$index]);
            unset($this->attachments[$certificate][$index]);
            $this->attachments[$certificate] = array_values($this->attachments[$certificate]);
            Settings::set("expiry_email_{$certificate}_attachments", json_encode($this->attachments[$certificate]));
        }
    }

    public function render()
    {
        return view('livewire.expiry-email-settings', [
            'certificates' => CertificateExpiry::CERTIFICATES,
            'logs' => ExpiryNotificationLog::with('club')->latest()->limit(50)->get(),
        ]);
    }
}
