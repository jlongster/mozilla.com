#!/bin/bash

if [ -z "$1" ]; then
    echo "Please specify the source code directory."
    echo "Usage: $0 SOURCE"
    echo "where:"
    echo "  SOURCE is the root directory with your PHP code"
    echo ""
    echo "Examples:"
    echo "  ./locale/extract.sh ."
    echo "  ./extract.sh .."
    exit 99
fi

SOURCE=$1
TARGET=`dirname $0`

source $TARGET/meta.config.sh
if [[ -z "$PACKAGE_NAME" || -z "$PACKAGE_VERSION" ]]; then
    echo "You must create a config file in $TARGET/meta.config.sh"
    echo "defining the following variables:"
    echo "  PACKAGE_NAME"
    echo "  PACKAGE_VERSION"
    exit 99
fi

POT="$TARGET/templates/LC_MESSAGES/messages.pot"
> $POT

echo -n "Extracting..."
find $SOURCE -name "*.php" | xgettext \
    --language=PHP \
    --add-comments=L10n \
    --force-po \
    --join-existing \
    --output=$POT \
    --copyright-holder="Mozilla Corporation" \
    --package-name="$PACKAGE_NAME" \
    --package-version="$PACKAGE_VERSION" \
    --files-from=- # Pull from standard input (our find command) \
echo "done."
