<?php

use Filament\Forms\Components\TextInput;
use Livewire\Livewire;
use RalphJSmit\Tall\Interactive\Forms\Form;

it('can render a Livewire component', function (string $livewire) {
    $component = Livewire::test($livewire, [
        'id' => 'test-actionable',
        'form' => TestValidationForm::class,
    ]);

    $component
        ->call('submitForm')
        ->assertHasErrors(['data.email' => 'required'])
        ->assertSee('EMAIL_REQUIRED_MESSAGE')
        ->set('data.email', 'rjs@ralphjsmit.com')
        ->call('submitForm')
        ->assertHasErrors(['data.number' => 'required'])
        ->assertSee('NUMBER_REQUIRED_MESSAGE')
        ->set('data.number', 'abcde')
        ->call('submitForm')
        ->assertHasErrors(['data.number' => 'numeric'])
        ->assertSee('NUMBER_NUMERIC_MESSAGE')
        ->set('data.number', '12345')
        ->call('submitForm')
        ->assertHasNoErrors();
})->with('actionables');

class TestValidationForm extends Form
{
    public static function getFormSchema(): array
    {
        return [
            TextInput::make('email')->email()->required(),
            TextInput::make('number')->rules(['numeric'])->required(),
        ];
    }

    public static function getFormDefaults(): array
    {
        return [
            'email' => '',
            'number' => '',
        ];
    }

    public static function getErrorMessages(): array
    {
        return [
            'email.required' => 'EMAIL_REQUIRED_MESSAGE',
            'number.required' => 'NUMBER_REQUIRED_MESSAGE',
            'number.numeric' => 'NUMBER_NUMERIC_MESSAGE',
        ];
    }
}
