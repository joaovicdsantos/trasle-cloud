<p align="center"> <img alt="Trasle-Cloud Logo" src="https://i.ibb.co/qkBbF05/Trasle.png" height=150> </p>

<h1 align="center">Trasle-Cloud</h1>
Trasle-Cloud is simply an experimental cloud service that anyone can use. It is hosted on a server that is perhaps not very reliable and is therefore recommended for testing. Its use is extremely simple and without bureaucracy to facilitate the work of any developer.


### Running Project
To run the project you need to have a __php server__ installed (WAMP, LAMP, XAMPP, EasyPHP) and the __composer__ installed on your machine. In addition, it is necessary to create an __.env file__ in the /lib folder for sending emails. To do this, consult the sample file located in the same folder.

```console
trasle@cloud:~$ composer install # for install all packages
```

### API Usage
#### Register
Following the entire project proposal, use is also simple. You must first register a user on the server. This must be done through a request to __/api/v1/user/register__ passing a JSON like this:
```json
{
  "username": "username",
  "full_name": "Name",
  "company": "company-name",
  "email": "email@email.com"
}
```
You will receive the API_KEY and the directory you must use as a response. But don't worry about writing this data down, as it is sent to your email.
#### Upload Files
To upload the files, it is necessary to send the files and API_KEY with the form-data format to __/api/v1/file/upload__. For example:
<p align="center"> <img alt="Request Example" src="https://i.ibb.co/F0vt8t0/exemplo-request.png" height=350> </p>
The return will be a json with the name of the files sent and the directory where they were saved. Making it easier to save the image path in the database.
