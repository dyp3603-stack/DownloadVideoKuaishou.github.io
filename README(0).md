# Backend API

Deploy this PHP folder to HTTPS hosting that supports PHP.

Endpoint:
POST /api/resolve

JSON:
{"url":"https://www.kuaishou.com/..."}

Expected successful response:
{
  "title":"Example video",
  "thumbnail":"https://...",
  "duration":"00:20",
  "download_url":"https://..."
}

This starter intentionally does not include code for bypassing DRM, VIP access, authentication, or other access controls. Replace the resolver section with an authorized API/service that you are permitted to use.
