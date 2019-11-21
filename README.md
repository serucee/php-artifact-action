# Container Action Template

Builds a release artifact according to the configuration file (artifact-configuration.json) in the calling repository.  
When using zip the generated artifact is called artifact.zip and is stored in /github/workspace 

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