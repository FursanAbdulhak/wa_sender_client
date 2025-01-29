<?php

namespace Alareqi\FilamentWhatsapp;

use Alareqi\FilamentWhatsapp\enums\MessageType;

use JsonSerializable;
use Illuminate\Support\Str;

class WhatsappMessage implements JsonSerializable
{

    public $recipients = null;
    public $to = null;
    public  $scheduleAt = null;
    public  $timezone = null;

    public function __construct(
        private ?string $title = null,
        private ?string $content = null,
        private ?string $file_url = null,
        private ?MessageType $type = null,
        private ?string $template_id = null,

    ) {
    }


    private function getmessageType()
    {

        if (
            $this->template_id != null
        ) {

            return MessageType::Template;
        } else if ($this->file_url  != null) {

            return MessageType::TextWithMedia;
        }

        return MessageType::PlainText;
    }



    public  function withRecipients($recipients): static
    {
        $this->recipients = $recipients;
        return  $this;
    }

    public  function withSchedule($datetime, $timezone = 'Asia/Aden'): static
    {
        $this->scheduleAt = $datetime;
        $this->timezone = $datetime == null ? null : $timezone;
        return  $this;
    }



    public  function withRecipient($recipient): static
    {

        if (Str::startsWith($recipient, "+967")) {

            $recipient = (Str::after($recipient, '+'));
        } else if (!Str::startsWith($recipient, "967")) {
            $recipient = ('967' . $recipient);
        }

        $this->to = $recipient;

        return  $this;
    }





    public function jsonSerialize(): array
    {

        return array_filter([
            'name' => $this->title,
            'message' => $this->content,
            'file' => $this->file_url,
            'template_id' => $this->template_id,
            'message_type' => $this->type ?? $this->getmessageType()->value,
            'to' => $this->recipients ?? $this->to,

            'schedule_at' => $this->scheduleAt,
            'timezone' => $this->timezone,

            'recipients' => $this->recipients,


        ], static fn ($value) => $value !== null);
    }
}
