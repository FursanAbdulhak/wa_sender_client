<?php

namespace Alareqi\FilamentWhatsapp\enums;


enum MessageType: string
{

    case PlainText = 'plain_text';

    case Template = 'template';

    case TextWithMedia = 'text-with-media';
}
