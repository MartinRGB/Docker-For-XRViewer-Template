# Brief

This is a template for localhost docker development & test

install `mkcert` first

- `choco install mkcert`(win)
- `brew install mkcert`(mac)

make sure docker is installed,then get docker's ip address:

windows:

<img src="https://github.com/MartinRGB/Docker-For-XRViewer-Template/assets/7036706/52261f75-eee8-4143-905d-6fae8c2a640d" width="50%" height="50%">

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

5. <img src="https://github.com/MartinRGB/Docker-For-XRViewer-Template/assets/7036706/5c915623-16c5-432c-bf9d-208eff538832" width="50%" height="50%">

6. 本地存储 -> 文件路径 `/root/zfile/figma`
  
    <img src="https://github.com/MartinRGB/Docker-For-XRViewer-Template/assets/7036706/9aeaf9ac-451b-46a5-b8a3-654e10d66fd1" width="50%" height="50%">


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

5. site will be like this   

   <img src="https://github.com/MartinRGB/Docker-For-XRViewer-Template/assets/7036706/c4e0c20d-8de8-4e42-a58e-ce1cc4c86c62" width="50%" height="50%">
    
