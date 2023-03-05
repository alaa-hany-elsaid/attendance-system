<?php


namespace App\Helpers;

trait ValidationTrait
{


    public function getValidatedValuesWithoutNulls(): array
    {
        return collect($this->validated())->filter()->collect()->toArray();
    }

}
