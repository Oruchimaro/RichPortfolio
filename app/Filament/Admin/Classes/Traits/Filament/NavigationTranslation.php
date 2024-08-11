<?php

namespace App\Filament\Admin\Classes\Traits\Filament;

use Illuminate\Translation\MessageSelector;

trait NavigationTranslation
{
    public static function getNavigationGroup(): ?string
    {
        return __(static::$navigationGroup);
    }

    public static function getNavigationLabel(): string
    {
        return __(static::$navigationLabel) ?? static::getTitleCasePluralModelLabel();
    }

    public static function getModelLabel(): string
    {
        return __(static::$modelLabel) ?? static::getLabel() ?? self::get_model_label(static::getModel());
    }

    public static function getPluralModelLabel(): string
    {
        if (filled($label = __(static::$pluralModelLabel) ?? static::getPluralLabel())) {
            return $label;
        }

        if (self::locale_has_pluralization()) {
            return \Str::plural(static::getModelLabel());
        }

        return static::getModelLabel();
    }

    public static function get_model_label(string $model): string
    {
        return (string) str(class_basename($model))
            ->kebab()
            ->replace('-', ' ');
    }

    public static function locale_has_pluralization(): bool
    {
        return (new MessageSelector)->getPluralIndex(app()->getLocale(), 10) > 0;
    }
}
