import re,time
import requests
from bs4 import BeautifulSoup
RESET = '\033[0m'
BLACK = '\033[30m'
RED = '\033[31m'
GREEN = '\033[32m'
YELLOW = '\033[33m'
BLUE = '\033[34m'
MAGENTA = '\033[35m'
CYAN = '\033[36m'
WHITE = '\033[37m'
print("""\

\033[34m
  ______ _ _             _ _                      _     _                               
 |  ____| (_)           (_) |                    | |   | |                              
 | |__  | |_ _ __  _ __  _| |_ _   _   _ __   ___| |_  | |__  _   _ _ __   __ _ ___ ___ 
 |  __| | | | '_ \| '_ \| | __| | | | | '_ \ / _ \ __| | '_ \| | | | '_ \ / _` / __/ __|
 | |    | | | |_) | |_) | | |_| |_| |_| | | |  __/ |_  | |_) | |_| | |_) | (_| \__ \__ /
 |_|    |_|_| .__/| .__/|_|\__|\__, (_)_| |_|\___|\__| |_.__/ \__, | .__/ \__,_|___/___/
            | |   | |           __/ |                          __/ | |                  
            |_|   |_|          |___/                          |___/|_|                  
\033[0m

By Take! - 1.0 - Source
                    """)
url = input("Url (flippity.net): ")
starttime = int(time.time())
response = requests.get(url)
source_code = response.text

soup = BeautifulSoup(source_code, 'html.parser')

pattern = r"https://docs\.google\.com/spreadsheets/d/([A-Za-z0-9_-]+)/pubhtml"
matches = re.findall(pattern, str(soup.find_all('script')))
#print(source_code)

if matches:
    spreadsheet_id = matches[0]

    spreadsheet_url = f"https://docs.google.com/spreadsheets/d/{spreadsheet_id}/pubhtml"
    response = requests.get(spreadsheet_url)
    link = spreadsheet_url
    normalized_link = link.replace("(", "").replace(")", "").replace("'", "").replace(",", "").replace("/pubhtml", "")
    normalized_link += "/pubhtml"
    print(f"{YELLOW}\033[H\033[JI would like to inform you that shared answers must not be used for any purposes related to school. This information is provided solely as general advice and information and should not be used for cheating, rule-breaking, or any other dishonest or unethical practices in relation to school responsibilities. It is important to adhere to the rules and ethical standards set by your school and to carry out your tasks independently.\n{RESET}")
    end = str(starttime-int(time.time())).replace("-", "")
    print(f"{GREEN}Here are the answers{RESET}: "+normalized_link.replace(" ","")+ f"\n{end}s")

    input()

else:
    print(f"{RED}No matching URL found.{RESET}")
