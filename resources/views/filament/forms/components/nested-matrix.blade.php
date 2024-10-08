@php
    $gridDirection = $getGridDirection() ?? 'column';
    $isDisabled = $isDisabled();
    $options2 = $getTreeOptions();
    $statePath = $getStatePath();
    $columnData = $getColumnData();
    $id = $getId();
    $pilColor = $getPilColor();
@endphp
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
<div @class(['break-inside-avoid pt-4'])>
    <div class="fi-fo-checkbox-list-option-label flex gap-x-3">
        <div class="grid text-sm leading-6">
            <span
                class="fi-fo-checkbox-list-option-label overflow-hidden break-words font-medium text-gray-950 dark:text-white">
                {{ $label['nombre'] }}
            </span>
            {{-- MATRIX --}}

            <div class="overflow-x-auto shadow ring-1 ring-gray-200 dark:ring-white/10 ring-opacity-5 rounded-lg">
                <table class="w-full table-auto divide-y divide-gray-200 dark:divide-white/5 bg-white dark:bg-gray-900">
                    <thead>
                    <tr class="p-2 bg-gray-50 dark:bg-gray-800">
                        <td></td>
                        @foreach($columnData as $column)
                            <td class="p-2 text-center">{{ $column }}</td>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($label['children'] as $rowKey => $rowValue)
                            <tr>
                                <td class="p-2">{{ $rowValue['nombre'] }}</td>
                                @foreach($columnData as $columnKey => $columnValue)
                                    @php
                                        $supStatPath = ($pilColor === 'radio') ? $statePath.'.'.$rowKey : $statePath.'.'.$rowKey.'.'.$columnKey ;
                                    @endphp
                                    <td class="p-2 text-center">
                                        @if ($pilColor === 'radio')
                                        <x-filament::input.radio
                                            :attributes="
                                                \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                                                    ->merge([
                                                        'wire:key'=>$id.$rowKey,
                                                        'wire:loading.attr' => 'disabled',
                                                        $applyStateBindingModifiers('wire:model') => $supStatPath,
                                                        'value' => $value,
                                                        'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                                        'id' => $id . '-' . $value,
                                                        'name' => $id,
                                                    ], escape: false)
                                                    ->class(['mt-1'])
                                            "
                                        />
                                        @else
                                        <x-filament::input.checkbox
                                            :attributes="
                                                \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                                                    ->merge([
                                                        'wire:key'=>$id.$rowKey,
                                                        'wire:loading.attr' => 'disabled',
                                                        $applyStateBindingModifiers('wire:model') => $supStatPath,
                                                        'value' => $value,
                                                        'disabled' => $isDisabled,
                                                    ], escape: false)
                                                    ->class(['mt-1'])
                                            "
                                        />
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
</x-filament::grid>
<br>
{{-- {{ json_encode($getState()) }} --}}
</x-dynamic-component>

