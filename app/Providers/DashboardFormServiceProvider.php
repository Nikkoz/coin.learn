<?php

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use Form;

class DashboardFormServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Form::component('bsText', 'components.dashboard.form.text', [
            'label', 'name', 'isRequired' => true, 'value' => null, 'help' => null, 'attributes' => []
        ]);
    }
}