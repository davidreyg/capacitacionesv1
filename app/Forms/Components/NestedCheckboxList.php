<?php

namespace App\Forms\Components;

use App\Models\CausaBasica;
use App\Utilities\TreeBuilder;
use Closure;
use Filament\Forms\Components\Concerns\CanDisableOptions;
use Filament\Forms\Components\Concerns\CanDisableOptionsWhenSelectedInSiblingRepeaterItems;
use Filament\Forms\Components\Concerns\CanFixIndistinctState;
use Filament\Forms\Components\Concerns\CanLimitItemsLength;
use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Forms\Components\Concerns\HasGridDirection;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Field;
use Illuminate\Contracts\Support\Arrayable;

class NestedCheckboxList extends Field
{
    use CanFixIndistinctState;
    use CanDisableOptions;
    use CanDisableOptionsWhenSelectedInSiblingRepeaterItems;
    use CanLimitItemsLength;
    use HasOptions;
    use HasGridDirection;
    use HasExtraInputAttributes;
    protected string $view = 'filament.forms.components.nested-checkbox-list';

    /**
     * @var array<string | array<string>> | Arrayable | string | Closure | null
     */
    protected array|Arrayable|string|Closure|null $treeOptions = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->default([]);

        $this->afterStateHydrated(static function (NestedCheckboxList $component, $state) {
            if (is_array($state)) {
                return;
            }

            $component->state([]);
        });

        $this->treeOptions(static function (NestedCheckboxList $component, $state) {
            $component->treeOptions = $component->buildTree($component->getOptions());
        });
    }

    /**
     * @param  array<string | array<string>> | Arrayable | string | Closure | null  $treeOptions
     */
    public function treeOptions(array|Arrayable|string|Closure|null $treeOptions): static
    {
        $this->treeOptions = $treeOptions;

        return $this;
    }

    public function getTreeOptions(): array
    {
        $options = $this->evaluate($this->treeOptions) ?? [];
        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }
        return $options;
    }

    protected function buildTree(array $elements, $parentId = null): array
    {
        return TreeBuilder::buildTree($elements, $parentId);
    }

    protected function formatOptions(array $tree): array
    {
        $options = [];

        foreach ($tree as $node) {
            $label = $node['nombre'];
            if (!empty($node['children'])) {
                $options[$node['id']] = [
                    'label' => $label,
                    'options' => $this->formatOptions($node['children']),
                ];
            } else {
                $options[$node['id']] = $label;
            }
        }

        return $options;
    }
}
