from Crypto.Cipher import AES
from Crypto.Util.strxor import strxor
from secret import flag,key,iv

def CheckIV(iv):
	v = int(iv[0]+iv[2])
	if (v%5 + v%7):
		return 0
	v = [ ord(iv[1]), ord(iv[3])]
	if 1800-(14*v[0]+10*v[1]) and 1793-(18*v[0]+7*v[1]):
		return 0
	v = iv[:4]
	for i in range(0,16,4):
		if iv[i:i+4] != v:
			return 0
	return 1

def Encrypt(Text,Key):
	Key = (Key * (len(Text)/len(Key) + 1))[:len(Text)]
	return strxor(Text,Key)

def pad(mess):
	p = 16-len(mess)%16
	return mess + chr(p)*p

Poem = open('poem.txt').read()
Poem = Encrypt(Poem,key)
open('poem.ct','w').write(Poem.encode('hex'))

if not CheckIV(iv):
	exit()

Cipher = AES.new(key,AES.MODE_CBC,iv)
Ct = Cipher.encrypt(pad(flag))
with open('flag.ct','w') as F:
	F.write(Ct.encode('hex'))