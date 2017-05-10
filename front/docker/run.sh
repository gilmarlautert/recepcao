#!/bin/bash

PROJECT_NAME="recepcao"
PROJECT_PORT="4200"
PROJECT_DIR=$(dirname "$(dirname "$(readlink -f "$0")")")


sudo docker rm -f $PROJECT_NAME
sudo docker build -t $PROJECT_NAME --force-rm "$PROJECT_DIR/docker"

sudo docker run -p "$PROJECT_PORT":4400 \
    		--name "$PROJECT_NAME" -d  \
    		-v "$PROJECT_DIR":/var/www/ \
    		-i "$PROJECT_NAME"

echo "Running project over http://localhost:$PROJECT_PORT"

