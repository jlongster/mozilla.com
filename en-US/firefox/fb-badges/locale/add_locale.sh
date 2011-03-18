#!/bin/bash

if [ -z "$2" ]; then
    echo "Two arguments are required."
    echo "Usage: $0 VCODE GCODE"
    echo "where"
    echo "  VCODE is the locale code used by Verbatim (e.g. 'es')"
    echo "  GCODE is the locale code used by Gettext (e.g. 'es_ES.utf8')"
    exit 99
fi

LOCALEDIR=`dirname $0`
V=$1
G=$2

mkdir -p $LOCALEDIR/$V/LC_MESSAGES

for pot in `ls -1 $LOCALEDIR/templates/LC_MESSAGES`; do
    echo "Initializing $pot"
    fname=`basename $pot .pot`
    msginit --no-wrap \
            --no-translator \
            -l $G \
            -i $LOCALEDIR/templates/LC_MESSAGES/$pot \
            -o $LOCALEDIR/$V/LC_MESSAGES/${fname}.po
done
