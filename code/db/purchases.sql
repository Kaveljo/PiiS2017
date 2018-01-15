CREATE TABLE `purchases` (
`id` int(11) NOT NULL AUTO_INCREMENT, 
  
`date` DATE, 
  
`image` varchar(100) NOT NULL,

`category` int(11) NOT NULL,   
  
`user_id` int(11) NOT NULL ,  
  
PRIMARY KEY (id) 
);