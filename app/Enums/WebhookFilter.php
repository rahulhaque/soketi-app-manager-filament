<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum WebhookFilter: string
{
    use EnumToArray;

    case CHANNEL_NAME_STARTS_WITH = 'channel_name_starts_with';
    case CHANNEL_NAME_ENDS_WITH = 'channel_name_ends_with';
}
