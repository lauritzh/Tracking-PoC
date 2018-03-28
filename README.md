# Tracking-POC
This Repository contains short Implementations to study Browser Behaviour, regarding Caching HTTP Redirects (Moved Permanently 301) and localStorage-Objects.

Idea (Redirect):   Client asks for Source test.php. Server responds with 301 and redirects to test.php?id=TRACKING. 
        Browser chaches Redirect and asks for Ressource with unique Tracking ID instead (everytime test.php is embedded as iFrame e.g.).
Idea (localStorage):    Create Storage Element (Tracking Key), check if key is existent - otherwise create new key.
