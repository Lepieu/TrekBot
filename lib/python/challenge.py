import sys
import base64

words = base64.b64decode(sys.argv[1])
import gtts

tts = gtts.gTTS(words)
tts.save("Hello.mp3")