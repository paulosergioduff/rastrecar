import requests
import time
from datetime import datetime


if __name__ == '__main__':
    last_send = None
    while(True):
        try:
            url = 'http://jctracker.com.br/tracker3/manager/include/gerar_recorrencias_pjb_boleto.php'
            req = requests.get(url)
            print(req.text)

            url3 = 'http://jctracker.com.br/tracker3/manager/include/gerar_recorrencias_pjb_boleto_10dias.php'
            req3 = requests.get(url3)
            print(req3.text)

          
            time.sleep(5)
        except:
            time.sleep(10)