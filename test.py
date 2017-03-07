from bs4 import BeautifulSoup
import requests
import webbrowser
import sys

#link = sys.argv[1]
#print(link)
## request page at url
#page = requests.get('https://new.sunyconnect.suny.edu:4439/F?func=direct&doc_number=000653454')
page = requests.get('https://new.sunyconnect.suny.edu:4439/F?func=direct&doc_number=000651842')
#page = requests.get(link)
## save data for page
data = page.text

## turn data into BS object for easy html searching
soup = BeautifulSoup(data)

## list for call numbers - may not be necessary
#callNumber = []

## variable for the location of call number in tables - find way to make dynamic
index = 13

## loop through page data to find the correct table data
for row in soup.find_all('tr')[index:index+1]:
	col = row.find_all('td')
	callNum = row.find_all('a')
	
	## add the contents (book's call number) to callNumber list - again may not be necessary
	#callNumber.append(str(callNum[0].contents[0]))
	cN = str(callNum[0].contents[0])
	
	
	## print call number
	print(cN)
	
	## for debugging purposes
	#print(len(callNum))
	#print(callNumber[0])
	#print(type(callNumber[0]))
new = 2
## open a public URL
url = "http://library.newpaltz.edu/appmap/"
webbrowser.open(url, new=new)
	