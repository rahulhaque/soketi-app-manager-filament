<?php

namespace App\Mixins;

class BluePrintMixins
{
    public function ownerships()
    {
        return function () {
            $this->foreignId('created_by')->nullable()->index();
            $this->foreignId('updated_by')->nullable()->index();
        };
    }
}
