<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use App\Models\Domain;

use Filament\Widgets\Widget;

use Carbon\CarbonImmutable;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Database\Eloquent\Builder;

class Dashboard extends Page
{
 
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
{
    return [

        \App\Filament\Widgets\MyWidgets::class,
    ];
}

}
