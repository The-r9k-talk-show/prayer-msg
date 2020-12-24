import boto3
import pandas as pd

ACCESS_KEY = ''
ACCESS_SECRET = ''
AWS_REGION = 'us-west-2'

RECIPIENT_NUMBERS = pd.read_csv('phones.csv')
MESSAGES = pd.read_csv('data.csv')
RECIPIENT_NUMBERS = RECIPIENT_NUMBERS['phone']

sns = boto3.client('sns', aws_access_key_id=ACCESS_KEY,
                   aws_secret_access_key=ACCESS_SECRET,
                   region_name=AWS_REGION)

for number in RECIPIENT_NUMBERS:
    message = MESSAGES.sample(n=1)

    name = message['name']
    name = name.to_string(index=False)

    prayer = message['prayer']
    prayer = prayer.to_string(index=False)

    MESSAGE = name + ', ' + prayer

    response = sns.publish(
        PhoneNumber=str(number),
        Message=str(MESSAGE)
    )

