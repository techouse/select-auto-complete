# Select Auto-Complete

[![Latest Version on Packagist](https://img.shields.io/packagist/v/techouse/select-auto-complete.svg?style=flat-square)](https://packagist.org/packages/techouse/select-auto-complete)
[![Total Downloads](https://img.shields.io/packagist/dt/techouse/select-auto-complete.svg?style=flat-square)](https://packagist.org/packages/techouse/select-auto-complete)

##### An auto-completing Laravel Nova search field.

Provides a capability of auto-completed searching for results inside a select input field.

![Select Auto-Complete](./screenshot.png)


## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require techouse/select-auto-complete
```

## Usage

The API is exactly the same as with [Nova's default `Select` Field](https://nova.laravel.com/docs/1.0/resources/fields.html#select-field)

Simply use `SelectAutoComplete` class instead of `Select` directly or alias it like the example below so you won't have to refactor too much existing code.

```php
<?php

namespace App\Nova\Actions;

use App\AccountData;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Techouse\SelectAutoComplete\SelectAutoComplete as Select;

class EmailAccountProfile extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            (new AccountData($model))->send();
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make(__('Person'), 'person')
                  ->options(Person::all()->mapWithKeys(function ($person) {
                      return [$person->id => $person->name];
                  }))
                  ->displayUsingLabels()
        ];
    }
}
```
