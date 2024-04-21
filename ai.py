from PIL import Image
import matplotlib.pyplot as plt
import numpy as np
import os
import json
def guess():
    # Load saved weights and biases from JSON file
    with open('model_params2.json', 'r') as json_file:
        params = json.load(json_file)

    W1_loaded = np.array(params['W1'])
    b1_loaded = np.array(params['b1'])
    W2_loaded = np.array(params['W2'])
    b2_loaded = np.array(params['b2'])
    image_path = "image.png"
    image = Image.open(image_path).convert('L')  # Convert to grayscale
    image = image.resize((28, 28))  # Resize to 28x28 pixels
    image_array = np.array(image) / 255.0  # Normalize pixel values


    # Flatten the image and reshape for forward propagation
    image_flattened = image_array.flatten()
    image_input = image_flattened.reshape(1, -1)  # Reshape to a 1x784 array

    def forward_propagation(X):
        # Compute activations for the hidden layer
        Z1 = np.dot(X, W1_loaded) + b1_loaded
        A1 = np.maximum(0, Z1)  # ReLU activation
        
        # Compute activations for the output layer
        Z2 = np.dot(A1, W2_loaded) + b2_loaded
        A2 = np.exp(Z2 - np.max(Z2, axis=1, keepdims=True)) / np.sum(np.exp(Z2 - np.max(Z2, axis=1, keepdims=True)), axis=1, keepdims=True)  # Softmax activation
        
        return A2

    # Perform forward propagation to get predictions
    predictions = forward_propagation(image_input)
    predicted_class = np.argmax(predictions)

    # Display the prediction
    x = [predicted_class]
    return x
