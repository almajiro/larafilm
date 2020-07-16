FROM nginx:stable-alpine
LABEL maintainer="Kuroki Almajiro <kuroki@almajiro.net"

ARG APP_UID
ARG APP_GID
ARG APP_DIR="/usr/local/share/larafilm"

RUN addgroup -g ${APP_GID} app && \
    adduser -s /sbin/nologin -D -u ${APP_UID} -G app app

RUN mkdir -p ${APP_DIR} && chown app:app ${APP_DIR}

USER ${APP_UID}
WORKDIR ${APP_DIR}
