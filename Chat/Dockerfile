#charger l'image python
FROM python:3.9-slim

#Definit le workspace du conteuneur
WORKDIR /app

#Copi le fichier requirements.txt dans le conteuneur
COPY requirements.txt /app

#Installer les dependences
RUN pip install -r requirements.txt

EXPOSE 8000
#Copier le contenu du repertoire courant dans le conteuneur 
COPY . /app

#Command to run myapi application
CMD [ "uvicorn","myapi:app","--host","0.0.0.0","--port","8000","--reload"]