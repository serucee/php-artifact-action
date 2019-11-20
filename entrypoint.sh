#!/bin/sh -l

# Exit on failure
set -e

echo "Calling php script"
pwd
ls -la
php ./app/main.php
