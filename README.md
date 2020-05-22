# demosurfer

Just a TYPO3 Surf Deployment test

# How To

*NOTE*: This How To assumes that you are using the same machine for running the composer installation as the deployment target.
Of course you can adapt this to use a different deployment target than your localhost

## Pre-requisites

* Check out repository on a machine with composer, webserver, mysql database in any directory (here: `~/Code/demosurfer`)
* Create an empty target deployment directory with proper access settings for both the SSH user as well as PHP/TYPO3 (default: `/var/www/demosurfer`)
* Create a DNS hostname for your target server (i.e. through `/etc/hosts`) mapping to your current machine (see note above) (default: `demosurfer.develop`)
* Make sure your webserver uses the target deployment directory plus `releases/current/htdocs/web` as its DocumentRoot for this hostname (full: `/var/www/demosurfer/releases/current/htdocs/web`). The base directory can be changed, but this `releases/htdocs/current/web/` part is mandatory for this project example.
* Have a valid user account on your server that has write permissions on the DocumentRoot (i.e. through belonging to a `www` group), and which has its own SSH key (or the one you will be running the Surf deployment as) in the `authorized_keys` file. (default: `demosurfer`)
* Make sure `composer` is available in the PATH setting of your OS
* Create or use an existing database, put down the credentials in `htdocs/web/typo3conf/AdditionalConfiguration.Local.Development.php` (default: `demosurfer` DB with username+password `demosurfer`)
* Import the `build/demosurfer.sql` database dump into your `demosurfer` database; it contains a stub TYPO3 empty installation database.
* If you changed any of the mentioned defaults, adapt the file `surf/deployments/Production.Development.php` and enter your changed hostname/paths/username there. Also adapt this file if your PHP binary is not in `/usr/bin/`. 

## Perform the deployment

```
cd ~/Code/demosurfer
cd surf
composer install
SURF_HOME=~/Code/demosurfer/surf ~/Code/demosurfer/surf/bin/surf deploy Production.Development -v
```

Then you should be able to go to `http://demosurfer.develop` and see the deployed installation.
