# Large File Parser (Steps)

- #Create A Console Command
    
    to create a console command in laravel, an artisan command called ```tofigh:parser``` is deviced. 
    - ## its jobs are:
        - checking for file existance
        - checking for file size
        - finding right method to parse the file
        - check which lines of log is parsed and added to the database 
    - ## how to run 
        run below code to apply the parser command
        ```ssh
        php artisan tofigh:parser 
        ```
        * It worth mentioning, to generate the right ```regex```, i used [regex101 website](https://regex101.com/). Below, you can see my tested regex:
        ```ssh
        /\s?([a-zA-Z0-9-]+)\s?\-\s?\[\s?(\d{1,2})\s?\/s?([a-zA-Z]{1,3})\s?\/s?(\d{4})\s?:([\d|:]+)\s?\]\s?\"(\w+)\s+([\/|\w+]+)\s+(\w+)\s?\/s?(\d+)\.s?(\d+)\"\s?(\d{1,3})\n?/g
        ```
        * note that, another command is made to generate random lines and append to the end of ```log.txt```
        ```ssh
        php artisan tofigh:generator [numberOfLines=1000] [fileAddress='docs/log.text']
        ```
        *note that it is the first version (in more time i would make an interface and implement the same solution using multiple design patterns especially SOLID, but it is 21:14 and i should deliver the job before 23:00)
- # Designing DataBase
    - first of all note that the used database here is ```MariaDB```. why? first, because It is a free and opensource database. and the second, it is a match for the problem data type (Which can be modeled in a **tabular** apporach)
    - After some normalization it is decided that these tables are needed to model the problem interaction with data and DBMS:
        - **services**: that can be filled with records such as ```order-service``` and ```invoice-service```
        - **methodes**: that can be filled with these 5 records: 
            - POST
            - GET
            - PUT
            - PATCH
            - DELETE
        - **endpoints**: because endpoints are repetitive and ```string``` type data, and also may change during the project, it is better to have their own table in the database. 
        - **protocols**: however the sample dataset only used ```HTTP/1.1```, yet there are several other options. It is tempting to use only given sample as reference in compliance to **YAGNI** pattern. However the software should be scalable so a seperate table is added to the database and filled under the light of [this article](https://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol) in wikipedia. However for the sake of normalization ```HTTP/``` part of the string is ommited and only the version would be included in the model. 
- # Seeding the database
    instead of seeding database, in this project I filled database with the neccessary data (as is described in pervious parts) in the migration table it self. (for the sake of berivity and saving challange time)
    * note that ```tofigh:parser``` command is in full compliace with data structure and model. 
- # Designing RESTful API
    - ## version 1: 
        in my first attemp i just solved the problem as fast as possible. the answer can be found in the below address:
        ```ssh
        /v1/logs/count
        ```
        * in this version the solution is highly depend on multiple entities and dependencies. and future changes should be applied in previous files (against open-closed principal). also it is against single responcibility rule. so the version 2 is deviced as below.
    - ## version 2:
        - in this verison multiple interfaces would be used in compliance with S and O principals os SOLID. (Sorry for bad english writing :D)
            - in the helpers folder i added a class called ```LogSearch```. and a base interface called ```IFilter``` in the interfaces folder.
            - I also made a new general filter ```FGeneral``` in filter folder. It filters results if it is either direct or throgh a relationship. 


- # Backend Programming
    - ## needed models
        - **Service**
        - **Methode**
        - **EndPoint**
        - **Protocol**
        - **Log**
        ```ssh
        php artisan make:model Service -m
        php artisan make:model Methode -m
        php artisan make:model EndPoint -m
        php artisan make:model Protocol -m
        php artisan make:model Log -m
        ```
    - ## needed controllers (up to this stage)
        ```ssh
        php artisan make:controller ServiceController -r
        php artisan make:controller MethodeController -r
        php artisan make:controller EndPointController -r
        php artisan make:controller ProtocolController -r
        php artisan make:controller LogController -r
        ```
    - ## needed helpers (up to this stage)
        ```FileHandler``` that implements both ```IFileReaderHandler``` and ```IFileWriterHandler``` 
        * may be it is better to make two seperate class but for now i do it this way.
        * I make another folder called ```Helpers``` to host my helpers. 

    based on my coding style and the matto (**composition over inheritance**), I always make a new folder called ```Interfaces``` under app directory. 
- # A sample simple test case
    ```ssh
    php artisan make:test LogTest
    ```
    - 3 simple tests are provided (very trivial and simple)
- # Applyed tools 
    - postman
    - phpunit
    - regex101


at the end sorry for bad english, i was in hurry and didn't check my writings 