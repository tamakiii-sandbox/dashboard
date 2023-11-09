FROM flyway/flyway:6.5.1 AS production-pseudo

USER root

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      make \
      && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

USER flyway

# --

FROM production-pseudo AS development

USER root

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      mysql-client \
      && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

USER flyway

# --

FROM development AS debug
