import numpy as np
import sys
import json

def calculo(valores):
    numeros = [float(valor) for valor in valores]
    varianza = np.var(numeros)
    return varianza
if __name__ == "__main__":
    valores = sys.argv[1:6]

    if(len(valores) != 5):
        print(json.dumps({'error':"Se requieren 5 elementos"}))
        sys.exit(1)
    
    resultado = {
        'varianza' : calculo(valores)
    }

    print(json.dumps(resultado))

