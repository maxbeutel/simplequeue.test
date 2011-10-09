#!/bin/bash

DIR="$( cd "$( dirname "$0" )" && pwd )"
RUN_SCRIPTS_DIR=$DIR/run
UPSTART_TEMPLATES_DIR=$DIR/upstart

cat $UPSTART_TEMPLATES_DIR/queue-worker.conf.template | sed -e 's!RUN_SCRIPTS_DIR!'"$RUN_SCRIPTS_DIR"'!g' > /etc/init/queue-worker.conf
cat $UPSTART_TEMPLATES_DIR/queue-manager.conf.template | sed -e 's!RUN_SCRIPTS_DIR!'"$RUN_SCRIPTS_DIR"'!g' > /etc/init/queue-manager.conf

echo "Copied scripts to /etc/init"
echo "Use 'start queue-worker' and 'start queue-manager'"