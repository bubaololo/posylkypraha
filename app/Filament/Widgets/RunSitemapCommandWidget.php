<?php

namespace App\Filament\Widgets;

use Filament\Actions\Action;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Artisan;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class RunSitemapCommandWidget extends Widget implements HasForms, HasActions

{
    use InteractsWithActions;
    use InteractsWithForms;
    
    protected static string $view = 'filament.widgets.run-sitemap-command-widget';
    
    public function sitemapGenerateAction(): Action
    {
//        Artisan::call('sitemap:generate');
        
        return Action::make('generate-sitemap')

//            ->action(fn () => Artisan::call('sitemap:generate'));
//            ->action( 'generateSitemap');
            ->action(
                    'generateSitemap'
            );
    }
    
    public function generateSitemap()
    {
        Artisan::call('sitemap:generate');
        return true;
    }
}
