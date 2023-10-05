# Using flask to make an api
# import necessary libraries and functions
from flask import Flask, jsonify, request
from des_function import *

# creating a Flask app
app = Flask(__name__)

# on the terminal type: curl http://127.0.0.1:5000/
# returns hello world when we use GET.
# returns the data that we send when we use POST.
@app.route('/encrypt1', methods=['POST'])
def encrypt1():
    data = request.get_json()
    pt = data['plaintext']
    key = data['key']

   

    # Key generation
    # --hex to binary
    key = hex2bin(key)

    # --parity bit drop table
    keyp = [57, 49, 41, 33, 25, 17, 9,
            1, 58, 50, 42, 34, 26, 18,
            10, 2, 59, 51, 43, 35, 27,
            19, 11, 3, 60, 52, 44, 36,
            63, 55, 47, 39, 31, 23, 15,
            7, 62, 54, 46, 38, 30, 22,
            14, 6, 61, 53, 45, 37, 29,
            21, 13, 5, 28, 20, 12, 4]
    # getting 56 bit key from 64 bit using the parity bits
    key = permute(key, keyp, 56)

    # Number of bit shifts
    shift_table = [1, 1, 2, 2,
                2, 2, 2, 2,
                1, 2, 2, 2,
                2, 2, 2, 1]

    # Key- Compression Table : Compression of key from 56 bits to 48 bits
    key_comp = [14, 17, 11, 24, 1, 5,
                3, 28, 15, 6, 21, 10,
                23, 19, 12, 4, 26, 8,
                16, 7, 27, 20, 13, 2,
                41, 52, 31, 37, 47, 55,
                30, 40, 51, 45, 33, 48,
                44, 49, 39, 56, 34, 53,
                46, 42, 50, 36, 29, 32]
    # Splitting
    left = key[0:28] # rkb for RoundKeys in binary
    right = key[28:56] # rk for RoundKeys in hexadecimal

    rkb = []
    rk = []
    for i in range(0, 16):
        # Shifting the bits by nth shifts by checking from shift table
        left = shift_left(left, shift_table[i])
        right = shift_left(right, shift_table[i])

        # Combination of left and right string
        combine_str = left + right

        # Compression of key from 56 to 48 bits
        round_key = permute(combine_str, key_comp, 48)

        rkb.append(round_key)
        rk.append(bin2hex(round_key))

    ciphertext = bin2hex(encrypt(pt, rkb, rk))


    rkb_rev = rkb[::-1]
    rk_rev = rk[::-1]
    text = bin2hex(encrypt(ciphertext, rkb_rev, rk_rev))
    

    response = {
        'ciphertext': ciphertext,
        'decrypted_text': text
    }

    return jsonify(response)


from Crypto.Cipher import AES
from Crypto.Util.Padding import pad, unpad
from Crypto.Random import get_random_bytes
import base64


@app.route('/aesEnc', methods=['POST'])
def aedEnc():
    data = request.get_json()
    plaintext = data['plaintext'].encode()
    key = data['key'].encode()
      #AES cipher object in ecb mode (weakness   ) electronic book
    cipher = AES.new(key, AES.MODE_ECB)
    #addding bits for to fill 128 bits 
    padtext = pad(plaintext, AES.block_size)
    #encrypt it using aes mode ecb algorithm
    ctext = cipher.encrypt(padtext)
    #binary to text format (a - z ,  0-9)
    encodedctext= base64.b64encode(ctext)
    return encodedctext

@app.route('/aesDec' , methods=['POST'])
def aesDec():
    data = request.get_json()
    ciphertext = data['cipher'].encode()
    key = data['key'].encode()
    cipher = AES.new(key, AES.MODE_ECB)
    decodedctext = base64.b64decode(ciphertext)
    padded_plaintext = cipher.decrypt(decodedctext)
    plaintext = unpad(padded_plaintext, AES.block_size)
    return plaintext

# A simple function to calculate the square of a number
# the number to be squared is sent in the URL when we use GET
# on the terminal type: curl http://127.0.0.1:5000 / home / 10
# this returns 100 (square of 10)
# @app.route('/home/<int:num>', methods = ['GET'])
# def disp(num):

# 	return jsonify({'data': num**2})

from rsa import rsa    
# rsa algorithm 
@app.route('/rsa1' , methods=['POST'])
def rsa1():
    data = request.get_json()
    p = data['p']
    q = data['q']
    M = data['M']
    enc = rsa(int(p),int(q),int(M))
    return enc


     

# driver function
if __name__ == '__main__':

	app.run(debug = True)
