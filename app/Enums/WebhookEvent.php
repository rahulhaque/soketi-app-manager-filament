<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum WebhookEvent: string
{
    use EnumToArray;

    case CHANNEL_OCCUPIED = 'channel_occupied';
    case CHANNEL_VACATED = 'channel_vacated';
    case MEMBER_ADDED = 'member_added';
    case MEMBER_REMOVED = 'member_removed';
    case CLIENT_EVENT = 'client_event';
}
