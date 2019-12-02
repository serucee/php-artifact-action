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

The Builder folder currently contains the ```PackageConfigurationBuilder``` to be able to use different output formats in the future.

### Exception

The Exception folder contains all the defined exceptions used in the project.

### Helper

The Helper folder contains helpers and classes that actually execute or run something.  
* ```ArrayHelper```  
  The ArrayHelper contains methods useful for handling arrays
* ```ExceptionHelper```  
  The ExceptionHelper is a wrapper for exception handling to return correct output for entrypoint.sh
* ```FileParserAbstract```  
  The FileParserAbstract is a base class for file parsers, so several configuration types are possible in the future.
* ```FileParserJson```  
  The FileParserJson extends the FileParserAbstract and returns the parsed file as an array.
* ```Parser Interface```  
  The Parser Interface is used to have a common interface for parsers.
* ```Runner```  
  The Runner executes bash commands using configuration objects.

### Model

The Model folder contains configuration objects used by helpers.  
* ```ComposerConfiguration```  
  The ComposerConfiguration contains all necessary information the Runner needs to execute composer commands.
* ```Configuration```  
  The Configuration acts as a DTO for all configuration objects used.
* ```ConfigurationAbstract```  
  The ConfigurationAbstract is used to define all base methods Configuration objects require for the Runner.
* ```PackageConfigurationAbstract```  
  The PackageConfigurationAbstract is a layer to support different package types in the future.
* ```PackageConfigurationZip```  
  The PackageConfigurationZip contains all necessary information the Runner needs to execute a zip command.