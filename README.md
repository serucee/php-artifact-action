# Container Action Template

!WIP!  
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