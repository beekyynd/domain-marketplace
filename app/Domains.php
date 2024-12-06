<?php

namespace App;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Domains: string implements HasLabel, HasColor
{
    case Available = 'available';

    case Sold = 'sold';

    case Suspended = 'suspended';

    case Pending = 'pending';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): ?string
    {
        return match($this){

            self::Available=>'success',
            self::Sold=>'primary',
            self::Pending=>'warning',
            self::Suspended=>'danger'
        };
    }
}
