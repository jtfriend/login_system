from urllib.request import urlopen as uReq
from bs4 import BeautifulSoup as soup
import http
import json
import urllib.request


my_themes_url = "https://www.lego.com/en-gb/themes"

uThemesClient = uReq(my_themes_url)
page_themes_html = uThemesClient.read()
uThemesClient.close()
page_themes_soup = soup(page_themes_html, "html.parser")

allData = {}

for indexBig , a in enumerate(page_themes_soup.findAll('a', href=True)):
  if indexBig < 100 :
    if a['href'][7:13] == 'themes' and  a['href'][14:] != "":
      # listOfThemes[index] = a['href']
      themeNames = a['href'].split("/")
      themeName = themeNames[3]
      print(themeName)
      allData[themeName] = {}

      my_url = 'https://www.lego.com/en-gb/themes/' + themeName

      uClient = uReq(my_url)
      page_html = uClient.read()
      uClient.close()
      page_soup = soup(page_html, "html.parser")

      containers = page_soup.findAll("li", {"data-test" :"product-item"})

      myNewData = {}

      for indexSmall, container in enumerate(containers):
        for x in range(10):
          if "product" == container.a["href"][7:14]:
            if ("Average" in container.text):
              allData[themeName][indexSmall] = {
                'href' : container.a["href"],
                'Name' : container.text[:container.text.index("Average")]
              }
              print(container.text[:container.text.index("Average")])
            else :
              allData[themeName][indexSmall] = {
                'href' : container.a["href"],
                'Name' : container.text
              }
              print(container.text)
            if ("|" not in container.a["href"]):
              itemUrl = "https://www.lego.com" + container.a["href"].encode('ascii', 'ignore').decode('ascii') + "?page=" + str(x+1)
              uNewClient = uReq(itemUrl)
              try:
                page_new_html = uNewClient.read()
              except (http.client.IncompleteRead) as e:
                page_new_html = e.partial
              uNewClient.close()

              page_new_soup = soup(page_new_html, "html.parser")

              itemImg = page_new_soup.find(itemprop="image")

              if itemImg is not None:
                print (container.a["href"])
                indexStr = str(indexSmall)

                urllib.request.urlretrieve(itemImg["src"], themeName+ indexStr.encode('ascii', 'ignore').decode('ascii') +".jpg")

      with open('data.json', 'w') as outfile:
        json.dump(allData, outfile)
