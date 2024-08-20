@php
    $gridDirection = $getGridDirection() ?? 'column';
    // $isBulkToggleable = $isBulkToggleable();
    $isDisabled = $isDisabled();
    $options2 = $getTreeOptions();
    // $isSearchable = $isSearchable();
    $statePath = $getStatePath();
@endphp
<!-- resources/views/forms/components/recursive-checkbox-list.blade.php -->
<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <x-filament::grid
    :default="$getColumns('default')"
    :sm="$getColumns('sm')"
    :md="$getColumns('md')"
    :lg="$getColumns('lg')"
    :xl="$getColumns('xl')"
    :two-xl="$getColumns('2xl')"
    :x-show="null"
    :direction="$gridDirection"
    :attributes="
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'fi-fo-checkbox-list gap-4',
                '-mt-4' => $gridDirection === 'column',
            ])    "
>
@foreach ($getTreeOptions() as $value => $label)
<x-forms.nested-checkbox-item
    :label="$label['nombre']"
    :isChild="isset($label['parent_id'])"
    :value="$value"
    :children="$label['children'] ?? []"
    :statePath="$statePath"
    :isDisabled="$isDisabled"
    :errors="$errors"
    :applyStateBindingModifiers="$applyStateBindingModifiers"
    :getExtraInputAttributeBag="$getExtraInputAttributeBag"
    :isOptionDisabled="$isOptionDisabled"
/>
@endforeach
</x-filament::grid>
<br>
{{-- {{ json_encode($getState()) }} --}}
</x-dynamic-component>

