from fastapi import FastAPI
from pydantic import BaseModel
from chat import reponse_chat
from fastapi.middleware.cors import CORSMiddleware
import uvicorn

app = FastAPI()

# Configurer les origines autorisées pour le CORS
origins = ["https://695994ae-6b10-45b5-838d-b9f34b1a4477.app.gra.ai.cloud.ovh.net/myapi", "https://www.existence-numerique.fr"]  # Ou spécifiez les origines qu'on souhaite autoriser, par exemple ["http://localhost", "http://127.0.0.1"]

# Ajouter le middleware CORS
app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

class Question(BaseModel):
    question: str

@app.post('/myapi')
async def my_api(question: Question):
    reponsee = reponse_chat(question.question)
    return reponsee

# Endpoint de readiness pour vérifier que l'application est prête à accepter des requêtes
@app.get("/ready")
async def readiness_check():
    # Ici, tu peux ajouter des vérifications supplémentaires, comme tester des connexions à une base de données
    return {"status": "ready"}

if __name__ == '__main__':
    # Pour le développement local uniquement, il est préférable d'utiliser `uvicorn.run` avec les paramètres suivants
    uvicorn.run(app, host="127.0.0.1", port=8000, reload=True)
