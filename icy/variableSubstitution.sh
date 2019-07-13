#!/bin/bash 
listvar=`env `
for envar in $listvar 
do
    envName=`echo $envar | cut -d '=' -f1`
    envValue=`echo $envar | cut -d '=' -f2`
    envValue=`echo $envValue | awk '{ gsub("/","\\\/",$0); print $0 }'`
    matchname=`egrep $envName'[\ \t]*=.*' .env`
    if [ -z "$matchname" ]
    then
        echo "no variable match"
    else
        sed  -i -e "s/$envName=.*/$envName=$envValue/g" .env
    fi

done