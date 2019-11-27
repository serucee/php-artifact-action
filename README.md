# Container Action Template

Builds an artifact according to the configuration file (artifact-configuration.json) in the calling repository.  
When using zip the generated artifact is called artifact.zip and is stored in /github/workspace  
This can be used in an automated release workflow to create assets, as seen [here](https://github.com/serucee/github-actions/blob/master/.github/workflows/create_release.yml)

## How to setup

Simply add the action to your workflow
````
- name: Create release package
  uses: serucee/php-artifact-action@master
````
And add ````artifact-configuration.json```` to your repository.  
Below you can find an [example configuration](#example-artifact-configurationjson). 

## How to configure

The script takes the full configuration out of the ````artifact-configuration.json```` since it was created with the purpose 
to be used in several php projects and I wanted to avoid passing too many parameters in the workflow files.

## Example artifact-configuration.json

### Mandatory example artifact-configuration.json
````json
{
  "package": {
    "type": "zip"
  }
}
````
### Full example artifact-configuration.json

```json
{
  "package": {
    "type": "zip",
    "execution-path": "/github/workspace",
    "file-blacklist": ["randomfile.txt", "*.md*"],
    "folder-blacklist": ["randomfolder", "tests/*"]
  },
  "composer": {
    "execution-path": "/github/workspace"  
 }
}
```

## Short overview of the file structure and classes

### main.php

The ```main.php``` file is the main file called through ```entrypoint.sh``` in the container.  
It calls the required objects in the correct order and executes the necessary methods.

### Builder

The Builder folder currently contains the PackageConfigurationBuilder to be able to use different output formats in the future.

### Exception

The Exception folder contains all the defined exceptions used in the project.

### Helper

### Model