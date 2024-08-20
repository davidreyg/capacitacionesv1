@props([
    'label',
    'value',
    'children' => [],
    'statePath',
    'isDisabled' => false,
    'errors' => [],
    'applyStateBindingModifiers',
    'getExtraInputAttributeBag',
    'isOptionDisabled',
    'isChild',
])

<div @class([
    'ml-6' => $isChild,
    'break-inside-avoid pt-4',
])>
    <label class="fi-fo-checkbox-list-option-label flex gap-x-3">
        @if (empty($children))
            <x-filament::input.checkbox :valid="!$errors->has($statePath)" :attributes="\Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                ->merge(
                    [
                        'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                        'value' => $value,
                        'wire:loading.attr' => 'disabled',
                        $applyStateBindingModifiers('wire:model') => $statePath,
                        'x-on:change' => null,
                    ],
                    escape: false,
                )
                ->class(['mt-1'])" />
        @endif

        <div class="grid text-sm leading-6">
            <span
                class="fi-fo-checkbox-list-option-label overflow-hidden break-words font-medium text-gray-950 dark:text-white">
                {{ $label }}
            </span>
        </div>
    </label>

    @if (!empty($children))
        @foreach ($children as $childValue => $childLabel)
            <x-forms.nested-checkbox-item :label="$childLabel['nombre']" :value="$childValue" :children="$childLabel['children'] ?? []" :statePath="$statePath"
                :isDisabled="$isDisabled" :errors="$errors" :applyStateBindingModifiers="$applyStateBindingModifiers" :getExtraInputAttributeBag="$getExtraInputAttributeBag" :isOptionDisabled="$isOptionDisabled"
                :isChild="isset($childLabel['parent_id'])" />
        @endforeach
    @endif
</div>
