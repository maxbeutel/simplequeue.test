#!/bin/bash

DIR="$( cd "$( dirname "$0" )" && pwd )"
QUEUE_DIR=$DIR"/../.."

$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 1 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 2 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 3 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 4 > /dev/null 2>&1 &

$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 5 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 6 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 7 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 8 > /dev/null 2>&1 &

$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 9 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 10 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 11 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 12 > /dev/null 2>&1 &

$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 13 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 14 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 15 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 16 > /dev/null 2>&1 &

$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 17 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 18 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 19 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 20 > /dev/null 2>&1 &

$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 21 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 22 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 23 > /dev/null 2>&1 &
$QUEUE_DIR/scripts/util/timeout.sh 10 /usr/bin/php $QUEUE_DIR/worker.php 24 > /dev/null 2>&1 &
