<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class crud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {nom : nom de modèle/table avec une majuscule et au singulier (ex : Produit)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Génère le nécessaire pour faire des CRUDs.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('nom');

        $this->controller($name);
        $this->model($name);
        $this->request($name);
    
        \File::append(base_path('routes/api.php'), 'Route::resource(\'' .  strtolower(\Str::of($name)->plural()) . "', '{$name}Controller');");
    }

    protected function getCrud($type)
    {
        return file_get_contents(resource_path("fichiersTypesCRUD/$type.php"));
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getCrud('Model')
        );

        file_put_contents(app_path("/{$name}.php"), $modelTemplate);
    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(\Str::of($name)->plural()),
                strtolower($name)
            ],
            $this->getCrud('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getCrud('Request')
        );

        if(!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }

}
