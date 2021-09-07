import requests
import json
import decimal
import random
import time
from datetime import datetime
import mysql.connector

## MYSQL CONNECT ##
mydb = mysql.connector.connect(
  host='',
  user='',
  password='.',
  db=''
)
mycursor = mydb.cursor()
## MYSQL CONNECT END ##

## COINS TRACKED ##
amoon = ["amoon","0xa9ef69cac80488ef05926023421214c98f22105d"]
adoge = ["adoge","0x11eecdbd8f2d670016d061e4c064072e6158ede2"]
sts = ["sts","0x8d8415e8f9fd6e7d0a1e6cad05f52dc83fb80ad2"]
arbitmoon = ["arbitmoon","0x9fed11d8dafeec39ae10188c599a3cd7cdcfc0ad"]
arib = ["arib","0xb0a5b5649104ccf27f9d14e23894c025c21fd4b5"]
aufo = ["aufo","0x05b04c68abfd85e72f3ac72692089eca433efb2b"]
acat = ["acat","0xb3f5daa49e6ca7026a511f5a79b491958e63f5a5"]
akitaarbi = ["akitaarbi","0x26274e0db149c847df7a3cf1fde9e93522a42d72"]
chainlink = ["chainlink","0x6f6ba3571a607e62f4b7f722e019925269e90f5a"]
sushitoken = ["sushitoken","0x3221022e37029923ace4235d812273c5a42c322d"]
wrappedether = ["wrappedether","0x905dfcd5649217c42684f23958568e533c711aa3"]
honeypot = ["honeypot","0xfc1acf07202f6fac951947427b79284d86a965d2"]
arbys = ["arbys","0xf4a738d9cae344cea4165f335d478493a7946f24"]
arbmars = ["arbm","0x54b9b260016990be64869dbc738763354f6ecf65"]
arbimars = ["arbimars","0x58e07553d44a7c8538f4e383065254ad44ad4c2f"]
gmx = ["gmx","0x05c6f695ad50c16299bedca3fe9059b56550082f"]

all_coins = [gmx,arbimars,arbmars,arbys,honeypot,amoon,adoge,sts,arbitmoon,arib,aufo,acat,akitaarbi,chainlink,sushitoken,wrappedether]
## COINS TRACKED END ##

## WAIT TIME ##
waiter = 60 / len(all_coins)
print(waiter)
## WAIT TIME END ##

## API CALL FUNCTION ##
def APIresponse(coin_name,coin_id):
    if(coin_name == "honeypot" or coin_name == "akitaarbi" or coin_name == 'arbys' or coin_name == 'arbimars'):
      api = "https://api2.sushipro.io/?chainID=42161&action=get_pair&pair=" + coin_id
      response = requests.get(api)
      response.raise_for_status()
      if response == 200:
        response.json()
      else:
        response = requests.get(api).json()
      currentpriceAPI = response[0]["Token_1_price"]
      return currentpriceAPI      
    else:
      api = "https://api2.sushipro.io/?chainID=42161&action=get_pair&pair=" + coin_id
      response = requests.get(api)
      response.raise_for_status()
      if response == 200:
        response.json()
      else:
        response = requests.get(api).json()    
      currentpriceAPI = response[0]["Token_2_price"]
      return currentpriceAPI     

## API CALL FUNCTION END ##

while True:
    for coin in all_coins:
        coin_name = coin[0]
        coin_id = coin[1]
        coin_price = APIresponse(coin_name,coin_id)
        sql = "INSERT INTO all_coins (date, price, datetime, coin_name) VALUES (%s, %s, %s, %s)"
        val = (datetime.utcnow(),coin_price,datetime.utcnow(),coin_name)
        mycursor.execute(sql, val)
        mydb.commit()
        print("Success - Input " + coin_name + " at " + str(datetime.utcnow()) + " " + str(coin_price))
        time.sleep(waiter)




