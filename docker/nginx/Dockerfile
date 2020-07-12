FROM nginx:1.19.1 as production-pseudo

COPY ./default.conf /etc/nginx/conf.d/default.conf

# --

FROM production-pseudo as development

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      procps \
      dnsutils \
      less \
      && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# --

FROM development as debug

CMD ["nginx-debug", "-g", "daemon off;"]

