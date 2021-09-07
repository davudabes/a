import json
import requests
import time
from bs4 import BeautifulSoup
from datetime import datetime, timedelta
import mysql.connector
## MYSQL CONNECT ##
mydb = mysql.connector.connect(
  host='',
  user='',
  password='',
  db=''
)
mycursor = mydb.cursor()

#ACCOUNT GRP 1
APIKEY = "GD3G2J97BC7DSSTB84USAEVXWP4V754HXW" #Lucas
APIKEY2 = "9JDA4Y6R9V7CJSEVXJKMFK5Z7QUA8JK41P" #Lucas
APIKEY3 = "M53YW3RA6U52WFN43TP1M74QWW7PCMHCBA" #Lucas
#ACCOUNT GRP 2
APIKEY4 = "QR2IDDMFE5Z874F4GHJK87WKA9K5IVEBE5" #Jack
APIKEY5 = "7K7D6QYQVP4GWVVSKGB8ZIVF84TGXIRPT3" #Jack
APIKEY6 = "GNGDK2DCT1177V8JKKPINRNY1R8Z3EY2SI" #Jack
# ACCOUNT GRP 3
APIKEY7 = "Q6E3A1Z73Y6YAWPF6N1I9VTDT7ZPWRK3FG" #Lucas2
APIKEY8 = "YIJBRHNDBENIABH7D59CE3Q6HIHYHKTJ4T" #Lucas2
APIKEY9 = "F3Y14Q554KWZFPPZE2INKDCTHJ76MISAVN" #Lucas2
# ACCOUNT GRP 5
APIKEY10 = "6I8J1NB6KPSNZDWBX5BK98CRW6NEGRKT8U" #Jack2
APIKEY11 = "8B4GSUMD44BMDYA9W48ABX7HPU1VQW3ZF6" #Jack2
APIKEY12 = "ZKFGNWFMPFP98V733MWE5GTTN4H6ICVGZ6" #Jack2

apikeys = [APIKEY,APIKEY4,APIKEY7,APIKEY10,APIKEY2,APIKEY5,APIKEY8,APIKEY11,APIKEY3,APIKEY6,APIKEY9,APIKEY12,]
number = 0
counter = 0

def countAPICalls():
    global counter
    counter = counter + 1

def apiKeyCycle():
    global number
    if number > 5:
        number = 0
    index_number = number
    number = number + 1
    return apikeys[index_number]

def blockFinder(lastBlockChecked):
    block_api = "https://api.arbiscan.io/api?module=proxy&action=eth_blockNumber&apikey=" + apiKeyCycle() + ""
    countAPICalls()
    time.sleep(2)
    api_request = requests.get(block_api)
    current_block_id_result = api_request.json()['result']
    current_block_id = maxRateLimit(current_block_id_result,block_api)
    previous_block_decimal = int(current_block_id, 16) - 1
    if previous_block_decimal == lastBlockChecked:
        previous_block_id = hex(previous_block_decimal)
        return previous_block_id
    elif previous_block_decimal > lastBlockChecked:
        lastBlockChecked = lastBlockChecked + 1
        previous_block_id = hex(lastBlockChecked)
        return previous_block_id
    else:   
        previous_block_id = hex(previous_block_decimal)
        return previous_block_id

def maxRateLimit(response, url):
    if response == 'Max rate limit reached':
        print('Max limit Reached -- Waiting')
        #time.sleep(2)
        while response == 'Max rate limit reached':
            #time.sleep(1)
            time.sleep(2)
            request = requests.get(url)
            response = request.json()['result']
        return response
    else:
        return response

block_api = "https://api.arbiscan.io/api?module=proxy&action=eth_blockNumber&apikey=" + apiKeyCycle() + ""
countAPICalls()
time.sleep(2)
api_request = requests.get(block_api)
current_block_id_result = api_request.json()['result']
current_block_id = maxRateLimit(current_block_id_result,block_api)
last_block_checked = int(current_block_id, 16) - 1
checked_previous = int(current_block_id, 16) - 2

