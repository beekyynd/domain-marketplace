<?php

namespace App\Filament\Widgets;

use App\Models\Domain;
use Carbon\CarbonImmutable;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Database\Eloquent\Builder;
 
class StatsWidgets extends StatsOverviewWidget
{
    use InteractsWithPageFilters;
 
    public function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
 
        return [
            StatsOverviewWidget\Stat::make(
                label: 'Total posts',
                value: Domain::query()
                    ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->count(),
            ),
            // ...
        ];
    }
}