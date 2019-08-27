### Typo3 Upgrade script

Create subdirectory in your Typo3 root (for example `.upgrade`).  
  
Put your project specific SQL scripts in `.upgrade/config/project/`
Put your instance specific SQL scripts in `.upgrade/config/instances/[instance name]/`
  
Create `.upgrade/composer.json`
```
{
  "repositories": [
    {
      "type": "composer",
      "url": "https://composer.typo3.org/"
    },
    {
      "type": "git",
      "url": "https://github.com/sourcebroker/upgrade-typo3.git"
    }
  ],
  "require": {
    "sourcebroker/typo3-upgrade": "dev-master"
  }
}
```  
  
Install with  
`composer update [--ignore-platform-reqs]`

Run upgrade in your Typo3 root directory  
`./.upgrade/vendor/bin/typo3-upgrade.php`
