#!/bin/bash
kubectl delete svc mysql-cluster-service
kubectl delete svc mysql-nodeport-service
kubectl delete deployment mysql
kubectl delete pvc mysql-pv-claim
kubectl delete pv mysql-pv-volume
