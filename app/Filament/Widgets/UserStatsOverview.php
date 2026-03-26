<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class UserStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $counts = Cache::remember(
            key: 'filament.stats.users',
            ttl: now()->addMinutes(10),
            callback: fn () => [
                'total' => User::count(),
                'admins' => User::where('role', UserRole::Admin)->count(),
            ],
        );

        return [
            Stat::make('Users', number_format($counts['total']))
                ->description('Total registered users')
                ->icon('heroicon-m-users'),
            Stat::make('Admins', number_format($counts['admins']))
                ->description('Admin accounts')
                ->icon('heroicon-m-shield-check'),
        ];
    }
}
