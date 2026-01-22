# Use a base image
FROM python:3.11

# Set working directory inside container
WORKDIR /app

# Copy project files
COPY . .

# Install dependencies (if any)
RUN pip install --no-cache-dir -r requirements.txt

# Command to run when container starts
CMD ["python", "app.py"]
