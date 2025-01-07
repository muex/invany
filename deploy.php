<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'invany');

// Project repository
set('repository', 'https://github.com/muex/invany.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', ['.env.local']);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('w0186f22.kasserver.com')
    ->set('deploy_path', '/www/htdocs/w0186f22/invany');
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