while True:
    if "x" not in str(last_block_checked):
        pass
    else:
        last_block_checked = int(last_block_checked, 16)
    last_block_checked = blockFinder(last_block_checked)
    last_block_checked_int = int(last_block_checked, 16)
    if last_block_checked_int != checked_previous:
        block_txs_api = "https://api.arbiscan.io/api?module=proxy&action=eth_getBlockByNumber&tag=" + last_block_checked + "&boolean=true&apikey=" + apiKeyCycle() + ""
        countAPICalls()
        last_block_checked, checked_previous = int(last_block_checked, 16), int(last_block_checked, 16)
        print("Checking Block: " + str(last_block_checked))
        time.sleep(2)
        api_request = requests.get(block_txs_api)   
        transactions_from_block_result = api_request.json()['result']
        transactions_from_block = maxRateLimit(transactions_from_block_result,block_txs_api)['transactions']
        for transcation in transactions_from_block:
            if transcation['to'] is None:
                print("Found")
                tHash = transcation['hash']
                contract_api = "https://api.arbiscan.io/api?module=proxy&action=eth_getTransactionReceipt&txhash=" + tHash + "&apikey=" + apiKeyCycle() + ""
                print(contract_api)
                countAPICalls()
                time.sleep(2)
                api_request_contract = requests.get(contract_api)
                transactions_from_block_result = api_request_contract.json()['result']
                transactions_from_block = maxRateLimit(transactions_from_block_result,contract_api)['contractAddress']
                time.sleep(2)
                if transactions_from_block == None:
                    transactions_from_block = ''
                else:
                    pass
                contact_info_request = requests.get("https://arbiscan.io/token/" + transactions_from_block + "", allow_redirects=False)
                if contact_info_request.status_code == 200:
                    contact_info_request_texxt = contact_info_request.text
                    contract_info_request_response = BeautifulSoup(contact_info_request_texxt, "html.parser")
                    contract_token_name_gather = contract_info_request_response.select('div.media-body')[0].text.strip()
                    contract_token_name = contract_token_name_gather.replace("Token ","")
                    if contract_token_name != "Token":
                        contract_total_supply_gather = contract_info_request_response.select('span.hash-tag')[0].text.strip()
                        contract_symbol_gather = contract_info_request_response.select('div.font-weight-medium')[0].text
                        contract_symbol = contract_symbol_gather.replace(contract_total_supply_gather,"")
                        contract_holders_gather = contract_info_request_response.select('div.mr-3')[0].text.strip()
                        contract_holders = contract_holders_gather.replace(" addresses","")
                        contract_deploy_time = datetime.now()
                        print(contract_deploy_time)
                        contract_creation_time = contract_deploy_time.strftime("%H:%M:%S")
                        contract_deployed_date = datetime.today().strftime('%Y-%m-%d')
                        full_date_time = contract_deployed_date + " " + contract_creation_time
                        contract_api_url = "https://api.arbiscan.io/api?module=contract&action=getsourcecode&address=" + transactions_from_block + "&apikey=" + apiKeyCycle() + ""
                        time.sleep(2)
                        contract_api_request = requests.get(contract_api_url)
                        contract_result = contract_api_request.json()['result']
                        print(contract_result)

                        print("Contract Name: " + contract_token_name + " // Contract Address: " + transactions_from_block + " // Contract Holders: " + contract_holders + " // Total Supply: " + contract_total_supply_gather + " // Creation Time: " + contract_creation_time)
                        try:
                            sql = "INSERT INTO coinTracker (coinName, coinSymbol, contractAddress, totalSupply, contractDeployed, contractDeployedDate, website_pulled) VALUES (%s, %s, %s, %s, %s, %s, %s)"
                            val = (contract_token_name, contract_symbol, transactions_from_block, contract_total_supply_gather, contract_creation_time, contract_deployed_date, full_date_time)
                            mycursor.execute(sql, val)
                            mydb.commit()
                        except:
                            print("Failed to port to Database")
                    else:
                        pass
                    #time.sleep(1)
                else:
                    print("Not 200")
            else:
                pass
        else:
            time.sleep(2)     
    #time.sleep(5)






