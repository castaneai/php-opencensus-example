# php-opencensus-example

## Usage

```sh
$ docker-compose up -d
$ docker-compose run php composer install
$ curl http://localhost:8080

hello
[  1053.83 ms] /
  [http.status_code] 200
  [http.host] localhost:8080
  [http.port] 80
  [http.method] GET
  [http.path] /
  [http.user_agent] curl/7.54.0
[  1000.48 ms] test-span
```

## Tips: Using [Stackdriver Trace](https://cloud.google.com/trace)

Open `php/index.php` and change exporter

```diff
- use OpenCensus\Trace\Exporter\OneLineEchoExporter; 
+ use OpenCensus\Trace\Exporter\StackdriverExporter; 

- $exporter = new OneLineEchoExporter();
+ $exporter = new StackdriverExporter();
```


Set `GOOGLE_APPLICATION_CREDENTIALS` env variable a path of JSON key of GCP service account which has **Cloud Trace Agent** role

```sh
$ export GOOGLE_APPLICATION_CREDENTIALS=/path/to/key.json
```

Open `docker-compose.yml` and add volume mount of JSON key file

```diff
     volumes:
       - ./php:/src
+      - ${GOOGLE_APPLICATION_CREDENTIALS}:/key.json:ro
```

Restart docker-compose containers

```sh
$ docker-compose down && docker-compose up -d
$ curl http://localhost:8080
```
