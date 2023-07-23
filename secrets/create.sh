#!/bin/bash
kubectl apply -f mysql-secret.yaml
kubectl apply -f control-config-map.yaml
kubectl apply -f timezone-config-map.yaml
