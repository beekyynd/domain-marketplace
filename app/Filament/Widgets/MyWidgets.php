<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Domain;
use App\Models\Payout;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MyWidgets extends BaseWidget

{
    protected function getCards(): array
    {
        return [

            
            Stat::make('Total Value of Sold Domains', '₦' . number_format(Domain::where('status', 'sold')->sum('price'), 2) ?: 'No domains sold'),
            Stat::make('Total Domains', Domain::whereNotIn('status', ['sold', 'suspended'])->count()),
            Stat::make('Sold Domains', Domain::where('status', 'sold')->count()),
            Stat::make('Domains Added Today', Domain::whereDate('created_at', today())->count()),
            Stat::make('Total Payouts', Payout::where('status', 'paid')->count()),
            Stat::make('Pending Payouts', Payout::where('status', 'pending')->count()),
            Stat::make('Last User Registration', User::latest()->first()->created_at->format('d M h:i A') ?? 'No users yet'),
            Stat::make('Total Sellers', User::count()),
        ];
    }
}