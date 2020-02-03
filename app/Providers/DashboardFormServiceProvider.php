<?php

namespace App\Providers;

use Form;
use Carbon\Laravel\ServiceProvider;

class DashboardFormServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Form::component('bsText', 'components.dashboard.form.text', [
            'label', 'name', 'isRequired' => true, 'value' => null, 'help' => null, 'attributes' => []
        ]);

        Form::component('bsTextarea', 'components.dashboard.form.textarea', [
            'label', 'name', 'isRequired' => true, 'value' => null, 'help' => null, 'attributes' => []
        ]);

        Form::component('bsSelect', 'components.dashboard.form.select', [
            'label', 'name', 'options', 'isRequired' => true, 'value' => null, 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsSelectWithoutSearch', 'components.dashboard.form.select-without-search', [
            'label', 'name', 'options', 'isRequired' => true, 'value' => null, 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsSelectMultiple', 'components.dashboard.form.select_multiple', [
            'label', 'name', 'options', 'isRequired' => true, 'value' => null, 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsCheckbox', 'components.dashboard.form.checkbox', [
            'label', 'name', 'value' => null, 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsSwitch', 'components.dashboard.form.switch', [
            'label', 'name', 'value' => null, 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsFile', 'components.dashboard.form.image', [
            'label', 'name', 'isRequired' => true, 'value' => null, 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsTextMultiple', 'components.dashboard.form.multiple.text', [
            'label', 'name', 'isRequired' => false, 'value' => [], 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsDate', 'components.dashboard.form.date', [
            'label', 'name', 'isRequired' => false, 'value' => null, 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsDateTime', 'components.dashboard.form.datetime', [
            'label', 'name', 'isRequired' => false, 'value' => null, 'help' => null, 'attributes' => [],
        ]);

        Form::component('bsSubmit', 'components.dashboard.form.submit', [
            'name', 'attributes' => [],
        ]);
    }
}