import requests
import time
from datetime import datetime


if __name__ == '__main__':
    while(True):
        try:
            url3 = 'http://rastreiamaisbrasil.com.br/tracker3/manager/include/aviso_vencimento.php'
            req3 = requests.get(url3)
            print(req3.text)
            
          
            time.sleep(4)
        except:
            time.sleep(8)