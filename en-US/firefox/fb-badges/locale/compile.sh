#!/bin/bash

PROJECT="fbbadges2011"

LOCKFILE="/tmp/${PROJECT}-compile-po.lock"

# check if the lockfile exists
if [ -e $LOCKFILE ]; then
    echo "$LOCKFILE present, exiting"
    exit 99
fi

TARGET=`dirname $0`

touch $LOCKFILE
for lang in `find $TARGET -type f -name "*.po"`; do
    dir=`dirname $lang`
    stem=`basename $lang .po`
    msgfmt -o ${dir}/${stem}.mo $lang
done
rm $LOCKFILE
