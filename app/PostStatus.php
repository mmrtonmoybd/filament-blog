<?php

namespace App;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum PostStatus: string implements HasLabel, HasColor

{
    case APPROVED = 'Approved';
    case UNAPPROVED = 'Unapproved';
    case PENDING = 'Pending';
    
    public function getLabel() : string {
        return match($this) {
            self::APPROVED => 'Approved',
            self::UNAPPROVED => 'Unapproved',
            self::PENDING => 'Pending',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::APPROVED => 'success',
            self::UNAPPROVED => 'danger',
            self::PENDING => 'warning',
        };
    }
}
