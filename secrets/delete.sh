#!/bin/bash
kubectl delete ConfigMap control-config-map
kubectl delete secret mysql-secret
kubectl delete ConfigMap timezone-config-map
