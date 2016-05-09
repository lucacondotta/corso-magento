#!/bin/bash

CMD=$1
TAG=$2
DATE=$(date +"%d%m%y%T")
ISNUM='^[0-9]+$'

if [ $CMD = "slide" ]; then

    if ! [[ $TAG =~ $ISNUM ]]; then

        echo 'Set a valid number'
        exit 1

    fi

    git stash save -q --include-untracked "$DATE"
    git checkout -f -q  $TAG
    echo 'You are now on slide group '$TAG

elif [ $CMD = "restore" ]; then

    git stash apply -q
    echo 'Your last changes have been restored'

fi


exit 0
