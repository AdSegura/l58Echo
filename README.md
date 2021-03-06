# Laravel 5.8, Echo Server, Echo Client, Socket Io, Redis

Proof of concept, Laravel Chat App with PresenceChannels, using Echo Server as SocketIo server all connected with Redis.

Frontend use Vue and Vue-Router.

This is the flow when a user authenticate within Laravel App and then with Echo Server.

Once authenticated, user can send a private message to another authenticated user.

![Auth Flow, Message Flow](flow.png)

# Mini Howto
#### Create new project
> laravel new l58-EchoServer
#### install predis
> composer require predis/predis
#### install passport
> composer require laravel/passport
#### install Laravel Echo Server
> npm install -g laravel-echo-server
#### install io, echo clients and vue-router
> npm install --save socket.io-client laravel-echo vue-router

#### install npm deps
> npm i

#### configure env file
> vim .env
- database
- redis
- session

#### Create Mysql Database
> CREATE DATABASE l58echo CHARACTER SET utf8 COLLATE utf8_general_ci;

#### Enable Auth
> php artisan make:auth

> php artisan migrate

> php artisan passport:install
```
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client secret: qw02adExQHk1YQoBSdxRIYmBrcJ663Y69m6bygE3
Password grant client created successfully.
Client ID: 2
Client secret: iVpG318MlLyQI1CAScjsTePP71POsrVqwAYw4heR
```
#### Configure Passport
> Add the Laravel\Passport\HasApiTokens trait to your App\User model. 

> Add Passport::routes method within the boot method of your AuthServiceProvider

> Edit config/auth.php Api driver should be passport and delete 'hash' => false

> Edit providers/BroadcastServiceProvider.php Broadcast::routes(['middleware' => ['auth:api']]);


#### Generate Passport keys
> php artisan passport:keys

#### Configure Broadcasting
Uncomment this provider in the providers array of your config/app.php
> App\Providers\BroadcastServiceProvider::class

#### Configure Laravel Echo Server
```
laravel-echo-server init
```
Will create laravel-echo-server.json file, heads up with Cors configuration.

_In **config/database.php** disable prefix for redis.
https://github.com/laravel/echo/issues/232#issuecomment-496278389_

##### Start Echo Server
```
laravel-echo-server start
```

#### make Two New Events
> php artisan make:event ControlChannelEvent
> php artisan make:event ChatMessageEvent

#### Fire events from Tinker
> broadcast(new App\Events\NewChatEvent($user, 'My Message'))
Above command will not fire the event until __destruct method is called

> broadcast(new App\Events\NewChatEvent($user, 'My Message'))->__destruct()

With event() it get fired without need to call extra methods
> event(new App\Events\NewChatEvent($user, 'My Message'))

#### Monitor Redis
> redis-cli -h redis.local monitor

How to issue Bearer Token
> $user->createToken('Token Name')->accessToken;
