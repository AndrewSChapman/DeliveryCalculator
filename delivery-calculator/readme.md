## Delivery Calculator

This project implements the Delivery Calculator!  

To get the project running you'll either need a native environment ready to run symfony, or you'll
need to setup a VM.  I have created a vagrant file to help should you need a VM.

### Setup VM
vagrant up

Note you may need to install the vagrant hosts updater plugin.
https://github.com/cogitatio/vagrant-hostsupdater

### Install dependencies
composer install


### API Url
The API is configured to run at the following URL

http://api.deliverycalculator.local

If you're not using vagrant, please add an entry to your hosts file manually to point the domain to your webserver.

### API Endpoints

List Regions
http://api.deliverycalculator.local/api/delivery/regions

Calculate Delivery Date
http://api.deliverycalculator.local/api/delivery/calculate-delivery-date/{supplierId}/{regionId}/{orderDate}

Note I've gone with a Http GET request for the delivery date calculation, since it is a "search" query 
and state is not being changed on the server.


## General Notes
There are a some rough edges in the project that I wish I had more time to address.  Namely:
* The front-end is written in JQuery (I would have liked to have used Vue)
* The error handling on the front-end could be more robust;
* The styling in general on the front-end is rough;

The back-end is generally where most of my attention was placed, and I've built quite an extensive type system and
a set of entities, collections and repositories as if it was the real deal. 

## Running Unit Tests
./bin/phpunit

