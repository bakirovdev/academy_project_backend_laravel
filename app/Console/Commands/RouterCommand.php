<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RouterCommand extends Command
{

    protected $signature = 'make:router {name}';

    protected $description = 'make route for model';

    public function handle()
    {
        $routeName = $this->argument('name');
        if (!file_exists('app/Http/Routes')) {
            mkdir('app/Http/Routes', 0777, true);
        }
        $repositoryFile = fopen("app/Http/Routes/$routeName.php", "w") or die("Unable to open file!");
        $repositoryText = "<?php \nnamespace App\Http\Routes;\n\nuse Illuminate\Support\Facades\Route;\n\nclass $routeName {\n   public static function routes(){\n//\n   }\n}";

        fwrite($repositoryFile, $repositoryText);
        $this->info('Router has successfully created');
    }
}
