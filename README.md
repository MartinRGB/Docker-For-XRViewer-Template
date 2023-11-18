# Brief

This is a template for localhost docker development & test

install `mkcert` first

- `choco install mkcert`(win)
- `brew install mkcert`(mac)
- `sudo apt-get install mkcert`(linux)

## xrviewer-zfile

1. create ur own CA(optinal) & save to ./proxy/certs

    ```mkcert zfile.xrviewer.com localhost 127.0.0.1 <Your Docker/Server IP Address> ::1```

    Install the local CA in the system trust store.

    ```mkcert -install```

2. add these to host(optional) && change `./proxy/conf/nginx.conf` 's `server_name`

    ```server_name zfile.xrviewer.com localhost 127.0.0.1 <Your Docker/Server Address>;```

3. change `./proxy/conf/nginx.conf` 's `proxy_pass` to ur physical ip & port(same port in `docker-compose.yml`)

    ```proxy_pass http://<Your Docker/Server Address>:8555/;```

4. setup
    ```docker-compose up -d```

5. 本地存储 -> 文件路径 `/root/zfile/figma`

reference -> https://www.howtoforge.com/how-to-create-locally-trusted-ssl-certificates-with-mkcert-on-ubuntu/

## xrviewer-nginx-ssl-service

1. create ur own CA(optinal) & save to ./proxy/certs

    ```mkcert xrviewer-nginx-ssl.service.com localhost 127.0.0.1 <Your Docker/Server Address> ::1```

    Install the local CA in the system trust store.

    ```mkcert -install```

2. add these to host(optional) && change `./proxy/conf/nginx.conf` 's `server_name`

    ```server_name xrviewer-nginx-ssl.service.com localhost 127.0.0.1 <Your Docker/Server Address>;```

3. change `./proxy/conf/nginx.conf` 's `proxy_pass` to ur physical ip & port(same port in `docker-compose.yml`)

    ```proxy_pass http://<Your Docker/Server Address>:8222/;```

4. setup
    ```docker-compose up -d```
    
