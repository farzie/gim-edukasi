# Dockerfile
# Menggunakan base image Python yang ringan
FROM python:3.11-slim

# Set working directory di dalam container
WORKDIR /usr/src/app

# Container hanya akan menjalankan skrip python bernama script.py
# Ini adalah titik masuk default saat container dijalankan
CMD ["python", "script.py"]