import requests
import time
from datetime import datetime


if __name__ == '__main__':
    while(True):
        try:
            url3 = 'http://jctracker.com.br/tracker3/manager/cron/global2.php'
            req3 = requests.get(url3)
            print(req3.text)
            
          
            time.sleep(5)
        except:
            time.sleep(8)