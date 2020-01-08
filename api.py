# Dependencies
from flask import Flask, request, jsonify
from sklearn.externals import joblib
import traceback
import pandas as pd
import numpy as np
import requests
import sys
import json
import h5py
import time
from keras.models import Sequential
from keras.models import load_model
from keras.preprocessing.sequence import pad_sequences
import tensorflow as tf
from flask_cors import CORS
from keras.models import Model
from tensorflow.python.keras.backend import set_session
sess = tf.compat.v1.Session()
sequence_length = 300
# SENTIMENT
positive = "positive"
negative = "negative"
neutral = "neutral"
sentiment_thresholds = (0.4, 0.7)
#API definition
app = Flask(__name__)
def get_model():
	set_session(sess)
	modelB = load_model('sentiment.h5', custom_objects=None,
						compile=True)
	global model
	model = Model(inputs=modelB.input, outputs=modelB.output)
	global graph
	graph = tf.compat.v1.get_default_graph()
	print("Model loaded!")
def decode_sentiment(score, include_neutral=True):
	if include_neutral:		   
		label = neutral
		if score <= sentiment_thresholds[0]:
			label = negative
		elif score >= sentiment_thresholds[1]:
			label = positive
		return label
	else:
		return negative if score < 0.5 else positive		
def predict(text, include_neutral=True):
	start_at = time.time()
	# Tokenize text
	x_test = pad_sequences(tokenizer.texts_to_sequences([text]), maxlen=sequence_length)
	# Predict
	with graph.as_default():
		set_session(sess)
		score = model.predict([x_test])[0]
	# Decode sentiment
	#return {"label": label, "score": float(score),"elapsed_time": time.time()-start_at}
	label = decode_sentiment(score, include_neutral=include_neutral)
	return {"sentiment": label, "score": float(score)}		 
@app.route('/predict', methods=['POST'])
def predictTxt():
	#print(predict("I hate the food"))	
	message = request.get_json(force=True)
	encoded = message["txt"]
	print(encoded)	
	print("The prediction:")
	prediction = predict(encoded)
	print(prediction)
	fullResponse = {
	"probability" : prediction
	}
	return json.dumps(fullResponse)
if __name__ == '__main__':
	try:
		port = int(sys.argv[1]) #for command-line input
	except:
		#app.run(host= '0.0.0.0' , port = 12345)
		port = 12345 #if no port provided set to 12345
		get_model()	
	#print ('Model loaded')
	tokenizer = joblib.load("tokenizer.pkl")
	print ('Tokenizer loaded')
	#print(predict("I hate the food"))	 
	app.run(host="192.168.100.27", port=port, debug=True)