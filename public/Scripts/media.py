import sys
import json

def calcular_media(valores):
    numeros = [float(valor) for valor in valores]
    media = sum(numeros) / len(numeros)
    return media

if __name__ =="__main__":
    valores = sys.argv[1:6]

    if len(valores) != 5:
        print(json.dumps({"error": "Se requieren exactamente 5 valores"}))
        sys.exit(1)

    resultado = {
        "media": calcular_media(valores)
    }

    print(json.dumps(resultado))
