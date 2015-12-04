# Laravel Administration Theme for Filomedios

## Installation

First copy all but if this doesn't work follow the instructions below.

1. Clone this project or Download that ZIP file
2. Make sure you have bower, gulp and npm installed globally
3. On the command prompt run the following commands
- cd `project-directory`
- Set permission 777 for storage
- `composer install`
- `npm install`
- `bower install`
- `gulp watch`
- `php artisan cache:clear`

If this doesn't work please send me a message.


#IMPORTANT FOR INSTALLATION

-Configure the next variables in the php.ini file

	upload_max_filesize 5000M
	post_max_size 5000M
	max_input_time -1
	max_execution_time -1

-Uncomment extension=php_fileinfo.dll from the PHP.ini file