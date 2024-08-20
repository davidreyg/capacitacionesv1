<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Components\CheckboxList;
use Illuminate\Contracts\Support\Arrayable;

class NestedMatrix extends CheckboxList
{
    protected string $view = 'filament.forms.components.nested-matrix';

    protected array|Closure $columnData = [];

    protected array|Closure $rowData = [];

    protected string $redOrBlue = 'radio';

    protected bool $rowSelectRequired = true;

    /**
     * @var array<string | array<string>> | \Illuminate\Contracts\Support\Arrayable | string | Closure | null
     */
    protected array|Arrayable|string|Closure|null $treeOptions = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rules([
            function () {
                return function (string $attribute, mixed $value, Closure $fail) {
                    if ($this->rowSelectRequired && (blank($value) || count($this->getRowData()) !== count($value))) {
                        $fail(__('required a selection for each row'));
                    }
                    foreach ($value as $val) {
                        if ($this->rowSelectRequired && is_array($val) && blank(array_filter($val))) {
                            $fail(__('required a selection for each row'));
                        }
                    }
                };
            },
        ]);

        $this->treeOptions(static function (NestedMatrix $component, $state) {
            $component->treeOptions = $component->buildTree($component->getOptions());
        });
    }

    public function columnData(array $data): static
    {
        $this->columnData = $data;

        return $this;
    }

    public function getColumnData(): array
    {
        return $this->evaluate($this->columnData);
    }

    public function getPilColor(): string
    {
        return $this->evaluate($this->redOrBlue);
    }

    public function asRadio(): static
    {
        $this->redOrBlue = 'radio';

        return $this;
    }

    public function asCheckbox(): static
    {
        $this->redOrBlue = 'checkbox';

        return $this;
    }

    public function rowSelectRequired(bool $rowSelectRequired = true): static
    {
        $this->rowSelectRequired = $rowSelectRequired;

        return $this;
    }

    /**
     * @param  array<string | array<string>> | \Illuminate\Contracts\Support\Arrayable | string | Closure | null  $treeOptions
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
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
            }
        }

        return $branch;
    }
}
