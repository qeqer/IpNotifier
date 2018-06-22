import requests

url = "http://localhost/ipnotifier/api.php"
data = '{"ip": "0.0.0.0"}'
res = ""
try:
	res = requests.post(url, json = data)
except Exception as inst:
	print(type(inst))
	print(inst.args)
else:
	print (res.status_code)
