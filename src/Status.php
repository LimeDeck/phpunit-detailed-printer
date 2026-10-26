<?php

namespace LimeDeck\Testing;

enum Status: int
{
    case Passed      = 0;
    case Skipped     = 1;
    case Incomplete  = 2;
    case Notice      = 3;
    case Deprecation = 4;
    case Risky       = 5;
    case Warning     = 6;
    case Failed      = 7;
    case Errored     = 8;

    public const RED    = 31;
    public const GREEN  = 32;
    public const YELLOW = 33;
    public const CYAN   = 36;
    public const WHITE  = 37;

    public function worst(self $other): self
    {
        return $other->value > $this->value ? $other : $this;
    }

    public function char(): string
    {
        return match ($this) {
            self::Passed      => '.',
            self::Skipped     => 'S',
            self::Incomplete  => 'I',
            self::Notice      => 'N',
            self::Deprecation => 'D',
            self::Risky       => 'R',
            self::Warning     => 'W',
            self::Failed      => 'F',
            self::Errored     => 'E',
        };
    }

    public function symbol(): string
    {
        return match ($this) {
            self::Passed  => '✔',
            self::Failed  => '✖',
            self::Errored => '!',
            default       => $this->char(),
        };
    }

    public function color(): int
    {
        return match ($this) {
            self::Passed                => self::GREEN,
            self::Skipped               => self::CYAN,
            self::Failed, self::Errored => self::RED,
            default                     => self::YELLOW,
        };
    }

    public function nameColor(): int
    {
        return $this === self::Passed ? self::WHITE : $this->color();
    }
}
