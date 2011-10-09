#!/bin/bash

DIR="$( cd "$( dirname "$0" )" && pwd )"
QUEUE_DIR=$DIR"/../.."

/usr/bin/php $QUEUE_DIR/manager.php