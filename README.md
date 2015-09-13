# Net_Worth_Charting
A collection of scripts that come together to create a automatic net worth charting system based on information from your mint account. 

## Disclaimer 

This code was built quickly with awful coding practice...Enjoy!

# API Reference
## Summary
Create a python script that will pull information from mint and insert it into a database. Set it on a cron job so it gets updated once a day. Create a php script to pull from the database and display the data in the proper format for a charting library. Create the html page that pulls the data and inserts it into a chart. 

## Technology
* 3rd party mint api : https://github.com/mrooney/mintapi
* Ubuntu OS
* Python for the script to pull down and insert data into the database
* MySql for the database table
* PHP for the scripts that format the MySQL data into csv, json etc. 
* HTML/JS using charts.js for the display of the chart

## Requirements
* Python 2.7.3
* MySql-Connector
* Mintapi

## Scripts
* MintInfoGather.py
* networthcsv.php
* networthjsonforchart.php
* index.html

## How To

1. Ensure you have Python, MySql, and Apache installed
2. Install the libraries that the python script requires using pip. First you need to make sure you have pip for python
  
  ```
  sudo apt-get -y install python-pip
  ```
3. Install the proper python packages. 
  
  ```
  sudo pip install mintapi
  ```
  
  ```
  sudo pip install --allow-external mysql-connector-python mysql-connector-python
  ```
4. I created a folder in my home/user to put the python script into. 
  
  ```
  /home/user/CustomPythonScripts
  ```
  * Move MintInfoGather.py

5. Create a folder to put your php scripts on your apache server 
  ```
  /var/www/customscripts/
  ```
  * Move networthcsv.php
  * Move networthjsonforchart.php

6. Put the html chart onto your apache server
  ```
  /var/www/customscripts/networth
  ```
  * Move index.html
  * Move Chart.min.js

7. Create a database using the SQL scripts inside of Database_creation_SQL.txt

8. Customize all the scripts with the custom information from your own set up. This may include adjusting mint information, database information, and script locations.

9. Test your python script by running it. For my python script since it’s in my user’s folder, I simply run 
  ```
  python ~/CustomPythonScripts/MintInfoGather.py
  ```

10. Create a Cron Job that will run your script every day if you want it to update every day. Otherwise you can run it manually or adjust the time. My scripts were designed to be run once a day. If you are not familiar with creating a scheduled task you can go here http://stackoverflow.com/questions/11774925/how-to-run-a-python-file-using-cron-jobs
  ```
  crontab -e
  ```
Add the following to the file
  ```
  30 5 * * * /usr/bin/python /home/youruseraccount/CustomPythonScripts/MintInfoGather.py
  ```
Save and close the file, your cron job has been created. To view you can use the command
  ```
  crontab -l
  ```

## Contributors

Currently, just lil'ol me (ObscureCoder)

## License

MIT License, you know the deal.
