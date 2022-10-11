<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository in repositories';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $interfaceName = $name."Interface";
        $interfaceFileName = "\\".$name."Interface";
        if (!file_exists('app/Http/Repositories')) {
            mkdir('app/Http/Repositories', 0777, true);
        }
        if (!file_exists('app/Http/Interfaces')) {
            mkdir('app/Http/Interfaces', 0777, true);
        }
        $repositoryFile = fopen("app/Http/Repositories/$name.php", "w") or die("Unable to open file!");
        $interfaceFile = fopen("app/Http/Interfaces/$interfaceName.php", "w") or die("Unable to open file!");
        $repositoryText ="<?php \n\nnamespace App\Http\Repositories; \n\nuse App\Http\Interfaces$interfaceFileName;\n\nclass $name implements $interfaceName {\n//\n}";

        $interfaceText ="<?php \n\nnamespace App\Http\Interfaces; \n\ninterface $interfaceName { \n //\n}";
        fwrite($repositoryFile, $repositoryText);
        fwrite($interfaceFile, $interfaceText);

        $this->info('Repository and Interface has successfully created');

    }
}
