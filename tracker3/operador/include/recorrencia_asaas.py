import requests
import time
from datetime import datetime


if __name__ == '__main__':
    last_send = None
    while(True):
        try:
            url = 'http://rastreiamaisbrasil.com.br/tracker3/manager/include/gerar_recorrencias_asaas_boleto_5dias.php'
            req = requests.get(url)
            print(req.text)

            url3 = 'http://rastreiamaisbrasil.com.br/tracker3/manager/include/gerar_recorrencias_asaas_boleto_10dias.php'
            req3 = requests.get(url3)
            print(req3.text)

          
            time.sleep(5)
        except:
            time.sleep(10)