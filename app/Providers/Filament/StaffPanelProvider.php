<?php

namespace App\Providers\Filament;

use App\Filament\Resources\ServiceRequestResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Vite;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\View\View;

class StaffPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('staff')
            ->path('werkplaats')
            ->login()
            ->brandName('Dockwerk · Werkplaats')
            ->brandLogo(asset('images/dockwerk-wordmark.svg'))
            ->brandLogoHeight('2rem')
            ->favicon(asset('images/dockwerk-mark.svg'))
            ->font('Mona Sans', url: asset('fonts/mona-sans.css'))
            ->colors(['primary' => Color::Blue])
            ->darkMode(false)
            ->renderHook(PanelsRenderHook::STYLES_AFTER, fn (): Htmlable => app(Vite::class)('resources/css/glacier.css'))
            ->renderHook(PanelsRenderHook::BODY_START, fn (): View => view('components.glacier'))
            ->resources([ServiceRequestResource::class])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([Authenticate::class]);
    }
}
