<?php

namespace App\Mail;

use App\Support\ExpiryEmailSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CertificateExpiredMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $certificateKey;
    public array $values;

    /**
     * @param string $certificateKey safeguarding|vetting|first_aid
     * @param array  $values name, certificate, expiry_date, club
     */
    public function __construct(string $certificateKey, array $values)
    {
        $this->certificateKey = $certificateKey;
        $this->values = $values;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: ExpiryEmailSettings::render(ExpiryEmailSettings::subject(), $this->values),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.certificate-expired',
            with: ['body' => ExpiryEmailSettings::render(ExpiryEmailSettings::body(), $this->values)],
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        foreach (ExpiryEmailSettings::attachments() as $path) {
            if (Storage::disk('local')->exists($path)) {
                $attachments[] = Attachment::fromStorageDisk('local', $path);
            }
        }

        return $attachments;
    }
}
