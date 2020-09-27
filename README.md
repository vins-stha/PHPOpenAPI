                                                                             # PHP proficiency test
                                                                             
                                                                             ## Folders included
                                                                             
                                                                             ### Api 	 contains files for endpoints of the api
                                                                                o	Read.php   readall data from table
                                                                                o	readOne.php  read one data from table by id
                                                                                o	streetName.php  retrieve street name in finnish and Swedish by postal_code
                                                                                o	insert.php   insert a data into the table manually
                                                                                o   index.php required to run at first to create data base table if not present
                                                                             
                                                                             ### Core			
                                                                                o	contains files that define the basics of posti addresses as class file and        
                                                                                o	posti.php  class file and endpoint resolver 
                                                                                
                                                                             ### Includes		
                                                                                o	contains config files
                                                                                o	data file  (BAF file from posti)
                                                                                o	file that retrieves data from data file and sends it to database table                                                                              	
                                                                                o	Postal_Address_Table.php -> table definition 
                                                                                
                                                                             ### Documentation   
                                                                                 o	contents for Open API 
                                                                                 
                                                                             ### Resources
                                                                                 o	data file
                                                                                 o	screen shots 
                                                                                 
                                                                             Table_name used = posti_address
                                                                             Database_used = restapi
                                                                             Host = localhost
                                                                             Database = Mysql
                                                                             Username = root
                                                                             
                                                                             
                                                                             •	Includes/index.php should be run/opened to create table and insert data from data file into table hence created
                                                                                php <path/to/api/index.php>index.php from command with cmd can also be done





                                                                         