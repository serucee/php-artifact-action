#!/bin/sh -l

# Exit on failure
set -e

echo "Calling php script"
php /usr/local/bin/src/main.php
EXIT_CODE=$?

if ! [[ "$EXIT_CODE" == 0 ]]; then
    echo "::error file=main.php::Script execution ended with error message $EXIT_CODE"
    exit 1
fi
echo "Script execution successful"
exit 0