# Jester

![Jester](Jester-Hat-Icon-200px.png)

Jester is a simple mp3 server to host funny sounds to that can be played with
your CI server.  You can setup your CI server to announce success and
failure on your code builds.

## Requirements

* [docker](https://www.docker.com/products/overview)
* [docker-compose](https://docs.docker.com/compose/install/)
* MP3 files of funny sounds/sayings

## Usage

In order to use the jester server you will need to change this line in
the `docker-compose.prod.yml` file:

```
    - "/media/data1/sounds/:/app/sounds/"
```

It should match the directory on your server/machine that you are
running docker on.

### Running the jester server

To run the jester server run the following in a terminal.
```
docker-compose -f docker-compose.prod.yml up -d
```

### Play sounds

To test the server is working simply put the following in a browser.

http://&lt;ip of jester server&gt;:30000/random.mp3

#### For successful sounds

http://&lt;ip of jester server&gt;:30000/success/random.mp3

#### For failure sounds

http://&lt;ip of jester server&gt;:30000/failure/random.mp3

## Development

To run jester in development run the following from a terminal.

```
docker-compose up -d
```
