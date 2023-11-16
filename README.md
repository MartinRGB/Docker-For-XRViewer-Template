# Brief

This is a template for localhost docker development & test

install `mkcert` first

- `choco install mkcert`(win)
- `brew install mkcert`(mac)

## Docker-HTTPS-ZFile

1. create ur own CA(optinal) & save to ./proxy/certs

    ```mkcert zfile.example.com localhost 127.0.0.1 <Your IPv4 Address> ::1```

    Install the local CA in the system trust store.

    ```mkcert -install```

2. add these to host(optional) && change `./proxy/conf/nginx.conf` 's `server_name`

    ```server_name zfile.example.com localhost 127.0.0.1 <Your IPv4 Address>;```

3. change `./proxy/conf/nginx.conf` 's `proxy_pass` to ur physical ip & port(same port in `docker-compose.yml`)

    ```proxy_pass http://<Your IPv4 Address>:8555/;```

4. setup
    ```docker-compose up -d```

5. 本地存储 -> 文件路径 `/root/zfile/data`

reference -> https://www.howtoforge.com/how-to-create-locally-trusted-ssl-certificates-with-mkcert-on-ubuntu/

## Docker-Https-Nginx-Service-1

1. create ur own CA(optinal) & save to ./proxy/certs

    ```mkcert zfile.example.com localhost 127.0.0.1 <Your IPv4 Address> ::1```

    Install the local CA in the system trust store.

    ```mkcert -install```

2. add these to host(optional) && change `./proxy/conf/nginx.conf` 's `server_name`

    ```server_name zfile.example.com localhost 127.0.0.1 <Your IPv4 Address>;```

3. change `./proxy/conf/nginx.conf` 's `proxy_pass` to ur physical ip & port(same port in `docker-compose.yml`)

    ```proxy_pass http://<Your IPv4 Address>:8555/;```

4. setup
    ```docker-compose up -d```
    
