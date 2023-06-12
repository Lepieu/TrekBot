import sys
import base64

if (sys.argv.length > 1):
    words = base64.b64decode(sys.argv[1])
    print(len(words))
else:
    print("No prompt found")