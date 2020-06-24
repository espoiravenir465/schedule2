# Bon Voyage!

![スクリーンショット 2020-06-04 16 57 14](https://user-images.githubusercontent.com/43898499/84912301-95fc4e00-b0b9-11ea-9415-ab7a2eed4339.png)

"Bon Voyage!" is an application for travel planning with Laravel.

# DEMO

![Bonvoyage-gif1](https://user-images.githubusercontent.com/43898499/84913861-4028a580-b0bb-11ea-85db-d6ce9dac69d6.gif)

# About

You can plan your trip and save your photos.
You can leave it as a memory after the trip!

# Requirement

 - php 7.1.3
 - laravel/framework 5.7.*
 - Vue.js 2.5.17
 - npm 6.13.1
 - Node.js v13.2.0
 - Google Drive API

# SETTING

    git clone https://github.com/espoiravenir465/schedule2.git
    cd schedule2

    composer install
    composer update

    npm install
    sudo npm audit fix

**Google API SET UP**

1.Create a project at https://console.developers.google.com
1.Go to the API Manager and enable Google Drive API
1.Go to Credentials and create the appropriate type of credential
1.Download client information
1.Add a query parameter to the following URL and access it with a browser
    -example
    https://accounts.google.com/o/oauth2/auth
    ?client_id=xxxxxxxxxxxxxxxx
    &redirect_uri=http://localhost
    &scope=https://www.googleapis.com/auth/drive
    &response_type=code
    &approval_prompt=force
    &access_type=offline
1.Open a new tab, enter in the search box, and press enter.
1.Allow Google Request
1.Code= which is returned in the search window Copy the following =authentication code
1.Execute the following command using the ID, URI, key, etc. on the terminal
    -example
    curl -d client_id=[client ID] -d client_secret=[client secret] -d redirect_uri=[redirect URI] -d grant_type=authorization_code -d code=[authentication code] https://accounts.google.com/o/oauth2/token
1.Get refresh token

# License
Bon Voyage! is licensed under the MIT license.
Copyright © 2020, E.H

[MIT license](https://en.wikipedia.org/wiki/MIT_License).
