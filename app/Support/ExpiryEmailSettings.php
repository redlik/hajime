<?php

namespace App\Support;

use App\Models\Options;

/**
 * Settings > Options values for the certificate expiry emails (CR26-001 R4b),
 * stored in the options table.
 */
class ExpiryEmailSettings
{
    public const DEFAULT_SUBJECT = 'Your {certificate} certificate has expired';

    // Placeholder copy – replace with the text approved by IJA.
    public const DEFAULT_BODY = "Dear {name},\n\nOur records show that your {certificate} certificate ({club}) expired on {expiry_date}.\n\nPlease renew it and send the updated details to your club or to IJA.\n\nKind regards,\nIrish Judo Association";

    public static function get(string $name, $default = null)
    {
        $value = Options::where('option_name', $name)->value('option_value');

        return $value === null ? $default : $value;
    }

    public static function set(string $name, $value): void
    {
        Options::withTrashed()->updateOrCreate(
            ['option_name' => $name],
            ['option_value' => (string) $value, 'deleted_at' => null]
        );
    }

    /** Sending is off until an administrator enables it (GDPR/copy sign-off pending). */
    public static function enabled(): bool
    {
        return self::get('expiry_email_enabled', '0') === '1';
    }

    public static function subject(): string
    {
        return self::get('expiry_email_subject') ?: self::DEFAULT_SUBJECT;
    }

    public static function body(): string
    {
        return self::get('expiry_email_body') ?: self::DEFAULT_BODY;
    }

    /** @return string[] storage paths on the local disk */
    public static function attachments(): array
    {
        return json_decode(self::get('expiry_email_attachments', '[]'), true) ?: [];
    }

    public static function render(string $template, array $values): string
    {
        $replace = [];
        foreach ($values as $key => $value) {
            $replace['{'.$key.'}'] = $value;
        }

        return strtr($template, $replace);
    }
}
