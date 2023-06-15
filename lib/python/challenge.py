import sys
import base64
import gtts
import openai
import creds

import string
import random

def gen_random_str(length=8):
    letters = string.ascii_letters 
    result_str = ''.join(random.choice(letters) for _ in range(length))
    return result_str


def apiresponse(prompt, api_key):
    openai.api_key = api_key
    words = prompt
    onCompletion = openai.ChatCompletion.create(
        model = "gpt-3.5-turbo",
        messages = [
            { "role" : "user", "content" : words }
        ]
    )
    response = onCompletion.choices[0].message.content
    return response 
    
    #maybe make it return 1 word at a time (or at least visually - as the bot is speaking)
    #NOTE: this is a good idea, but probably want to do that in JS rather than on the Python side
   

def texttospeech(textinput):
    filename = f'{gen_random_str()}.mp3'
    tts = gtts.gTTS(textinput)
    tts.save(filename)
    return filename

words = str(base64.b64decode(sys.argv[1]))
api_flag = sys.argv[2]
tts_flag = sys.argv[3]

if api_flag == 1:
  api_response = apiresponse(words, creds.api_key)

if tts_flag == 1:
  print(texttospeech(api_response))
else:
  print(api_response)