import requests
import time
from datetime import datetime


if __name__ == '__main__':
    while(True):
        try:
            url = 'http://jctracker.com.br/tracker3/manager/cron/envios_push.php'
            req = requests.get(url)
            print(req.text)
          
            time.sleep(5)
        except:
            time.sleep(3)