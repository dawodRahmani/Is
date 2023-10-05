import random
from sympy import isprime

# Function to calculate modular inverse using extended Euclidean algorithm
#a⁻¹ mod m =1,
def mod_inverse(a, m):
    g, x, y = extended_gcd(a, m)
    if g != 1:
        raise ValueError("The modular inverse does not exist")
    else:
        return x % m

# Function to perform the extended Euclidean algorithm
def extended_gcd(a, b):
    if a == 0:
        return (b, 0, 1)
    else:
        g, x, y = extended_gcd(b % a, a)
        return (g, y - (b // a) * x, x)

# Key generation
def generate_keys(bit_length):
    p = 0
    while True:
        p = random.getrandbits(bit_length)
        if is_prime(p):
            break
    #generator
    g = random.randint(2, p - 2)
    #private
    x = random.randint(1, p - 2)
    #public
    y = pow(g, x, p)
    
    #tuple 3 value
    public_key = (p, g, y)
    private_key = x
    return public_key, private_key

# Encryption
def encrypt(plain_text, public_key):
    p, g, y = public_key
    k = random.randint(1, p - 2)
    #component 1
    c1 = pow(g, k, p)
    s = pow(y, k, p)
    c2 = (plain_text * s) % p
    return (c1, c2)

# Decryption
def decrypt(ciphertext, private_key, public_key):
    p, _, _ = public_key
    c1, c2 = ciphertext
    s = pow(c1, private_key, p)
    s_inverse = mod_inverse(s, p)
    plain_text = (c2 * s_inverse) % p
    return plain_text

# Check if a number is prime using sympy
def is_prime(n):
    return isprime(n)


# Example usage
if __name__ == "__main__":
    bit_length = 128
    message = 1234567890

    public_key, private_key = generate_keys(bit_length)
    print("Public key:", public_key)
    print("Private key:", private_key)

    ciphertext = encrypt(message, public_key)
    print("Ciphertext:", ciphertext)

    decrypted_message = decrypt(ciphertext, private_key, public_key)
    print("Decrypted message:", decrypted_message)  