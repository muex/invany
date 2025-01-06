<?php

namespace Deployer;

// Include base recipes
require 'recipe/symfony.php';

// Include hosts
import('.hosts.yml');

set('http_user', 'ssh-w0186f22');
set('http_group', 'w0186f22');

set('repository', 'https://github.com/muex/invany.git');
set('writable_mode', 'chmod');
// Define binaries
set('/usr/bin/php', 'php');

// Set maximum number of releases
set('keep_releases', 5);

// Use current date as release name
set('release_name', fn() => run('echo $(date "+%Y-%m-%dT%H-%M-%S")'));

// Set shared directories
$sharedDirectories = [
    'var/log',
    'public/uploads'
];
set('shared_dirs', $sharedDirectories);

// Set shared files
$sharedFiles = [
    '.env.local',
];
set('shared_files', $sharedFiles);
// Schreibbare Verzeichnisse
set('writable_dirs', ['var/cache', 'var/log', 'public/uploads']);


// Tasks
desc('Installiere Abhängigkeiten');
task('deploy:vendors', function () {
    run('composer install --no-dev --optimize-autoloader');
});

desc('Cache leeren und aufwärmen');
task('deploy:cache', function () {
    run('php {{release_path}}/bin/console cache:clear --env=prod');
    run('php {{release_path}}/bin/console cache:warmup');
});

desc('Datenbank-Migrationen ausführen');
task('database:migrate', function () {
    run('php {{release_path}}/bin/console doctrine:migrations:migrate --no-interaction');
});

// Deployment-Workflow
desc('Deployment starten');
task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'deploy:cache',
    'database:migrate',
    'deploy:publish',
]);

// Fehlerbehandlung
after('deploy:failed', 'deploy:unlock');
