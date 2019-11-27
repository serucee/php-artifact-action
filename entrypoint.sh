#!/bin/sh -l

# Exit on failure
#set -e

echo "Calling php script"
php /usr/local/bin/src/main.php
EXIT_CODE=$?

if (( "$EXIT_CODE" != "0" )); then
    echo "Script execution ended with error :: $EXIT_CODE"
    exit 1
fi
echo "Script execution successful"
exit 0