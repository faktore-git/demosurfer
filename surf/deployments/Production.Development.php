<?php
/** @var \TYPO3\Surf\Domain\Model\Deployment $deployment */
$workflow = new \TYPO3\Surf\Domain\Model\SimpleWorkflow();

$configuration = [
    'hostname'      => 'demosurfer.develop',
    'baseUrl'       => 'http://demosurfer.develop/',

    'php'           => '/usr/bin/php',
    'repository'    => 'https://github.com/faktore-git/demosurfer.git',
    'branch'        => 'master',
    'environment'   => 'production',

    'composerPath'  => 'htdocs',
    'docRoot'       => 'htdocs/web',
    'remoteRoot'    => '/var/www/demosurfer/',
    'remoteDocRoot' => '/var/www/demosurfer/releases/current/htdocs/web/',
    'sshUser'       => 'demosurfer',
];

$environment = ucfirst($configuration['environment']);

$liveNode = new \TYPO3\Surf\Domain\Model\Node('Production/' . $environment);
$liveNode->setHostname($configuration['hostname'])
    ->setOption('username', $configuration['sshUser']);

$application = new \TYPO3\Surf\Application\TYPO3\CMS($configuration['hostname']);
$application->addNode($liveNode)
    ->setOption('useApplicationWorkspace', false)

    ->setOption('phpBinaryPathAndFilename', $configuration['php'])

    ->setOption('composerCommandPath', 'composer')

    ->setOption('keepReleases', 3)
    ->setOption('repositoryUrl', $configuration['repository'])
    ->setOption('branch', $configuration['branch'])

    ->setOption('scriptFileName', $configuration['composerPath'] . '/vendor/bin/typo3cms')
    ->setOption('webDirectory', $configuration['docRoot'])
    ->setOption('composerJsonPath', $configuration['composerPath'])

    ->setOption('context', 'Production/' . $environment)
    ->setOption('rsyncExcludes', array(
        '/.git',
        '/.gitignore',
        '/readme.md',
        '/build',
        '/surf'
    ))
    ->setOption(
        'scriptBasePath',
        \TYPO3\Flow\Utility\Files::concatenatePaths([$deployment->getWorkspacePath($application), ''])
    )
    ->setOption('baseUrl', $configuration['baseUrl'])
    ->setDeploymentPath($configuration['remoteRoot']);

$deployment->addApplication($application);

$workflow->defineTask(
    'Faktore\\Surf\\DefinedTask\\Node\\EnvironmentSymLinkTask',
    'TYPO3\\Surf\\Task\\ShellTask',
    [
        'command' =>
            [
                // Just a stub, if you want .env files in deployment target
                // "ln -s " . $configuration['remoteRoot'] . "/shared/.env " . $deployment->getApplicationReleasePath($application) . "/" . $configuration['composerPath'] . "/.env",
            ]

    ]
);

/** @var \TYPO3\Surf\Domain\Model\Deployment $deployment */
$deployment->setWorkflow($workflow);

$deployment->onInitialize(function() use ($workflow, $application) {
    $workflow->afterTask(
        \TYPO3\Surf\Task\Generic\CreateSymlinksTask::class,
        'Faktore\\Surf\\DefinedTask\\Node\\EnvironmentSymLinkTask',
        $application
    );

    // SymLinks are created with a custom task
    $workflow->removeTask('TYPO3\\Surf\\Task\\TYPO3\\CMS\\SymlinkDataTask');

    // Required customized InstallTask to be able to use a custom composer.json non-project root location
    // If you reached this line, this is what the repository is all about. Hi!
    $workflow->removeTask('TYPO3\\Surf\\DefinedTask\\Composer\\LocalInstallTask');
    $workflow->defineTask(
        'Faktore\\Surf\\DefinedTask\\Composer\\LocalInstallTask',
        'Faktore\\Surf\\Task\\Composer\\InstallTask', [
            'nodeName' => 'localhost',
            'useApplicationWorkspace' => true
        ]
    );

    $workflow->afterTask(
        'TYPO3\\Surf\\Task\\Package\\GitTask',
        'Faktore\\Surf\\DefinedTask\\Composer\\LocalInstallTask',
        $application
    );

    $workflow->beforeTask(
        'TYPO3\\Surf\\Task\\TYPO3\\CMS\\SetUpExtensionsTask',
        'TYPO3\\Surf\\Task\\TYPO3\\CMS\\FlushCachesTask',
        $application
    );

    $workflow->beforeTask(
        'TYPO3\\Surf\\Task\\TYPO3\\CMS\\SetUpExtensionsTask',
        'TYPO3\\Surf\\Task\\TYPO3\\CMS\\CompareDatabaseTask',
        $application
    );
});

/** @var \TYPO3\Surf\Domain\Model\Deployment $deployment */
$deployment->setWorkflow($workflow);
