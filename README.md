11111# TransDb project

### Description

Use database as a translation provider.  
Define a translation loader to load translation data from database.  
Define a translation dumper to parse files and save translation data to database.  

You can run the dumper:  

php app/console translation:extract de --dir=./src/ --output-dir=./app/Resources/translations --keep  

### Installation

git clone https://github.com/torrodo/transdb.git

cd transdb  
make install

When configuring parameters, please enter the following values:


Creating the "app/config/parameters.yml" file 
Some parameters are missing. Please provide them.  
database_driver (pdo_mysql):  
database_host (127.0.0.1):   
database_port (null):  
database_name (symfony): transdb  
database_user (root): root  
database_password (null):  
mailer_transport (smtp):  
mailer_host (127.0.0.1):  
mailer_user (null):   
mailer_password (null):  


### Usage

To test, just start the built in server from the project root:

php app/console server:start

###### Links:  

Check out translations with the next two languages:

http://127.0.0.1:8000/en => english page  
http://127.0.0.1:8000/de => german page
