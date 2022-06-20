# MH Blossoms

MH Blossoms is a website that contains all the information about books. It’s a website that has books, quotes, summaries, news, interviews, and authors. It can be thought of as the social media of the reading community. It’s based on the same idea of goodreads. 

The website contains 9 web pages. The pages are built using HTML, CSS, JS, and php only. The database is using python and SQL. 

## To run the project: 

1.	Install xampp. 
(Can use this link: https://downloadsapachefriends.global.ssl.fastly.net/8.1.6/xampp-windows-x64-8.1.6-0-VS16-installer.exe?from_af=true)
2.	Open xampp control panel and start Apache and MySQL. Then, click on admin of MySQL. 
![image](https://user-images.githubusercontent.com/64710994/174628486-a549d77e-ccc9-4bdb-aacd-ea13ec402212.png)
3.	phpMyAdmin will open in the browser. Go to User Accounts and create a new user. Give the user all privileges like test user shown below.
For simplicity in future steps, create user with the following credentials.
Username: test
Password: test123
![image](https://user-images.githubusercontent.com/64710994/174628570-ec977687-5b8e-47de-add5-492a8e02f557.png)
4.	Go to the location of xampp folder on your PC then, go to htdocs folder. Download the project code here and extract the folder.
5.	Skip this step if you created the new user with the credentials mentioned above. Open the config file and change the username and password to the username and password you created. Then, open each php page and change the username and password as well. 
6.	Open the databse folder and run the databse.exe application. This will populate the database of MH Blossoms.
![image](https://user-images.githubusercontent.com/64710994/174628592-357b1ea7-5991-4a9f-9581-039e79ad8bf9.png)
7.	Now, everything is set up. To open the project, type http://localhost/MHBlossoms/home/home.php in your browser. The homepage should open. 
