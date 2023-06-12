import sys
import creds
import openai
import base64 

openai.api_key = creds.api_key
words = str(base64.b64decode(sys.argv[1]))
onCompletion = openai.ChatCompletion.create(
    model = "gpt-3.5-turbo",
    messages = [
        { "role" : "user", "content" : words }
    ]
)
response = onCompletion.choices[0].message.content
#maybe make it return 1 word at a time (or at least visually - as the bot is speaking)
print(response)