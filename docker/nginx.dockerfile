FROM nginx:stable-alpine

# Environment arguments
ARG UID=1000
ARG GID=1000
ARG USER=nginxuser

ENV UID=${UID}
ENV GID=${GID}
ENV USER=${USER}

# Remove conflicting dialout group
RUN delgroup dialout

# Creating user and group
RUN addgroup -g ${GID} --system ${USER}
RUN adduser -G ${USER} --system -D -s /bin/sh -u ${UID} ${USER}

# Modify nginx configuration to use the new user's privileges
RUN sed -i "s/user nginx/user '${USER}'/g" /etc/nginx/nginx.conf

# Copies nginx configurations to override the default
ADD ./nginx/*.conf /etc/nginx/conf.d/

# Make html directory
RUN mkdir -p /var/www/html
