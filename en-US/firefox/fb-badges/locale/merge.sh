#!/bin/bash

TARGET=`dirname $0`

POT="$TARGET/templates/LC_MESSAGES/messages.pot"

echo "Merging all locales..."
for i in `find $TARGET -type f -name "messages.po"`; do
    dir=`dirname $i`
    stem=`basename $i .po`

    # msgen will copy the msgid -> msgstr for English.  All other locales will get a blank msgstr
    if [[ "$i" =~ "en" ]]; then
        msgen $POT | msgmerge -U --backup=off "$i" -
    else
        msgmerge -U --backup=off "$i" $POT
    fi
done
