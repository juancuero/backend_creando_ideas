<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class GenerateCrudCommand extends Command
{
    protected $model;
    protected $modelCamel;
    protected $modelKebab;

    protected function configure()
    {
        $this->setName('make:crud')
            ->setDescription('Generate CRUD files')
            ->addOption('model', 'm', InputOption::VALUE_REQUIRED, 'The model name');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->model = $this->input->getOption('model');

        if (!$this->model) {
            $this->error('The model option is required');

            return 1;
        }

        $this->modelCamel = Str::camel($this->model);
        $this->modelKebab = Str::kebab($this->model);

        $this->output->info('Generating CRUD for model: ' . $this->model);

        //Interface
        $this->generateInterfaceModel();

        //Eloquent Repository
        $this->generateEloquentRepository();

        //Controller Create
        $this->generateController('Create');

        //Controller Index
        $this->generateController('Index');

        //Controller Show
        $this->generateController('Show');

        //Controller Update
        $this->generateController('Update');

        //Controller Delete
        $this->generateController('Delete');

        //Controller Paginate
        $this->generateController('Paginate');

        //Request Create and Update
        $this->generateRequests();

        //Resources
        $this->createResources();

        //Routes Create
        $this->generateRoutes();

        return Command::SUCCESS;
    }

    public function generateInterfaceModel()
    {
        $path = 'app/Interfaces/Repositories/' . $this->model . 'Repository.php';

        $stub = File::get('./stubs/Interfaces/InterfaceModel.stub');

        $stubReplace = [
            '**Model**' => $this->model,
        ];

        $file = strtr($stub, $stubReplace);

        File::put($path, $file);

        $this->output->info('Created: ' . $path);
    }

    public function generateEloquentRepository()
    {
        $path = 'app/Repositories/Eloquent' . $this->model . 'Repository.php';

        $stub = File::get('./stubs/Repositories/EloquentModelRepository.stub');

        $stubReplace = [
            '**Model**' => $this->model,
        ];

        $file = strtr($stub, $stubReplace);

        File::put($path, $file);

        $this->output->info('Created: ' . $path);
    }

    public function generateController($action)
    {
        $folderController = 'app/Http/Controllers/V1/' . $this->model;

        if (!file_exists($folderController)) {
            mkdir($folderController, 0777, true);
        }

        $path = $folderController . '/' . $this->model . $action . 'Controller.php';

        $stub = File::get('./stubs/Controllers/Model' . $action . 'Controller.stub');

        $stubReplace = [
            '**Model**' => $this->model,
            '**modelCamel**' => $this->modelCamel,
            '**modelKebab**' => $this->modelKebab,
        ];

        $file = strtr($stub, $stubReplace);

        File::put($path, $file);

        $this->output->info('Created: ' . $path);
    }

    public function generateRequests()
    {
        $folderRequests = 'app/Http/Requests/V1/' . $this->model;

        if (!file_exists($folderRequests)) {
            mkdir($folderRequests, 0777, true);
        }

        $path = $folderRequests . '/' . $this->model . 'CreateRequest.php';

        $stub = File::get('./stubs/Requests/ModelRequest.stub');

        $stubReplace = [
            '**Model**' => $this->model,
            '**Action**' => 'Create',
        ];

        $file = strtr($stub, $stubReplace);

        File::put($path, $file);

        $this->output->info('Created: ' . $path);

        $path = $folderRequests . '/' . $this->model . 'UpdateRequest.php';

        $stub = File::get('./stubs/Requests/ModelRequest.stub');

        $stubReplace = [
            '**Model**' => $this->model,
            '**Action**' => 'Update',
        ];

        $file = strtr($stub, $stubReplace);

        File::put($path, $file);

        $this->output->info('Created: ' . $path);
    }

    public function generateRoutes()
    {
        $folderRoutes = 'routes/V1/' . $this->model;

        if (!file_exists($folderRoutes)) {
            mkdir($folderRoutes, 0777, true);
        }

        $path = $folderRoutes . '/api.php';

        $stub = File::get('./stubs/Routes/api.stub');

        $stubReplace = [
            '**Model**' => $this->model,
            '**modelCamel**' => $this->modelCamel,
            '**modelKebab**' => $this->modelKebab,
        ];

        $file = strtr($stub, $stubReplace);

        File::put($path, $file);

        $this->output->info('Created: ' . $path);
    }

    public function createResources()
    {
        Artisan::call('make:resource', [
            'name' => 'Api/V1/' . $this->model . '/' . $this->model . 'Resource',
        ]);

        $path = 'app/Http/Resources/Api/V1/' . $this->model . '/' . $this->model . 'Collection.php';

        $stub = File::get('./stubs/Resources/ModelCollection.stub');

        $stubReplace = [
            '**Model**' => $this->model,
        ];

        $file = strtr($stub, $stubReplace);

        File::put($path, $file);
    }
}
