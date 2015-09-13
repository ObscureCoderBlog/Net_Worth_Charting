#!/usr/bin/python
import mintapi
import __builtin__
import mysql.connector


def RunStuff():
	Gather_Mint_Information()

def InsertMintData(data):
	# parse out the row
	id = data['id']
	lastUpdateInString = data['lastUpdatedInString']
	value = data['value']
	accountType = data['accountType']
	currentBalance = data['currentBalance']
	
	#connect to your database
	cnx = mysql.connector.connect(user='customscripts_user', database='customscripts_db', password='mypass', host='127.0.0.1')
	cursor = cnx.cursor()
	
	# concatenate the insert
	add_mintdatarow = ("INSERT INTO mintinfo (accountId,lastUpdatedInString,accountValue,accountType,currentBalance) VALUES(" + str(id) + ",'" + str(lastUpdateInString) + "'," + str(value) +",'" + str(accountType) +"'," + str(currentBalance) + ");")
	
	# insert new datarow
	cursor.execute(add_mintdatarow)
	
	# make sure data is commited to the database
	cnx.commit()
	
	# close the connection
	cursor.close()
	cnx.close()

def Gather_Mint_Information():
	# email and password
	email = "mint@email.com"
	password = "mint_password"
	
	# gather instantiate the mint api
	mint = mintapi.Mint(email, password)
	
	# Get basic account information
	#mint.get_accounts()
	JSONInfo = mint.get_accounts()
	
	# Initiate an account refresh so information is good for the next day
	mint.initiate_account_refresh()
	
	# Print out the arrays for each accont for debugging
	for (i, item) in enumerate(JSONInfo):
		# insert the data into mysql
		InsertMintData(item)

RunStuff()
