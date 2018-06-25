import requests
import subprocess
import socket
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.connect(("google.com", 80))
ip = s.getsockname()[0]

s.close()
# subprocess.call(["tracert", "google.com"])


url = "http://localhost/ipnotifier/api.php"
data = {"command": "saveIP","ip": ip}

res = ""
try:
	res = requests.post(url, json=data)
except Exception as inst:
	print(type(inst))
	print(inst.args)
else:
	print (res.status_code)