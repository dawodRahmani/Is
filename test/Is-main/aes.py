from Crypto.Cipher import AES
from Crypto.Util.Padding import pad, unpad
from Crypto.Random import get_random_bytes
import base64
def encrypt(plaintext, key):
    #AES cipher object in ecb mode (weakness   ) electronic book
    cipher = AES.new(key, AES.MODE_ECB)
    #addding bits for to fill 128 bits 
    padtext = pad(plaintext, AES.block_size)
    #encrypt it using aes mode ecb algorithm
    ctext = cipher.encrypt(padtext)
    #binary to text format (a - z ,  0-9)
    encodedctext= base64.b64encode(ctext)
    return encodedctext
def decrypt(ciphertext, key):
    cipher = AES.new(key, AES.MODE_ECB)
    decodedctext = base64.b64decode(ciphertext)
    padded_plaintext = cipher.decrypt(decodedctext)
    plaintext = unpad(padded_plaintext, AES.block_size)
    return plaintext
#16 byte for 128 bit key
key = get_random_bytes(16) 
# encode it to byte of binary
plaintext = input("Enter the plaintext: ").encode()
enc= encrypt(plaintext, key)
print("The encrypted data is:", enc)
decrypted = decrypt(enc, key)
print("The decrypted data is:", decrypted.decode('utf-8'))