# [Nexmo](https://nexmo.com) Demo Application #

Just for fun this application is used for proxying text messages to someone so that you can hide your
real phone number from the recipient.

When you provide your api key and secret, this app will fetch the phone numbers available in your account to
choose from, then it will let you send a message to someone. After sending that message it will fetch your
history with that number for the current day and display all the messages.

To use the app, just paste in your api key and secret, click to load phone numbers from your account in order to
choose which one you want to send from, then enter the phone number to send a text to, a message, and your done :-)

## Getting Started ##
1. Clone the repo
2. Make sure you have [Vagrant](http://vagrantup.com) and [VirtualBox](http://virtualbox.org)
3. Open your cmd prompt and run vagrant up
4. Add an entry to your hosts file for 192.168.33.10 nexmo-demo.local
5. Open your browser and go to http://nexmo-demo.local