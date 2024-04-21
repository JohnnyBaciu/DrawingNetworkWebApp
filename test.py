from PIL import Image
import numpy as np
import ai

# Function to create and save the image
def create_image_from_list(values, save_path):
    # Reshape the 1D list into a 28x28 NumPy array
    image_array = np.array(values).reshape(28, 28)

    # Scale the values to a visible range (0-255)
    image_array = (image_array * 255).astype(np.uint8)

    # Create a grayscale image using PIL
    image = Image.fromarray(image_array, mode='L')

    if save_path is not None:
        # Save the image as PNG
        image.save(save_path)
    else:
        # Display the image (optional)
        pass
# Call the function to create the image and save it as "image.png"
