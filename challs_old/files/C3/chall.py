#!/usr/bin/env python
import sys
from secret import flag,Primes
from random import SystemRandom
from Crypto.Util.number import *

Rand = SystemRandom()
p = Rand.choice(Primes)
q = Rand.choice(Primes)

n = p*q
e = 65537

sys.stdout.write("n = "+str(n)+'\n')
sys.stdout.write("e = "+str(e)+'\n')

sys.stdout.write("What do you want to Encrypt :: ")
sys.stdout.flush()

Inp = sys.stdin.readline().strip('\n')
if Inp == 'flag': Inp = flag


m = bytes_to_long(Inp)
c = pow(m,e,n)

sys.stdout.write("c = "+str(c)+'\n')
sys.stdout.flush()
sys.exit()