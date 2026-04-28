#!/bin/bash
echo "=== Starting Laravel on Azure App Service ==="

# Apply custom nginx config
cp /home/site/wwwroot/default /etc/nginx/sites-available/default 2>/dev/null || true
cp /home/site/wwwroot/default /etc/nginx/sites-enabled/default 2>/dev/null || true

nginx -t && service nginx reload

echo "=== Laravel nginx config applied ==="