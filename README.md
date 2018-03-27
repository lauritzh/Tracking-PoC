# Tracking-POC
This is a short Implementation in order to study Browser Behaviour regarding Caching HTTP Redirects (Moved Permanently 301).

Idea:   Client asks for Source test.php. Server responds with 301 and redirects to test.php?id=TRACKING. 
        Browser chaches Redirect and asks for Ressource with unique Tracking ID instead (everytime test.php is embedded as iFrame e.g.).
