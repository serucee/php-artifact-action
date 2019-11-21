#!/bin/sh -l

# Exit on failure
set -e

echo "Calling php script"
php /usr/local/bin/app/main.php
exit $?