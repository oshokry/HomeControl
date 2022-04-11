#!/bin/bash
kubectl delete svc control-cluster-service
kubectl delete svc control-nodeport-service
kubectl delete deployment control
kubectl delete pvc control-pv-claim
kubectl delete pv control-pv-volume
