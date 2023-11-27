# Which bin?
A little script to notify you of which bin to put out this week.

## How does it work?
1. A cronjob runs a php script on bin day
2. The php script checks today's bin using some pre-prepared JSON data
3. The php script triggers a Macrodroid Macro with a webhook, passing through the bin data
4. The Macrodroid macro displays a notification on your phone, showing today's bin


## Set up
### Prerequisites 
- A server on which to run the script
- Knowledge of your bin days
- The [Macrodroid](https://play.google.com/store/apps/details?id=com.arlosoft.macrodroid) app

### Steps
1. Get over the fact I wrote this in php lmao
2. Clone this repo to your server
3. Update the dates JSON ([data/dates-2023.json](data/dates-2023.json)) with your bin dates
4. Import the macro ([macrodroid/which-bin.macro](macrodroid/which-bin.macro)) into Macrodroid
5. Get your Device ID from Macrodroid
    1. Navigate to the imported macro
    2. Tap on the 'Webhook (Url)' trigger and select configure'
    3. Your webhook Url is displayed towards the top, with the option to share it
    4. Your device ID is the long string: `https://trigger.macrodroid.com/[deviceId]/whichbin`
6. Create the file `/macrodroid/macrodroid-device-id.txt` with your Device ID as the content
7. Update the timezone in [which-bin.php#L9](which-bin.php#L9) if necessary (Default: Australia/Adelaide)
8. Update the bin names in [which-bin.php](which-bin.php) if necessary (Default: Recycling / Green)
9. Create a cronjob to run the script on your bin day. Examples here: [cronjobs.txt](cronjobs.txt)
