<?php

namespace App\Filament\Pages;
use Filament\Actions\Action;
use App\Models\CustomContent;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Support\Exceptions\Halt;
use Filament\Notifications\Notification;

class EditCheckoutText extends Page implements HasForms
{
    use InteractsWithForms;
    
    public ?array $data = [];
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-checkout-text';
    
    protected static ?string $navigationLabel = "Текст после заказа";
    
    public static function getNavigationGroup(): ?string
    {
        return 'Текста на сайте';
    }
    
    
    public function mount(): void
    {
        $record = CustomContent::first()->checkout_thanks;
        $this->form->fill(['checkout_thanks' => $record]);
    }
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('checkout_thanks')
                    ->required()->label('текст после заказа'),
            ])
            ->statePath('data')
            ;
    }
    
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }
    
    public function save(): void
    {
        try {
            $data = $this->form->getState();
            $text = CustomContent::find(1);
            $text->checkout_thanks = $data['checkout_thanks'];
            $text->save();

            Notification::make()
                ->success()
                ->title('СОХРАНЕНО')
                ->send();
        } catch (Halt $exception) {
            return;
        }

    }
}
