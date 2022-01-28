@php
    $parameters = [
        'id' => $attributes->get('id'),
        'slot' => $slot,
    ];

    $optionalParameters = [
        'closeOnSubmit',
        'description',
        'dismissable',
        'dismissableWith',
        'forceCloseOnSubmit',
        'form',
        'formVersion',
        'hideControls',
        'maxWidth',
        'model',
        'submitWith',
        'title',
    ];

    foreach ($optionalParameters as $optionalParameter) {
        if ( $attributes->has($optionalParameter) ) {
            $parameters[$optionalParameter] = $attributes->get($optionalParameter);
        }
    }

@endphp

@livewire('tall-interactive::slide-over', $parameters)


