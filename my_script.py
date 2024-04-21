# Python script to receive a list input, process it, and return the result
import ai
import sys
import json
import test
import NN
def main():
    # Read the JSON input from PHP through command line arguments
    if len(sys.argv) > 1:
        # The first argument (index 0) is the script name, so we skip it and access the JSON argument
        json_arg = sys.argv[1]
        json_arg = json_arg.replace("\\ ", "\"")
        input_data = json.loads(json_arg)
    userInput = input_data["userInput"]
    name = input_data["name"]

    test.create_image_from_list(userInput, name.strip()+".png")
    x = NN.guess(name.strip()+".png")
    # Convert the processed list back to JSON and print it
    print(x)


if __name__ == "__main__":
    main()
