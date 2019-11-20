#!/bin/sh -l

# Exit on failure
set -e

echo "Calling php script"
php /usr/local/bin/app/main.php
# add check if zip file was created in workspace dir